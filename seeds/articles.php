<?php

require_once __DIR__ . '/../libs/Database.php';
require_once __DIR__ . '/../helpers/datime.php';

for ($i = 0; $i < 10; $i++)
    Database::insert('articles', ['user_id', 'title', 'body', 'is_top', 'creation_timestamp', 'update_timestamp'], [1, "Article $i", "Body of article $i", random_int(0, 1), now(), now()]);
