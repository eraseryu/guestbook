<?php

class Framework_Model_Registry
{
    private $_connection = null;

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

    public function setConnection($connection)
    {
        $this->_connection = $connection;
        return $this;
    }

    public function __call($name, $params)
    {
        if ($this->_connection) {
            if (method_exists($this->_connection, $name)) {
                return call_user_func_array(array($this->_connection, $name), $params[0]);
            }

            throw new Exception('Method not supported');
        }

        throw new Exception('Connection not available');
    }

    public function __get($name)
    {
        if (isset($this->_connections[$name])) {
            return $this->_connections[$name];
        }

        throw new Exception('Connection not available');
    }
}