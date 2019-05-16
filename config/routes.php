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

		//recover password
		'user/recover/password' => [
			'controller' => 'user',
			'action' => 'recoverPassword'
		],

		'user/recover/password/request' => [
		'controller' => 'user',
		'action' => 'recoverPasswordSendLink'
		],

		'user/recover/password/confirm/[a-z0-9]{32}' => [
		'controller' => 'user',
		'action' => 'recoverPasswordConfirm'
		],

		'user/recover/password/confirm/set' => [
			'controller' => 'user',
			'action' => 'recoverSetNewPassword'
		],

		'user/profile' => [
			'controller' => 'user',
			'action' => 'profile'
		],

		//logout
		'user/logout' => [
			'controller' => 'user',
			'action' => 'logout'
		],

		//change login
		'user/change/login' => [
			'controller' => 'user',
			'action' => 'changeLogin'
		],

		'user/change/login/set' => [
			'controller' => 'user',
			'action' => 'setNewLogin'
		],

		//change email
		'user/change/email' => [
			'controller' => 'user',
			'action' => 'changeEmail'
		],

		'user/change/email/set' => [
			'controller' => 'user',
			'action' => 'setNewEmail'
		],

		//change password

		'user/change/password' => [
			'controller' => 'user',
			'action' => 'changePassword'
		],

		'user/change/password/set' => [
			'controller' => 'user',
			'action' => 'setNewPassword'
		],
	];