<?php

require_once "libs/Config.php";

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

    public static function get()
    {
        if (isset(Database::$dbh))
            return Database::$dbh;

        return Database::connect();
    }
}
