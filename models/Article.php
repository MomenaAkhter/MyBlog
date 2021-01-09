<?php

require_once 'libs/Database.php';

class Article
{
    public static function find($id)
    {
        return Database::find('articles', $id);
    }
}
