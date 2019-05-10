<div class="register_form">
	<span style="font-size: xx-large; margin-left: 30%">Register</span>
	<div class="fill_box">
		<form action="register/validate" method="post">
			<label for="login">Your login:</label>
			<input class="input_zone" type="text" name="login" id="login">
			<p class="rules">• at least 3 and up to 8 latin symbols</p>
			<p class="rules">• 1-2 digits after symbols (optional)</p>
			<label for="email">Your email:</label>
			<input class="input_zone" type="text" name="email" id="email">
			<p class="rules">• example@example.com</p>
			<label for="password">Your password:</label>
			<input class="input_zone" type="password" name="password" id="password"><br>
			<p class="rules">• at least 1 latin symbol in uppercase and lowercase</p>
			<p class="rules">• at least 1 special symbol like !@#$&*-</p>
			<p class="rules">• minimum length is 8 symbols</p>
			<label for="confirm">Confirm password:</label>
			<input class="input_zone" type="password" name="confirm" id="confirm"><br>
			<button type="submit" class="submit_button">Create</button>
		</form>
	</div>
</div>