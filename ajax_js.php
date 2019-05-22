<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<base href="/">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ajax</title>
</head>
<body>
<form id="test" onsubmit="ajax(event, this, 'test.php')">
	<label for="login">log</label>
	<input type="text" name="login" id="login"><br>
	<label for="password">pas</label>
	<input type="password" name="password" id="password"><br>
	<label for="confirm">con</label>
	<input type="password" name="confirm" id="confirm"><br>
	<button id="btn" type="submit">submit</button>
</form>
</body>
<script>

	function ajax(event, object, action) {
		event.preventDefault();

		let ajax = new XMLHttpRequest();
		ajax.open('POST', action, true);

		let values = {};
		for (let i = 0; i < object.length - 1; i++)
			values[object.elements[i].name] = object.elements[i].value;
		let json = JSON.stringify(values);

		ajax.setRequestHeader('Content-Type',
			'application/x-www-form-urlencoded');
		ajax.send(json);

		ajax.onreadystatechange = function () {
			if (ajax.readyState !== 4)
				location.href = 'error.php';
			if (ajax.status !== 200)
				location.href = 'error.php';
			else {
				let result = JSON.parse(ajax.responseText);
				if (result === true)
					return true;
				else
					addWarning(result);
			}
		}
	}
</script>
</html>