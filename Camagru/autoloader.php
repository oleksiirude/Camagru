<?php

	spl_autoload_register(function ($class) {
		if (preg_match('/component/', $class))
			require_once ROOT.'components/'.$class.'.php';
		else if (preg_match('/controller/', $class))
			require_once ROOT.'controllers/'.$class.'.php';
		else if (preg_match('/model/', $class))
			require_once ROOT.'models/'.$class.'.php';
		else if (preg_match('/view/', $class))
			require_once ROOT.'views/'.$class.'.php';
	});