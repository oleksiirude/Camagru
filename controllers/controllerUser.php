<?php

	class controllerUser extends componentController {

		public function __construct($route) {
			parent::__construct($route);
		}

		public function actionIndex() {
			$this->view->render('Camagru: main');
			return true;
		}

		public function actionRegister() {
			$this->view->render('Camagru: register');
			return true;
		}

		public function actionLogin() {
			$this->view->render('Camagru: login');
			return true;
		}

		public function actionRecover() {
			$this->view->render('Camagru: recover password');
			return true;
		}
	}