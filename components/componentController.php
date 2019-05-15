<?php

	abstract class componentController {
		public $route;
		public $view;

		public function __construct($route) {
			$this->route = $route;
			$this->view = new componentView($route);
		}
	}