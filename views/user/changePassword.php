<div class="wrapper">
	<div class="menu">
		<span class="title">change pass</span>
		<form id="form" onsubmit="check(event, this, 'user/change/password/set')">
			<div id="menu">
				<div id="password">
					<p><b>new password</b></p>
						<input class="input_zone" type="password" name="password" id="password"
							   data-tooltip="	• at least 1 latin symbol in uppercase and lowercase<br>
												• at least 1 special symbol like !@#$&*-<br>
												• minimum length is 8 symbols"><br>
				</div>
				<div id="confirm">
					<p><b>confirm</b></p>
					<input class="input_zone" type="password" name="confirm" id="confirm"><br>
				</div>
			</div>
			<button type="submit" class="submit_button">change</button>
		</form>
		<br><a id="link_back" href="user/settings">back</a>
	</div>
</div>