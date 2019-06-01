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

			$name = md5(time().$_SESSION['user_logged']);
			imagepng($webshoot, ROOT."tmp/$name".'.png');
			imagedestroy($webshoot);

			$image = imagecreatefrompng(ROOT."tmp/$name".'.png');
			unlink(ROOT."tmp/$name".'.png');

			$bg = imagecreatetruecolor(imagesx($image), imagesy($image));
			imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
			imagealphablending($bg, TRUE);
			imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
			imagedestroy($image);
			imagejpeg($bg, ROOT."tmp/$name".'.jpeg', 100);
			imagedestroy($bg);

			$img = file_get_contents(ROOT."tmp/$name".'.jpeg');
			unlink(ROOT."tmp/$name".'.jpeg');

			$preview = 'data:image/jpeg;base64,'.base64_encode($img);
			return $preview;
		}

		public function validateUsersPic() {
			$filePath = $_FILES['pic']['tmp_name'];
			$errorCode = $_FILES['pic']['error'];

			if (($result = componentView::basicPictureChecks($filePath, $errorCode)) !== true)
				return $result;
			$id = $_SESSION['user_id'];
			preg_match("/.*(jpeg|jpg|png)$/i", $_FILES['pic']['type'], $matches);
			$type = $matches[1];
			$name = $id.'tmp'.'.'.$matches[1];
			$base64 = componentView::resizePic($filePath, $name, $type, 640, 480);
			if (!$base64)
				return ['result' => false, 'warning' => 'invalid file!'];
			return $base64;
		}

		public function addPostToDb($base64, $description) {

            $user = $_SESSION['user_id'];
            date_default_timezone_set('Europe/Kiev');
            $date = date("Y-m-d H:i:s");
		    $path = 'views/pictures/posts/'.$_SESSION['user_id'].','.md5(time()).'.jpeg';

		    $photo = base64_decode($base64);
		    $photo = imagecreatefromstring($photo);
		    imagejpeg($photo, $path);
		    imagedestroy($photo);

		    $sth = $this->prepare("INSERT INTO posts(user, description, add_date, path)
                                            VALUES ('$user', :description, '$date','$path')");
		    $sth->execute([':description' => $description]);
        }
	}
