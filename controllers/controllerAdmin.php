<?php

	class controllerAdmin extends componentController
	{
		private $post;
		private $model;

		public function __construct($route) {
			parent::__construct($route);
			$this->model = new modelAdmin();
			$this->post = componentController::processAjaxRequest();
		}

		public function actionAdmin() {
			$this->view->render('Camagru: admin');
			return true;
		}

		public function actionLogin() {
			if ($this->post['login'] === 'admin' && $this->post['password'] === 'admin') {
				$_SESSION['admin_logged'] = true;
				echo json_encode(true);
			}
			else
				echo json_encode(['id' => 'password', 'warning' => 'error']);
			return true;
		}

		public function actionCheckIfLogged() {
			if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] === true)
				echo json_encode(true);
			else
				echo json_encode(false);
			return true;
		}


		public function actionReCreateDb() {
			$this->onlyForAdmin();
			$this->model->reCreateDb();
			return true;
		}

		public function actionLogout() {
			$this->onlyForAdmin();
			unset($_SESSION['admin_logged']);
			return true;
		}
}