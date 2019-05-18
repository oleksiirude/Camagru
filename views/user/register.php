<div class="wrapper">
    <div class="registration_menu">
			<span class="title">register</span>
		    <form action="user/register/validate" method="post">
			    <label for="login"><b>login<b></label><br>
			    <input class="input_zone" type="text" name="login" id="login"
					   data-tooltip="• at least 3 and up to 8 latin symbols<br>• 1-2 digits after symbols (optional)"><br>
			    <label for="email"><b>email<b></label><br>
			    <input class="input_zone" type="text" name="email" id="email"
					   data-tooltip="• example@example.com"><br>
			    <label for="password"><b>password<b></label><br>
			    <input class="input_zone" type="password" name="password" id="password"
					   data-tooltip="	• at least 1 latin symbol in uppercase and lowercase<br>
										• at least 1 special symbol like !@#$&*-<br>
										• minimum length is 8 symbols"><br>
			    <label for="confirm"><b>confirm password<b></label>
			    <input class="input_zone" type="password" name="confirm" id="confirm"><br>
			    <button type="submit" class="submit_button">create</button>
		    </form>
	    </div>
    </div>
</div>