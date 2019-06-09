<?php

	class modelWorkshop extends componentModel {

		//gets base64 shot from webcam and mask images, creates collage from this stuff
		public function getPreview($base64, $data) {

			$webshoot = imagecreatefromstring(base64_decode($base64));

			$i = 0;
			foreach ($data as $elem) {
				$data[$i] = (array)$elem;
				$i++;
			}

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
			}

            ob_start();
            imagepng($webshoot);
            $png = ob_get_contents();
            ob_end_clean();
            imagedestroy($webshoot);
            $image = imagecreatefromstring($png);

			$new = imagecreatetruecolor(imagesx($image), imagesy($image));
			imagefill($new, 0, 0, imagecolorallocate($new, 255, 255, 255));
			imagealphablending($new, TRUE);
			imagecopy($new, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
			imagedestroy($image);

            ob_start();
            imagejpeg($new);
            $jpeg = ob_get_contents();
            ob_end_clean();
            imagedestroy($new);

			$preview = 'data:image/jpeg;base64,'.base64_encode($jpeg);
			return $preview;
		}

		public function validateUsersPic() {
			$filePath = $_FILES['pic']['tmp_name'];
			$errorCode = $_FILES['pic']['error'];

			if (($result = componentView::basicPictureChecks($filePath, $errorCode)) !== true)
				return $result;
			preg_match("/.*(jpeg|jpg|png)$/i", $_FILES['pic']['type'], $matches);
			$type = $matches[1];
			$base64 = componentView::resizePic($filePath, $type, 640, 480);
			if (!$base64)
				return ['result' => false, 'warning' => 'invalid file!'];
			return $base64;
		}

		public function addPostToDb($base64, $description) {

            $user = $_SESSION['user_logged'];
            if ($_SESSION['avatar'] === false)
            	$user_avatar = 'views/pictures/avatars/default.png';
            else
            	$user_avatar = $_SESSION['avatar'];
            date_default_timezone_set('Europe/Kiev');
            $date = date("Y-m-d H:i:s");
		    $path = 'views/pictures/posts/'.$_SESSION['user_id'].','.md5(time()).'.jpeg';

		    $photo = base64_decode($base64);
		    $photo = imagecreatefromstring($photo);
		    imagejpeg($photo, $path);
		    imagedestroy($photo);

		    $sth = $this->prepare("INSERT INTO posts(user, user_avatar, description, add_date, path)
                                            VALUES ('$user', '$user_avatar', :description, '$date','$path')");
		    $sth->execute([':description' => $description]);

		    //get current post id and create row for this post in likes table
			$sth = $this->query("SELECT id FROM posts WHERE path = '$path'");
			$id = $sth->fetchAll(self::FETCH_ASSOC);
			$id = $id[0]['id'];
			$user = $_SESSION['user_id'];
			$this->query("INSERT INTO likes(post, owner, list) VALUES ('$id', '$user', '')");
        }
	}
