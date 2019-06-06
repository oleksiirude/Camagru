<?php

	$tables = array(
		'users' => "CREATE TABLE users (
						id INT NOT NULL AUTO_INCREMENT,
						login VARCHAR(10) NOT NULL,
						email VARCHAR(255) NOT NULL,
						password VARCHAR(255) NOT NULL,
						confirm TINYINT(1) DEFAULT 0 NOT NULL,
						token VARCHAR(32) DEFAULT '',
						notification TINYINT(1) DEFAULT 1 NOT NULL,
						avatar VARCHAR(255) DEFAULT NULL, 
						PRIMARY KEY (id)) ENGINE=InnoDB
						CHARACTER SET utf8mb4",

		'posts' => 'CREATE TABLE posts (
						id INT NOT NULL AUTO_INCREMENT,
						user VARCHAR(10) NOT NULL,
						user_avatar VARCHAR(255) NOT NULL,
						description VARCHAR(100) NOT NULL,
						likes INT DEFAULT 0,
						comments INT DEFAULT 0,
						add_date DATETIME NOT NULL,
						path VARCHAR(255) NOT NULL,
						PRIMARY KEY (id)) ENGINE=InnoDB
						CHARACTER SET utf8mb4',

		'likes' => "CREATE TABLE likes (
						post INT NOT NULL,
						owner INT NOT NULL,
						list TEXT NOT NULL DEFAULT '') ENGINE=InnoDB
						CHARACTER SET utf8mb4",

		'comments' => 'CREATE TABLE comments (
						post INT NOT NULL,
						owner VARCHAR(10) NOT NULL,
						author_login VARCHAR(10) NOT NULL,
						author_avatar VARCHAR(255) NOT NULL,
						add_date DATETIME NOT NULL,
						comment TEXT NOT NULL) ENGINE=InnoDB
						CHARACTER SET utf8mb4'
	);

	define('TABLES', $tables);

	$olrudenk_password = '$2y$10$OLvVti4OPYWwhi7hD1nheOtxYh9yW81lngn2Kfw1FsRifq7REUNwC';
	$kate_password = '$2y$10$CBBhezmNbhYxv0afGAa4jeonlaS/ZFqzCBVGFl1DvVKhmS4HMwWnS';
	$kaban_password = '$2y$10$PQgr91sw7cZxKfTAYtMZAuHxDITJG9IJLeBqgyaDX.BD4IU6nDT9a';

	$users = array(

		'users' => "INSERT INTO users(login, email, password, confirm, avatar) VALUES ('olrudenk', 'rudefromkiev@gmail.com', '$olrudenk_password', '1', 'views/pictures/avatars/1.jpeg');
					INSERT INTO users(login, email, password, confirm, avatar) VALUES ('kate', 'kate@gmail.com', '$kate_password', '1', 'views/pictures/avatars/2.jpeg');
					INSERT INTO users(login, email, password, confirm, avatar) VALUES ('kaban', 'kaban@gmail.com', '$kaban_password', '1', 'views/pictures/avatars/3.jpeg');"

	);

	define('USERS', $users);

	$posts = array(

		'posts' => "INSERT INTO posts(`user`, user_avatar, description, likes, comments, add_date, path) VALUES ('olrudenk', 'views/pictures/avatars/1.jpeg', 'just chilling at home', '3', '1', '2019-06-05 21:53:00', 'views/pictures/posts/1,1db1c0a63bee9fc69e2f434ae3eb9f41.jpeg');
					INSERT INTO posts(`user`, user_avatar, description, likes, comments, add_date, path) VALUES ('kate', 'views/pictures/avatars/2.jpeg', 'with my real king!', '3', '0', '2019-06-05 20:43:11', 'views/pictures/posts/2,9b85c3338e4b318ac47161273882167c.jpeg');
					INSERT INTO posts(`user`, user_avatar, description, likes, comments, add_date, path) VALUES ('kaban', 'views/pictures/avatars/3.jpeg', 'santa in Dragobrat', '3', '0', '2019-06-05 20:40:01', 'views/pictures/posts/3,9aabb0d5eb1be240884109a43b380922.jpeg');
					INSERT INTO posts(`user`, user_avatar, description, likes, comments, add_date, path) VALUES ('olrudenk', 'views/pictures/avatars/1.jpeg', 'swimming in winter', '3', '0', '2019-06-05 20:03:10', 'views/pictures/posts/1,12b5c630cbc147336f3923008fa37b4a.jpeg');
					INSERT INTO posts(`user`, user_avatar, description, likes, comments, add_date, path) VALUES ('kate', 'views/pictures/avatars/2.jpeg', 'simpsons)))', '3', '0', '2019-06-05 19:09:17', 'views/pictures/posts/2,30c81cd7f5737c8c7fedfb3ff937c8e5.jpeg');
					INSERT INTO posts(`user`, user_avatar, description, likes, comments, add_date, path) VALUES ('kaban', 'views/pictures/avatars/3.jpeg', 'I AM!', '3', '0', '2019-06-04 11:53:00', 'views/pictures/posts/3,7728aba89b0ca5814326118c4c6ae0ac.jpeg');
					INSERT INTO posts(`user`, user_avatar, description, likes, comments, add_date, path) VALUES ('olrudenk', 'views/pictures/avatars/1.jpeg', 'OMG!', '3', '0', '2019-06-04 11:43:10', 'views/pictures/posts/1,57ce37ecf225ebbf6546e5d8b7c72091.jpeg');
					INSERT INTO posts(`user`, user_avatar, description, likes, comments, add_date, path) VALUES ('kate', 'views/pictures/avatars/2.jpeg', 'mickey with horses', '2', '0', '2019-06-04 10:10:00', 'views/pictures/posts/2,08807e3c839690a9745a2aabb41fd697.jpeg');
					INSERT INTO posts(`user`, user_avatar, description, likes, comments, add_date, path) VALUES ('kaban', 'views/pictures/avatars/3.jpeg', 'SUPERDOG!', '3', '0', '2019-06-04 09:52:20', 'views/pictures/posts/3,b6a409437d30c004c9895888eb65736b.jpeg');
					INSERT INTO posts(`user`, user_avatar, description, likes, comments, add_date, path) VALUES ('olrudenk', 'views/pictures/avatars/1.jpeg', 'le superman', '3', '0', '2019-06-04 08:13:02', 'views/pictures/posts/1,62b641d823cd4cb3946689c152ee56ed.jpeg');
					INSERT INTO posts(`user`, user_avatar, description, likes, comments, add_date, path) VALUES ('kate', 'views/pictures/avatars/2.jpeg', 'with Jocker in Warsaw', '3', '0', '2019-06-03 18:33:40', 'views/pictures/posts/2,9824acc00485546f39e94a44d853311e.jpeg');
					INSERT INTO posts(`user`, user_avatar, description, likes, comments, add_date, path) VALUES ('kaban', 'views/pictures/avatars/3.jpeg', 'aliens...', '3', '0', '2019-06-03 17:17:30', 'views/pictures/posts/3,beef88b081830fa702c24bc312897e14.jpeg');
					INSERT INTO posts(`user`, user_avatar, description, likes, comments, add_date, path) VALUES ('olrudenk', 'views/pictures/avatars/1.jpeg', 'mr dangerous :D', '3', '0', '2019-06-03 16:34:40', 'views/pictures/posts/1,98bfe4369720c82695e6fc4d1f9fa347.jpeg');
					INSERT INTO posts(`user`, user_avatar, description, likes, comments, add_date, path) VALUES ('kate', 'views/pictures/avatars/2.jpeg', 'yeeehhhhaaaa!!!', '3', '0', '2019-06-03 15:13:20', 'views/pictures/posts/2,a04589ccfb1ae1bdf9f42f744906a5fa.jpeg');
					INSERT INTO posts(`user`, user_avatar, description, likes, comments, add_date, path) VALUES ('kaban', 'views/pictures/avatars/3.jpeg', 'my crazy dad', '3', '1', '2019-06-03 14:10:02', 'views/pictures/posts/3,dff12ea5500c190ae072efee9b7c9454.jpeg');"

	);

	define('POSTS', $posts);

	$comments = array(

		'comments' => "INSERT INTO comments(post, owner, author_login, author_avatar, add_date, comment) VALUES ('1', 'olrudenk', 'kate', 'views/pictures/avatars/2.jpeg', '2019-06-05 21:58:30', 'put off this stuff! it is mine )))');
						INSERT INTO comments(post, owner, author_login, author_avatar, add_date, comment) VALUES ('15', 'kaban', 'olrudenk', 'views/pictures/avatars/1.jpeg', '2019-06-03 15:43:11', 'yeah, it is me )');"
	);

	define('COMMENTS', $comments);

	$likes = array(

	'likes' => "INSERT INTO likes(post, owner, list) VALUES ('1', '1', '1,2,3');
				INSERT INTO likes(post, owner, list) VALUES ('2', '1', '1,2,3');
				INSERT INTO likes(post, owner, list) VALUES ('3', '1', '1,2,3');
				INSERT INTO likes(post, owner, list) VALUES ('4', '1', '1,2,3');
				INSERT INTO likes(post, owner, list) VALUES ('5', '1', '1,2,3');
				INSERT INTO likes(post, owner, list) VALUES ('6', '2', '1,2,3');
				INSERT INTO likes(post, owner, list) VALUES ('7', '2', '1,2,3');
				INSERT INTO likes(post, owner, list) VALUES ('8', '2', '1,2,');
				INSERT INTO likes(post, owner, list) VALUES ('9', '2', '1,2,3');
				INSERT INTO likes(post, owner, list) VALUES ('10', '2', '1,2,3');
				INSERT INTO likes(post, owner, list) VALUES ('11', '3', '1,2,3');
				INSERT INTO likes(post, owner, list) VALUES ('12', '3', '1,2,3');
				INSERT INTO likes(post, owner, list) VALUES ('13', '3', '1,2,3');
				INSERT INTO likes(post, owner, list) VALUES ('14', '3', '1,2,3');
				INSERT INTO likes(post, owner, list) VALUES ('15', '3', '1,2,3');"

	);

	define('LIKES', $likes);
