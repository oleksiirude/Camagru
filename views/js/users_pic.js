function getUsersPicInWorkplace() {
	let workplace, pic_error, valid_pic, snap;

	document.getElementsByClassName('camera')[0].setAttribute('style', 'display: none');
	document.getElementsByClassName('upload_pic')[0].setAttribute('style', 'display: none');
	document.getElementById('back_upload').setAttribute('style', 'display: inline-block');


	workplace = document.getElementsByClassName('workplace')[0];

	let pic = document.getElementById('upload').files[0];
	if (/.*(.jpe?g|.png)$/i.test(pic.name)) {
		if (pic.size > 5000000) {
			pic_error = document.createElement('p');
			pic_error.id = 'pic_error';
			pic_error.className = 'pic_error';
			pic_error.innerHTML = 'too big image!<p style="font-size: 16px">up to 5mb is valid</p>';
			workplace.appendChild(pic_error);
			return;
		}

		let formData = new FormData();
		formData.append('pic', pic);
		let ajax = new XMLHttpRequest();
		ajax.open('POST', 'workshop/userspicvalidate', true);
		ajax.send(formData);

		ajax.onreadystatechange = function () {
		if (ajax.status !== 200) {
		 		location.href = 'error';
		 	}
		 	if (ajax.readyState === 4) {
		 		let result = JSON.parse(ajax.responseText);
		 		//let result = ajax.responseText;
		 		//console.log(result);
		 		if (result['result'] === true) {
					clearCanvas();
					valid_pic = document.createElement('img');
					valid_pic.id = 'valid_pic';
					valid_pic.className = 'valid_pic';
					valid_pic.setAttribute('src', result['base64']);
					workplace.appendChild(valid_pic);

					snap = document.createElement('button');
					snap.innerText = 'SNAP!';
					snap.setAttribute('id', 'users_pic_snap');
					snap.setAttribute('class', 'submit_button');
					snap.setAttribute('style', 'display: block');
					workplace.appendChild(snap);
					snap.addEventListener('click', getUsersPicPreview);
				}
				else {
					pic_error = document.createElement('p');
					pic_error.id = 'pic_error';
					pic_error.className = 'pic_error';
					pic_error.innerHTML = result['warning'];
					workplace.appendChild(pic_error);
				}
			}
		};
	}
	else {
		pic_error = document.createElement('p');
		pic_error.id = 'pic_error';
		pic_error.className = 'pic_error';
		pic_error.innerHTML = 'invalid file!';
		workplace.appendChild(pic_error);
	}
}

function backToMain() {
	clearCanvas();
	let pic_error = document.getElementById('pic_error');
	if (pic_error)
		pic_error.remove();

	document.getElementsByClassName('nowebcam')[0].setAttribute('style', 'display: block');
	document.getElementById('video').setAttribute('style', 'display: none');
	document.getElementsByClassName('camera')[0].setAttribute('style', 'display: inline-block');
	document.getElementById('snap').setAttribute('style', 'display: none');
	document.getElementById('back').setAttribute('style', 'display: none');
	document.getElementsByClassName('upload_pic')[0].setAttribute('style', 'display: block');
	document.getElementById('back_upload').setAttribute('style', 'display: none');

	let users_pic = document.getElementById('valid_pic');
	if (users_pic)
		users_pic.remove();
	let users_pic_snap = document.getElementById('users_pic_snap');
	if (users_pic_snap)
		users_pic_snap.remove();

	let images = document.getElementsByClassName('workplace')[0].getElementsByClassName('mask');
	if (images.length > 0)
		while (images.length--)
			images[0].remove();
}

function getUsersPicPreview() {
	let snap = document.getElementById('users_pic_snap');
	snap.disabled = true;
	let canvas = document.getElementById('canvas');
	let context = canvas.getContext('2d');
	let pic = document.getElementById('valid_pic');

	context.drawImage(pic, 0, 0, 640, 480);
	let images = document.getElementsByClassName('workplace')[0].getElementsByClassName('mask');
	ajaxMontage(canvas.toDataURL(), getData(images), 'pic');
}

function clearCanvas() {
	let canvas = document.getElementById('canvas');
	let context = canvas.getContext('2d');
	context.clearRect(0, 0, canvas.width, canvas.height);
}