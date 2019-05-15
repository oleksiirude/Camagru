<?php

	class componentMail {

		public static function sendActivationLink($token) {

			$login = $_POST['login'];
			$path = 'http://localhost/user/register/confirm/'.$token;
			$to = $_POST['email'];
			$headers =	"From: camagrubot@gmail.com\r\n".
				"Reply-To: no-reply\r\n".
				"MIME=Version: 1.0\r\n".
				"Content-Type: text/html; charset=utf-8\r\n";
			$subject = 'Account activation';
			$message = "<p>Hi, dear $login!</p>
						<p>Please, follow this link to activate your account: $path</p>
						<p>See ya!</p>";
			mail($to, $subject, $message, $headers);
		}

		public static function sendChangePasswordLink($token) {
			$login = $_POST['login'];
			$path = 'http://localhost/user/change/password/confirm/'.$token;
			$to = $_POST['email'];
			$headers =	"From: camagrubot@gmail.com\r\n".
				"Reply-To: no-reply\r\n".
				"MIME=Version: 1.0\r\n".
				"Content-Type: text/html; charset=utf-8\r\n";
			$subject = 'Password change';
			$message = "
						<p>Hi, dear $login!</p>
						<p>Please, follow this link to change your password: $path</p>
						<p>Notice: you have only one attempt to change your pass with this link!</p>
						<p>See ya!</p>";
			mail($to, $subject, $message, $headers);
			componentView::redirect('');

		}

	}