<?php

require_once __DIR__ . '/Config.php';

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
        $value_placeholders = implode(',', array_map(function ($column) {
            return ":$column";
        }, $columns));

        $value_placeholder_associations = [];
        for ($i = 0; $i < count($values); $i++)
            $value_placeholder_associations[":{$columns[$i]}"] = $values[$i];

        $columns = implode(',', $columns);

        $sth = Database::getHandle()->prepare("INSERT INTO $table ($columns) VALUES ($value_placeholders)");
        return $sth->execute($value_placeholder_associations);
    }

    public static function remove($table, $id)
    {
        $sth = Database::getHandle()->prepare("DELETE FROM $table WHERE id = :id", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        return $sth->execute([':id' => $id]);
    }
}
