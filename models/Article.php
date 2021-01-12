<?php

require_once __DIR__ . '/../libs/Database.php';

class Article
{
    public static function find($id)
    {
        return Database::find('articles', $id);
    }
}
