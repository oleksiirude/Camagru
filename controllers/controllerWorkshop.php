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
//			$base64 = str_replace(' ', '+', json_decode($_POST['photo']));
//			$return = $base64;
//			$base64 = str_replace('data:image/png;base64,', '', $base64);
//			$photo = base64_decode($base64);
			//file_put_contents('tmp/'.md5(time()).'.png',$photo);
			$data = (array)json_decode($_POST['box']);
			$base64 = array_pop($data);
			$i = 0;
			foreach ($data as $elem) {
				$data[$i] = (array)$elem;
				$i++;
			}
			var_dump($base64);
			var_dump($data);
			return true;
		}
	}

//		public function actionPhoto()
////		{
//////        print_r($_POST);
////			$img = $_POST['userPhoto'];
////			$imagemy = explode('data:image/png;base64,', $img)[1];
////			$funMask = imagecreatefrompng($_POST['superposable']);
////			$name = md5($_POST['userEmail']).time();
////			$maskwidth = imagesx($funMask);
////			$maskusrwidth = $_POST['maskWidth'];
////			$maskheight = imagesy($funMask);
////			$maskusrheight = $_POST['maskHeight'];
////			$data = base64_decode($imagemy);
////			$im = imagecreatefromstring($data);
////			$left = explode('px', $_POST['maskLeft'])[0];
////			$top = explode('px', $_POST['maskTop'])[0];
////			imagecopyresampled ($im, $funMask, $left, $top, 0, 0, $maskusrwidth, $maskusrheight, $maskwidth, $maskheight);
//////        header('Content-Type: image/png');
//////        imagepng($im);
////			$save = "public/images/tmp/". strtolower($name) .".png";
//////        echo $save;
////			chmod($save,0755);
////			imagepng($im, $save, 0, NULL);
////			imagedestroy($im);
////			imagedestroy($funMask);
////			$_SESSION['photo'] = $save;
////			header("Location: /camagru/snapchat");
////		}
