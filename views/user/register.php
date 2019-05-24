<div class="wrapper">
    <div class="menu">
			<span class="title">register</span>
		<form id="form" onsubmit="check(event, this, 'user/register/validate')">
				<div id="menu">
					<div id="login">
						<p><b>login</b></p>
						<input class="input_zone" type="text" name="login"
							   data-tooltip="• at least 3 and up to 8 latin symbols<br>• 1-2 digits after symbols (optional)"><br>
					</div>
					<div id="email">
						<p><b>email</b></p>
			    		<input class="input_zone" type="text" name="email"
							   data-tooltip="• example@example.com"><br>
					</div>
					<div id="password">
						<p><b>password</b></p>
			    		<input class="input_zone" type="password" name="password"
							   data-tooltip="	• at least 1 latin symbol in uppercase and lowercase<br>
												• at least 1 special symbol like !@#$&*-<br>
												• minimum length is 8 symbols"><br>
					</div>
					<div id="confirm">
						<p><b>confirm</b></p>
			    		<input class="input_zone" type="password" name="confirm"><br>
					</div>
					<button type="submit" class="submit_button">create</button><br>
				</div>
		    </form>
			<a id="link_back" href="/">back</a>
	</div>
</div>