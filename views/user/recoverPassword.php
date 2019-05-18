<?php if (isset($this->params['recover_password']) and $this->params['recover_password'] === true) { ?>
	<div class="wrapper">
		    <div class="login_menu">
				<span class="title">Set new password</span>
			    <form action="user/recover/password/confirm/set" method="post">
				    <label for="password"><b>new password<b></label><br>
					<input class="input_zone" type="password" name="password" id="password"
						   data-tooltip="	• at least 1 latin symbol in uppercase and lowercase<br>
										• at least 1 special symbol like !@#$&*-<br>
										• minimum length is 8 symbols"><br>
				    <label for="confirm"><b>confirm<b></label><br>
				    <input class="input_zone" type="password" name="confirm" id="confirm"><br>
				    <button class="submit_button">set</button>
			    </form>
		    </div>
    </div>
<?php }
else { ?>
    <div class="wrapper">
		    <div class="login_menu">
				<span class="title">send recovery link</span>
			    <form action="user/recover/password/request" method="post">
				    <label for="login"><b>login<b></label><br>
				    <input class="input_zone" type="text" name="login" id="login"><br>
				    <label for="email"><b>email<b></label><br>
				    <input class="input_zone" type="email" name="email" id="email"><br>
				    <button class="submit_button">Send</button>
			    </form>
		    </div>
    </div>
<?php }