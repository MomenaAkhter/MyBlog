<?php

class Config
{
    private static function getContents()
    {
        $handle = fopen("config.json", "r");

        $contents = fread($handle, filesize("config.json"));
        fclose($handle);

        return $contents;
    }

    public static function get($key)
    {
        return json_decode(Config::getContents(), true)[$key];
    }

    public static function getAll()
    {
        return json_decode(Config::getContents(), true);
    }
}
