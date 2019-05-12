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
			$this->sendActivationLink($token);
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

		private function sendActivationLink($token) {

			$login = $_POST['login'];
			$path = 'http://localhost/user/confirm/'.$token;
			$to = $_POST['email'];
			$headers =	"From: camagrubot@gmail.com\r\n".
				"Reply-To: no-reply\r\n".
				"MIME=Version: 1.0\r\n".
				"Content-Type: text/html; charset=utf-8\r\n";
			$subject = 'Account activation';
			$message = "<p>Hi, dear $login!</p>
						<p>Please, follow this link to activate your account: $path</p>
						<p>See ya!</p>";
			mail($to, $subject, $message, $headers);
			componentView::redirect('user/login');
		}

		public function actionLoginValidate() {
			if (($result = $this->model->validateInputLoginData()) !== true) {
				var_dump($result);
				exit;
			}
			$_SESSION['logged_user'] = true;
			var_dump($_SESSION['logged_user']);
			$this->view->redirect('');
		}
	}