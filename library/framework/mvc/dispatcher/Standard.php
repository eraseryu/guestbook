<?php

class Framework_Mvc_Dispatcher_Standard implements Framework_Mvc_Dispatcher_Interface
{
    const CONTROLLER_PREFIX = 'Controller_';

    private $_controller;

    private $_method;

    public function setRoute($route)
    {
        $this->_controller = $route[0];
        $this->_method = $route[1];

        return $this;
    }

    public function testRoute()
    {
        $controller = $this->_getControllerName();
        return class_exists($controller);
    }

    public function loadRoute()
    {
        $controller = $this->_getControllerName();
        $method = $this->_method;

        $object = new $controller();
        $output = $object->$method();

        return $output;
    }

    private function _getControllerName()
    {
        $controller = ucwords($this->_controller);
        return self::CONTROLLER_PREFIX . $controller;
    }
}