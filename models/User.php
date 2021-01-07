<?php

require_once "libs/Database.php";

class User
{
    public static function find($id)
    {
        $sth = Database::get()->prepare('SELECT * FROM users WHERE id = :id', array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id' => $id));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
}
