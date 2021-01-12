<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_title; ?></title>
        <link rel="stylesheet" href="../static/css/base.css">
        <link rel="stylesheet" href="../static/css/admin-panel.css">
    </head>

    <body>
        <?php
    require_once __DIR__ . '/../../../models/User.php';

    $user = User::isLoggedIn();

    if ($user && $user['is_admin'] == 1) {
        require_once __DIR__ . '/menu.php';
        require_once __DIR__ . '/../../../pages/' . $page_name . '.php';
    } else {
        header('Location: index.php');
    } ?>

    </body>

</html>
