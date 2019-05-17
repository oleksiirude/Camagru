<?php

	if (isset($_SESSION['user_logged'])) { ?>
		<div class="wrapper">
            <p>main feed</p>
		</div>
	<?php }
	else { ?>
        <div class="wrapper">
		    <div class="login_form">
		        <div class="fill_box">
			        <p style="width: 200px">You need to login or register to continue</p><br>
			        <a href="/user/login">log in</a><br>
			        <a href="/user/register">register</a>
		        </div>
		    </div>
        </div>
	<?php }


