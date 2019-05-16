<div class="recover_form">
	<span style="font-size: 28px; margin-left: 10%"><?= $data; ?></span>
	<div class="fill_box">
		<form action="user/change/login/set" method="post">
			<label for="login">New login:</label>
			<input class="input_zone" type="text" name="login" id="login" required><br>
			<button class="recover_button">Set</button>
		</form>
	</div>
</div>