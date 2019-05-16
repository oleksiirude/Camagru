<header>
	<?php if (isset($_SESSION['user_logged'])) { ?>
			logged user header
			<a href="/">Camagru</a>
			<?= 'Hello, '.$_SESSION['user_logged'] ?>
			<form action='user/profile' method='post'>
				<button type='submit'>profile</button>
			</form>
			<form action='workshop' method='post'>
				<button type='submit'>workshop</button>
			</form>
			<form action='user/settings' method='post'>
				<button type='submit'>settings</button>
			</form>
			<form action='user/logout' method='post'>
				<button type='submit'>log out</button>
			</form>
	<?php }
	else { ?>
			unlogged user header
			<a href="/">Camagru</a>
	<?php } ?>
</header>
