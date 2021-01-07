<?php

require_once 'libs/Database.php';
require_once 'models/User.php';

echo User::find(1)['name'];

// echo Config::get("db_name");
