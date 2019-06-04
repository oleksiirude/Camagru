<?php

	class modelUser extends componentModel {

		//REGULAR INPUT DATA CHECKS
		//checks fields filling (depends on $request array)
		private function validateIsFullFields($request, $post) {

			if (isset($request['login'])) {
				$post['login'] = trim($post['login']);
				if (empty($post['login']))
					return ['id' => 'login', 'warning' => 'login field is empty'];
			}
			if (isset($request['email'])) {
				$post['email'] = trim($post['email']);
				if (empty($post['email']))
					return ['id' => 'email', 'warning' => 'email field is empty'];
			}
			if (isset($request['password'])) {
				$post['password'] = trim($post['password']);
				if (empty($post['password']))
					return ['id' => 'password', 'warning' => 'password field is empty'];
			}
			if (isset($request['confirm'])) {
				$post['confirm'] = trim($post['confirm']);
				if (empty($post['confirm']))
					return ['id' => 'confirm', 'warning' => 'confirm field is empty'];
			}
			return true;
		}

		//checks if input data is corresponds to requirements
		private function validateInputData($request, $post) {

			$patternLogin = '/^[a-zA-Z]{3,8}\d{0,2}$/';
			$patternEmail = '/^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/';
			$patternPassword = '/^(?=.*[A-Z]{1,})(?=.*[!@#$&*-]{1,})(?=.*[0-9]{1,})(?=.*[a-z]{1,}).{8,}$/';

			if (isset($request['login']))
				if (!preg_match($patternLogin, $post['login']))
					return ['id' => 'login', 'warning' => 'login field is not valid'];
			if (isset($request['email']))
				if (!preg_match($patternEmail, $post['email']))
					return ['id' => 'email', 'warning' => 'email field is not valid'];
			if (isset($request['password']))
				if (!preg_match($patternPassword, $post['password']))
					return ['id' => 'password', 'warning' => 'password field is not valid'];
			if (isset($request['confirm']))
				if ($post['password'] !== $post['confirm'])
					return ['id' => 'confirm', 'warning' => 'passwords do not match'];
			return true;
		}

		//checks for login and/or email exist in database
		private function validateIfExistsInDb($request, $post) {

			if ($request === 'check_login') {
				$pseudo = [':login' => $post['login']];
				$query = 'SELECT login FROM users WHERE login = :login';
				$error = ['id' => 'login', 'warning' => 'this login is already taken'];
			}
			elseif ($request === 'check_email') {
				$pseudo = [':email' => $post['email']];
				$query = 'SELECT email FROM users WHERE email = :email';
				$error = ['id' => 'email', 'warning' => 'this email is already taken'];
			}
			elseif ($request === 'check_both') {
				$pseudo = [':login' => $post['login'], ':email' => $post['email']];
				$query = 'SELECT login FROM users WHERE login = :login OR email = :email';
				$error = ['id' => 'menu', 'warning' => 'login or/and email are already taken'];
			}
			$sth = $this->prepare($query);
			$sth->execute($pseudo);
			$result = $sth->fetchAll(self::FETCH_ASSOC);
			if (!$result)
				return true;
			return $error;
		}


		//REGISTRATION
		//checks input registration data from user
		public function validateRegistrationData($post) {

			$request = [
				'login' => true,
				'email' => true,
				'password' => true,
				'confirm' => true
			];

			if (($result = self::validateIsFullFields($request, $post)) !== true)
				return $result;
			elseif (($result = self::validateInputData($request, $post)) !== true)
				return $result;
			elseif (($result = self::validateIfExistsInDb('check_both', $post)) !== true)
				return $result;
			return true;
		}

		//inserts valid registration data into database
		public function insertValidRegistrationDataInDb($token, $post) {

			$login = $post['login'];
			$email = $post['email'];
			$password = password_hash($post['password'], PASSWORD_BCRYPT);
			$this->query("INSERT INTO users(login, email, password, token) 
										VALUES ('$login', '$email', '$password', '$token')");
		}

		//checks if token is valid, if true confirms account
		public function confirmRegistrationRequest($token) {

			$sth = $this->prepare("SELECT id, token FROM users WHERE token = '$token'");
			$sth->execute();
			$result = $sth->fetch(self::FETCH_ASSOC);
			if (!$result)
				return false;
			$id = $result['id'];
			$this->query("UPDATE users SET token = '', confirm = '1' WHERE users.id = '$id'");
			return true;
		}

		//LOGIN
		public function validateInputLoginData($post) {

			$request = ['login' => true, 'password' => true];

			if (($result = self::validateIsFullFields($request, $post)) !== true)
				return $result;
			$sth = $this->prepare("SELECT id, login, email, password, confirm, avatar FROM users WHERE login = :login");
			$sth->execute([':login' => $post['login']]);
			$result = $sth->fetch(self::FETCH_ASSOC);
			if (!$result || !password_verify($post['password'], $result['password'])
				|| $result['confirm'] !== '1' || $post['login'] !== $result['login'])
				return ['id' => 'menu', 'warning' => 'incorrect login or/and password'];
			$_SESSION['user_id'] = $result['id'];
			$_SESSION['user_logged'] = $post['login'];
			$_SESSION['email'] = $result['email'];
			if ($result['avatar'] === null)
				$_SESSION['avatar'] = false;
			else
				$_SESSION['avatar'] = $result['avatar'];
			return true;
		}

		//PASSWORD RECOVERY
		//do all necessary checks before recovering password
		public function validateRecoverPasswordIntention($post) {

			$request = ['login' => true, 'email' => true,];

			if (($result = self::validateIsFullFields($request, $post)) !== true)
				return $result;
			$pseudo = [':login' => $post['login'], ':email' => $post['email']];
			$sth = $this->prepare('SELECT confirm FROM users 
												WHERE login = :login AND email = :email');
			$sth->execute($pseudo);
			$result = $sth->fetch(self::FETCH_ASSOC);
			if ($result['confirm'] === '1')
				return true;
			return ['id' => 'menu', 'warning' => 'nonexistent login or email'];
		}

		public function insertTokenInDb($token, $post) {
			$login = $post['login'];
			$email = $post['email'];

			$this->query("UPDATE users SET token = '$token' 
										WHERE users.login = '$login' AND users.email = '$email'");
		}

		public function checkTokenInDb($token) {
			$sth = $this->prepare("SELECT id, token FROM users WHERE token = '$token'");
			$sth->execute();
			$result = $sth->fetch(self::FETCH_ASSOC);
			if ($result['token'] === $token) {
				$_SESSION['id_recover_password'] = $result['id'];
				return true;
			}
			return false;
		}

		//checks recovering password input data, if ok recovers password
		public function validateRecoverPasswordData($post) {
			$request = ['password' => true, 'confirm' => true];

			$id = $_SESSION['id_recover_password'];
			if (($result = self::validateIsFullFields($request, $post)) !== true)
				return $result;
			elseif (($result = self::validateInputData($request, $post)) !== true)
				return $result;

			$password = password_hash($post['password'], PASSWORD_BCRYPT);
			$this->query("UPDATE users SET token = '', password = '$password' 
										WHERE users.id = '$id'");
			unset($_SESSION['id_recover_password']);
			return true;
		}

		//PASSWORD CHANGE
		private function validateSetNewPasswordIntention($post) {

			$request = ['password' => true, 'confirm' => true];

			if (($result = self::validateIsFullFields($request, $post)) !== true)
				return $result;
			elseif (($result = self::validateInputData($request, $post)) !== true)
				return $result;
			return true;
		}

		public function setNewPassword($post) {
			if (($result = $this->validateSetNewPasswordIntention($post)) !== true)
				return $result;
			$login = $_SESSION['user_logged'];
			$password = password_hash($post['password'], PASSWORD_BCRYPT);
			$this->query("UPDATE users SET password = '$password' 
										WHERE users.login = '$login'");
			return true;
		}

		//EMAIL CHANGE
		private function validateChangeEmailIntention($post) {

			$request = ['email' => true];

			if (($result = self::validateIsFullFields($request, $post)) !== true)
				return $result;
			elseif (($result = self::validateInputData($request, $post)) !== true)
				return $result;
			elseif (($result = self::validateIfExistsInDb('check_email', $post)) !== true)
				return $result;
			return true;
		}

		public function changeEmail($post) {

			if (($result = $this->validateChangeEmailIntention($post)) !== true)
				return $result;
			$login = $_SESSION['user_logged'];
			$new_email = $post['email'];
			$this->query("UPDATE users SET email = '$new_email' 
										WHERE users.login = '$login'");
			$_SESSION['email'] = $new_email;
			return true;
		}

		//LOGIN CHANGE
		private function validateChangeLoginIntention($post) {

			$request = ['login' => true];

			if (($result = self::validateIsFullFields($request, $post)) !== true)
				return $result;
			elseif (($result = self::validateInputData($request, $post)) !== true)
				return $result;
			elseif (($result = self::validateIfExistsInDb('check_login', $post)) !== true)
				return $result;
			return true;
		}

		public function changeLogin($post) {

			if (($result = $this->validateChangeLoginIntention($post)) !== true)
				return $result;
			$old_login = $_SESSION['user_logged'];
			$new_login = $post['login'];
			$this->query("UPDATE users SET login = '$new_login' 
										WHERE users.login = '$old_login'");
			$_SESSION['user_logged'] = $new_login;
			return true;
		}

		//DELETE ACCOUNT
		public function deleteAccount() {

			$id = $_SESSION['user_id'];
			$this->query("DELETE FROM users WHERE id = '$id'");
		}

		//CHANGE AVATAR

		private function deleteOldAvatar($avatar) {
			$file = ROOT.'views/pictures/avatars/'.$avatar;
			chmod($file, 0755);
			unlink($file);
		}

		public function validateNewAvatar() {
			$filePath = $_FILES['avatar']['tmp_name'];
			$errorCode = $_FILES['avatar']['error'];

			if (($result = componentView::basicPictureChecks($filePath, $errorCode)) !== true)
				return $result;
			$id = $_SESSION['user_id'];
			preg_match("/.*(jpeg|jpg|png)$/i", $_FILES['avatar']['type'], $matches);
			$type = $matches[1];
			$name = $id.'tmp'.'.'.$matches[1];
			$base64 = componentView::resizePic($filePath, $name, $type, 240, 240);
			if (!$base64)
				return ['result' => 'false', 'warning' => 'invalid file!'];
			return $base64;
		}

		public function setNewAvatar($post) {
		$base64 = explode(',', $post['avatar']);
		if (preg_match('~png~', $base64[0]))
			$type = 'png';
		else
			$type = 'jpeg';

		$user = $_SESSION['user_logged'];
		$photo = base64_decode($base64[1]);
		$id = $_SESSION['user_id'];
		$destination = 'views/pictures/avatars/'.$id.'.'.$type;
		file_put_contents($destination, $photo);
		$this->query("UPDATE users SET avatar = '$destination' WHERE users.id = '$id'");
		$this->query("UPDATE comments SET author_avatar = '$destination' WHERE author_id = '$id'");
		$this->query("UPDATE posts SET user_avatar = '$destination' WHERE user = '$user'");
		$_SESSION['avatar'] = $destination;
		return true;
		}

		public function setAvatarDelete() {
			$_SESSION['avatar'] = false;

			$id = $_SESSION['user_id'];
			$user = $_SESSION['user_logged'];
			$avatars = scandir(ROOT.'views/pictures/avatars');
			foreach ($avatars as $avatar)
				if (preg_match("/^$id/", $avatar))
						self::deleteOldAvatar($avatar);
			$this->query("UPDATE users SET avatar = null WHERE users.id = '$id'");
			$this->query("UPDATE comments SET author_avatar = 'views/pictures/avatars/default.png' WHERE author_id = '$id'");
			$this->query("UPDATE posts SET user_avatar = 'views/pictures/avatars/default.png' WHERE user = '$user'");
		}

		//NOTIFICATION
		public function getNotificationsMode() {
			$user = $_SESSION['user_id'];

			$sth = $this->query("SELECT notification FROM users WHERE id = '$user'");
			$result = $sth->fetchAll(self::FETCH_ASSOC);
			if ($result[0]['notification'] === '1')
				$result = true;
			else
				$result = false;
			return $result;
		}

		public function setNotificationsMode($boolean) {
			$user = $_SESSION['user_id'];
			if ($boolean === true)
				$status = '1';
			else
				$status = '0';

			$this->query("UPDATE users SET notification = '$status' WHERE id = '$user'");
		}
}