<?php

class Framework_Controller_Request
{
    public function getController()
    {
        return $this->get('controller');
    }

    public function getMethod()
    {
        return $this->get('method');
    }

    public function getRequest()
    {
        return $_REQUEST;
    }

    public function get($key)
    {
        switch (true) {
            case isset($_GET[$key]):
                return $_GET[$key];

            case isset($_POST[$key]):
                return $_POST[$key];

            case isset($_REQUEST[$key]):
                return $_REQUEST[$key];

            case isset($_COOKIE[$key]):
                return $_COOKIE[$key];

            case isset($_SERVER[$key]):
                return $_SERVER[$key];

            case isset($_ENV[$key]):
                return $_ENV[$key];

            default:
                return null;
        }
    }

    public function has($key)
    {
        switch (true) {
            case isset($_GET[$key]):
                return true;

            case isset($_POST[$key]):
                return true;

            case isset($_COOKIE[$key]):
                return true;

            case isset($_SERVER[$key]):
                return true;

            case isset($_ENV[$key]):
                return true;

            default:
                return false;
        }
    }

    public function getPost($post)
    {
        return (isset($_POST[$post])) ? $_POST[$post] : false;
    }

    public function getPosts()
    {
        return $_POST;
    }

    public function getGet($get)
    {
        return (isset($_GET[$get])) ? $_GET[$get] : false;
    }

    public function getServer($server)
    {
        return (isset($_SERVER[$server])) ? $_SERVER[$server] : false;
    }

    public function getRequestMethod()
    {
        return $this->getServer('REQUEST_METHOD');
    }

    public function isPost()
    {
        if ($this->getRequestMethod() == 'POST') {
            return true;
        }

        return false;
    }

    public function isGet()
    {
        if ($this->getRequestMethod() == 'GET') {
            return true;
        }

        return false;
    }
}