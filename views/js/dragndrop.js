function dragndrop(e) {

    let parent = document.getElementsByClassName('webcam')[0];
    let elem = e.target;
    elem.style.zIndex = '10';

    let limits = {
        top: parent.offsetTop,
        right: parent.offsetWidth + parent.offsetLeft - elem.offsetWidth + 10,
        bottom: parent.offsetHeight + parent.offsetTop - elem.offsetHeight + 10,
        left: parent.offsetLeft
    };

    parent.appendChild(elem);
    moveAt(e);

    function moveAt(e) {
        let newLocation = {
            x: limits.left,
            y: limits.top
        };
        if (e.pageX > limits.right) {
            newLocation.x = limits.right - 10;
        } else if (e.pageX > limits.left) {
            newLocation.x = e.pageX - 10;
        }
        if (e.pageY > limits.bottom) {
                newLocation.y = limits.bottom - 60;
                elem.remove();
            let images = document.getElementsByClassName('webcam')[0]
                .getElementsByClassName('mask');
            if (!images.length) {
                snap.disabled = true;
            }
        } else if (e.pageY > limits.top) {
            newLocation.y = e.pageY - 10;
        }
        relocate(newLocation);
    }

    function relocate(newLocation) {
        elem.style.left = newLocation.x + 'px';
        elem.style.top = newLocation.y + 'px';
    }

    document.onmousemove = (e) => { moveAt(e); };

    elem.onmouseup = () => {
        document.onmousemove = null;
        elem.onmouseup = null;
    };

    elem.ondragstart = () => { return false; };

    elem.onwheel = (e) => {
        let delta = e.deltaY || e.detail;
        let elem = e.target;

        let size, style;
        if (delta > 0) {
            size = elem.offsetWidth + 10;
            style = elem.style;
            style.width = size + 'px';
        }
        else {
            size = elem.offsetWidth - 10;
            style = elem.style;
            style.width = size + 'px';
        }
        e.preventDefault();
    };
}

function createClone(e) {
    let mask_existence = document.getElementsByClassName('webcam').length;
    if (mask_existence < 2) {
        let snap = document.getElementById('snap');
        snap.disabled = false;
    }
    let new_mask = document.createElement('img');
    let parent = document.getElementsByClassName('webcam')[0];
    let images = parent.getElementsByClassName('mask');

    let webcam = document.getElementById('video');
    let pic = document.getElementById('valid_pic');
    if (!webcam.offsetWidth && !pic)
        return;
    if (images.length > 9)
        return;
    new_mask.src = e.target.src;
    new_mask.className = 'mask';
    new_mask.style.position = 'absolute';
    new_mask.addEventListener('mousedown', dragndrop);
    parent.insertBefore(new_mask, parent.firstChild);
}

let snap = document.getElementById('snap');
if (snap)
    snap.disabled = true;
let masks = document.getElementsByClassName('mask');
if (masks)
    for (let i = 0; i < masks.length; i++)
        masks[i].addEventListener('click', createClone);