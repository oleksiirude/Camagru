let form_avatar = document.getElementById('form_avatar');
if (form_avatar)
	form_avatar.addEventListener('submit', set_new_avatar);

function set_new_avatar(e) {
	e.preventDefault();
	let avatar = document.getElementById('new_avatar').getAttribute('src');

	let ajax = new XMLHttpRequest();
	let data = {};
	ajax.open('POST', 'user/change/avatar/set', true);
	data['avatar'] = avatar;
	avatar = JSON.stringify(data);
	//console.log(avatar);
	ajax.send(avatar);

	ajax.onreadystatechange = function () {
		if (ajax.status !== 200) {
			location.href = 'error';
		}
		if (ajax.readyState === 4) {
			let result = JSON.parse(ajax.responseText);
			console.log(result);
			if (result === true)
				messageDone("your avatar has been changed<br>",
					'back', 'user/settings');
			else
				showError(result);
		}
	}
}

function showError(result) {
	let preview = document.getElementById('temp_preview');
	if (preview)
		preview.remove();

	let error = document.getElementById('avatar_preview');
	let new_elem = document.createElement('p');
	new_elem.id = 'temp_preview';
	new_elem.innerHTML = result['warning'];
	new_elem.setAttribute('style', 'color: red; font-size: large');
	error.appendChild(new_elem);
}