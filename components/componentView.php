<?php

	class componentView {
		public $path;
		public $params = [];

		public function __construct($route) {
			$this->path = ROOT.'views/'.$route['controller'].'/'.$route['action'].'.php';
		}

		private function specifyPath() {
			if (strstr($this->path, 'recoverPasswordConfirm')) {
				$this->path = preg_replace('~recoverPasswordConfirm~', 'recoverPassword', $this->path);
				$this->params['recover_password'] = true;
			}
		}

		public function render($title, $data = null) {
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

		public function showMessage($title, $message) {
			require_once (ROOT."views/default/message.php");
			exit;
		}

		public static function errorHandle($code) {
			http_response_code($code);
			require_once (ROOT.'views/error/error.php');
			exit;
		}
	}