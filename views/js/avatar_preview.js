function getAvatarPreview() {
	let preview, avatar, new_elem, path;

	preview = document.getElementById('temp_preview');
	if (preview)
		preview.remove();

	avatar = document.getElementById('change_avatar').files[0];

	if (/.*(.jpe?g|.png)$/i.test(avatar.name)) {
		preview = document.getElementById('avatar_preview');
		if (avatar.size > 1000000) {
			new_elem = document.createElement('p');
			new_elem.id = 'temp_preview';
			new_elem.innerHTML = 'too big file!';
			new_elem.setAttribute('style', 'color: red; font-size: xx-large');
			preview.appendChild(new_elem);
			return;
		}

		new_elem = document.createElement('img');
		new_elem.id = 'temp_preview';
		new_elem.className = 'avatar_preview';

		path = URL.createObjectURL(avatar);
		new_elem.setAttribute('src', path);
		preview.appendChild(new_elem);
		document.getElementById('change_avatar_button').style.display = 'block';
	}
	else {
		preview = document.getElementById('avatar_preview');

		new_elem = document.createElement('p');
		new_elem.innerHTML = 'invalid file!';
		new_elem.setAttribute('style', 'color: red; font-size: xx-large');
		preview.appendChild(new_elem);
	}
}