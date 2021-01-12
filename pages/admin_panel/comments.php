<h1>Comments</h1>


<?php
require_once __DIR__ . '/../../libs/Database.php';
require_once __DIR__ . '/../../models/Comment.php';

$comments = Comment::getAll();
$groups = [];

foreach ($comments as $comment)
    if (isset($groups[$comment['article_id']]))
        $groups[$comment['article_id']][] = $comment;
    else
        $groups[$comment['article_id']] = [$comment];



foreach ($groups as $article_id => $comments)
    if (count($comments) > 0) {
        echo "<h1>{$comments[0]['article_title']}</h1>";


        foreach ($comments as $comment) { ?>

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
        <?php
                echo "<tr><td>{$comment['id']}</td><td>{$comment['user_name']}</td><td>{$comment['body']}</td><td></td></tr>";
                ?>
    </tbody>
</table>
<?php
        }
    }




?>
