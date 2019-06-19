<?php

	class componentView
	{
		public $path;
		public $params = [];

		public function __construct($route) {
			$this->path = ROOT.'views/'.$route['controller'].'/'.$route['action'].'.php';
		}

		private function specifyPath()
		{
			if (strstr($this->path, 'recoverPasswordConfirm')) {
				$this->path = preg_replace('~recoverPasswordConfirm~', 'recoverPassword', $this->path);
				$this->params['recover_password'] = true;
			}
		}

		public function render($title)
		{
			$this->specifyPath();
			ob_start();
			require_once($this->path);
			$content = ob_get_clean();
			require_once(ROOT . 'views/default/index.php');
			exit;
		}

		public static function toMainPage($title)
		{
			ob_start();
			require_once(ROOT . 'views/user/content.php');
			$content = ob_get_clean();
			require_once(ROOT . "views/default/index.php");
			exit;
		}

		public static function redirect($path) {
			header('Location: /' . $path);
			exit;
		}

		public static function errorHandle($code) {
			http_response_code($code);
			require_once(ROOT . 'views/error/error.php');
			exit;
		}

		//WORK WITH IMAGES
		public static function basicPictureChecks($filePath, $errorCode)
		{
			$fi = finfo_open(FILEINFO_MIME_TYPE);
			$mime = (string)finfo_file($fi, $filePath);

			//checks real MIME-type
			if (!preg_match('/.*[.jpg|.jpeg|.png]$/i', $mime))
				return ['result' => 'false', 'warning' => 'inappropriate image!'];
			//checks upload status
			if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath))
				return ['result' => 'false', 'warning' => 'upload error, try later!'];
			return true;
		}

		public static function setOrientation($filePath, $image)
		{
			$exif = exif_read_data($filePath);

			if (!empty($exif['Orientation'])) {
				switch ($exif['Orientation']) {
					case 8:
						$image = imagerotate($image, 90, 0);
						break;
					case 3:
						$image = imagerotate($image, 180, 0);
						break;
					case 6:
						$image = imagerotate($image, -90, 0);
						break;
				}
			}
			return $image;
		}

		public static function resizePic($filePath, $type, $width, $height)
		{

			if (preg_match('~png~i', $type)) {
				@$image = imagecreatefrompng($filePath);
				if (!$image)
					return false;
			}
			else if (preg_match('~jpe?g~i', $type)) {
				@$image = imagecreatefromjpeg($filePath);
				if (!$image)
					return false;
			}
			if (!preg_match('~png~i', $type))
				$image = self::setOrientation($filePath, $image);
			$new = imagecreatetruecolor($width, $height);

			if ($type === 'png' || $type === 'PNG') {
				imagesavealpha($new, true);
				$color = imagecolorallocatealpha($new, 0, 0, 0, 127);
				imagefill($new, 0, 0, $color);
			}

			imagecopyresampled($new, $image, 0, 0,
				0, 0, $width, $height, imagesx($image), imagesy($image));

            ob_start();
			if ($type === 'png' || $type === 'PNG')
				imagepng($new);
			else
				imagejpeg($new);
            $pic = ob_get_contents();
            ob_end_clean();
			imagedestroy($image);
			imagedestroy($new);

			$base64 = "data:image/$type;base64,".base64_encode($pic);
			$result = ['result' => true, 'base64' => $base64];
			return $result;
		}
	}