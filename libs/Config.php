<?php

class Config
{
    private static $config;

    private static function load()
    {
        if (!isset(Config::$config)) {

            $handle = fopen("config.json", "r");

            $contents = fread($handle, filesize("config.json"));
            fclose($handle);

            Config::$config = json_decode($contents, true);
        }
    }

    public static function get($key)
    {
        Config::load();
        return Config::$config[$key];
    }

    public static function getAll()
    {
        Config::load();
        return Config::$config;
    }
}
