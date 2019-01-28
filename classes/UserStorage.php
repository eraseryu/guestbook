<?php

class UserStorage
{
    private static $_instance = null;

    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    private function __construct() { }

    private function __clone() { }

    public function setCookie(array $user)
    {
        setcookie("guestbookLoginData", json_encode($user), time() + 3600);
    }

    public function deleteCookie()
    {
        setcookie("guestbookLoginData", "", time() - 3600);
    }

    public function isAdmin(): bool
    {
        if (isset($_COOKIE['guestbookLoginData'])) {
            $data = json_decode($_COOKIE['guestbookLoginData'], true);
            if (isset($data['admin']) && ($data['admin'])) {
                return true;
            }
        }

        return false;
    }

    public function isLoggedIn(): bool
    {
        if (isset($_COOKIE['guestbookLoginData'])) {
            return true;
        }

        return false;
    }

    public function getUserId()
    {
        if (isset($_COOKIE['guestbookLoginData'])) {
            $data = json_decode($_COOKIE['guestbookLoginData'], true);
            if (isset($data['id'])) {
                return $data['id'];
            }
        }

        return false;
    }

    public function getUsername()
    {
        if (isset($_COOKIE['guestbookLoginData'])) {
            $data = json_decode($_COOKIE['guestbookLoginData'], true);
            if (isset($data['username'])) {
                return $data['username'];
            }
        }

        return false;
    }

}