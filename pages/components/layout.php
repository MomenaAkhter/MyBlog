<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $page_title; ?></title>
        <link rel="stylesheet" href="static/css/base.css">
    </head>

    <body>
        <?php require_once __DIR__ . '/../components/menu.php'; ?>
        <?php require_once __DIR__ . '/../' . $page_name . '.php'; ?>
    </body>

</html>
