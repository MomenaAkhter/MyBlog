<?php

require_once __DIR__ . '/../libs/Database.php';

class Article
{
    public static function find($id)
    {
        $sth = Database::getHandle()->prepare("SELECT * FROM articles LEFT JOIN users ON users.id = articles.user_id WHERE id = :id", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id' => $id));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAll()
    {
        $sth = Database::getHandle()->prepare("SELECT * FROM articles LEFT JOIN users ON users.id = articles.user_id WHERE 1", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
