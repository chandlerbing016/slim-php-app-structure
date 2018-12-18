<?php
namespace Kirk\Lib;

use Kirk\Lib\Session;

class Auth
{
    public static function ifUser()
    {
        # assuming that nothing has been tempered
        return Session::exists('logged_in_user');
    }

    public static function getUser()
    {
        return Session::get('logged_in_user');
    }
}