<div class="wrapper">
	<div class="login_menu">
		<span class="title">sign in</span>
		<form id="login_form" onsubmit="check(event, this, 'user/login/validate')">
			<div id="menu">
				<div id="login">
					<label for="login"><b>login<b></label><br>
					<input class="input_zone" type="text" name="login" id="login"><br>
				</div>
				<div id="password">
					<label for="password">password</label><br>
					<input class="input_zone" type="password" name="password" id="password"><br>
				</div>
			</div>
			<button type="submit" class="submit_button">login</button>
		</form>
		<form action="user/recover/password" method="post">
			<button type="submit" class="help_button">forgot password?</button>
		</form><a href="/">back</a>
	</div>
</div>