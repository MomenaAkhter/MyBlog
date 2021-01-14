<h1>Top Articles</h1>

<?php
require_once __DIR__ . '/../libs/Database.php';
require_once __DIR__ . '/../models/Article.php';
require_once __DIR__ . '/../helpers/datetime.php';

$articles = Article::getAllTop();

?>
<div class="articles articles-top">
    <?php foreach ($articles as $article) { ?>
    <div class="article">
        <a href="article.php?id=<?php echo $article['id']; ?>">
            <div class="title"><?php echo $article['title']; ?></div>
        </a>
        <div class="author">
            Written by <i><?php echo $article['user_name']; ?></i>
        </div>
        <div class="comments-info">
            <b><?php echo $article['comments_count']; ?></b>
            comment<?php echo $article['comments_count'] > 1 ? 's' : ''; ?>
        </div>
        <div class="body"><?php echo $article['body']; ?></div>
    </div>
    <?php
    }
    ?>
</div>
