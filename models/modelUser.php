<?php

	class modelUser extends componentModel {

		//REGULAR INPUT DATA CHECKS
		//checks fields filling (depends on $request array)
		private function validateIsFullFields($request) {
			if (isset($request['login'])) {
				$_POST['login'] = trim($_POST['login']);
				if (empty($_POST['login']))
					return 'Login field is empty!';
			}
			if (isset($request['email'])) {
				$_POST['email'] = trim($_POST['email']);
				if (empty($_POST['email']))
					return 'Email field is empty!';
			}
			if (isset($request['password'])) {
				$_POST['password'] = trim($_POST['password']);
				if (empty($_POST['password']))
					return 'Password field is empty!';
			}
			if (isset($request['confirm'])) {
				$_POST['confirm'] = trim($_POST['confirm']);
				if (empty($_POST['confirm']))
					return 'Confirm field is empty!';
			}
			return true;
		}

		//checks if input data is corresponds to requirements
		private function validateInputData($request) {

			$patternLogin = '/^[a-zA-Z]{3,8}\d{0,2}$/';
			$patternEmail = '/^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/';
			$patternPassword = '/^(?=.*[A-Z]{1,})(?=.*[!@#$&*-]{1,})(?=.*[0-9]{1,})(?=.*[a-z]{1,}).{8,}$/';

			if (isset($request['login']))
				if (!preg_match($patternLogin, $_POST['login']))
					return 'Login field is not valid!';
			if (isset($request['email']))
				if (!preg_match($patternEmail, $_POST['email']))
					return 'Email field is not valid!';
			if (isset($request['password']))
				if (!preg_match($patternPassword, $_POST['password']))
					return 'Password field is not valid!';
			if (isset($request['confirm']))
				if ($_POST['password'] !== $_POST['confirm'])
					return 'Confirm field is not valid!';
			return true;
		}

		//checks for login and/or email exist in database
		private function validateIfExistsInDb($request) {

			if ($request === 'check_login') {
				$pseudo = [':login' => $_POST['login']];
				$query = 'SELECT login FROM users WHERE login = :login';
				$error = 'This login is already taken!';
			}
			elseif ($request === 'check_email') {
				$pseudo = [':email' => $_POST['email']];
				$query = 'SELECT email FROM users WHERE email = :email';
				$error = 'This email is already taken!';
			}
			elseif ($request === 'check_both') {
				$pseudo = [':login' => $_POST['login'], ':email' => $_POST['email']];
				$query = 'SELECT login FROM users WHERE login = :login OR email = :email';
				$error = 'Login or email is already taken!';
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
		public function validateRegistrationData() {

			$request = [
				'login' => true,
				'email' => true,
				'password' => true,
				'confirm' => true
			];

			if (($result = self::validateIsFullFields($request)) !== true)
				return $result;
			elseif (($result = self::validateInputData($request)) !== true)
				return $result;
			elseif (($result = self::validateIfExistsInDb('check_both')) !== true)
				return $result;
			return true;
		}

		//inserts valid registration data into database
		public function insertValidRegistrationDataInDb($token) {

			$login = $_POST['login'];
			$email = $_POST['email'];
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
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
		public function validateInputLoginData() {

			$request = [
				['login' => true],
				['password' => true],
			];

			if ($result = self::validateIsFullFields($request) !== true)
				return $result;
			$sth = $this->prepare("SELECT login, email, password, confirm FROM users WHERE login = :login");
			$sth->execute([':login' => $_POST['login']]);
			$result = $sth->fetch(self::FETCH_ASSOC);
			if (!$result || !password_verify($_POST['password'], $result['password'])
				|| $result['confirm'] !== '1')
				return 'Incorrect login or password!';
			$_SESSION['user_logged'] = $_POST['login'];
			$_SESSION['email'] = $result['email'];
			return true;
		}

		//PASSWORD RECOVERY
		//do all necessary checks before recovering password
		public function validateRecoverPasswordIntention() {

			$request = [
				['login' => true],
				['email' => true],
			];

			if (($result = self::validateIsFullFields($request)) !== true)
				return $result;
			$pseudo = [':login' => $_POST['login'], ':email' => $_POST['email']];
			$sth = $this->prepare('SELECT confirm FROM users 
												WHERE login = :login AND email = :email');
			$sth->execute($pseudo);
			$result = $sth->fetch(self::FETCH_ASSOC);
			if ($result['confirm'] === '1')
				return true;
			return 'Nonexistent login or email!';
		}

		public function insertTokenInDb($token) {
			$login = $_POST['login'];
			$email = $_POST['email'];

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
		public function validateRecoverPasswordData() {
			$request = [
				'password' => true,
				'confirm' => true
			];

			$id = $_SESSION['id_recover_password'];
			if (($result = self::validateIsFullFields($request)) !== true)
				return $result;
			elseif (($result = self::validateInputData($request)) !== true)
				return $result;

			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$this->query("UPDATE users SET token = '', password = '$password' 
										WHERE users.id = '$id'");
			unset($_SESSION['id_recover_password']);
			return true;
		}

		//PASSWORD CHANGE
		private function validateSetNewPasswordIntension() {

			$request = [
				'password' => true,
				'confirm' => true
			];

			if (($result = self::validateIsFullFields($request)) !== true)
				return $result;
			elseif (($result = self::validateInputData($request)) !== true)
				return $result;
			return true;
		}

		public function setNewPassword() {
			if (($result = $this->validateSetNewPasswordIntension()) !== true)
				return $result;
			$login = $_SESSION['user_logged'];
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$this->query("UPDATE users SET password = '$password' 
										WHERE users.login = '$login'");
			return true;
		}

		//EMAIL CHANGE
		private function validateChangeEmailIntension() {

			$request = ['email' => true];

			if (($result = self::validateIsFullFields($request)) !== true)
				return $result;
			elseif (($result = self::validateInputData($request)) !== true)
				return $result;
			elseif (($result = self::validateIfExistsInDb('check_email')) !== true)
				return $result;
			return true;
		}

		public function changeEmail() {

			if (($result = $this->validateChangeEmailIntension()) !== true)
				return $result;
			$login = $_SESSION['user_logged'];
			$new_email = $_POST['email'];
			$this->query("UPDATE users SET email = '$new_email' 
										WHERE users.login = '$login'");
			$_SESSION['email'] = $new_email;
			return true;
		}

		//LOGIN CHANGE
		private function validateChangeLoginIntension() {

			$request = ['login' => true];

			if (($result = self::validateIsFullFields($request)) !== true)
				return $result;
			elseif (($result = self::validateInputData($request)) !== true)
				return $result;
			elseif (($result = self::validateIfExistsInDb('check_login')) !== true)
				return $result;
			return true;
		}

		public function changeLogin() {

			if (($result = $this->validateChangeLoginIntension()) !== true)
				return $result;
			$old_login = $_SESSION['user_logged'];
			$new_login = $_POST['login'];
			$this->query("UPDATE users SET login = '$new_login' 
										WHERE users.login = '$old_login'");
			$_SESSION['user_logged'] = $new_login;
			return true;
		}
}