<?php

abstract class Framework_Controller
{
    private $_mvcObject;

    final public function __construct()
    {
        $this->_mvcObject = Framework_Mvc::getInstance();
        return $this->init();
    }

    final public function __call($name, $args)
    {
        return $this->_mvcObject->$name($args);
    }

    public function init()
    {
        return true;
    }

    final public function request()
    {
        return new Framework_Controller_Request();
    }

    final public function redirect()
    {
        return new Framework_Controller_Redirect();
    }

    final public function view()
    {
        return new Framework_View();
    }

    final public function model()
    {
        return new Framework_Model();
    }
}