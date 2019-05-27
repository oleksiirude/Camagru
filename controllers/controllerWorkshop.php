<?php

	class controllerWorkshop extends componentController {
		private $model;

		public function __construct($route) {
			parent::__construct($route);
			$this->model = new modelUser();
		}

		//workshop
		public function actionWorkshop() {
			$this->onlyForLogged();
			$this->view->render('Camagru: workshop');
			return true;
		}

		public function actionSavePhoto() {
			$base64 = str_replace(' ', '+', json_decode($_POST['photo']));
			$return = $base64;
			$base64 = str_replace('data:image/png;base64,', '', $base64);
			$photo = base64_decode($base64);
			//file_put_contents('tmp/'.md5(time()).'.png',$photo);
			echo $return;
			return true;
		}
	}