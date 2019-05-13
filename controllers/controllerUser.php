<?php

	class controllerUser extends componentController {
		private $model;

		public function __construct($route) {
			parent::__construct($route);
			$this->model = new modelUser();
		}

		public function actionRegister() {
			$this->view->render('Camagru: register');
			return true; }

		public function actionLogin() {
			$this->view->render('Camagru: login');
			return true; }

		public function actionRecover() {
			$this->view->render('Camagru: recover password');
			return true; }

		public function actionRegisterValidate() {

			if (($result = $this->model->validateRegistrationData()) !== true) {
				var_dump($result);
				//$this->view->redirect('/user/register');
				exit;
			}
			$token = md5($_POST['login'].time().$_POST['email']);
			$this->model->insertValidDataToDb($token);
			componentMail::sendActivationLink($token);
			$this->view->redirect('user/login');
			exit;
		}

		public function actionConfirm($token) {
			$token = substr($token, 13, 32);
			if ($this->model->confirmRequest($token) === true)
				componentView::redirect('user/login');
			else
				componentView::errorHandle(404);
			exit;
		}

		public function actionLoginValidate() {
			if (($result = $this->model->validateInputLoginData()) !== true) {
				var_dump($result);
				exit;
			}
			$_SESSION['logged_user'] = true;
			$this->view->redirect('');
		}

		public function actionRecoverValidate() {
			if (ctype_digit($result = $this->model->validateRecoverData()) === false) {
				var_dump($result);
				exit;
			}
			$token = $result.'/'.md5($_POST['login'].time().$_POST['email']);
			componentMail::sendRecoveryLink($token);
			echo 'ok';
			exit;
			$this->view->redirect('user/login');
		}
	}