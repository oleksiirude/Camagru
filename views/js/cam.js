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

function makeSnap() {
    let canvas = document.getElementById('canvas');
    let context = canvas.getContext('2d');
    let video = document.getElementById('video');

    context.drawImage(video, 0, 0, 640, 480);
    ajax_test(canvas.toDataURL());
}


function ajax_test(photo) {

    let ajax = new XMLHttpRequest();
    ajax.open('POST', 'workshop/savephoto', true);
    ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    let json = 'photo='+JSON.stringify(photo);
    //console.log(json);
    ajax.send(json);

    ajax.onreadystatechange = function () {
        if (ajax.status !== 200) {
            location.href = 'error';
        }
        if (ajax.readyState === 4) {
            //let result = JSON.parse(ajax.responseText);
            let result = ajax.responseText;
            if (result) {
                let pics = document.getElementsByClassName('pics')[0];
                //console.log(pics.childElementCount);
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