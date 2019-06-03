<?php

	$tables = array(
		'users' => "CREATE TABLE users (
						id INT NOT NULL AUTO_INCREMENT,
						login VARCHAR(10) NOT NULL,
						email VARCHAR(255) NOT NULL,
						password VARCHAR(255) NOT NULL,
						confirm TINYINT(1) DEFAULT 0 NOT NULL,
						token VARCHAR(32) DEFAULT '',
						avatar VARCHAR(255) DEFAULT NULL, 
						PRIMARY KEY (id)) ENGINE=InnoDB
						CHARACTER SET utf8mb4",

		'posts' => 'CREATE TABLE posts (
						id INT NOT NULL AUTO_INCREMENT,
						user VARCHAR(10)NOT NULL,
						user_avatar VARCHAR(255) NOT NULL,
						description VARCHAR(100) NOT NULL,
						likes INT DEFAULT 0,
						comments INT DEFAULT 0,
						add_date DATETIME NOT NULL,
						path VARCHAR(255) NOT NULL,
						PRIMARY KEY (id)) ENGINE=InnoDB
						CHARACTER SET utf8mb4',

		'comments' => 'CREATE TABLE comments (
						post INT NOT NULL,
						author_id INT NOT NULL,
						author_login VARCHAR(10) NOT NULL,
						author_avatar VARCHAR(255) NOT NULL,
						add_date DATETIME NOT NULL,
						comment TEXT NOT NULL) ENGINE=InnoDB
						CHARACTER SET utf8mb4'
	);

	define('TABLES', $tables);

	$olrudenk_password = '$2y$10$OLvVti4OPYWwhi7hD1nheOtxYh9yW81lngn2Kfw1FsRifq7REUNwC';
	$dpiven_password = '$2y$10$3HFOuwEMNDOVV63P2ZtHOu/iNhkIHnCp6OxybW8cJ7bXktovv8oJG';
	$dminakov_password = '$2y$10$H4NUQWj7yU3zNUXJqp58A.xuxuFZtyBx11M4LclYGvf4qPUkHsahO';

	$users = array(

		'users' => "INSERT INTO users(login, email, password, confirm) VALUES ('olrudenk', 'olrudenk@gmail.com', '$olrudenk_password', '1');
					INSERT INTO users(login, email, password, confirm) VALUES ('dpiven', 'dpiven@gmail.com', '$dpiven_password', '1');
					INSERT INTO users(login, email, password, confirm) VALUES ('dminakov', 'dminakov@gmail.com', '$dminakov_password', '1');"

	);

	define('USERS', $users);
