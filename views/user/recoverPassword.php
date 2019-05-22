<?php if (isset($this->params['recover_password']) and $this->params['recover_password'] === true) { ?>
	<div class="wrapper" id="wrapper">
		<div class="login_menu" id="login_menu">
				<span class="title">set new password</span>
				<form id="login_form" onsubmit="check(event, this, 'user/recover/password/confirm/set')">
					<div id="menu">
						<div id="password">
				    		<label for="password"><b>new password<b></label><br>
							<input class="input_zone" type="password" name="password" id="password"
						   		data-tooltip="	• at least 1 latin symbol in uppercase and lowercase<br>
												• at least 1 special symbol like !@#$&*-<br>
												• minimum length is 8 symbols"><br>
						</div>
						<div id="confirm">
				    		<label for="confirm"><b>confirm<b></label><br>
				    		<input class="input_zone" type="password" name="confirm" id="confirm"><br>
						</div>
					</div>
					<button class="submit_button">set</button><br>
			    </form>
		</div>
    </div>
<?php }
else { ?>
    <div class="wrapper" id="wrapper">
		    <div class="login_menu" id="login_menu">
				<span class="title">send recovery link</span>
				<form id="login_form" onsubmit="check(event, this, 'user/recover/password/request')">
					<div id="menu">
						<div id="login">
				    		<label for="login"><b>login<b></label><br>
							<input class="input_zone" type="text" name="login" id="login"><br>
						</div>
						<div id="email">
				    		<label for="email"><b>email<b></label><br>
				    		<input class="input_zone" type="email" name="email" id="email"><br>
						</div>
					</div>
				    <button class="submit_button" id="send_button">send</button><br>
			    </form>
				<a href="user/login" id="link_back">back</a>
		    </div>
    </div>
<?php }