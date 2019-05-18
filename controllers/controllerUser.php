<?php

	class controllerUser extends componentController {
		private $model;

		public function __construct($route) {
			parent::__construct($route);
			$this->model = new modelUser();
		}

		//REGISTRATION
		public function actionRegister() {
			$this->onlyForUnlogged();
			$this->view->render('Camagru: register');
			return true;
		}

		public function actionRegisterValidate() {
			$this->onlyForUnlogged();
			if (($result = $this->model->validateRegistrationData()) !== true)
				self::showStatus('Camagru: something went wrong', $result);
			$token = md5($_POST['login'].time().$_POST['email']);
			$this->model->insertValidRegistrationDataInDb($token);
			componentMail::sendActivationLink($token);
			self::showStatus('Camagru: success',
				'The link has been sent, check your email to activate account!');
		}

		public function actionConfirmRegistration($uri) {
			$token = substr($uri, 22, 32);
			if ($this->model->confirmRegistrationRequest($token) === true)
				componentView::redirect('user/login');
			else
				componentView::errorHandle(404);
			exit;
		}

		//LOGIN
		public function actionLogin() {
			$this->onlyForUnlogged();
			$this->view->render('Camagru: login');
			return true;
		}

		public function actionLoginValidate() {
			if (($result = $this->model->validateInputLoginData()) !== true)
				self::showStatus('Camagru: something went wrong', $result);
			$this->view->redirect('');
		}

		//LOGOUT
		public function actionLogout() {
			if(isset($_SESSION['user_logged'])) {
				session_destroy();
				componentView::redirect('');
			}
		}

		//PASSWORD RECOVERY
		public function actionRecoverPassword() {
			$this->onlyForUnlogged();
			$this->view->render('Camagru: recover password');
			return true;
		}

		public function actionRecoverPasswordSendLink() {
			if (($result = $this->model->validateRecoverPasswordIntention()) !== true) {
				self::showStatus('Camagru: recover password error', $result);
			}
			$token = md5($_POST['login'].time().$_POST['email']);
			$this->model->insertTokenInDb($token);
			componentMail::sendRecoverPasswordLink($token);
			self::showStatus('Camagru: check your email', 'The link has been sent, check your email to recover password!');
		}

		public function actionRecoverPasswordConfirm($uri) {
			$token = substr($uri, 30, 32);
			if (($result = $this->model->checkTokenInDb($token)) !== true)
				componentView::errorHandle(404);
			$this->view->render('Camagru: set new password');
			exit;
		}

		public function actionRecoverSetNewPassword() {
			if(!isset($_SESSION['id_recover_password']))
				componentView::redirect('');

			if (($result = $this->model->validateRecoverPasswordData()) !== true)
				self::showStatus('Camagru: something went wrong', $result);
			componentView::redirect('user/login');
		}

		//CHANGE LOGIN
		public function actionChangeLogin() {
			$this->onlyForLogged();
			$this->view->render('Camagru: change login');
			return true;
		}

		public function actionSetNewLogin() {
			$this->onlyForLogged();
			if (($result = $this->model->changeLogin()) !== true) {
				$this->view->showMessage('Something went wrong', $result);
				exit;
			}
			$this->view->showMessage('Camagru: success', 'Your login has been changed!');
		}

		//CHANGE EMAIL
		public function actionChangeEmail() {
			$this->onlyForLogged();
			$this->view->render('Camagru: change email');
			return true;
		}

		public function actionSetNewEmail() {
			if(!isset($_SESSION['user_logged'])) {
				componentView::errorHandle(404);
			}
			elseif (($result = $this->model->changeEmail()) !== true) {
				$this->view->showMessage('Camagru: something went wrong', $result);
				exit;
			}
			componentMail::sendToNewEmail();
			$this->view->showMessage('Email changing', 'Your email has been changed!');
		}

		//PASSWORD CHANGE
		public function actionChangePassword() {
			$this->onlyForLogged();
			$this->view->render('Camagru: change password');
			return true;
		}

		public function actionSetNewPassword() {
			if(!isset($_SESSION['user_logged']))
				componentView::redirect('');
			elseif (($result = $this->model->setNewPassword()) !== true) {
				$this->view->showMessage('Camagru: something went wrong', $result);
				exit;
			}
			$this->view->showMessage('Camagru: success', 'Your password has been changed!');

		}

		//PROFILE
		public function actionProfile() {
			$this->onlyForLogged();
			$this->view->render('Camagru: my profile');
			return true;
		}

		//SETTINGS
		public function actionSettings() {
			$this->onlyForLogged();
			$this->view->render('Camagru: my settings');
			return true;
		}

		//DELETE ACCOUNT
		public function actionDeleteAccount() {
			$this->onlyForLogged();
			$this->view->render('Camagru: delete account');
		}

		public function actionDeleteAccountConfirm() {
			$this->onlyForLogged();
			//add complex deleting!
			$this->model->deleteAccount();
			session_destroy();
			componentView::redirect('');
		}

		//CHANGE AVATAR
		public function actionChangeAvatar() {
			$this->onlyForLogged();
			$this->view->render('Camagru: change avatar');
		}

		public function actionChangeAvatarSet() {

			$this->onlyForLogged();
			if (($result = $this->model->validateNewAvatar()) !== true) {
				$this->view->showMessage('Something went wrong', $result);
				exit;
			}
			componentView::redirect('user/profile');
		}

		//STATUS OR ERROR MESSAGE (temporary, I hope)
		public function showStatus($title, $result) {
			$this->view->showMessage($title, $result);
			exit;
		}
	}