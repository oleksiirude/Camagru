<?php

	class componentMail {

		public static function sendActivationLink($token) {

			$login = $_POST['login'];
			//$path = 'http://localhost:8080/user/register/confirm/'.$token;
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

		public static function sendRecoverPasswordLink($token) {
			$login = $_POST['login'];
			//$path = 'http://localhost:8080/user/change/password/confirm/'.$token;
			$path = 'http://localhost/user/recover/password/confirm/'.$token;
			$to = $_POST['email'];
			$headers =	"From: camagrubot@gmail.com\r\n".
				"Reply-To: no-reply\r\n".
				"MIME=Version: 1.0\r\n".
				"Content-Type: text/html; charset=utf-8\r\n";
			$subject = 'Password recover';
			$message = "
						<p>Hi, dear $login!</p>
						<p>Please, follow this link to recover your password: $path</p>
						<p>Notice: you have only one attempt to recover your password with this link!</p>
						<p>See ya!</p>";
			mail($to, $subject, $message, $headers);
		}

		public static function sendToNewEmail() {
			$login = $_SESSION['user_logged'];
			$to = $_POST['email'];
			$headers =	"From: camagrubot@gmail.com\r\n".
				"Reply-To: no-reply\r\n".
				"MIME=Version: 1.0\r\n".
				"Content-Type: text/html; charset=utf-8\r\n";
			$subject = 'New email';
			$message = "
						<p>Hi, dear $login!</p>
						<p>You have just set new email in our social network to this.</p>
						<p>See ya!</p>";
			mail($to, $subject, $message, $headers);
		}
	}