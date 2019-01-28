<?php

class Framework_Mvc
{
    private static $_instance = null;

    private $_router = null;

    private $_dispatcher = null;

    private $_defaultRoute = array();

    private $_output = '';

    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    private function __construct() { }

    private function __clone() { }

    public function setDefaultRoute($route)
    {
        $this->_defaultRoute = $route;
    }

    public function getDefaultRoute()
    {
        return $this->_defaultRoute;
    }

    public function getRouter()
    {
        return $this->_router;
    }

    public function setRouter($router)
    {
        if ($router instanceof Framework_Mvc_Router_Interface) {
            $this->_router = $router;
            return $this;
        }

        throw new Exception('Router is invalid');
    }
    public function getDispatcher()
    {
        return $this->_dispatcher;
    }

    public function setDispatcher($dispatcher)
    {
        if ($dispatcher instanceof Framework_Mvc_Dispatcher_Interface) {
            $this->_dispatcher = $dispatcher;
            return $this;
        }

        throw new Exception('Dispatcher is invalid');
    }

    public function addOutput($output)
    {
        $this->_output .= $output;
        return $this;
    }

    public function getOutput()
    {
        return $this->_output;
    }

    public function run()
    {
        $this->setDispatcher(new Framework_Mvc_Dispatcher_Standard());
        $this->setRouter(new Framework_Mvc_Router_Standard());

        $router = $this->getRouter();
        $dispatcher = $this->getDispatcher();

        $route = new Framework_Controller_Request();
        $router->setRoute(array(
            $route->getController(),
            $route->getMethod()
        ));

        $dispatcher->setRoute(array(
            $router->getController(),
            $router->getMethod()
        ));

        if (!$dispatcher->testRoute()) {
            $router->setRoute($this->getDefaultRoute());
        }

        $dispatcher->setRoute(array(
            $router->getController(),
            $router->getMethod()
        ));

        if (!$dispatcher->testRoute()) {
            throw new Exception('Route is invalid');
        }

        $output = $dispatcher->loadRoute();
        $this->addOutput($output);

        return $this;
    }
}