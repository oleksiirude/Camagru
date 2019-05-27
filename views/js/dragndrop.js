function dragndrop(object) {

    object.onmousedown = function(e) {

        let coords = getCoords(object);
        let shiftX = e.pageX - coords.left;
        let shiftY = e.pageY - coords.top;

        object.style.position = 'absolute';
        let wrapper = document.getElementsByClassName('wrapper')[0];
        wrapper.appendChild(object);
        moveAt(e);

        object.style.zIndex = '1000';

        function moveAt(e) {
            object.style.left = e.pageX - shiftX + 'px';
            object.style.top = e.pageY - shiftY + 'px';
        }

        document.onmousemove = function(e) {
            moveAt(e);
        };

        object.onmouseup = function() {
            document.onmousemove = null;
            object.onmouseup = null;
        };

    };

    object.ondragstart = function() {
        return false;
    };

    object.onmouseout = function () {
        let size, style;

        size = object.offsetWidth + 7;
        style = object.style;
        style.width = size + 'px';
    };

    object.oncontextmenu = function () {
        let size, style;

        size = object.offsetWidth - 7;
        style = object.style;
        style.width = size + 'px';
        return false;
    };

    function getCoords(elem) {
        let box = elem.getBoundingClientRect();
        return {
            top: box.top + pageYOffset,
            left: box.left + pageXOffset
        };
    }
}