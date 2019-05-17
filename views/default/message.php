<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<base href="/">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title ?></title>
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/views/css/styles.css">
</head>
<body>
<?php require_once (ROOT.'views/default/header.php'); ?>
<div class="wrapper">
    <div class="status_form">
	    <p><?= $message; ?></p>
    </div>
</div>
<?php require_once (ROOT.'views/default/footer.php'); ?>
</body>
</html>
