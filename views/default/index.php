<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <base href="/">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/views/css/styles.css">
	<script src="views/js/tooltips.js"></script>
</head>
<body>
	<?php require_once (ROOT.'views/default/header.php'); ?>
	    <?php echo $content; ?>
	<?php require_once (ROOT.'views/default/footer.php'); ?>
	<script src="views/js/avatar_preview.js"></script>>
</body>
</html>
