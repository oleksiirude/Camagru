<?php

	class controllerUser extends componentController {
		private $model;

		public function __construct($route) {
			parent::__construct($route);
			$this->model = new modelUser();
		}

		//REGISTRATION
		public function actionRegister() {
			if(isset($_SESSION['user_logged']))
				componentView::redirect('');
			$this->view->render('Camagru: register');
			return true;
		}
<<<<<<< HEAD

=======
>>>>>>> 0962d104259e37d96cdf89627c5d629e6fbc8ef8
		public function actionRegisterValidate() {

			if (($result = $this->model->validateRegistrationData()) !== true) {
				self::showStatus('Registration error', $result);
				exit;
			}
			$token = md5($_POST['login'].time().$_POST['email']);
			$this->model->insertValidRegistrationDataInDb($token);
			componentMail::sendActivationLink($token);
<<<<<<< HEAD
//			componentView::redirect('user/login');
			self::showStatus('Check your email', 'We have sent the link, check your email!');
			exit;
		}

=======
			componentView::redirect('user/login');
			exit;
		}
>>>>>>> 0962d104259e37d96cdf89627c5d629e6fbc8ef8
		public function actionConfirmRegistration($token) {
			$token = substr($token, 22, 32);
			if ($this->model->confirmRegistrationRequest($token) === true)
				componentView::redirect('user/login');
			else
				componentView::errorHandle(404);
			exit;
		}

		//LOGIN
		public function actionLogin() {
			if(isset($_SESSION['user_logged']))
				componentView::redirect('');
			$this->view->render('Camagru: login');
			return true;
		}
<<<<<<< HEAD

=======
>>>>>>> 0962d104259e37d96cdf89627c5d629e6fbc8ef8
		public function actionLoginValidate() {
			if (($result = $this->model->validateInputLoginData()) !== true) {
				self::showStatus('Login error', $result);
				exit;
			}
			$this->view->redirect('');
		}

		//LOGOUT
		public function actionLogout() {
			if(isset($_SESSION['user_logged'])) {
				unset($_SESSION['user_logged']);
				componentView::redirect('');
			}
		}

		//CHANGE PASSWORD
		public function actionChangePassword() {
			if(isset($_SESSION['user_logged']))
<<<<<<< HEAD
				$this->view->render('Camagru: change password', 'Change password');
			else
				$this->view->render('Camagru: recover password', 'Recover password');
			return true;
		}

		public function actionChangePasswordSendLink() {
			if (($result = $this->model->validateChangePasswordIntention()) !== true) {
				self::showStatus('Change password error', $result);
				exit;
			}
			$token = md5($_POST['login'].time().$_POST['email']);
			$this->model->insertTokenInDb($token);
			componentMail::sendChangePasswordLink($token);
//			componentView::redirect('');
			self::showStatus('Check your email', 'We have sent the link, check your email to change pass!');
		}

		public function actionChangePasswordConfirm($token) {
			$token = substr($token, 29, 32);
			if (($result = $this->model->checkTokenInDb($token)) !== true) {
				componentView::errorHandle(404);
			}
			$this->view->render('Camagru: set new password');
			exit;
		}

		public function actionSetNewPassword() {
			if(!isset($_SESSION['id_change_password']))
				componentView::errorHandle(404);

			if (($result = $this->model->validateChangePasswordData()) !== true) {
				self::showStatus('Change password error', $result);
				exit;
			}
			componentView::redirect('user/login');
		}

		//CHANGE EMAIL

		//CHANGE LOGIN


		//PROFILE
		public function actionProfile() {
			if(!isset($_SESSION['user_logged']))
				componentView::redirect('');
			$_SESSION['profile'] = true;
			$this->view->render('Camagru: my profile');
			return true;
		}

		//STAUS OR ERROR (temporary)
		public function showStatus($title, $result) {
			$this->view->incorrectData($title, $result);
			exit;
=======
				componentView::redirect('');
			$this->view->render('Camagru: change password');
			return true;
		}
		public function actionChangePasswordSendLink() {
			if (($result = $this->model->validateChangePasswordIntention()) !== true) {
				var_dump($result);
				exit;
			}
			$token = md5($_POST['login'].time().$_POST['email']);
			$this->model->insertTokenInDb($token);
			componentMail::sendChangePasswordLink($token);
			componentView::redirect('');
		}
		public function actionChangePasswordConfirm($token) {
			$token = substr($token, 29, 32);
			if (($result = $this->model->checkTokenInDb($token)) !== true) {
				componentView::errorHandle(404);
			}
			$this->view->render('Camagru: set new password');
			exit;
		}
		public function actionSetNewPassword() {
			if(!isset($_SESSION['id_change_password']))
				componentView::errorHandle(404);

			if (($result = $this->model->validateChangePasswordData()) !== true) {
				var_dump($result);
				exit;
			}
			componentView::redirect('user/login');
>>>>>>> 0962d104259e37d96cdf89627c5d629e6fbc8ef8
		}
	}