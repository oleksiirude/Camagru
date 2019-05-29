<?php

	class modelWorkshop extends componentModel {

		//gets base64 shot from webcam and mask images, creates collage from this stuff
		public function getPreviewFromWebCam($base64, $data) {

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

			$name = md5(time().$_SESSION['user_logged']).'png';
			imagepng($webshoot, ROOT."tmp/$name");
			imagedestroy($webshoot);
			$img = file_get_contents(ROOT."tmp/$name");
			unlink(ROOT."tmp/$name");

			$preview = 'data:image/png;base64,'.base64_encode($img);
			return $preview;
		}

	}
