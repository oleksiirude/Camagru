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

		//CHECK IF USER LOGGED IN
		'user/iflogged' => [
			'controller' => 'user',
			'action' => 'ifLogged'
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


		//DELETE ACCOUNT
		'user/delete/account' => [
			'controller' => 'user',
			'action' => 'deleteAccount'
		],

		'user/delete/account/confirm' => [
			'controller' => 'user',
			'action' => 'deleteAccountConfirm'
		],

		//CHANGE AVATAR
		'user/change/avatar' => [
			'controller' => 'user',
			'action' => 'changeAvatar'
		],

		'user/change/avatar/validate' => [
			'controller' => 'user',
			'action' => 'changeAvatarValidate'
		],

		'user/change/avatar/set' => [
			'controller' => 'user',
			'action' => 'changeAvatarSet'
		],

		'user/change/avatar/delete' => [
			'controller' => 'user',
			'action' => 'changeAvatarDelete'
		],

		//SETTINGS
		'user/settings' => [
			'controller' => 'user',
			'action' => 'settings'
		],

		'user/change/notifications' => [
			'controller' => 'user',
			'action' => 'changeNotifications'
		],

		'user/getnotificationsmode' => [
			'controller' => 'user',
			'action' => 'getNotificationsMode'
		],

		'user/setnotificationsmode' => [
			'controller' => 'user',
			'action' => 'setNotificationsMode'
		],

		//CONTROLLER - WORKSHOP
		//WORKSHOP
		'workshop' => [
			'controller' => 'workshop',
			'action' => 'workshop'
		],

		'workshop/getpreview' => [
			'controller' => 'workshop',
			'action' => 'getPreview'
		],

		'workshop/userspicvalidate' => [
			'controller' => 'workshop',
			'action' => 'usersPicValidate'
		],

		'workshop/addpost' => [
			'controller' => 'workshop',
			'action' => 'addPost'
		],

        //CONTROLLER - PROFILE
        //PROFILE
        'profile/getfivepostsprofile' => [
            'controller' => 'profile',
            'action' => 'getFivePostsProfile'
        ],

		'profile/getnextpostprofile' => [
			'controller' => 'profile',
			'action' => 'getNextPostProfile'
		],

		'profile/deletepost' => [
			'controller' => 'profile',
			'action' => 'deletePost'
		],

		'profile/getcomments' => [
			'controller' => 'profile',
			'action' => 'getComments'
		],

		'profile/addcomment' => [
			'controller' => 'profile',
			'action' => 'addComment'
		],

		'profile/makelike' => [
			'controller' => 'profile',
			'action' => 'makeLike'
		],

		//CONTROLLER
		//MAIN FEED
		'main/getfivepostsmain' => [
			'controller' => 'main',
			'action' => 'getFivePostsMain'
		],

		//ADMIN
		'admin' => [
			'controller' => 'admin',
			'action' => 'admin'
		],

		'admin/login' => [
			'controller' => 'admin',
			'action' => 'login'
		],

		'admin/checkiflogged' => [
			'controller' => 'admin',
			'action' => 'checkIfLogged'
		],

		'admin/recreatedb' => [
			'controller' => 'admin',
			'action' => 'reCreateDb'
		],


		'admin/logout' => [
			'controller' => 'admin',
			'action' => 'logout'
		],
	];