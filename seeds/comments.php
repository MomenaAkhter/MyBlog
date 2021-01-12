<?php

require_once __DIR__ . '/../libs/Database.php';

$datetime_now = date('Y-m-d H:i:s');

for ($i = 0; $i < 30; $i++)
    Database::insert('comments', ['user_id', 'article_id', 'body', 'creation_timestamp', 'update_timestamp'], [1, random_int(1, 10), "Body of comment $i", $datetime_now, $datetime_now]);
