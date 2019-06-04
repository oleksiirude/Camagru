<?php

	class componentMail {

		public static function sendActivationLink($token, $post) {

			$login = $post['login'];
			//$path = 'http://localhost:8080/user/register/confirm/'.$token;
			$path = 'http://localhost/user/register/confirm/'.$token;
			$to = $post['email'];
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

		public static function sendRecoverPasswordLink($token, $post) {
			$login = $post['login'];
			//$path = 'http://localhost:8080/user/change/password/confirm/'.$token;
			$path = 'http://localhost/user/recover/password/confirm/'.$token;
			$to = $post['email'];
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

		public static function sendToNewEmail($post) {
			$login = $_SESSION['user_logged'];
			$to = $post['email'];
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

		public static function sendNotification($user, $email) {
			$headers =	"From: camagrubot@gmail.com\r\n".
				"Reply-To: no-reply\r\n".
				"MIME=Version: 1.0\r\n".
				"Content-Type: text/html; charset=utf-8\r\n";
			$subject = 'Activity in your post';
			$message = "
						<p>Hi, dear $user!</p>
						<p>Someone has left comment under one of your posts!</p>
						<p>Check it out!</p>";
			mail($email, $subject, $message, $headers);
		}
	}