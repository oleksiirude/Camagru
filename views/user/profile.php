<?php
if (isset($_SESSION['avatar']))
    $avatar = $_SESSION['avatar'] ? $_SESSION['avatar'] : 'views/pictures/avatars/default.png';
?>

<div class="substrate"></div>
<div class="delete_post">
	<p>Delete this post?<br>Are you sure?<br>This action is irreversible!<br></p>
	<button id="delete_post" class="snap_button">DELETE</button>
</div>
<div class="wrapper">
    <h1 class="title">MY PROFILE</h1>
    <div class="main_info">
        <img class="avatar_profile" src="<?= $avatar ?>" alt="avatar" title="<?= $_SESSION['user_logged']; ?>">
        <p class="login_profile"><?= $_SESSION['user_logged']; ?></p>
        <p class="email_profile"><?= $_SESSION['email']; ?></p>
    </div>
    <div class="posts_profile">
		<div class="setting_link">
			<a href="user/settings">profile settings</a>
		</div>
    </div>
	<button id="manual_pagination">next posts</button>
</div>