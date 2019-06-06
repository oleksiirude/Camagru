function doPostIntention(img) {

	let substrate = document.getElementsByClassName('substrate')[0];
	let post = document.getElementsByClassName('make_post')[0];
	let pic_preview = document.getElementsByClassName('pic_preview')[0];
	if (pic_preview)
		pic_preview.remove();
	post.style.display = 'block';
	substrate.style.display = 'block';

	let pic = document.createElement('img');
	pic.src = img.target.src;
	pic.className = 'pic_preview';
	post.insertBefore(pic, post.childNodes[2]);
	window.onclick = (e) => {
		if (e.target === substrate) {
			substrate.style.display = 'none';
			post.style.display = 'none';
		}
	};
	document.getElementById('add_post').addEventListener('click', doPost);
}

function doPost() {
	let img = document.getElementsByClassName('pic_preview')[0];
	let error = document.getElementsByClassName('description_value_error')[0];
	if (error)
		error.remove();
	let parent = document.getElementsByClassName('make_post')[0];

	let description = document.getElementsByClassName('description_zone')[0];
	if (description.value.length <= 100)
		ajaxDoPost(description.value.trim().replace(/\s\s+/g, ' '), img.src);
	else {
		error = document.createElement('p');
		error.innerText = 'more than 100 symbols';
		error.className = 'description_value_error';
		parent.insertBefore(error, parent.childNodes[7]);
	}
}

function ajaxDoPost(description, photo) {

	let ajax = new XMLHttpRequest();
	ajax.open('POST', 'workshop/addpost', true);
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

	let json = {};
	json['photo'] = photo;
	json['description'] = description.replace(/&/g, 'amp');
	ajax.send('data='+JSON.stringify(json));

	ajax.onreadystatechange = () => {
		if (ajax.status !== 200) {
			location.href = 'error';
		}
		if (ajax.readyState === 4) {
			let result = JSON.parse(ajax.responseText);
			console.log(result);
			if (result === true)
				location.href = 'user/profile';
		}
	}
}