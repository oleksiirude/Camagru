<?php if (isset($this->params['recover_password']) and $this->params['recover_password'] === true) { ?>
	<div class="wrapper">
		<div class="menu">
				<span class="title">set new pass</span>
				<form id="form" onsubmit="check(event, this, 'user/recover/password/confirm/set')">
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
    <div class="wrapper">
		    <div class="menu">
				<span class="title">recover pass</span>
				<form id="form" onsubmit="check(event, this, 'user/recover/password/request')">
					<div id="menu">
						<div id="login">
							<p><b>login</b></p>
							<input class="input_zone" type="text" name="login"><br>
						</div>
						<div id="email">
							<p><b>email</b></p>
				    		<input class="input_zone" type="email" name="email"><br>
						</div>
					</div>
				    <button class="submit_button">send</button><br>
			    </form>
				<a id="link_back" href="user/login">back</a>
		    </div>
    </div>
<?php }