<?php
require_once 'libs/Config.php';
require_once 'models/User.php';
?>

<nav class="menu">
    <div class="left">
        <div class="title"><?php echo Config::get('site_name'); ?></div>
        <a href="index.php">Home</a>
        <a href="articles.php">Articles</a>
    </div>
    <div class="right">
        <?php if (User::isLoggedIn()) { ?>
        <a href="logout.php">Logout</a>
        <?php } else { ?>
        <a href="login_register.php">Login / Register</a>
        <?php } ?>
    </div>
</nav>
