function check(event, object, action) {
	let warning = document.getElementById('warning');
	if (warning)
		warning.remove();
	let send_button = document.getElementById('send_button');
	if (send_button)
		send_button.disabled = true;
	//delete back link!!!
	ajax(event, object, action);
}

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
		if (ajax.status !== 200) {
			location.href = 'error';
		}
		if (ajax.readyState === 4) {
			let result = JSON.parse(ajax.responseText);
			//let result = ajax.responseText;
			console.log(result);
			if (result === true)
				location.href = '';
			else if (result === 'link')
				messageRecoveryPassword();
			else if (result === 'recover')
				messageRecoveryPasswordDone();
			else
				addWarning(result);
		}
	}
}

function addWarning(result) {
	let send_button = document.getElementById('send_button');
	if (send_button)
		send_button.disabled = false;

	let form = document.getElementById(result['id']);
	let warning = document.createElement('div');
	warning.innerHTML = result['warning'];
	warning.setAttribute('class', 'error');
	warning.setAttribute('id', 'warning');
	form.appendChild(warning);
}

function messageRecoveryPassword() {
	document.getElementById('login_menu').remove();
	let wrapper = document.getElementById('wrapper');

	let message = document.createElement('div');
	message.innerHTML = "the link has been sent, check mail";
	message.setAttribute('class', 'message');

	let link = document.createElement('a');
	link.innerHTML = "to main page";
	link.setAttribute('style', 'color: darkred');
	link.setAttribute('href', '/');

	message.appendChild(document.createElement('br'));
	message.appendChild(link);
	wrapper.appendChild(message);
}

function messageRecoveryPasswordDone() {
	document.getElementById('login_menu').remove();
	let wrapper = document.getElementById('wrapper');

	let message = document.createElement('div');
	message.innerHTML = "your password has been changed<br>now you can log in";
	message.setAttribute('class', 'message');

	let link = document.createElement('a');
	link.innerHTML = "to login from";
	link.setAttribute('style', 'color: darkred');
	link.setAttribute('href', 'user/login');

	message.appendChild(document.createElement('br'));
	message.appendChild(link);
	wrapper.appendChild(message);
}
