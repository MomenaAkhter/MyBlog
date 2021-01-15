<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Comment.php';
require_once __DIR__ . '/../libs/Database.php';
require_once __DIR__ . '/../helpers/datetime.php';

function create()
{
    if ($user = User::isLoggedIn()) {
        if (Database::insert('comments', ['user_id', 'article_id', 'body', 'creation_timestamp', 'update_timestamp'], [$user['id'], $_POST['article-id'], htmlentities($_POST['body']), now(), now()]))
            echo 'ok';
    } else {
        echo 'error';
    }
}

function filter()
{
    $comments = Comment::filter($_GET['article-id']);

    echo json_encode($comments);
}

if (isset($_POST['action']))
    $_POST['action']();
else if (isset($_GET['action']))
    $_GET['action']();
