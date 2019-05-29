<?php

	class controllerWorkshop extends componentController
	{
		private $model;

		public function __construct($route)
		{
			parent::__construct($route);
			$this->model = new modelUser();
		}

		//workshop
		public function actionWorkshop()
		{
			$this->onlyForLogged();
			$this->view->render('Camagru: workshop');
			return true;
		}

		public function actionSavePhoto() {
			$data = (array)json_decode($_POST['box']);
			$base64 = str_replace(' ', '+', array_pop($data));
			$base64 = str_replace('data:image/png;base64,', '', $base64);
			$webshoot = imagecreatefromstring(base64_decode($base64));

			$i = 0;
			foreach ($data as $elem) {
				$data[$i] = (array)$elem;
				$i++;
			}

			$i = 0;
			foreach ($data as $elem) {
				$mask = imagecreatefrompng($elem['link']);
				$maskWidthInitial = imagesx($mask);
				$maskHeightInitial = imagesy($mask);
				$maskWidthCaptured = $elem['sizeW'];
				$maskHeightCaptured = $elem['sizeH'];
				$posTop = $elem['posTop'];
				$posLeft = $elem['posLeft'];
				imagecopyresampled($webshoot, $mask, $posLeft, $posTop,
					0, 0, $maskWidthCaptured, $maskHeightCaptured, $maskWidthInitial, $maskHeightInitial);
				imagedestroy($mask);
				$i++;
			}

			imagepng($webshoot, ROOT . 'tmp/test.png');
			imagedestroy($webshoot);
			$img = file_get_contents(ROOT . 'tmp/test.png');
			unlink(ROOT . 'tmp/test.png');
			$result = 'data:image/png;base64,'.base64_encode($img);
			echo $result;
			return true;
		}

}
