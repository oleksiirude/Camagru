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
			$elements = $_POST['elements'];

            $this->onlyForLogged();
            $result = $this->model->getFivePosts($elements);
			$result = json_encode($result);
			echo $result;
            return true;
        }
    }