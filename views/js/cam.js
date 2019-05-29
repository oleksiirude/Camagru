function getWebcam() {
    let video = document.getElementById('video');

    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {

        navigator.mediaDevices.getUserMedia({video: true}).then(function (stream) {
            video.srcObject = stream;
            document.getElementsByClassName('camera')[0].remove();
            document.getElementById('video').setAttribute('style', 'display: block');
            setTimeout(() =>
                document.getElementById('snap').setAttribute('style', 'display: block'),
                1200);
            video.play();
        })
    }
}

function getData(images) {
    let data = {};
    let parentPos = document.getElementsByClassName('workplace')[0].getBoundingClientRect();

    for (let i = 0; i < images.length; i++) {
        let childPos = images[i].getBoundingClientRect();
        let relativePos = {};

        relativePos.top = childPos.top - parentPos.top;
        relativePos.left = childPos.left - parentPos.left;

        //let remove = /http:\/\/localhost:8080\//; //for unit
        let remove = /http:\/\/localhost\//; //for home
        let link = images[i].src;
        link = link.replace(remove, '');
        data[i] = {
            link: link,
            sizeW: images[i].offsetWidth,
            sizeH: images[i].offsetHeight,
            posTop: parseInt(relativePos.top),
            posLeft: parseInt(relativePos.left)
        }
    }
    return data;
}

function makeSnap() {
    let canvas = document.getElementById('canvas');
    let context = canvas.getContext('2d');
    let video = document.getElementById('video');

    context.drawImage(video, 0, 0, 640, 480);
    let images = document.getElementsByClassName('workplace')[0].getElementsByClassName('mask');
    ajax_montage(canvas.toDataURL(), getData(images));
}


function ajax_montage(photo, data) {

    let ajax = new XMLHttpRequest();
    ajax.open('POST', 'workshop/savephoto', true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    //let json = 'photo='+JSON.stringify(photo)+'data='+JSON.stringify(data);

    let value = Object.keys(data).length;
    let json = {};
    while (value-- >= 0)
        json[value] = data[value];
    json['photo'] = photo;

    json = 'box='+JSON.stringify(json);
    ajax.send(json);

    ajax.onreadystatechange = function () {
        if (ajax.status !== 200) {
            location.href = 'error';
        }
        if (ajax.readyState === 4) {
            //let result = JSON.parse(ajax.responseText);
            let result = ajax.responseText;
            //console.log(result);
            if (result) {
                let pics = document.getElementsByClassName('pics')[0];
                if (pics.childElementCount >= 2)
                    pics.childNodes[0].remove();
                //console.log(pics);
                let img = document.createElement('img');
                img.setAttribute('src', result);
                img.setAttribute('class', 'pic');
                pics.appendChild(img);
            }
        }
    }
}