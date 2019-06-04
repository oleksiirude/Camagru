<?php

	class controllerUser extends componentController {
		private $post;
		private $model;

		public function __construct($route) {
			parent::__construct($route);
			$this->model = new modelUser();
			$this->post = componentController::processAjaxRequest();
		}

		//REGISTRATION
		public function actionRegister() {
			$this->onlyForUnlogged();
			$this->view->render('Camagru: register');
			return true;
		}

		public function actionRegisterValidate() {
			$this->onlyForUnlogged();
			if (($result = $this->model->validateRegistrationData($this->post)) !== true) {
				echo json_encode($result);
				return true;
			}
			$token = md5($this->post['login'].time().$this->post['email']);
			$this->model->insertValidRegistrationDataInDb($token, $this->post);
			componentMail::sendActivationLink($token, $this->post);
			echo json_encode('registered');
			return true;
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
			if (($result = $this->model->validateInputLoginData($this->post)) !== true)
				echo json_encode($result);
			else
				echo json_encode(true);
			return true;
		}

		//LOGOUT
		public function actionLogout() {
			if(isset($_SESSION['user_logged'])) {
				session_destroy();
				componentView::redirect('');
			}
		}

		public function actionIfLogged() {
			if (isset($_SESSION['user_logged']) === false)
				echo json_encode(false);
			else
				echo json_encode(true);
			return true;
		}

		//PASSWORD RECOVERY
		public function actionRecoverPassword() {
			$this->onlyForUnlogged();
			$this->view->render('Camagru: recover password');
			return true;
		}

		public function actionRecoverPasswordSendLink() {
			if (($result = $this->model->validateRecoverPasswordIntention($this->post)) !== true) {
				echo json_encode($result);
				return true;
			}
			$token = md5($this->post['login'].time().$this->post['email']);
			$this->model->insertTokenInDb($token, $this->post);
			componentMail::sendRecoverPasswordLink($token, $this->post);
			echo json_encode('link');
			return true;
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

			if (($result = $this->model->validateRecoverPasswordData($this->post)) !== true) {
				echo json_encode($result);
				return true;
			}
			echo json_encode('recover');
			return true;
		}

		//CHANGE LOGIN
		public function actionChangeLogin() {
			$this->onlyForLogged();
			$this->view->render('Camagru: change login');
			return true;
		}

		public function actionSetNewLogin() {
			$this->onlyForLogged();
			if (($result = $this->model->changeLogin($this->post)) !== true) {
				echo json_encode($result);
				return true;
			}
			echo json_encode('login_changed');
			return true;
		}

		//CHANGE EMAIL
		public function actionChangeEmail() {
			$this->onlyForLogged();
			$this->view->render('Camagru: change email');
			return true;
		}

		public function actionSetNewEmail() {
			$this->onlyForLogged();
			if (($result = $this->model->changeEmail($this->post)) !== true) {
				echo json_encode($result);
				return true;
			}
			componentMail::sendToNewEmail($this->post);
			echo json_encode('email_changed');
			return true;
		}

		//PASSWORD CHANGE
		public function actionChangePassword() {
			$this->onlyForLogged();
			$this->view->render('Camagru: change password');
			return true;
		}

		public function actionSetNewPassword() {
			$this->onlyForLogged();
			if (($result = $this->model->setNewPassword($this->post)) !== true) {
				echo json_encode($result);
				return true;
			}
			echo json_encode('password_changed');
			return true;
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

		//DELETE ACCOUNT -> DO MORE COMPLEX DELETE!
		public function actionDeleteAccount() {
			$this->onlyForLogged();
			$this->view->render('Camagru: delete account');
		}

		public function actionDeleteAccountConfirm() {
			$this->onlyForLogged();
			$this->model->deleteAccount();
			session_destroy();
			componentView::redirect('');
		}

		//CHANGE AVATAR
		public function actionChangeAvatar() {
			$this->onlyForLogged();
			$this->view->render('Camagru: change avatar');
		}

		public function actionChangeAvatarValidate() {
			$this->onlyForLogged();
			if (($result = $this->model->validateNewAvatar()) !== true) {
				echo json_encode($result);
				return true;
			}
			echo json_encode($result);
			return true;
		}

		public function actionChangeAvatarSet() {
			$this->onlyForLogged();
			if (($result = $this->model->setNewAvatar($this->post)) !== true) {
				echo json_encode($result);
				return true;
			}
			echo json_encode(true);
			return true;
		}

		public function actionChangeAvatarDelete() {
			$this->onlyForLogged();
			$this->model->setAvatarDelete();
			componentView::redirect('user/settings');
		}

		public function actionChangeNotifications() {
			$this->onlyForLogged();
			$this->view->render('Camagru: set up notification');
			return true;
		}

		public function actionGetNotificationsMode() {
			$this->onlyForLogged();
			$result = $this->model->getNotificationsMode();
			echo json_encode($result);
			return true;
		}

		public function actionSetNotificationsMode() {
			$this->onlyForLogged();
			$boolean = (array)json_decode($_POST['boolean']);
			$boolean = $boolean[0];
			$this->model->setNotificationsMode($boolean);
			return true;
		}
	}