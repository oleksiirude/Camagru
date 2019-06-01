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
//        	$_POST['elements'];
            $this->onlyForLogged();
            $result = $this->model->getFivePosts();
			$result = json_encode($result);
			echo $result;
//            echo json_encode(true);
            return true;
        }
    }