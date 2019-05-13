<?php

	class modelUser extends componentModel {
		public $result = true;

		//checks all input registration data from user
		public function validateRegistrationData() {

			$request = [
				['login' => true],
				['email' => true],
				['password' => true],
				['confirm' => true]
			];

			if (($result = self::validateIsFullFields($request)) !== true)
				return $result;
			elseif (($result = self::validateInputRegistrationData()) !== true)
				return $result;
			elseif (($result = self::validateIfExistsInDb()) !== true)
				return $result;
			return true;
		}

		//checks fields filling (depends on $request array)
		private function validateIsFullFields($request) {
			if (isset($request['login'])) {
				$_POST['login'] = trim($_POST['login']);
				if (empty($_POST['login']))
					return 'Login field is empty!';
			}
			if (isset($request['email'])) {
				if (empty($_POST['email']))
					return 'Password field is empty!';
			}
			if (isset($request['password'])) {
				if (empty($_POST['password']))
				return 'Password field is empty!';
			}
			if (isset($request['confirm'])) {
				if (empty($_POST['confirm']))
					return 'Confirm field is empty!';
			}
			return true;
		}

		//checks if login and password fields is not empty
		private function validateIsFullLoginPassword() {
			$_POST['login'] = trim($_POST['login']);
			$_POST['password'] = trim($_POST['password']);

			if (empty($_POST['login']))
				$this->result = 'Login field is empty!';
			elseif (empty($_POST['password']))
				$this->result = 'Password field is empty!';
			return $this->result;
		}

		//checks if input data is corresponds to requirements
		private function validateInputRegistrationData() {

			$patternLogin = '/^[a-zA-Z]{3,8}\d{0,2}$/';
			$patternEmail = '/^[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/';
			$patternPassword = '/^(?=.*[A-Z]{1,})(?=.*[!@#$&*-]{1,})(?=.*[0-9]{1,})(?=.*[a-z]{1,}).{8,}$/';

			if (!preg_match($patternLogin, $_POST['login']))
				$this->result = 'Login field is not valid!';
			elseif (!preg_match($patternEmail, $_POST['email']))
				$this->result = 'Email field is not valid!';
			elseif (!preg_match($patternPassword, $_POST['password']))
				$this->result = 'Password field is not valid!';
			elseif ($_POST['password'] !== $_POST['confirm']) {
				$this->result = 'Passwords do not match!'; }
			return $this->result;
		}

		//checks for login and password existence in database
		private function validateIfExistsInDb() {

			$query = [':login' => $_POST['login'], ':email' => $_POST['email']];
			$sth = $this->prepare('SELECT login FROM users WHERE login = :login OR email = :email');
			$sth->execute($query);
			$result = $sth->fetchAll(self::FETCH_ASSOC);
			if (!$result)
				return true;
			return 'Login or password are already taken!';
		}

		//checks if token is valid, if true confirms account
		public function confirmRequest($token) {

			$sth = $this->prepare("SELECT id, token FROM users WHERE token = '$token'");
			$sth->execute();
			$result = $sth->fetch(self::FETCH_ASSOC);
			if (!$result)
				return false;
			$id = $result['id'];
			$this->query("UPDATE users SET token = '', confirm = '1' WHERE users.id = '$id'");
			return true;
		}

		//inserts valid registration data into database
		public function insertValidDataToDb($token) {

				$login = $_POST['login'];
				$email = $_POST['email'];
				$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
				$this->query("INSERT INTO users(login, email, password, token) 
										VALUES ('$login', '$email', '$password', '$token')");
		}

		public function validateInputLoginData() {

			$request = [
				['login' => true],
				['password' => true],
			];

			if ($result = self::validateIsFullFields($request) !== true)
				return $result;

			$sth = $this->prepare("SELECT login, password, confirm FROM users WHERE login = :login");
			$sth->execute([':login' => $_POST['login']]);
			$result = $sth->fetch(self::FETCH_ASSOC);
			if (!$result || !password_verify($_POST['password'], $result['password'])
				|| $result['confirm'] !== '1')
				return 'Incorrect login or password!';
			return true;
		}

		public function validateRecoverData() {

			$request = [
				['login' => true],
				['email' => true],
			];

			if (($result = self::validateIsFullFields($request)) !== true)
				return $result;
			$query = [':login' => $_POST['login'], ':email' => $_POST['email']];
			$sth = $this->prepare('SELECT id FROM users WHERE login = :login AND email = :email');
			$sth->execute($query);
			$result = $sth->fetch(self::FETCH_ASSOC);
			if ($result)
				return $result['id'];
			return 'Nonexistent login or email!';

	}
}