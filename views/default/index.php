<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <base href="/">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title; ?></title>
	<link rel="shortcut icon" href="views/pictures/service/logo.ico" type="image/x-icon">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/views/css/styles.css">
	<script src="views/js/tooltips.js"></script>
</head>
<body>
	<?php require_once (ROOT.'views/default/header.php'); ?>
	    <?php echo $content; ?>
	<?php require_once (ROOT.'views/default/footer.php'); ?>
	<script src="views/js/ajax_forms.js"></script>
	<script src="views/js/avatar_preview.js"></script>
	<script src="views/js/set_new_avatar.js"></script>
    <script src="views/js/cam.js"></script>
    <script src="views/js/dragndrop.js"></script>
	<script src="views/js/users_pic.js"></script>
	<script src="views/js/make_post.js"></script>
    <script src="views/js/profile.js"></script>
	<script src="views/js/comments.js"></script>
	<script src="views/js/likes.js"></script>
	<script src="views/js/main.js"></script>
	<script src="views/js/notifications.js"></script>
</body>
</html>
