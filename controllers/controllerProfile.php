<?php
    class controllerProfile extends componentController {
        private $model;

        public function __construct($route)
        {
            parent::__construct($route);
            $this->model = new modelProfile();
        }

        public function actionGetFivePostsProfile() {
            $this->onlyForLogged();
			$elements = $_POST['elements'];
            $result = $this->model->getFivePostsProfile($elements);
			$result = json_encode($result);
			echo $result;
            return true;
        }

		public function actionGetNextPostProfile() {
			$this->onlyForLogged();
			$result = $this->model->getNextPostProfile($_POST['id']);
			$result = json_encode($result);
			echo $result;
			return true;
		}

        public function actionDeletePost() {
			$this->onlyForLogged();
			$this->model->deletePost($_POST['id']);
        	return true;
		}

		public function actionGetComments() {
			$this->onlyForLogged();
			$result = $this->model->getComments($_POST['id']);
			echo json_encode($result);
			return true;
		}

		public function actionAddComment() {
			$this->onlyForLogged();
			$data = (array)json_decode($_POST['data']);
			$post = $data['post'];
			$comment = htmlentities($data['comment']);
			$result = $this->model->addComment($post, $comment);
			$this->model->prepareNotification($post);
			echo json_encode($result);
			return true;
		}
    }