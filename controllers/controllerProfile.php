<?php
    class controllerProfile extends componentController
    {
        private $model;

        public function __construct($route)
        {
            parent::__construct($route);
            $this->model = new modelProfile();
        }

        public function actionGetFivePosts() {
            $this->onlyForLogged();
			$elements = $_POST['elements'];
            $result = $this->model->getFivePosts($elements);
			$result = json_encode($result);
			echo $result;
            return true;
        }

		public function actionGetNextPost() {
			$this->onlyForLogged();
			$result = $this->model->getNextPost($_POST['id']);
			$result = json_encode($result);
			echo $result;
			return true;
		}

        public function actionDeletePost() {
			$this->onlyForLogged();
			$this->model->deletePost($_POST['id']);
        	return true;
		}
    }