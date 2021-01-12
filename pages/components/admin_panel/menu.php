<?php
require_once __DIR__ . '/../../../libs/Config.php';
require_once __DIR__ . '/../../../models/User.php';
?>

<nav class="menu admin-panel-menu">
    <div class="left">
        <div class="title"><?php echo Config::get('site_name'); ?> Admin Panel</div>
        <a href="articles.php">Articles</a>
        <a href="menu_items.php">Menu Items</a>
        <a href="users.php">Users</a>
        <a href="comments.php">Comments</a>
    </div>
    <div class="right">
        <?php $user = User::isLoggedIn() ?>
        <span>Hello <b><?php echo $user['name']; ?></b></span>
        <a href="../index.php">View Site</a>
        <a href="../logout.php">Logout</a>
    </div>
</nav>
