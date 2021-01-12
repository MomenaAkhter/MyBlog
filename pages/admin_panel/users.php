<h1>Users</h1>

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
        require_once __DIR__ . '/../../libs/Database.php';
        require_once __DIR__ . '/../../models/Article.php';

        $users = Database::getAll('users');
        foreach ($users as $user) {
            echo "<tr><td>{$user['id']}</td><td>{$user['name']}</td><td>{$user['email_address']}</td><td>{$user['is_admin']}</td><td></td></tr>";
        }

        ?>
    </tbody>
</table>
