if (document.documentURI === 'http://camagru.us-east-2.elasticbeanstalk.com/user/change/notifications') {
	let ajax = new XMLHttpRequest();
	ajax.open('POST', 'user/getnotificationsmode', true);
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajax.send();

	ajax.onreadystatechange = () => {
		if (ajax.status !== 200) {
			location.href = 'error';
		}
		if (ajax.readyState === 4) {
			let result = JSON.parse(ajax.responseText);
			//console.log(ajax.responseText);
			let slider = document.getElementById("slider");
			let circle = document.getElementById("circle");
			let circle_content = document.getElementById("circle-content");

			if (result === true) {
				document.getElementById("switch").addEventListener('click', setToFalse);
			}
			else if (result === false) {
				slider.classList.toggle('change');
				circle.classList.toggle('change');
				circle_content.classList.toggle('change');
				document.getElementById("switch").addEventListener('click', setToTrue);
			}
		}
	}
}

function setToFalse() {
	let slider = document.getElementById("slider");
	let circle = document.getElementById("circle");
	let circle_content = document.getElementById("circle-content");
	slider.classList.toggle('change');
	circle.classList.toggle('change');
	circle_content.classList.toggle('change');
	setNotificationTo(false);
}

function setToTrue() {
	let slider = document.getElementById("slider");
	let circle = document.getElementById("circle");
	let circle_content = document.getElementById("circle-content");
	slider.classList.toggle('change');
	circle.classList.toggle('change');
	circle_content.classList.toggle('change');
	setNotificationTo(true);
}

function setNotificationTo(boolean) {

	let ajax = new XMLHttpRequest();
	ajax.open('POST', 'user/setnotificationsmode', true);
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajax.send('boolean='+JSON.stringify(boolean));


	if (boolean === false) {
		document.getElementById("switch").removeEventListener('click', setToFalse);
		document.getElementById("switch").addEventListener('click', setToTrue);
	}
	else {
		document.getElementById("switch").removeEventListener('click', setToTrue);
		document.getElementById("switch").addEventListener('click', setToFalse);
	}
}