<h1>Menu Items</h1>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Link</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once __DIR__ . '../../libs/Database.php';

        $menu_items = Database::getAll('menu_items');
        foreach ($menu_items as $menu_item) {
            echo "<tr><td>{$menu_item['id']}</td><td>{$menu_item['name']}</td><td>{$menu_item['href']}</td><td></td></tr>";
        } ?>
    </tbody>
</table>
