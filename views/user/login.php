<div class="wrapper">
	<div class="menu">
		<span class="title">sign in</span>
		<form id="form" action="user/login/validate">
			<div id="menu">
				<div id="login">
					<p><b>login</b></p>
					<input class="input_zone" type="text" name="login"><br>
				</div>
				<div id="password">
					<p><b>password</b></p>
					<input class="input_zone" type="password" name="password"><br>
				</div>
			</div>
			<button type="submit" class="submit_button">login</button>
		</form>
		<form action="user/recover/password" method="post">
			<button type="submit" class="help_button">forgot password?</button>
		</form>
		<a id="link_back" href="/">back</a>
	</div>
</div>