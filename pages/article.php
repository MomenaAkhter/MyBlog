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

    echo <<<EOT
        <h2 id='comments-count'>Comments (?)</h1>
        <div id='messages'></div>
        EOT;

    if ($user = User::isLoggedIn()) {
        echo <<<EOT
        <form action='#'>
            <input type='hidden' id='article-id' value='{$article['id']}'/>
            <textarea id='body' placeholder='Type your message here'></textarea>
            <input type='submit' value='Post'/>
        </form>
        EOT;
    } else {
        echo "You need to login to post a comment.<br/><br/>";
    }

    echo "<div class='comments'>Loading...</div>";
} else {
    echo "<i>Comments are disabled for this post</i>";
}
?>

<script src="../static/js/base.js"></script>
<script src="../static/js/article.js"></script>
