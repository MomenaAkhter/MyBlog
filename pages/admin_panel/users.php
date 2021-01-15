<h1>Users</h1>

<?php

require_once __DIR__ . '/../../libs/Database.php';
require_once __DIR__ . '/../../models/Article.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

// Delete
if ($action == 'delete')
    if (Database::remove('users', $_GET['id']))
        echo "<div class='message is-success'>User deleted successfully.</div>";
// Promote
if ($action == 'promote')
    if (User::promote($_GET['id']))
        echo "<div class='message is-success'>User promoted successfully.</div>";

// Demote
if ($action == 'demote')
    if (User::demote($_GET['id']))
        echo "<div class='message is-success'>User demoted successfully.</div>";

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
            $user['is_admin'] = $user['is_admin'] == 1 ? 'Yes' : 'No';

            echo <<<EOT
                <tr>
                    <td>{$user['id']}</td>
                    <td>{$user['name']}</td>
                    <td>{$user['email_address']}</td>
                    <td>{$user['is_admin']}</td>
                    <td>
                EOT;

            if ($user['is_admin'] == 'Yes')
                echo <<<EOT
                    <a href='?action=demote&id={$user['id']}'>Demote</a>
                    EOT;
            else
                echo <<<EOT
                        <a href='?action=promote&id={$user['id']}'>Promote</a>
                        EOT;


            echo <<<EOT
                        &nbsp;
                        <a href='?action=delete&id={$user['id']}'>Delete</a>
                    </td>
                </tr>
                EOT;
        }

        ?>
    </tbody>
</table>
