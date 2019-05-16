<?php

	class controllerWorkshop extends componentController {
		private $model;

		public function __construct($route) {
			parent::__construct($route);
			$this->model = new modelUser();
		}

		//Workshop
		public function actionWorkshop() {
			$this->onlyForLogged();
			$this->view->render('Camagru: workshop');
			return true;
		}
	}