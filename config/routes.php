<?php
	return [

		'user/register' => [
			'controller' => 'user',
			'action' => 'register'
		],

		'user/confirm/[a-z0-9]{32}' => [
			'controller' => 'user',
			'action' => 'confirm'
		],

		'user/register/validate' => [
			'controller' => 'user',
			'action' => 'registerValidate'
		],

		'user/login' => [
			'controller' => 'user',
			'action' => 'login'
		],

		'user/login/validate' => [
			'controller' => 'user',
			'action' => 'loginValidate'
		],

		'user/recover' => [
			'controller' => 'user',
			'action' => 'recover'
		]
	];