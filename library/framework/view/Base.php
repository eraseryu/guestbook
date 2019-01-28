<?php

class Framework_View_Base
{
    private $_vars = array();

    private $_target = null;

    public function load($target)
    {
        $this->_target = $this->_prefix . $target;
        return $this;
    }

    public function __set($name, $value)
    {
        return $this->set($name, $value);
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function set($name, $value)
    {
        $this->_vars[$name] = $value;
        return $this;
    }

    public function get($name)
    {
        if (isset($this->_vars[$name])) {
            return $this->_vars[$name];
        }

        return false;
    }

    public function render()
    {
        ob_start();
        extract($this->_vars);

        $autoloader = Framework_Autoloader::getInstance();
        include $autoloader->autoload($this->_target, false);

        return ob_get_clean();
    }
}