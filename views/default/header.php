<header>
	header block
	<div style="float: left">
	<a href="/">Camagru</a>
<<<<<<< HEAD
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
=======
		<div><?php if(isset($_SESSION['user_logged'])) {
					echo 'Hi, ' . $_SESSION['user_logged'];
					echo "	<form action='user/logout' method='post'>
								<button type='submit'>log out</button>
							</form>";
				} ?>
>>>>>>> 0962d104259e37d96cdf89627c5d629e6fbc8ef8
		</div>
	</div>
</header>