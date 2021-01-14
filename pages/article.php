<?php
require_once __DIR__ . '/../helpers/datetime.php';

$article = $GLOBALS['article'];
$time_difference = diff($article['creation_timestamp']);
?>

<?php
echo <<<EOT
        <h1>{$article['title']}</h1>
        <span>Written by <b>{$article['user_name']}</b> {$time_difference} ago</span>
        <hr/>
        EOT;
?>


<div>
    <?php echo nl2br($article['body']); ?>
</div>

<hr />

<?php
if ($article['comments_enabled'] == 1) {
    require_once __DIR__ . '/../models/Comment.php';
    require_once __DIR__ . '/../models/User.php';

    $comments = Comment::filter($article['id']);
    $comments_count = count($comments);

    echo <<<EOT
        <h2>Comments ($comments_count)</h1>
        EOT;

    if ($user = User::isLoggedIn()) {
        echo <<<EOT
        <form action='#'>
            <textarea placeholder='Type your message here'></textarea>
            <input type='submit' value='Post'/>
        </form>

        <div class='comments'>
        EOT;
    } else {
        echo "You need to login to post a comment.";
    }

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
