<?php
	return [

		'user/register' => [
			'controller' => 'user',
			'action' => 'register'
		],

		'user/register/validate' => [
			'controller' => 'user',
			'action' => 'registerValidate'
		],

		'user/confirm/[a-z0-9]{32}' => [
			'controller' => 'user',
			'action' => 'confirm'
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
		],

		'user/recover/validate' => [
		'controller' => 'user',
		'action' => 'recoverValidate'
		],

		'user/recover/[0-9]+/[a-z0-9]{4}' => [
		'controller' => 'user',
		'action' => 'recoverValidate'
		]
	];