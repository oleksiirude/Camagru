<?php

	class componentView {
		public $path;

		public function __construct($route) {
			$this->path = ROOT.'views/'.$route['controller'].'/'.$route['action'].'.php';
		}

		public function render($title, $params = []) {
			ob_start();
			require_once ($this->path);
			$content = ob_get_clean();
			require_once (ROOT.'views/default/index.php');
		}

		public static function toMainIndex($title) {
			ob_start();
			require_once (ROOT.'views/user/content.php');
			$content = ob_get_clean();
			require_once (ROOT."views/default/index.php");
			exit;
		}

		public static function redirect($path) {
			header('Location: /' . $path);
			exit;
		}

		public static function errorHandle($code) {
			http_response_code($code);
			require_once (ROOT.'views/error/'.$code.'.php');
			exit;
		}
	}