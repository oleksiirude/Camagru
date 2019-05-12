<div class="login_form">
	<span style="font-size: xx-large; margin-left: 32%">Sign in</span>
	<div class="fill_box">
		<div class="login">
			<form action="login/validate" method="post">
				<label for="login">Your login:</label>
				<input class="input_zone" type="text" name="login" id="login" required>
				<label for="password">Your password:</label>
				<input class="input_zone" type="password" name="password" id="password" required><br>
				<button type="submit" class="submit_button">Login</button>
			</form>
			<form action="recover">
				<button type="submit" class="help_button">Forgot your password?</button>
			</form>
		</div>
	</div>
</div>