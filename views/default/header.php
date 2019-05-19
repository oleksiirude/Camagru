<?php var_dump($_SESSION['avatar']); ?>
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
            <a href="user/profile"><img class="avatar" src="<?= $_SESSION['avatar'] ?  $_SESSION['avatar'] : "views/pictures/avatars/default.png"; ?>" alt="avatar" title="<?= $_SESSION['user_logged']; ?>"></a>
	<?php }
	else { ?>
			<h1 class="title">WELCOME!</h1>
	<?php } ?>
</header>