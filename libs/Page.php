<?php

class Page
{
    public static function get($name, $title, $layout = 'layout')
    {
        $page_title = $title;
        $page_name = $name;

        require_once __DIR__ . "/../pages/components/$layout.php";
    }
}
