<?php

	if (isset($_SESSION['user_logged'])) { ?>
		<div class="wrapper">
            <h1>main feed</h1>
		</div>
	<?php }
	else { ?>
        <div class="wrapper">
		    <div class="enter_menu">
			        <div class="title">enter</div><br>
				<div class="enter_choice">
			        <a href="/user/login">log in</a> |
			        <a href="/user/register">sign up</a>
				</div>
		    </div>
        </div>
	<?php }


