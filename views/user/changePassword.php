<div class="wrapper">
    <div class="change_menu">
        <span class="title">change pass</span>
            <form action="user/change/password/set" method="post">
                <label for="password">new password</label>
				<input class="input_zone" type="password" name="password" id="password"
					   data-tooltip="	• at least 1 latin symbol in uppercase and lowercase<br>
										• at least 1 special symbol like !@#$&*-<br>
										• minimum length is 8 symbols"><br>
                <label for="confirm">confirm</label><br>
                <input class="input_zone" type="password" name="confirm" id="confirm"><br>
                <button class="submit_button">change</button>
            </form>
		<a href="user/settings">back</a>
	</div>
</div>