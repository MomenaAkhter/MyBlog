<?php

function prepare_session()
{
    if (session_status() != PHP_SESSION_ACTIVE) session_start();
}

function set_session_key($key, $value)
{
    prepare_session();

    $_SESSION[$key] = $value;
}

function get_session_key($key)
{
    prepare_session();

    return $_SESSION[$key];
}

function check_session_key($key)
{
    prepare_session();

    var_dump(isset($_SESSION['name']));
    exit();

    return isset($_SESSION[$key]);
}

function remove_session_key($key)
{
    prepare_session();

    unset($_SESSION[$key]);
}
