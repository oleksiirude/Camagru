# Camagru [125/125]
This project at UNIT Factory (School 42) is about creating a web-application on MVC handmade framework.

Main aim of this project is to build a complex web-app without any external framework. Only pure PHP and JS.
This app it's something like insta-snapchat. You can add photos or take snaps from webcam, edit them with masks, post these stuff, comment and like posts of others, etc.

Technologies used in project developing:
- Back-end: pure PHP with handmaded MVC framework, GD lib (work with images)
- Front-end: pure HTML, CSS and JS
- data exchange - AJAX
- responsive by css media queries

Functionality of my app is:
1. Entering the site:
- complex registration with confirm link
- login with ability to recover password if forgot
2. User settings:
- change login, email, password
- set up avatar, delete avatar
- set up notification
- complex user account deleteing (with all it's stuff on server)
3. Studio/workshop
- live masks imposition on webcam
- edtiting of your own image (jpeg/png)
- list of previosly taken snashots
- make post with one of them
4. Profile
- list of all your posts with comments and likes
- ability to delete your post
- infinitive pagination
5. Main feed
- list of all posts from all users
- ability to like and comment their posts
- infinitive pagination
6. Logout
- yes, user can logout! impressive, doesn't it? :D

Site/app has responsive design and you can view it's content with comfort in small resolution/devices.

Few words about security: you can't enter the main part of site while you don't login, unlogged users can only see all posts but can't like or comment them. All password are well encrypted by password_hash PHP function, app is safe of SQL-injections, pieces of HTML/JS code. All php-files are secured from straight opening from browser url. Also app has ability to validate uploaded files, and if you want to upload some unwanted stuff - you receive an error-message.

Here you are some super collage pics:
![alt text](https://github.com/oleksiirude/Camagru_mvc/blob/master/img/responsive.png)
![alt text](https://github.com/oleksiirude/Camagru_mvc/blob/master/img/main.png)
![alt text](https://github.com/oleksiirude/Camagru_mvc/blob/master/img/settings.png)

And now, how to run:
- you should have something like XAMPP, MAMP, LAMP, etc.
- all config info about databse connection located in Camagru/config/config.php.
- copy all stuff from Camagru directory to the root of your server (in MAMP for example it's: MAMP/apache2/htdocs)
- open browser, type localhost[maybe some special port here?] or name of your domain and enjoy!

You can read project requirement in Subject pdf.
