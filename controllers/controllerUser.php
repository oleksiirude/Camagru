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

		public function actionRegisterValidate() {

			if (($result = $this->model->validateRegistrationData()) !== true) {
				self::showStatus('Registration error', $result);
				exit;
			}
			$token = md5($_POST['login'].time().$_POST['email']);
			$this->model->insertValidRegistrationDataInDb($token);
			componentMail::sendActivationLink($token);
//			componentView::redirect('user/login');
			self::showStatus('Check your email', 'The link has been sent, check your email to activate account!');
			exit;
		}

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

		//PASSWORD RECOVER
		public function actionRecoverPassword() {
			if(isset($_SESSION['user_logged']))
				componentView::redirect('');
			else
				$this->view->render('Camagru: recover password');
			return true;
		}

		public function actionRecoverPasswordSendLink() {
			if (($result = $this->model->validateRecoverPasswordIntention()) !== true) {
				self::showStatus('Recover password error', $result);
				exit;
			}
			$token = md5($_POST['login'].time().$_POST['email']);
			$this->model->insertTokenInDb($token);
			componentMail::sendRecoverPasswordLink($token);
//			componentView::redirect('');
			self::showStatus('Camagru: check your email', 'The link has been sent, check your email to recover password!');
		}

		public function actionRecoverPasswordConfirm($token) {
			$token = substr($token, 30, 32);
			if (($result = $this->model->checkTokenInDb($token)) !== true) {
				componentView::errorHandle(404);
			}
			$this->view->render('Camagru: set new password');
			exit;
		}

		public function actionRecoverSetNewPassword() {
			if(!isset($_SESSION['id_recover_password']))
				componentView::errorHandle(404);

			if (($result = $this->model->validateRecoverPasswordData()) !== true) {
				self::showStatus('Change password error', $result);
				exit;
			}
			componentView::redirect('user/login');
		}

		//CHANGE PASSWORD

		public function actionChangePassword() {
			if(!isset($_SESSION['user_logged']))
				componentView::redirect('');
			else
				$this->view->render('Camagru: change password');
			return true;
		}

		public function actionSetNewPassword() {
			if(!isset($_SESSION['user_logged'])) {
				componentView::errorHandle(404);
			}
			elseif (($result = $this->model->setNewPassword()) !== true) {
				$this->view->showMessage('Something went wrong', $result);
				exit;
			}
			$this->view->showMessage('Password changing', 'Your password has been changed!');

		}
		//CHANGE EMAIL

		public function actionChangeEmail() {
			if(!isset($_SESSION['user_logged']))
				componentView::redirect('');
			$this->view->render('Camagru: change email', 'Change email');
			return true;
		}

		public function actionSetNewEmail() {
			if(!isset($_SESSION['user_logged'])) {
				componentView::errorHandle(404);
			}
			elseif (($result = $this->model->changeEmail()) !== true) {
				$this->view->showMessage('Something went wrong', $result);
				exit;
			}
			componentMail::sendToNewEmail();
			$this->view->showMessage('Email changing', 'Your email has been changed!');
		}
		//CHANGE LOGIN

		public function actionChangeLogin() {
			if(!isset($_SESSION['user_logged']))
				componentView::redirect('');
			$this->view->render('Camagru: change login', 'Change login');
			return true;
		}

		public function actionSetNewLogin() {
			if(!isset($_SESSION['user_logged'])) {
				componentView::errorHandle(404);
			}
			elseif (($result = $this->model->changeLogin()) !== true) {
				$this->view->showMessage('Something went wrong', $result);
				exit;
			}
			$this->view->showMessage('Login changing', 'Your login has been changed!');
		}

		//PROFILE
		public function actionProfile() {
			if(!isset($_SESSION['user_logged']))
				componentView::redirect('');
			$_SESSION['profile'] = true;
			$this->view->render('Camagru: my profile');
			return true;
		}

		//STATUS OR ERROR MESSAGE (temporary, I hope)
		public function showStatus($title, $result) {
			$this->view->showMessage($title, $result);
			exit;
		}
	}