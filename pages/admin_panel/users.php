<h1>Users</h1>

<?php

require_once __DIR__ . '/../../libs/Database.php';
require_once __DIR__ . '/../../models/Article.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

// Delete
if ($action == 'delete')
    if (Database::remove('users', $_GET['id']))
        echo "<div class='message is-success'>User deleted successfully.</div>";

?>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email Address</th>
            <th>Admin?</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $users = Database::getAll('users');
        foreach ($users as $user) {
            echo <<<EOT
                <tr>
                    <td>{$user['id']}</td>
                    <td>{$user['name']}</td>
                    <td>{$user['email_address']}</td>
                    <td>{$user['is_admin']}</td>
                    <td>
                        <a href='?action=delete&id={$user['id']}'>Delete</a>
                    </td>
                </tr>
                EOT;
        }

        ?>
    </tbody>
</table>
