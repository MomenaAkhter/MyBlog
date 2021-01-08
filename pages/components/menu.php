<?php require_once 'libs/Config.php'; ?>

<nav class="menu">
    <div class="left">
        <div class="title"><?php echo Config::get('site_name'); ?></div>
        <a href="index.php">Home</a>
        <a href="home.php">Articles</a>
    </div>
    <div class="right">
        <a href="login_register.php">Login / Register</a>
    </div>
</nav>
