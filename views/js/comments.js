function showComments(e) {
	let container, button, id, comment_box;

	container = e.target.parentNode.parentElement;
	button = e.target;
	id = button.id.replace('comments', '');
	button.removeEventListener('click', showComments);

	comment_box = document.createElement('div');
	comment_box.id = id;
	comment_box.className = 'comment_box';

	//load comments
	getComments(id, comment_box, container);

	button.onclick = () => {
		comment_box = document.getElementById(id);
		if (comment_box)
			comment_box.remove();
		button.addEventListener('click', showComments);
	};
}

function getComments(id, comment_box, container) {
	let ajax = new XMLHttpRequest();
	ajax.open('POST', 'profile/getcomments', true);
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajax.send('id='+id);

	ajax.onreadystatechange = () => {
		if (ajax.status !== 200) {
			location.href = 'error';
		}
		if (ajax.readyState === 4) {
			let result = JSON.parse(ajax.responseText);
			//let result = ajax.responseText;
			// console.log(result);
			let textarea, button_add, box, avatar, date, text;
			if (result.length > 0) {
				for (let i = 0; i < result.length; i++) {
					box = document.createElement('div');
					box.className = 'comment_container';

					avatar = document.createElement('img');
					avatar.src = result[i]['author_avatar'];
					avatar.className = 'avatar_comment';
					avatar.title = result[i]['author_login'];

					date = document.createElement('span');
					date.className = 'date_comment';
					date.innerHTML = result[i]['add_date'];

					text = document.createElement('span');
					text.className = 'text_comment';
					text.innerHTML = result[i]['comment'];

					box.appendChild(avatar);
					box.appendChild(date);
					box.appendChild(text);

					comment_box.appendChild(box);
				}
			}
				textarea = document.createElement('textarea');
				textarea.placeholder = 'type here up to 300 symbols';
				textarea.className = 'add_comment_input';
				textarea.name = 'comment';

				button_add = document.createElement('button');
				button_add.className = 'submit_button';
				button_add.style.marginTop = '-2px';
				button_add.innerHTML = 'add';
				button_add.addEventListener('click', addComment);
				comment_box.appendChild(textarea);
				comment_box.appendChild(button_add);

				container.appendChild(comment_box);

		}
	};
}

function addComment(e) {
	let button = e.target;
	button.disabled = true;

	let error = document.getElementById('comment_error');
	if (error)
		error.remove();

	let post_id = e.target.parentElement.id;
	let last = e.target.parentNode.childNodes;
	let length = last.length - 2;
	if (validateInputComment(last[length], e.target.parentNode)) {
		button.disabled = false;
		return;
	}

	let comment = last[length].value.replace(/&/g, 'amp');
	comment = comment.trim().replace(/\s\s+/g, ' ');
	let ajax = new XMLHttpRequest();
	ajax.open('POST', 'profile/addcomment', true);
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	let json = {};
	json['post'] = post_id;
	json['comment'] = comment;
	ajax.send('data='+JSON.stringify(json));


	// ajax.onreadystatechange = () => {
	// 	if (ajax.status !== 200) {
	// 		location.href = 'error';
	// 	}
	// 	if (ajax.readyState === 4) {
	// 		let result = ajax.responseText;
	// 		console.log(result);
	// 	}
	// };


	//post new comment
	let counter = e.target.parentNode.parentNode;
	counter = counter.getElementsByClassName('activity_box')[1].getElementsByTagName('p')[0];
	let value = parseInt(counter.innerHTML);
	value++;
	counter.innerHTML = value;

	let box, avatar, date, text;
	let last1 = e.target.parentNode;
	let length1 = last1.childNodes.length - 2;
	box = document.createElement('div');
	box.className = 'comment_container';

	let src = document.getElementsByTagName('header')[0];
	src = src.getElementsByClassName('avatar')[0];
	avatar = document.createElement('img');
	avatar.src = src.src;

	let login = document.getElementsByTagName('header')[0];
	login = login.getElementsByClassName('avatar')[0];
	avatar.className = 'avatar_comment';
	avatar.title = login.title;

	date = document.createElement('span');
	date.className = 'date_comment';
	date.innerHTML = 'posted just now';

	text = document.createElement('span');
	text.className = 'text_comment';
	text.innerHTML = comment;

	box.appendChild(avatar);
	box.appendChild(date);
	box.appendChild(text);

	last1.insertBefore(box, last1.childNodes[length1]);

	setTimeout( () => {
		button.disabled = false;
	}, 3000);
}

function validateInputComment(input, parent) {
	let error = document.createElement('p');
	error.className = 'comment_error';
	error.id = 'comment_error';

	if (input.value.length <= 0) {
		error.innerHTML = 'please, type something';
		parent.insertBefore(error, parent.lastChild);
		return true;
	}
	else if (input.value.length > 300) {
		error.innerHTML = 'too many symbols';
		parent.insertBefore(error, parent.lastChild);
		return true;
	}
	return false;
}