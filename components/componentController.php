<?php

	abstract class componentController {
		public $route;
		public $view;

		public function __construct($route) {
			$this->route = $route;
			$this->view = new componentView($route);
		}

		public function onlyForLogged() {
			if(!isset($_SESSION['user_logged']))
				componentView::redirect('');
		}

		public function onlyForUnlogged() {
			if(isset($_SESSION['user_logged']))
				componentView::redirect('');
		}
	}