<div class="wrapper">
    <h1 class="title">workshop</h1>
    <div class="webcam">
        <div class="video">
            <video id="video" width="620" height="480" autoplay></video>
            <img class="camera" src="views/pictures/camera.png" alt="camera" onclick="getWebcam()">
            <button id="snap" class="submit_button" onclick="makeSnap()">snap!</button>
			<canvas id="canvas" style="visibility: hidden" width="620" height="480"></canvas>
        </div>
    </div>
    <div class="masks">
        <ul>
            <li><img class="mask" src="views/pictures/masks/mask1.png" alt="mask1"></li>
            <li><img class="mask" src="views/pictures/masks/mask2.png" alt="mask2"</li>
            <li><img class="mask" src="views/pictures/masks/sunglasses1.png" alt="sg1"</li>
            <li><img class="mask" src="views/pictures/masks/sunglasses2.png" alt="sg2"</li>
            <li><img class="mask" src="views/pictures/masks/sunglasses3.png" alt="sg3"</li>
            <li><img class="mask" src="views/pictures/masks/mustache1.png" alt="mustache1"</li>
            <li><img class="mask" src="views/pictures/masks/hat1.png" alt="hat1"</li>
            <li><img class="mask" src="views/pictures/masks/beard1.png" alt="beard1"</li>
        </ul>
    </div>
	<div class="pics">
	</div>
</div>