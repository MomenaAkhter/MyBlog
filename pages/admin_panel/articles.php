<h1>Articles</h1>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Author</th>
            <th>Title</th>
            <th>Body</th>
            <th>Top?</th>
            <th>Comments Enabled?</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once __DIR__ . '/../../libs/Database.php';
        require_once __DIR__ . '/../../models/Article.php';

        $articles = Article::getAll();
        foreach ($articles as $article) {
            echo "<tr><td>{$article['id']}</td><td>{$article['name']}</td><td>{$article['title']}</td><td>{$article['body']}</td><td>{$article['is_top']}</td><td>{$article['comments_enabled']}</td><td></td></tr>";
        }

        ?>
    </tbody>
</table>
