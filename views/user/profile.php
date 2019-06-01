<?php
if (isset($_SESSION['avatar']))
    $avatar = $_SESSION['avatar'] ? $_SESSION['avatar'] : 'views/pictures/avatars/default.png';
?>

<div class="wrapper">
    <h1 class="title">MY PROFILE</h1>
    <div class="main_info">
        <img class="avatar_profile" src="<?= $avatar ?>" alt="avatar" title="<?= $_SESSION['user_logged']; ?>">
        <p class="login_profile"><?= $_SESSION['user_logged']; ?></p>
        <p class="email_profile"><?= $_SESSION['email']; ?></p>
    </div>
    <div class="posts_profile">
    </div>
</div>