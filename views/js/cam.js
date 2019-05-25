function getWebcam() {
    let video = document.getElementById('video');

    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        document.getElementsByClassName('camera')[0].remove();
        document.getElementById('video').setAttribute('style', 'display: block');
        document.getElementById('snap').setAttribute('style', 'display: block');

        navigator.mediaDevices.getUserMedia({video: true}).then(function (stream) {
            video.srcObject = stream;
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
            console.log(result);
            if (result === true)
               console.log('ok');
            else
                console.log('ko');
        }
    }
}