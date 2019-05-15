<?php
	return [
		//registration
		'user/register' => [
			'controller' => 'user',
			'action' => 'register'
		],

		'user/register/validate' => [
			'controller' => 'user',
			'action' => 'registerValidate'
		],

		'user/register/confirm/[a-z0-9]{32}' => [
			'controller' => 'user',
			'action' => 'confirmRegistration'
		],

		//login
		'user/login' => [
			'controller' => 'user',
			'action' => 'login'
		],

		'user/login/validate' => [
			'controller' => 'user',
			'action' => 'loginValidate'
		],

		//change password
		'user/change/password' => [
			'controller' => 'user',
			'action' => 'changePassword'
		],

		'user/change/password/request' => [
		'controller' => 'user',
		'action' => 'changePasswordSendLink'
		],

		'user/change/password/confirm/[a-z0-9]{32}' => [
		'controller' => 'user',
		'action' => 'changePasswordConfirm'
		],

		'user/change/password/confirm/set' => [
			'controller' => 'user',
			'action' => 'setNewPassword'
		],

		//logout
		'user/logout' => [
			'controller' => 'user',
			'action' => 'logout'
		]
		//change login

		//change email
	];