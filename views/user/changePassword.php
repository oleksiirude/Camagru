<?php if (isset($this->params['change_password']) and $this->params['change_password'] === true) { ?>
	<div class="recover_form">
		<span style="font-size: 28px; margin-left: 10%">Set new password</span>
		<div class="fill_box">
<<<<<<< HEAD
			<form action="user/change/password/confirm/set" method="post">
=======
			<form action="set" method="post">
>>>>>>> 0962d104259e37d96cdf89627c5d629e6fbc8ef8
				<label for="password">New password:</label>
				<input class="input_zone" type="password" name="password" id="password" required><br>
				<label for="confirm">Confirm:</label>
				<input class="input_zone" type="password" name="confirm" id="confirm" required><br>
				<button class="recover_button">Set</button>
			</form>
		</div>
	</div>
<?php }
else { ?>
	<div class="recover_form">
<<<<<<< HEAD
		<span style="font-size: 28px; margin-left: 10%"><?= $data; ?></span>
		<div class="fill_box">
			<form action="user/change/password/request" method="post">
=======
		<span style="font-size: 28px; margin-left: 10%">Change password</span>
		<div class="fill_box">
			<form action="password/request" method="post">
>>>>>>> 0962d104259e37d96cdf89627c5d629e6fbc8ef8
				<label for="login">Your login:</label>
				<input class="input_zone" type="text" name="login" id="login" required><br>
				<label for="email">Your email:</label>
				<input class="input_zone" type="email" name="email" id="email" required><br>
				<button class="recover_button">Send email</button>
			</form>
		</div>
	</div>
<?php }

