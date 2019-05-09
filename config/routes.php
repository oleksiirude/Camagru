<?php
	return [
		'user/index' => [
			'controller' => 'user',
			'action' => 'index'
		],

		'user/register' => [
			'controller' => 'user',
			'action' => 'register'
		],

		'user/login' => [
			'controller' => 'user',
			'action' => 'login'
		],

		'user/recover' => [
			'controller' => 'user',
			'action' => 'recover'
		]
	];


//	return array(
//		'index' => 'user/index',
//		'register' => 'user/register',
//		'login' => 'user/login',
//		'recover' => 'user/recover'

//		'index' => 'enter/index',
//		'register' => 'enter/register',
//		'login' => 'enter/login',
//		'recover' => 'enter/recover',
//
//		'main' => 'user/index',
//		'dashboard' => 'user/dashboard',
//		'profile' => 'user/profile',
//
//		'admin' => 'admin/index',
//		'enter' => 'admin/login'
//	);