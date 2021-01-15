<?php

require_once __DIR__ . '/../libs/Database.php';
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../helpers/datetime.php';

class User
{
    public static function find($id)
    {
        return Database::find('users', $id);
    }

    public static function login($name, $password)
    {
        if ($user = Database::get('users', 'name', $name)) {
            if (password_verify($password, $user['password'])) {
                set_session_value('id', $user['id']);
                return true;
            }
        }

        return false;
    }

    public static function isLoggedIn()
    {
        return check_session_key('id') ? User::find(get_session_value('id')) : false;
    }

    public static function logout()
    {
        remove_session_key('id');
    }

    public static function register($name, $password, $password_confirmation, $email)
    {
        $errors = [];

        if (Database::get('users', 'name', $name))
            $errors[] = "Name is already taken.";

        if (Database::get('users', 'email_address', $email))
            $errors[] = "Email Address is already taken.";

        if ($password_confirmation != $password)
            $errors[] = "Passwords do not match.";

        if (strlen(trim($name)) == 0)
            $errors[] = "Name can't be blank.";

        if (strlen(trim($password)) == 0)
            $errors[] = "Password can't be blank.";

        if (strlen(trim($email)) == 0)
            $errors[] = "Email Address can't be blank.";

        if (count($errors) == 0) {
            Database::insert('users', ['name', 'password', 'email_address', 'is_admin', 'creation_timestamp', 'update_timestamp'], [$name, password_hash($password,  PASSWORD_DEFAULT), $email, 0, now(), now()]);
        }

        return $errors;
    }

    public static function promote($id)
    {
        $sth = Database::getHandle()->prepare("UPDATE users SET is_admin = 1, update_timestamp = :update_timestamp WHERE id = :id", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        return $sth->execute([':id' => $id, ':update_timestamp' => now()]);
    }

    public static function demote($id)
    {
        $sth = Database::getHandle()->prepare("UPDATE users SET is_admin = 0, update_timestamp = :update_timestamp WHERE id = :id", array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        return $sth->execute([':id' => $id, ':update_timestamp' => now()]);
    }
}
