<?php $article = $GLOBALS['article']; ?>

<h1><?php echo $article['title']; ?></h1>
<h4>Written by <i><?php echo $article['user_name']; ?></i></h4>
<h4><?php echo $article['creation_timestamp']; ?></h4>

<div>
    <?php echo $article['body']; ?>
</div>

<hr />

<?php
if ($article['comments_enabled'] == 1) {
    require_once __DIR__ . '/../models/Comment.php';
    require_once __DIR__ . '/../helpers/datetime.php';

    echo "<div class='comments'>";
    $comments = Comment::filter($article['id']);
    foreach ($comments as $comment) {
        $comment['diff'] = diff($comment['creation_timestamp']);
        echo <<<EOT
                <div class='comment'>
                    <div class='header'>
                        <b>{$comment['user_name']}</b> {$comment['diff']}
                    </div>
                    <div class='body'>{$comment['body']}</div>
                </div>
            EOT;
    }
    echo "</div>";
} else {
    echo "<i>Comments disabled for this post</i>";
}
?>
