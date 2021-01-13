<h1>Articles</h1>

<?php

require_once __DIR__ . '/../../libs/Database.php';
require_once __DIR__ . '/../../models/Article.php';
require_once __DIR__ . '/../../models/User.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

// Delete
if ($action == 'delete')
    if (Database::remove('articles', $_GET['id']))
        echo "<div class='message is-success'>Article deleted successfully.</div>";

// Create form submission
if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $is_top = isset($_POST['is_top']) ? 1 : 0;
    $comments_enabled = isset($_POST['comments_enabled']) ? 1 : 0;
    $user_id = User::isLoggedIn()['id'];

    if (Database::insert('articles', ['user_id', 'title', 'body', 'creation_timestamp', 'update_timestamp', 'is_top', 'comments_enabled'], [$user_id, $title, $body, date('Y-m-d H:i:s'), date('Y-m-d H:i:s'), $is_top, $comments_enabled]))
        echo "<div class='message is-success'>Article created successfully.</div>";
}

// Create form
if ($action == 'create') { ?>
<form action="articles.php" method='POST'>
    <input type="hidden" name="create">
    <input type="text" name="title" value="<?php echo $_GET['title']; ?>" placeholder="Title">
    <textarea name="body" placeholder="Body" cols="30" rows="10"></textarea>
    <div>
        Top
        <input type="checkbox" name="is_top">
    </div>
    <div>
        Comments
        <input type="checkbox" name="comments_enabled">
    </div>
    <input type="submit" value="Create">
</form>
<?php
} else {
?>

<form action="articles.php" method='GET' class="form-inline">
    <input type="hidden" name="action" value="create">
    <input type="text" name="title" placeholder="Title">
    <input type="submit" value="Create">
</form>

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
                $article['is_top'] = $article['is_top'] == 1 ? 'Yes' : 'No';
                $article['comments_enabled'] = $article['comments_enabled'] == 1 ? 'Yes' : 'No';

                echo <<<EOT
                    <tr>
                        <td>{$article['id']}</td>
                        <td>{$article['user_name']}</td>
                        <td>{$article['title']}</td>
                        <td>{$article['body']}</td>
                        <td>{$article['is_top']}</td>
                        <td>{$article['comments_enabled']}</td>
                        <td>
                            <a href='?action=edit&id={$article['id']}'>Edit</a>&nbsp;
                            <a href='?action=delete&id={$article['id']}'>Delete</a>
                        </td>
                    </tr>
                EOT;
            }

            ?>
    </tbody>
</table>
<?php } ?>
