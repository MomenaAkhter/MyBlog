<?php

require_once __DIR__ . '/../libs/Database.php';

class Comment
{
    public static function getAll()
    {
        $sth = Database::getHandle()->prepare("SELECT comments.*, users.name as 'user_name', articles.title as 'article_title' FROM comments LEFT JOIN users ON users.id = comments.user_id LEFT JOIN articles ON articles.id = comments.article_id GROUP BY articles.id;", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
