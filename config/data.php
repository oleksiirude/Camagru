<?php

	$tables = array(
		'users' => 'CREATE TABLE users (
						id INT NOT NULL AUTO_INCREMENT,
						login VARCHAR(10) NOT NULL,
						email VARCHAR(255) NOT NULL,
						password VARCHAR(255) NOT NULL,
						PRIMARY KEY (id)) ENGINE=InnoDB
						CHARACTER SET utf8mb4',

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

	$users = array(
		'users' => "INSERT INTO users(login, email, password) VALUES ('olrudenk', 'olrudenk@gmail.com', 'Olrudenk-2019');
					INSERT INTO users(login, email, password) VALUES ('dpiven', 'dpiven@gmail.com', 'Dpiven-2019');
					INSERT INTO users(login, email, password) VALUES ('dminakov', 'dminakov@gmail.com', 'Dminakov-2019');"

	);

	define('USERS', $users);
