<h1>Articles</h1>

<?php
require_once 'libs/Database.php';
require_once 'models/Article.php';

$articles = Database::getAll('articles');
?>
<div class="articles">
    <?php foreach ($articles as $article) { ?>
    <div class="article">
        <div class="title"><?php echo $article['title']; ?></div>
        <div class="body"><?php echo $article['body']; ?></div>
    </div>
    <?php
    }
    ?>
</div>
