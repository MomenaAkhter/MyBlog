<?php

require_once __DIR__ . '/../libs/Database.php';
require_once __DIR__ . '/../helpers/datetime.php';

class Article
{
    public static function find($id)
    {
        $sth = Database::getHandle()->prepare("SELECT articles.*, users.name as user_name FROM articles LEFT JOIN users ON users.id = articles.user_id WHERE articles.id = :id", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id' => $id));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAll()
    {
        $sth = Database::getHandle()->prepare("SELECT articles.*, users.name as user_name, COUNT(comments.id) as comments_count FROM articles LEFT JOIN users ON users.id = articles.user_id LEFT JOIN comments ON comments.article_id = articles.id GROUP BY articles.id ORDER BY update_timestamp DESC", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getAllTop()
    {
        $sth = Database::getHandle()->prepare("SELECT articles.*, users.name as user_name, COUNT(comments.id) as comments_count FROM articles LEFT JOIN users ON users.id = articles.user_id LEFT JOIN comments ON comments.article_id = articles.id WHERE articles.is_top = 1 GROUP BY articles.id ORDER BY update_timestamp DESC", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function alter($id, $title, $body, $is_top, $comments_enabled)
    {
        $sth = Database::getHandle()->prepare("UPDATE articles SET title = :title, body = :body, is_top = :is_top, comments_enabled = :comments_enabled, update_timestamp = :update_timestamp WHERE id = :id", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        return $sth->execute([':id' => $id, ':title' => $title, ':body' => $body, ':is_top' => $is_top, ':comments_enabled' => $comments_enabled, ':update_timestamp' => now()]);
    }
}
