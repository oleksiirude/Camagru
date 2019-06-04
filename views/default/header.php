<?php
	if (isset($_SESSION['avatar']))
		$avatar = $_SESSION['avatar'] ? $_SESSION['avatar'] : 'views/pictures/avatars/default.png';
?>

<header>
    <div class="logo">
        <a href="/"><img class="camagru" src="views/pictures/service/logo.png" alt="CAMAGRU" title="CAMAGRU"></a>
    </div>
	<?php if (isset($_SESSION['user_logged'])) { ?>
        <nav class="navbar">
            <a href="user/profile">profile</a> |
            <a href="workshop">workshop</a> |
            <a href="user/settings">settings</a> |
            <a href="user/logout">logout</a>
        </nav>
            <a href="user/change/avatar"><img class="avatar" src="<?= $avatar ?>" alt="avatar" title="<?= $_SESSION['user_logged']; ?>"></a>
	<?php }
	else { ?>
		<div class="enter_menu">
			<div class="enter_choice">
				<a href="/user/login">log in</a> |
				<a href="/user/register">sign up</a>
			</div>
		</div>
	<?php } ?>
</header>