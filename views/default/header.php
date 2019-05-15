<header>
	header block
	<div style="float: left">
	<a href="/">Camagru</a>
		<div>
            <?php if(isset($_SESSION['user_logged'])) {
					echo 'Hi, '.$_SESSION['user_logged'];
				    echo "	<form action='user/profile' method='post'>
							    	<button type='submit'>my profile</button>
							    </form>";
					echo "	<form action='user/logout' method='post'>
								<button type='submit'>log out</button>
							</form>";
				    } ?>
		</div>
	</div>
</header>