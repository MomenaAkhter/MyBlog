<?php

require_once __DIR__ . '/../libs/Database.php';

class MenuItem
{
    public static function getAll()
    {
        $sth = Database::getHandle()->prepare("SELECT * FROM menu_items WHERE 1 ORDER BY weight ASC", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function moveUp($id)
    {
        $sth = Database::getHandle()->prepare("UPDATE menu_items SET weight = weight - 1 WHERE id = :id", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        return $sth->execute([':id' => $id]);
    }

    public static function moveDown($id)
    {
        $sth = Database::getHandle()->prepare("UPDATE menu_items SET weight = weight + 1 WHERE id = :id", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        return $sth->execute([':id' => $id]);
    }

    public static function alter($id, $name, $link, $weight)
    {
        $sth = Database::getHandle()->prepare("UPDATE menu_items SET name = :name, href = :href, weight = :weight WHERE id = :id", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        return $sth->execute([':id' => $id, ':name' => $name, ':href' => $link, ':weight' => $weight]);
    }
}
