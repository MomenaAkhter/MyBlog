<h1>Homepage</h1>

<?php
require_once __DIR__ . '/../models/User.php';

// User::logout();
echo User::isLoggedIn() ? 'Logged in' : 'Not logged in';
?>
