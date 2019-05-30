function doPost(img) {

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
	console.log(img.target);
	window.onclick = (e) => {
		if (e.target === substrate) {
			substrate.style.display = 'none';
			post.style.display = 'none';
		}
	}
}