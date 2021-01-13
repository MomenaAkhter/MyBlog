<h1>Comments</h1>

<?php
require_once __DIR__ . '/../../libs/Database.php';
require_once __DIR__ . '/../../models/Comment.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

// Delete
if ($action == 'delete')
    if (Database::remove('comments', $_GET['id']))
        echo "<div class='message is-success'>Comment deleted successfully.</div>";

$comments = Comment::getAll();
$groups = [];

foreach ($comments as $comment)
    if (isset($groups[$comment['article_id']]))
        $groups[$comment['article_id']][] = $comment;
    else
        $groups[$comment['article_id']] = [$comment];



foreach ($groups as $article_id => $comments) {
    if (count($comments) > 0) {
        echo "<h1>{$comments[0]['article_title']}</h1>";
?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Author</th>
            <th>Body</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($comments as $comment) {
                    echo <<<EOT
                <tr>
                    <td>{$comment['id']}</td>
                    <td>{$comment['user_name']}</td>
                    <td>{$comment['body']}</td>
                    <td>
                        <a href='?action=delete&id={$comment['id']}'>Delete</a>
                    </td>
                </tr>
                EOT;
                } ?>
    </tbody>
</table>
<?php

    }
}
?>
