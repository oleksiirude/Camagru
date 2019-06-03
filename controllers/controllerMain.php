<?php
	class controllerMain extends componentController {
		private $model;

		public function __construct($route)
		{
			parent::__construct($route);
			$this->model = new modelMain();
		}

		public function actionGetFivePostsMain() {
			$this->onlyForLogged();
			$elements = $_POST['elements'];
			$result = $this->model->getFivePostsMain($elements);
			$result = json_encode($result);
			echo $result;
			return true;
		}

	}
