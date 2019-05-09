<?php

	class componentView {
		public $path;

		public function __construct($route) {
			$this->path = ROOT.'views/'.$route['controller'].'/'.$route['action'].'.php';
		}

		public function render($title, $params = []) {
			require_once (ROOT.'views/default/metadata.php');
			require_once (ROOT.'views/default/header.php');
			require_once ($this->path);
			require_once (ROOT.'views/default/footer.php');
		}

		public static function errorHandle($code) {
			http_response_code($code);
			require_once (ROOT.'views/error/'.$code.'.php');
			exit;
		}

		public static function toMainIndex() {
			echo "empty URI. Now you are at the main index page";
			require_once (ROOT."index.php");
			exit;
		}
	}