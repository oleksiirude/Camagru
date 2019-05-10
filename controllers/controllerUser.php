<?php

	class controllerUser extends componentController {
		private $model;

		public function __construct($route) {
			parent::__construct($route);
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
			$this->model = new modelUser();

			if (($result = $this->model->validateData()) !== true) {
				echo $result;
//				$this->route['action'] = 'register';
//				$this->view->render("Camagru: register error", $result);
				exit;
			}
			echo "VALIDATED";
			exit;
		}
	}