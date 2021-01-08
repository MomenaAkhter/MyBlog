<?php

require_once 'libs/Config.php';

class Database
{
    private static $dbh;

    public static function connect()
    {
        $config_keys = Config::getAll();

        $dsn = sprintf('%s:dbname=%s;host=%s', $config_keys['db_type'], $config_keys['db_name'], $config_keys['db_host']);
        $user = $config_keys['db_username'];
        $password = $config_keys['db_password'];

        try {
            return Database::$dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public static function getHandle()
    {
        if (isset(Database::$dbh))
            return Database::$dbh;

        return Database::connect();
    }

    public static function find($table, $id)
    {
        $sth = Database::getHandle()->prepare("SELECT * FROM $table WHERE id = :id", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(':id' => $id));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public static function get($table, $key, $value)
    {
        $sth = Database::getHandle()->prepare("SELECT * FROM $table WHERE $key = :$key", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute(array(":$key" => $value));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    public static function getAll($table)
    {
        $sth = Database::getHandle()->prepare("SELECT * FROM $table WHERE 1", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function insert($table, $columns, $values)
    {
        $columns = implode(',', $columns);
        $values = implode(',', array_map(function ($item) {
            if (is_int($item))
                return $item;
            return "'$item'";
        }, $values));

        Database::getHandle()->exec("INSERT INTO $table ($columns) VALUES ($values)");
    }
}
