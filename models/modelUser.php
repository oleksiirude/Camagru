<?php

	class modelUser extends componentModel {
		public $result = true;

		public function validateData() {

			if (($result = $this->validateIsFull()) !== true)
				return $result;
			elseif (($result = $this->validateInputData()) !== true)
				return $result;
			elseif (($result = $this->validateIfExistsInDb()) !== true)
				return $result;
			return $this->result;
		}

		private function validateIsFull() {

			$_POST['login'] = trim($_POST['login']);
			$_POST['email'] = trim($_POST['email']);
			$_POST['password'] = trim($_POST['password']);
			$_POST['confirm'] = trim($_POST['confirm']);

			if (empty($_POST['login']))
				$this->result = 'Login field is empty!';
			elseif (empty($_POST['email']))
				$this->result = 'Email field is empty!';
			elseif (empty($_POST['password']))
				$this->result = 'Password field is empty!';
			elseif (empty($_POST['confirm']))
				$this->result = 'Confirm field is empty!';
			return $this->result;
		}

		private function validateInputData() {

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

		private function validateIfExistsInDb() {

			$query = [':login' => $_POST['login'], ':email' => $_POST['email']];
			$sth = $this->prepare('SELECT login FROM users WHERE login = :login OR email = :email');
			$sth->execute($query);
			$result = $sth->fetchAll(self::FETCH_ASSOC);
			if (!$result)
				return true;
			return 'Login or password are already taken!';
		}
	}
