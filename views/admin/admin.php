<div class="wrapper">
	<div class="settings_menu" style="display: none">
		<h2 style="color: #5a5a5a">admin's menu</h2>
		<button id="create" class="help_button">re-create db</button><br><br>
		<button id="logout" class="help_button">logout</button>
	</div>
	<div class="menu">
		<span class="title">enter as admin</span>
		<form id="admin_form" action="admin/login">
			<div id="menu">
				<div id="login">
					<p><b>login</b></p>
					<input class="input_zone" type="text" name="login"><br>
				</div>
				<div id="password">
					<p><b>password</b></p>
					<input class="input_zone" type="password" name="password"><br>
				</div>
			</div>
			<button type="submit" class="submit_button">login</button>
		</form>
	</div>
</div>