<?php

require_once __DIR__ . '/../libs/Database.php';
require_once __DIR__ . '/../helpers/datetime.php';

for ($i = 0; $i < 30; $i++)
    Database::insert('comments', ['user_id', 'article_id', 'body', 'creation_timestamp', 'update_timestamp'], [1, random_int(1, 10), "Body of comment $i", now(), now()]);
