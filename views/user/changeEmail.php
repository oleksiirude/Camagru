<div class="recover_form">
	<span style="font-size: 28px; margin-left: 10%"><?= $data; ?></span>
	<div class="fill_box">
		<form action="user/change/email/set" method="post">
			<label for="email">New email:</label>
			<input class="input_zone" type="email" name="email" id="email" required><br>
			<button class="recover_button">Set</button>
		</form>
	</div>
</div>