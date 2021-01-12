<?php
require_once __DIR__ . '/../../libs/Config.php';
require_once __DIR__ . '/../../models/User.php';
?>

<nav class="menu">
    <div class="left">
        <div class="title"><?php echo Config::get('site_name'); ?></div>
        <?php foreach (Database::getAll('menu_items') as $menuItem) {
            echo "<a href='{$menuItem['href']}'>{$menuItem['name']}</a>";
        } ?>
    </div>
    <div class="right">
        <?php if ($user = User::isLoggedIn()) { ?>
        <span>Hello <b><?php echo $user['name']; ?></b></span>

        <?php if ($user['is_admin'] == 1) { ?>
        <a href="admin_panel/index.php">Admin Panel</a>
        <?php } ?>

        <a href="logout.php">Logout</a>
        <?php } else { ?>
        <a href="login_register.php">Login / Register</a>
        <?php } ?>
    </div>
</nav>
