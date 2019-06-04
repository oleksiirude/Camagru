function makeLike(e) {
	let parent = e.target.parentElement;
	let like = e.target;
	like.src = 'views/pictures/service/liked.png';
	like.removeEventListener('click', makeLike);
	let counter = parent.childNodes[1];
	counter = parseInt(counter.innerHTML);
	counter++;
	let p = parent.childNodes[1];
	p.innerHTML = counter;

	let post = e.target.parentNode.parentNode;
	post = post.getElementsByClassName('post_photo')[0];
	post = post.id.replace(/img/, '');

	let ajax = new XMLHttpRequest();
	ajax.open('POST', 'profile/makelike', true);
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajax.send('post='+post);
}