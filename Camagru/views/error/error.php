<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<head>
	<meta charset="UTF-8">
	<base href="/">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Camagru: error</title>
	<link rel="shortcut icon" href="views/pictures/service/logo.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/views/css/styles.css">
</head>
<body>
	<div class="wrapper" style="background-color: grey">
		<div class="error_block">
			<p>ERROR <?= $code; ?></p>
			<a style="font-size: 20px;" href="/">to home page</a>
		</div>
	</div>
</body>
</html>