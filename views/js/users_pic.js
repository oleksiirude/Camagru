document.getElementById('backFromPic').addEventListener('click', backFromPic);
document.getElementById('upload').addEventListener('change', getUsersPicInWorkplace);

function getUsersPicInWorkplace() {
	let workplace, pic_error, valid_pic, snap;

	document.getElementsByClassName('camera')[0].setAttribute('style', 'display: none');
	document.getElementsByClassName('uploadPic')[0].setAttribute('style', 'display: none');
	document.getElementById('backFromPic').setAttribute('style', 'display: inline-block');


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
		 		if (result['result'] === true) {
					clearCanvas();
					valid_pic = document.createElement('img');
					valid_pic.id = 'valid_pic';
					valid_pic.className = 'valid_pic';
					valid_pic.setAttribute('src', result['base64']);
					workplace.appendChild(valid_pic);

					snap = document.getElementById('snap');
					snap.setAttribute('style', 'display: block');
					snap.addEventListener('click', getUsersPicPreview);
					snap.removeEventListener('click', makeSnap);
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

function backFromPic() {
	clearCanvas();
	let pic_error = document.getElementById('pic_error');
	if (pic_error)
		pic_error.remove();

	document.getElementsByClassName('snapContainer')[0].setAttribute('style', 'display: block');
	document.getElementById('video').setAttribute('style', 'display: none');
	document.getElementsByClassName('camera')[0].setAttribute('style', 'display: inline-block');
	document.getElementById('snap').setAttribute('style', 'display: none');
	document.getElementById('backFromCam').setAttribute('style', 'display: none');
	document.getElementsByClassName('uploadPic')[0].setAttribute('style', 'display: block');
	document.getElementById('backFromPic').setAttribute('style', 'display: none');

	let valid_pic = document.getElementById('valid_pic');
	if (valid_pic)
		valid_pic.remove();

	let images = document.getElementsByClassName('workplace')[0].getElementsByClassName('mask');
	if (images.length > 0)
		while (images.length--)
			images[0].remove();
}

function getUsersPicPreview() {
	let snap = document.getElementById('snap');
	snap.disabled = true;
	let canvas = document.getElementById('canvas');
	let context = canvas.getContext('2d');
	let pic = document.getElementById('valid_pic');

	context.drawImage(pic, 0, 0, 640, 480);
	let images = document.getElementsByClassName('workplace')[0].getElementsByClassName('mask');
	ajaxMontage(canvas.toDataURL(), getData(images));
}

function clearCanvas() {
	let canvas = document.getElementById('canvas');
	let context = canvas.getContext('2d');
	context.clearRect(0, 0, canvas.width, canvas.height);
}