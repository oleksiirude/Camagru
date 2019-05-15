<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title; ?></title>
	<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/views/css/styles.css">
</head>
<body>
	<?php require_once (ROOT.'views/default/header.php'); ?>
	<?php echo $content; ?>
	<?php require_once (ROOT.'views/default/footer.php'); ?>
</body>
</html>
