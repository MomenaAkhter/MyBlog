<h1>Menu Items</h1>

<?php

require_once __DIR__ . '/../../models/MenuItem.php';
require_once __DIR__ . '/../../libs/Database.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

// Delete
if ($action == 'delete')
    if (Database::remove('menu_items', $_GET['id']))
        echo "<div class='message is-success'>Menu item deleted successfully.</div>";

// Movement
if ($action == 'move_up')
    if (MenuItem::moveUp($_GET['id']))
        echo "<div class='message is-success'>Menu item moved up successfully.</div>";

if ($action == 'move_down')
    if (MenuItem::moveDown($_GET['id']))
        echo "<div class='message is-success'>Menu item moved down successfully.</div>";

// Create
if (isset($_POST['name']))
    if (Database::insert('menu_items', ['name', 'href', 'weight'], [$_POST['name'], $_POST['link'], 0]))
        echo "<div class='message is-success'>Menu item created successfully.</div>";


?>

<form action="menu_items.php" method='POST' class="form-inline">
    <input type="text" name="name" placeholder="Name">
    <input type="text" name="link" placeholder="Link">
    <input type="submit" value="Create">
</form>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Link</th>
            <th>Weight</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php


        $menu_items = MenuItem::getAll();
        foreach ($menu_items as $menu_item) {
            echo <<<EOT
                <tr>
                    <td>{$menu_item['id']}</td>
                    <td>{$menu_item['name']}</td>
                    <td>{$menu_item['href']}</td>
                    <td>{$menu_item['weight']}</td>
                    <td>
                        <a href='?action=move_up&id={$menu_item['id']}'>Move Up</a>&nbsp;
                        <a href='?action=move_down&id={$menu_item['id']}'>Move Down</a>&nbsp;
                        <a href='?action=edit&id={$menu_item['id']}'>Edit</a>&nbsp;
                        <a href='?action=delete&id={$menu_item['id']}'>Delete</a>
                    </td>
                </tr>
                EOT;
        } ?>
    </tbody>
</table>

<script src="../static/js/admin_panel/menu_items.js"></script>
