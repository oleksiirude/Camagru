function ajax_img(event, object, action) {
	event.preventDefault();

	let file = document.getElementById('change_avatar').files[0];
	let formData = new FormData();
	formData.append('avatar', file);
	let ajax = new XMLHttpRequest();
	ajax.open('POST', action, true);
	ajax.send(formData);

	ajax.onreadystatechange = function () {
		if (ajax.status !== 200) {
			location.href = 'error';
		}
		if (ajax.readyState === 4) {
			let result = JSON.parse(ajax.responseText);
			//let result = ajax.responseText;
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