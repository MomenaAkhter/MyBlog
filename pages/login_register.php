<?php

require_once __DIR__ . '/../models/User.php';

if (isset($_POST['login'])) {
    if (User::login($_POST['name'], $_POST['password'])) {
        header('Location: index.php');
        exit;
    } else {
        echo "<div class='message is-danger'>Incorrect credentials.</div>";
    }
}

if (isset($_POST['register'])) {
    $errors = User::register($_POST['name'], $_POST['password'], $_POST['password-confirmation'], $_POST['email-address']);
    if (count($errors) == 0) {
        header('Location: index.php');
        exit;
    } else {
        $error_items = implode("", array_map(function ($item) {
            return "<li>$item</li>";
        }, $errors));

        echo "<div class='message is-danger'>Registration failed due to the following issues:<ul>$error_items</ul></div>";
    }
}
?>

<div class="login-register">
    <div class="login">
        <h1>Login</h1>

        <form action="" method="post">
            <input type="hidden" name="login">
            <div class="label">
                Name:
            </div>
            <div>
                <input type="text" name="name">
            </div>

            <div class="label">
                Password:
            </div>
            <div>
                <input type="password" name="password">
            </div>

            <div>
                <input type="submit" value="Login">
            </div>
        </form>
    </div>
    <div class="register">
        <h1>Register</h1>

        <form action="" method="post">
            <input type="hidden" name="register">
            <div class="label">
                Name:
            </div>
            <div>
                <input type="text" name="name">
            </div>

            <div class="label">
                Password:
            </div>
            <div>
                <input type="password" name="password">
            </div>

            <div class="label">
                Password Confirmation:
            </div>
            <div>
                <input type="password" name="password-confirmation">
            </div>

            <div class="label">
                Email Address:
            </div>
            <div>
                <input type="email" name="email-address">
            </div>

            <div>
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</div>
