<?php

	class controllerWorkshop extends componentController
	{
		private $model;

		public function __construct($route)
		{
			parent::__construct($route);
			$this->model = new modelWorkshop();
		}

		//workshop
		public function actionWorkshop()
		{
			$this->onlyForLogged();
			$this->view->render('Camagru: workshop');
			return true;
		}

		public function actionGetPreview() {
			$this->onlyForLogged();
			$data = (array)json_decode($_POST['box']);
			$base64 = str_replace(' ', '+', array_pop($data));
			$base64 = str_replace('data:image/png;base64,', '', $base64);
			$preview = $this->model->getPreview($base64, $data);
			echo $preview;
			return true;
		}

		public function actionUsersPicValidate() {
			$this->onlyForLogged();
			if (($result = $this->model->validateUsersPic()) !== true) {
				echo json_encode($result);
				return true;
			}
			echo json_encode($result);
			return true;
		}

		public function actionAddPost() {
			$data = (array)json_decode($_POST['data']);
			$base64 = str_replace(' ', '+', $data['photo']);
			$base64 = str_replace('data:image/jpeg;base64,', '', $base64);
			$description = htmlentities($data['description']);
			$this->model->addPostToDb($base64, $description);
			echo json_encode(true);
			return true;
		}
}
