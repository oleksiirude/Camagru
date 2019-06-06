// if (document.documentURI === 'http://localhost/admin') {//for home
if (document.documentURI === 'http://localhost:8080/admin') { //for unit
	let not_logged_user = document.getElementsByClassName('enter_choice')[0];
	if (not_logged_user)
		not_logged_user.remove();
	let navbar = document.getElementsByClassName('navbar')[0];
	if (navbar)
		navbar.remove();
	let avatar = document.getElementsByClassName('avatar')[0];
	if (avatar)
		avatar.remove();

	let ajax = new XMLHttpRequest();
	ajax.open('POST', 'admin/checkiflogged', true);
	ajax.send();

	ajax.onreadystatechange = () => {
		if (ajax.status !== 200) {
			location.href = 'error';
		}
		if (ajax.readyState === 4) {
			let result = JSON.parse(ajax.responseText);
			//let result = ajax.responseText;
			//console.log(result);
			if (result === true) {
				document.getElementsByClassName('menu')[0].remove();
				let menu = document.getElementsByClassName('settings_menu')[0];
				menu.style.display = 'block';
				document.getElementById('create').addEventListener('click', reCreateDb);
				document.getElementById('logout').addEventListener('click', logout);
			}
		}
	};
	let form = document.getElementById('admin_form');
	if (form)
		form.addEventListener('submit', checkAdmin);
}

function checkAdmin(e) {
		e.preventDefault();
		let action = e.target.getAttribute('action');
		let warning = document.getElementById('warning');
		if (warning)
			warning.remove();
		let submit_button = document.getElementsByClassName('submit_button')[0];
		if (submit_button)
			submit_button.disabled = true;
		ajaxAdmin(e.target, action);
	}

function ajaxAdmin(object, action) {
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
				//let result = ajax.responseText;
				//console.log(result);
				if (result === true) {
					document.getElementsByClassName('menu')[0].remove();
					let menu = document.getElementsByClassName('settings_menu')[0];
					menu.style.display = 'block';
					document.getElementById('create').addEventListener('click', reCreateDb);
					document.getElementById('logout').addEventListener('click', logout);
				} else
					addWarning(result);
			}
		};
	}

function reCreateDb() {
		let ajax = new XMLHttpRequest();
		ajax.open('POST', 'admin/recreatedb', true);
		ajax.send();

		document.getElementById('create').style.backgroundColor = 'green';
	}

function logout() {
		let ajax = new XMLHttpRequest();
		ajax.open('POST', 'admin/logout', true);
		ajax.send();
		location.href = '';
	}