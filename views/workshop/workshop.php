<div class="substrate"></div>
<div class="make_post">
	<h2 class="title" style="margin-top: 0">MAKE POST</h2>
	<p class="description">tell everyone something about this photo</p>
	<textarea class="description_zone" placeholder="type here up to 100 symbols" name="description" cols="40" rows="2"></textarea><br>
	<button id="add_post" class="add_post_button">POST IT!</button>
</div>
<div class="wrapper">
    <h1 class="title">WORKSHOP</h1>
    <div class="snapContainer">
        <div class="webcam">
            <video id="video" width="620" height="480" autoplay></video>
            <img class="camera" src="views/pictures/service/camera.png" alt="camera">
			<button id="backFromCam" class="back_button">BACK</button>
			<canvas id="canvas" style="visibility: hidden" width="620" height="480"></canvas>
        </div>
		<div class="noWebcam">
			<form id="uploadPic" class="uploadPic" enctype="multipart/form-data">
				<label for="upload">or upload your own png/jpeg image</label>
				<input id="upload" type="file" accept=".png, .jpg, .jpeg" name="image"><br>
			</form>
			<button id="backFromPic" class="back_button">BACK</button>
		</div>
		<button id="snap" class="snap_button">SNAP!</button>
    </div>
	<div class="pics">
	</div>
    <div class="masks">
        <ul>
            <li><img class="mask" src="views/pictures/masks/sg1.png" alt="sunglasses"></li>
			<li><img class="mask" src="views/pictures/masks/sg2.png" alt="sunglasses"></li>
			<li><img class="mask" src="views/pictures/masks/joint.png" alt="joint"></li>
			<li><img class="mask" src="views/pictures/masks/sg3.png" alt="sunglasses"></li>
			<li><img class="mask" src="views/pictures/masks/sg4.png" alt="sunglasses"></li>
			<li><img class="mask" src="views/pictures/masks/sg5.png" alt="sunglasses"></li>
			<li><img class="mask" src="views/pictures/masks/sg6.png" alt="sunglasses"></li>
			<li><img class="mask" src="views/pictures/masks/sg7.png" alt="sunglasses"></li>
			<li><img class="mask" src="views/pictures/masks/sg8.png" alt="sunglasses"></li>
			<li><img class="mask" src="views/pictures/masks/sg9.png" alt="sunglasses"></li>
			<li><img class="mask" src="views/pictures/masks/sg10.png" alt="sunglasses"></li>
			<li><img class="mask" src="views/pictures/masks/sg11.png" alt="sunglasses"></li>
			<li><img class="mask" src="views/pictures/masks/sg12.png" alt="sunglasses"></li>
			<li><img class="mask" src="views/pictures/masks/sg13.png" alt="sunglasses"></li>
			<li><img class="mask" src="views/pictures/masks/hat1.png" alt="hat"></li>
			<li><img class="mask" src="views/pictures/masks/hat2.png" alt="hat"></li>
			<li><img class="mask" src="views/pictures/masks/hat3.png" alt="hat"></li>
			<li><img class="mask" src="views/pictures/masks/hat4.png" alt="hat"></li>
			<li><img class="mask" src="views/pictures/masks/hat5.png" alt="hat"></li>
			<li><img class="mask" src="views/pictures/masks/hat6.png" alt="hat"></li>
			<li><img class="mask" src="views/pictures/masks/hat7.png" alt="hat"></li>
			<li><img class="mask" src="views/pictures/masks/hat8.png" alt="hat"></li>
			<li><img class="mask" src="views/pictures/masks/hat9.png" alt="hat"></li>
			<li><img class="mask" src="views/pictures/masks/hat10.png" alt="hat"></li>
			<li><img class="mask" src="views/pictures/masks/mask1.png" alt="mask"></li>
			<li><img class="mask" src="views/pictures/masks/mask2.png" alt="mask"></li>
			<li><img class="mask" src="views/pictures/masks/mask3.png" alt="mask"></li>
			<li><img class="mask" src="views/pictures/masks/mask4.png" alt="mask"></li>
			<li><img class="mask" src="views/pictures/masks/mask5.png" alt="mask"></li>
			<li><img class="mask" src="views/pictures/masks/peppe1.png" alt="peppe"></li>
			<li><img class="mask" src="views/pictures/masks/peppe2.png" alt="peppe"></li>
			<li><img class="mask" src="views/pictures/masks/peppe3.png" alt="peppe"></li>
			<li><img class="mask" src="views/pictures/masks/peppe4.png" alt="peppe"></li>
			<li><img class="mask" src="views/pictures/masks/peppe5.png" alt="peppe"></li>
			<li><img class="mask" src="views/pictures/masks/peppe6.png" alt="peppe"></li>
			<li><img class="mask" src="views/pictures/masks/simpsons1.png" alt="simpsons"></li>
			<li><img class="mask" src="views/pictures/masks/simpsons2.png" alt="simpsons"></li>
			<li><img class="mask" src="views/pictures/masks/simpsons3.png" alt="simpsons"></li>
			<li><img class="mask" src="views/pictures/masks/simpsons4.png" alt="simpsons"></li>
			<li><img class="mask" src="views/pictures/masks/simpsons5.png" alt="simpsons"></li>
			<li><img class="mask" src="views/pictures/masks/mustache1.png" alt="mustache"></li>
			<li><img class="mask" src="views/pictures/masks/mustache2.png" alt="mustache"></li>
			<li><img class="mask" src="views/pictures/masks/mustache3.png" alt="mustache"></li>
			<li><img class="mask" src="views/pictures/masks/mustache4.png" alt="mustache"></li>
			<li><img class="mask" src="views/pictures/masks/beard1.png" alt="beard"></li>
			<li><img class="mask" src="views/pictures/masks/beard2.png" alt="beard"></li>
			<li><img class="mask" src="views/pictures/masks/beard3.png" alt="beard"></li>
			<li><img class="mask" src="views/pictures/masks/beard4.png" alt="beard"></li>
			<li><img class="mask" src="views/pictures/masks/tag1.png" alt="tag"></li>
			<li><img class="mask" src="views/pictures/masks/tag2.png" alt="tag"></li>
			<li><img class="mask" src="views/pictures/masks/tag3.png" alt="tag"></li>
			<li><img class="mask" src="views/pictures/masks/tag4.png" alt="tag"></li>
			<li><img class="mask" src="views/pictures/masks/tag5.png" alt="tag"></li>
			<li><img class="mask" src="views/pictures/masks/dog.png" alt="dog"></li>
		</ul>
    </div>
</div>