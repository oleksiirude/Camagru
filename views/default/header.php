<header>
    <div class="logo">
        <a href="/"><img class="camagru" src="views/pictures/logo.png" alt="CAMAGRU" title="CAMAGRU"></a>
    </div>
	<?php if (isset($_SESSION['user_logged'])) { ?>
        <nav class="navbar">
            <a href="user/profile">profile</a> |
            <a href="workshop">workshop</a> |
            <a href="user/settings">settings</a> |
            <a href="user/logout">logout</a>
        </nav>
            <img class="avatar" src="views/pictures/default_avatar.png" alt="avatar" title="<?= $_SESSION['user_logged']; ?>">
	<?php }
	else { ?>
			<div class="welcome">Welcome!</div>
	<?php } ?>
</header>
