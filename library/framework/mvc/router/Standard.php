<?php

class Framework_Mvc_Router_Standard implements Framework_Mvc_Router_Interface
{
    const DELIMITER = '/';

    private $_controller = false;

    private $_method = false;

    public function getRoute()
    {
        return $this->getController
        . self::DELIMITER
        . $this->getMethod;
    }

    public function setRoute($route)
    {
        if (isset($route[0]) && isset($route[1])) {
            $this->setController($route[0]);
            $this->setMethod($route[1]);
        }

        return $this;
    }

    public function getController()
    {
        return $this->_controller;
    }

    public function setController($controller)
    {
        $this->_controller = $controller;
        return $this;
    }

    public function getMethod()
    {
        return $this->_method;
    }
    public function setMethod($method)
    {
        $this->_method = $method;
        return $this;
    }
}