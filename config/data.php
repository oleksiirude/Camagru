<?php

	$tables = array(
		'users' => "CREATE TABLE users (
						id INT NOT NULL AUTO_INCREMENT,
						login VARCHAR(10) NOT NULL,
						email VARCHAR(255) NOT NULL,
						password VARCHAR(255) NOT NULL,
						confirm TINYINT(1) DEFAULT 0 NOT NULL,
						token VARCHAR(32) DEFAULT '',
						avatar VARCHAR(255) DEFAULT 'views/pictures/avatars/default.png', 
						PRIMARY KEY (id)) ENGINE=InnoDB
						CHARACTER SET utf8mb4",

		'photos' => 'CREATE TABLE photos (
						id_photo INT NOT NULL AUTO_INCREMENT,
						id_user INT NOT NULL,
						title VARCHAR(255) NOT NULL,
						path VARCHAR(255) NOT NULL,
						likes INT DEFAULT NULL,
						date DATE DEFAULT NULL,
						PRIMARY KEY (id_photo)) ENGINE=InnoDB
						CHARACTER SET utf8mb4',

		'comments' => 'CREATE TABLE comments (
						id_photo INT NOT NULL,
						id_user INT NOT NULL,
						id_author INT NOT NULL,
						comment TEXT NOT NULL,
						date DATE DEFAULT NULL) ENGINE=InnoDB
						CHARACTER SET utf8mb4'
	);

	define('TABLES', $tables);

	$olrudenk_password = '$2y$10$OLvVti4OPYWwhi7hD1nheOtxYh9yW81lngn2Kfw1FsRifq7REUNwC';
	$dpiven_password = '$2y$10$3HFOuwEMNDOVV63P2ZtHOu/iNhkIHnCp6OxybW8cJ7bXktovv8oJG';
	$dminakov_password = '$2y$10$H4NUQWj7yU3zNUXJqp58A.xuxuFZtyBx11M4LclYGvf4qPUkHsahO';

	$users = array(

		'users' => "INSERT INTO users(login, email, password, confirm, avatar) VALUES ('olrudenk', 'olrudenk@gmail.com', '$olrudenk_password', '1', 'views/pictures/avatars/olrudenk.jpg');
					INSERT INTO users(login, email, password, confirm, avatar) VALUES ('dpiven', 'dpiven@gmail.com', '$dpiven_password', '1', 'views/pictures/avatars/dpiven.jpg');
					INSERT INTO users(login, email, password, confirm, avatar) VALUES ('dminakov', 'dminakov@gmail.com', '$dminakov_password', '1', 'views/pictures/avatars/dminakov.jpg');"

	);

	define('USERS', $users);
