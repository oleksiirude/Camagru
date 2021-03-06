<?php

	class componentRouter {
		private $routes;

		public function __construct() {
			$this->routes = require_once (ROOT.'config/routes.php');
		}

		//get uri string
		private function getURI() {
			$uri = trim($_SERVER['REQUEST_URI'], '/');
			if (!empty($uri))
				return $uri;
			return false;
		}


		//find needed controller, create an object and launch method
		public function run() {
			if (!$uri = $this->getURI()) {
				componentView::toMainPage('Camagru: main');
			}
			else {
				$success = null;
				foreach ($this->routes as $uriPattern => $route) {
					if (preg_match("~^$uriPattern$~", $uri)) {
						$controllerName = 'controller'.ucfirst($route['controller']);
						$actionName = 'action'.ucfirst($route['action']);

						$class = ROOT.'controllers/'.$controllerName.'.php';
						if (file_exists($class)
							&& class_exists($controllerName)
							&& method_exists($controllerName, $actionName)) {

							require_once ($class);
							$controller = new $controllerName($route);
							$success = $controller->$actionName($uri);
							if ($success)
								break;
						}
						else
							componentView::errorHandle(404);
					}
				}
				if (!$success)
					componentView::errorHandle(404);
			}
		}
	}