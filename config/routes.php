<?php
	return [
		//CONTROLLER - USER
		//REGISTRATION
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

		//LOGIN
		'user/login' => [
			'controller' => 'user',
			'action' => 'login'
		],

		'user/login/validate' => [
			'controller' => 'user',
			'action' => 'loginValidate'
		],

		//LOGOUT
		'user/logout' => [
			'controller' => 'user',
			'action' => 'logout'
		],

		//PASSWORD RECOVERY
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

		//LOGIN CHANGE
		'user/change/login' => [
			'controller' => 'user',
			'action' => 'changeLogin'
		],

		'user/change/login/set' => [
			'controller' => 'user',
			'action' => 'setNewLogin'
		],

		//EMAIL CHANGE
		'user/change/email' => [
			'controller' => 'user',
			'action' => 'changeEmail'
		],

		'user/change/email/set' => [
			'controller' => 'user',
			'action' => 'setNewEmail'
		],

		//PASSWORD CHANGE
		'user/change/password' => [
			'controller' => 'user',
			'action' => 'changePassword'
		],

		'user/change/password/set' => [
			'controller' => 'user',
			'action' => 'setNewPassword'
		],

		//PROFILE
		'user/profile' => [
			'controller' => 'user',
			'action' => 'profile'
		],

		//PROFILE
		'user/settings' => [
			'controller' => 'user',
			'action' => 'settings'
		],

		//CONTROLLER - WORKSHOP
		//WORKSHOP
		'workshop' => [
			'controller' => 'workshop',
			'action' => 'workshop'
		],

	];