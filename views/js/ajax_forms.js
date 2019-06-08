let form = document.getElementById('form');
if (form)
	form.addEventListener('submit', check);

function check(e) {
	e.preventDefault();
	let action = e.target.getAttribute('action');
	let warning = document.getElementById('warning');
	if (warning)
		warning.remove();
	let submit_button = document.getElementsByClassName('submit_button')[0];
	if (submit_button) {
		submit_button.disabled = true;
		submit_button.style.backgroundColor = '#959595';
	}
	let link_back = document.getElementById('link_back');
	if (link_back)
		link_back.setAttribute('style', 'display: none');
	ajax(e.target, action);
}

function ajax(object, action) {
	let ajax = new XMLHttpRequest();
	ajax.open('POST', action, true);

	let values = {};
	for (let i = 0; i < object.length - 1; i++)
		values[object.elements[i].name] = object.elements[i].value;
	let json = JSON.stringify(values);

	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajax.send(json);

	ajax.onreadystatechange = () => {
		if (ajax.status !== 200) {
			location.href = 'error';
		}
		if (ajax.readyState === 4) {
			let result = JSON.parse(ajax.responseText);
			// let result = ajax.responseText;
			// console.log(result);
			if (result === true)
				location.href = '';
			else if (result === 'link')
				messageDone("recovery link has been sent<br>check email",
					'main page', '/');
			else if (result === 'recover')
				messageDone("your password has been changed<br>now you can log in",
					'login page', 'user/login');
			else if (result === 'registered')
				messageDone("activation link has been sent<br>check email",
					'main page', '/');
			else if (result === 'login_changed')
				messageDone("your login has been changed<br>",
					'back', 'user/settings');
			else if (result === 'email_changed')
				messageDone("your email has been changed<br>",
					'back', 'user/settings');
			else if (result === 'password_changed')
				messageDone("your password has been changed<br>",
					'back', 'user/settings');
			else if (result === 'avatar_changed')
				location.href = 'user/profile';
			else
				addWarning(result);
		}
	}
}

function addWarning(result) {
	let link_back = document.getElementById('link_back');
	if (link_back)
		link_back.setAttribute('style', 'display: block');
	let submit_button = document.getElementsByClassName('submit_button')[0];
	if (submit_button) {
		submit_button.disabled = false;
		submit_button.style.backgroundColor = '#5a5a5a';
	}

	let form = document.getElementById(result['id']);
	let warning = document.createElement('div');
	warning.innerHTML = result['warning'];
	warning.setAttribute('class', 'error');
	warning.setAttribute('id', 'warning');
	form.appendChild(warning);
}

function messageDone(text, to, url) {
	document.getElementsByClassName('menu')[0].remove();
	let wrapper = document.getElementsByClassName('wrapper')[0];

	let message = document.createElement('div');
	message.innerHTML = text;
	message.setAttribute('class', 'message');

	let link = document.createElement('a');
	link.innerHTML = to;
	link.setAttribute('style', 'color: darkred');
	link.setAttribute('href', url);

	message.appendChild(document.createElement('br'));
	message.appendChild(link);
	wrapper.appendChild(message);
}
