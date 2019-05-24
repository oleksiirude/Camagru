<?php

	class componentView {
		public $path;
		public $params = [];

		public function __construct($route) {
			$this->path = ROOT.'views/'.$route['controller'].'/'.$route['action'].'.php';
		}

		private function specifyPath() {
			if (strstr($this->path, 'recoverPasswordConfirm')) {
				$this->path = preg_replace('~recoverPasswordConfirm~', 'recoverPassword', $this->path);
				$this->params['recover_password'] = true;
			}
		}

		public function render($title) {
			$this->specifyPath();
			ob_start();
			require_once ($this->path);
			$content = ob_get_clean();
			require_once (ROOT.'views/default/index.php');
			exit;
		}

		public static function toMainPage($title) {
			ob_start();
			require_once (ROOT.'views/user/content.php');
			$content = ob_get_clean();
			require_once (ROOT."views/default/index.php");
			exit;
		}

		public static function redirect($path) {
			header('Location: /'.$path);
			exit;
		}

		public static function errorHandle($code) {
			http_response_code($code);
			require_once (ROOT.'views/error/error.php');
			exit;
		}

		//WORK WITH IMAGES
		public static function basicPictureChecks($filePath, $errorCode) {
			$fi = finfo_open(FILEINFO_MIME_TYPE);
			$mime = (string)finfo_file($fi, $filePath);

			//checks real MIME-type
			if (!preg_match('/.*[.jpg|.jpeg|.png]$/i', $mime))
				return ['id' => 'email', 'warning' => 'inappropriate file!'];
			//checks upload status
			if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath))
				return ['id' => 'email', 'warning' => 'upload error, try later!'];
			return true;
		}

		public static function setOrientation($filePath, $image) {
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

		public static function resizeForAvatar($filePath, $name, $type) {
			$width = 240;
			$height = 240;

			if ($type === 'png' || $type === 'PNG')
				$image = imagecreatefrompng($filePath);
			else
				$image = imagecreatefromjpeg($filePath);
			$image = self::setOrientation($filePath, $image);
			$new = imagecreatetruecolor(240, 240);

			if ($type === 'png' || $type === 'PNG') {
				imagesavealpha($new, true);
				$color = imagecolorallocatealpha($new, 0, 0, 0, 127);
				imagefill($new, 0, 0, $color);
			}

			imagecopyresampled($new, $image, 0, 0,
				0, 0, $width, $height, imagesx($image),imagesy($image));

			if ($type === 'png' || $type === 'PNG')
				imagepng($new, ROOT.'views/pictures/avatars/'.$name);
			else
				imagejpeg($new, ROOT.'views/pictures/avatars/'.$name);

			imagedestroy($image);
			imagedestroy($new);
		}
	}