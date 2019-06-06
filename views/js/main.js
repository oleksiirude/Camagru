if (document.documentURI === 'http://localhost/') { //for home
//if (document.documentURI === 'http://localhost:8080/') { //for unit
	window.scrollTo(0, 0);
	let parent = document.getElementsByClassName('posts_main')[0];
	ajaxMainFeed(parent,0);
	window.onscroll = () => {
		let scrollHeight, clientHeight, position, elements;
		scrollHeight = Math.max(
			document.body.scrollHeight, document.documentElement.scrollHeight,
			document.body.offsetHeight, document.documentElement.offsetHeight,
			document.body.clientHeight, document.documentElement.clientHeight
		);
		clientHeight = document.documentElement.clientHeight;
		position = scrollHeight - window.pageYOffset - clientHeight;
		if (position === 0) {
			elements = parent.getElementsByClassName('post_container').length;
			setTimeout(() =>
				ajaxMainFeed(parent, elements),500);
		}
	}
}

function ajaxMainFeed(parent, elements) {
	let ajax = new XMLHttpRequest();
	ajax.open('POST', 'main/getfivepostsmain', true);
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajax.send('elements='+elements);

	ajax.onreadystatechange = () => {
		if (ajax.status !== 200) {
			location.href = 'error';
		}
		if (ajax.readyState === 4) {
			let result = JSON.parse(ajax.responseText);
			//let result = ajax.responseText;
			//console.log(result);
			if (result.length > 0)
				addContent(parent, result);
			else if (result['empty'] === true) {
				let empty = document.getElementById('empty');
				if (empty)
					empty.remove();
				empty = document.createElement('p');
				empty.id = 'empty';
				empty.style.fontWeight = 'bold';
				empty.style.color = 'darkred';
				empty.innerHTML = "It seems that there is totally empty here";
				parent.append(empty);
			}
		}
	};
}

function warn() {
	let substrate = document.getElementsByClassName('substrate')[0];
	let warn = document.getElementsByClassName('warn')[0];

	warn.style.display = 'block';
	warn.style.marginTop =  window.pageYOffset+100+'px';
	substrate.style.display = 'block';
	window.onclick = (e) => {
		if (e.target === substrate) {
			substrate.style.display = 'none';
			warn.style.display = 'none';
		}
	};
}