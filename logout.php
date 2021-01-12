<?php

require_once __DIR__ . '/models/User.php';

User::logout();

header("Location: index.php");
