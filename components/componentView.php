<?php

	class componentView {
		public $path;
		public $params = [];

		public function __construct($route) {
			$this->path = ROOT.'views/'.$route['controller'].'/'.$route['action'].'.php';
		}

		private function specifyPath() {
			if (strstr($this->path, 'changePasswordConfirm')) {
				$this->path = preg_replace('~changePasswordConfirm~', 'changePassword', $this->path);
				$this->params['change_password'] = true;
			}
		}

<<<<<<< HEAD
		public function render($title, $data = null) {
=======
		public function render($title) {
>>>>>>> 0962d104259e37d96cdf89627c5d629e6fbc8ef8
			$this->specifyPath();
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
			header('Location: /'.$path);
			exit;
		}

		public function incorrectData($title, $data) {
			require_once (ROOT."views/default/temporary.php");
		}

		public static function errorHandle($code) {
			http_response_code($code);
			require_once (ROOT.'views/error/'.$code.'.php');
			exit;
		}
	}