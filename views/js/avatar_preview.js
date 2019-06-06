let change_avatar = document.getElementById('change_avatar');
if (change_avatar)
	change_avatar.addEventListener('change', getAvatarPreview);

function getAvatarPreview() {
	let preview, avatar, new_elem;

	preview = document.getElementById('new_avatar');
	if (preview)
		preview.remove();

	avatar = document.getElementById('change_avatar').files[0];
	if (/.*(.jpe?g|.png)$/i.test(avatar.name)) {
		preview = document.getElementById('avatar_preview');
		if (avatar.size > 5000000) {
			new_elem = document.createElement('p');
			new_elem.id = 'new_avatar';
			new_elem.innerHTML = 'too big image!';
			new_elem.setAttribute('style', 'color: red; font-size: large');
			preview.appendChild(new_elem);
			document.getElementById('change_avatar_button').style.display = 'none';
			return;
		}

		let formData = new FormData();
		formData.append('avatar', avatar);
		let ajax = new XMLHttpRequest();
		ajax.open('POST', 'user/change/avatar/validate', true);
		ajax.send(formData);

		ajax.onreadystatechange = () => {
			if (ajax.status !== 200) {
				location.href = 'error';
			}
			if (ajax.readyState === 4) {
				let result = JSON.parse(ajax.responseText);
				if (result['result'] === true) {
					new_elem = document.createElement('img');
					new_elem.id = 'temp_preview';
					new_elem.className = 'avatar_preview';

					new_elem.setAttribute('id', 'new_avatar');
					new_elem.setAttribute('src', result['base64']);
					preview.appendChild(new_elem);
					document.getElementById('change_avatar_button').style.display = 'inline-block';
				}
				else {
					preview = document.getElementById('avatar_preview');

					new_elem = document.createElement('p');
					new_elem.id = 'new_avatar';
					new_elem.innerHTML = result['warning'];
					new_elem.setAttribute('style', 'color: red; font-size: large');
					preview.appendChild(new_elem);
					document.getElementById('change_avatar_button').style.display = 'none';
				}
			}
		};
	}
	else {
		preview = document.getElementById('avatar_preview');

		new_elem = document.createElement('p');
		new_elem.id = 'new_avatar';
		new_elem.innerHTML = 'invalid file!';
		new_elem.setAttribute('style', 'color: red; font-size: large');
		preview.appendChild(new_elem);
		document.getElementById('change_avatar_button').style.display = 'none';
	}
}