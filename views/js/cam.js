let backFromCamButton = document.getElementById('backFromCam');
    if (backFromCamButton)
        backFromCamButton.addEventListener('click', backFromCam);
let camera = document.getElementsByClassName('camera')[0];
    if (camera)
        camera.addEventListener('click', getWebcam);

function getWebcam() {
    let video = document.getElementById('video');

    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {

        navigator.mediaDevices.getUserMedia({video: true}).then(function (stream) {
            video.srcObject = stream;
            document.getElementsByClassName('noWebcam')[0].style.display = 'none';
            document.getElementsByClassName('camera')[0].style.display = 'none';
            document.getElementById('video').style.display = 'block';
            document.getElementsByClassName('masks')[0].style.display = 'block';


            let snap = document.getElementById('snap');
            snap.addEventListener('click', makeSnap);
            snap.removeEventListener('click', getUsersPicPreview);

            setTimeout(() =>
                snap.style.display = 'inline-block',1200);
            setTimeout(() =>
                document.getElementById('backFromCam').style.display = 'inline-block',1200);
            let images = document.getElementsByClassName('webcam')[0].getElementsByClassName('mask');
            if (!images.length)
                snap.disabled = true;
            video.play();
        });
    }
}

function backFromCam() {
    let video = document.getElementById('video');
    video.srcObject.getTracks().forEach(track => track.stop());

    document.getElementById('video').style.display = 'none';
    document.getElementById('snap').style.display = 'none';
    document.getElementById('backFromCam').style.display = 'none';
    document.getElementsByClassName('noWebcam')[0].style.display = 'block';
    document.getElementsByClassName('camera')[0].style.display = 'inline-block';

    let images = document.getElementsByClassName('webcam')[0].getElementsByClassName('mask');
    if (images.length > 0)
        while (images.length--)
            images[0].remove();
}

function getData(images) {
    let data = {};
    let correction = document.getElementById('video').clientWidth;
    if (correction === 0)
        correction = document.getElementById('valid_pic').clientWidth;
    let parentPos = document.getElementsByClassName('webcam')[0].getBoundingClientRect();

    switch (correction) {
        case 640:
            correction = 1;
            break;
        case 400:
            correction = 1.6;
            break;
        case 320:
            correction = 2;
            break;
    }

    for (let i = 0; i < images.length; i++) {
        let childPos = images[i].getBoundingClientRect();
        let relativePos = {};

        relativePos.top = childPos.top - parentPos.top;
        relativePos.left = childPos.left - parentPos.left;

        let remove = /http:\/\/localhost:8080\//; //for unit
        // let remove = /http:\/\/localhost\//; //for home
        let link = images[i].src;
        link = link.replace(remove, '');
        data[i] = {
            link: link,
            sizeW: images[i].offsetWidth*correction,
            sizeH: images[i].offsetHeight*correction,
            posTop: parseInt(relativePos.top)*correction,
            posLeft: parseInt(relativePos.left)*correction
        }
    }
    return data;
}

function makeSnap() {
    let snap = document.getElementById('snap');
    snap.disabled = true;
    let canvas = document.getElementById('canvas');
    let context = canvas.getContext('2d');
    let video = document.getElementById('video');

    context.drawImage(video, 0, 0, 640, 480);
    let images = document.getElementsByClassName('webcam')[0].getElementsByClassName('mask');
    ajaxMontage(canvas.toDataURL(), getData(images));
}

function ajaxMontage(photo, data) {

    let ajax = new XMLHttpRequest();
    ajax.open('POST', 'workshop/getpreview', true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    let value = Object.keys(data).length;
    let json = {};
    while (value-- >= 0)
        json[value] = data[value];
    json['photo'] = photo;

    json = 'box='+JSON.stringify(json);
    ajax.send(json);

    ajax.onreadystatechange = () => {
        if (ajax.status !== 200) {
            location.href = 'error';
        }
        if (ajax.readyState === 4) {
            let result = ajax.responseText;
            if (result && result.search(/Fatal error/) < 0) {
                let pics = document.getElementsByClassName('pics')[0];
                if (pics.childElementCount >= 2)
                    pics.childNodes[0].remove();
                let img = document.createElement('img');
                img.setAttribute('src', result);
                img.setAttribute('class', 'pic');
                img.addEventListener('click', doPostIntention);
                pics.appendChild(img);
                document.getElementsByClassName('pics')[0].style.display = 'block';
            }
            let snap = document.getElementById('snap');
                snap.disabled = false;
        }
    }
}