<?php

require_once 'libs/Database.php';

class User
{
    public static function find($id)
    {
        return Database::find('users', $id);
    }
}
