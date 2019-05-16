<div class="recover_form">
	<span style="font-size: 28px; margin-left: 10%">Set new password</span>
	<div class="fill_box">
		<form action="user/change/password/set" method="post">
			<label for="password">New password:</label>
			<input class="input_zone" type="password" name="password" id="password" required><br>
			<p class="rules">• at least 1 latin symbol in uppercase and lowercase</p>
			<p class="rules">• at least 1 special symbol like !@#$&*-</p>
			<p class="rules">• minimum length is 8 symbols</p>
			<label for="confirm">Confirm:</label>
			<input class="input_zone" type="password" name="confirm" id="confirm" required><br>
			<button class="recover_button">Set</button>
		</form>
	</div>
</div>