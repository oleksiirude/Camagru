<?php

	if (isset($_SESSION['user_logged'])) { ?>
		<h1>Main feed</h1>
	<?php }
	else { ?>
		<div class="login_form">
		<div class="fill_box">
			<p style="width: 200px">You need to login or register to continue</p>
			<a href="/user/login">log in</a><br>
			<a href="/user/register">register</a>
		</div>
		</div>
	<?php }


