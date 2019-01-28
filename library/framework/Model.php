<?php

class Framework_Model
{
    const PREFIX = 'Model_';

    private $_registry;

    public function __construct()
    {
        $this->_registry = Framework_Model_Registry::getInstance();

        $this->init();
        return $this;
    }

    public function init()
    {
        return true;
    }

    final public function load($model)
    {
        $model = self::PREFIX . $model;

        $object = new $model();
        $object->init();

        return $object;
    }

    public function __call($name, $params)
    {
        return $this->_registry->$name($params);
    }

    public function __get($name)
    {
        return $this->_registry->$name;
    }
}