<?php
	class componentMail
	{
		public static function sendActivationLink($token, $post)
		{

			$login = $post['login'];
			$path = 'http://localhost:8080/user/register/confirm/'.$token; // for unit
//			$path = 'http://localhost/user/register/confirm/'.$token; // for home
			$to = $post['email'];
            $date = date('r', $_SERVER['REQUEST_TIME']);
            $headers = "From: camagrubot@gmail.com\r\n" .
                "Reply-To: no-reply\r\n" .
                "Content-Transfer-Encoding: 7bit" .
                "MIME-Version: 1.0\r\n" .
                "Date: $date" .
                "Content-Type: text/html; charset=utf-8\r\n";
            $subject = iconv_mime_encode('Subject','Account activation');
			$message = "Hi, dear $login!\nPlease, follow this link to activate your account: $path\nSee ya!";
			mail($to, $subject, $message, $headers);
		}

		public static function sendRecoverPasswordLink($token, $post)
		{
			$login = $post['login'];
			$path = 'http://localhost:8080/user/recover/password/confirm/'.$token; // for unit
//			$path = 'http://localhost/user/recover/password/confirm/'.$token; // for home
			$to = $post['email'];
            $date = date('r', $_SERVER['REQUEST_TIME']);
			$headers = "From: camagrubot@gmail.com\r\n" .
				"Reply-To: no-reply\r\n" .
                "Content-Transfer-Encoding: 7bit" .
				"MIME-Version: 1.0\r\n" .
                "Date: $date" .
				"Content-Type: text/html; charset=utf-8\r\n";
			$subject = iconv_mime_encode('Subject','Password recover');
			$message = "Hi, dear $login!\nPlease, follow this link to recover your password: $path\nNotice: you have only one attempt to recover your password with this link!\nSee ya!";
			mail($to, $subject, $message, $headers);
		}

		public static function sendToNewEmail($post)
		{
			$login = $_SESSION['user_logged'];
			$to = $post['email'];
            $date = date('r', $_SERVER['REQUEST_TIME']);
            $headers = "From: camagrubot@gmail.com\r\n" .
                "Reply-To: no-reply\r\n" .
                "Content-Transfer-Encoding: 7bit" .
                "MIME-Version: 1.0\r\n" .
                "Date: $date" .
                "Content-Type: text/html; charset=utf-8\r\n";
            $subject = iconv_mime_encode('Subject','New email');
			$message = "Hi, dear $login!\nYou have just set new email in our social network to this.\nSee ya!";
			mail($to, $subject, $message, $headers);
		}

		public function sendNotification($user, $email)
		{
            $date = date('r', $_SERVER['REQUEST_TIME']);
            $headers = "From: camagrubot@gmail.com\r\n" .
                "Reply-To: no-reply\r\n" .
                "Content-Transfer-Encoding: 7bit" .
                "MIME-Version: 1.0\r\n" .
                "Date: $date" .
                "Content-Type: text/html; charset=utf-8\r\n";
            $subject = iconv_mime_encode('Subject','Activity in your post');
			$message = "Hi, dear $user!\nSomeone has left comment under one of your posts!\nCheck it out!";
			mail($email, $subject, $message, $headers);
		}
	}