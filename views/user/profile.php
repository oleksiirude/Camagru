<?php
if (isset($_SESSION['avatar']))
    $avatar = $_SESSION['avatar'] ? $_SESSION['avatar'] : 'views/pictures/avatars/default.png';
?>

<div class="main_info">
    <img class="avatar_profile" src="<?= $avatar ?>" alt="avatar" title="<?= $_SESSION['user_logged']; ?>">
    <h2 class="title"><?= $_SESSION['user_logged']; ?></h2>
    <p><?= $_SESSION['email']; ?></p>
</div>
<div class="wrapper">
    <h1 class="title">My profile</h1>
</div>