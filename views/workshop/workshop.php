<div class="wrapper">
    <h1 class="title">workshop</h1>
    <div class="webcam">
        <div class="video">
            <video id="video" width="620" height="480" autoplay></video>
            <img class="camera" src="views/pictures/camera.png" alt="camera" onclick="getWebcam()">
            <button id="snap" class="submit_button" onclick="makeSnap()">snap!</button>
        </div>
    </div>
    <div class="webcam">
        <div class="video">
            <canvas id="canvas" width="620" height="480"></canvas>
        </div>
    </div>
</div>