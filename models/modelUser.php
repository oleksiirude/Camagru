<?php

	class modelUser extends componentModel {
		public $result = true;

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

			if (isset($request['login'])) {
				if (!preg_match($patternLogin, $_POST['login']))
					return 'Login field is not valid!';
			}
			elseif (isset($request['email'])) {
				if (!preg_match($patternEmail, $_POST['email']))
					return 'Email field is not valid!';
			}
			elseif (isset($request['password'])) {
				if (!preg_match($patternPassword, $_POST['password']))
					return 'Password field is not valid!';
			}
			elseif (isset($request['confirm'])) {
				if ($_POST['password'] !== $_POST['confirm'])
					return 'Confirm field is not valid!';
			}
			return true;
		}

		//checks for login and/or password exist in database
		private function validateIfExistsInDb() {

			$query = [':login' => $_POST['login'], ':email' => $_POST['email']];
			$sth = $this->prepare('SELECT login FROM users WHERE login = :login OR email = :email');
			$sth->execute($query);
			$result = $sth->fetchAll(self::FETCH_ASSOC);
			if (!$result)
				return true;
			return 'Login or email is already taken!';
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
			elseif (($result = self::validateIfExistsInDb()) !== true)
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
			$sth = $this->prepare("SELECT login, password, confirm FROM users WHERE login = :login");
			$sth->execute([':login' => $_POST['login']]);
			$result = $sth->fetch(self::FETCH_ASSOC);
			if (!$result || !password_verify($_POST['password'], $result['password'])
				|| $result['confirm'] !== '1')
				return 'Incorrect login or password!';
			$_SESSION['user_logged'] = $_POST['login'];
			return true;
		}

		//PASSWORD CHANGE
		//do all necessary checks before changing password
		public function validateChangePasswordIntention() {

			$request = [
				['login' => true],
				['email' => true],
			];

			if (($result = self::validateIsFullFields($request)) !== true)
				return $result;
			$query = [':login' => $_POST['login'], ':email' => $_POST['email']];
			$sth = $this->prepare('SELECT confirm FROM users 
												WHERE login = :login AND email = :email');
			$sth->execute($query);
			$result = $sth->fetch(self::FETCH_ASSOC);
			if ($result['confirm'] === '1')
				return true;
			return 'Nonexistent login or email!';
		}

		//checks input changing password data and if ok changes password
		public function validateChangePasswordData() {
			$request = [
				'password' => true,
				'confirm' => true
			];

			$id = $_SESSION['id_change_password'];
			if (($result = self::validateIsFullFields($request)) !== true)
				return $result;
			elseif (($result = self::validateInputData($request)) !== true)
				return $result;

			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$this->query("UPDATE users SET token = '', password = '$password' 
										WHERE users.id = '$id'");
			unset($_SESSION['id_change_password']);
			return true;
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
				$_SESSION['id_change_password'] = $result['id'];
				return true;
			}
			return false;
		}

		//LOGIN CHANGE
		//EMAIL CHANGE

}