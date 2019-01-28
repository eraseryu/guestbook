<?php

class Framework_Database
{
    private $_adapter = null;

    private $_connection = null;

    public function setAdapter($adapter)
    {
        if (!is_object($adapter)) {
            throw new Exception('Adapter is invalid');
        }

        $this->_adapter = $adapter;
    }

    public function getAdapter()
    {
        return $this->_adapter;
    }

    public function getConnection($host, $name, $user, $pass)
    {
        if (!$this->_adapter) {
            throw new Exception('Please set adapter first');
        }

        $connector = $this->_adapter->getConnector($name, $host);
        $params = $this->_adapter->getParams();

        if (!$this->_connection) {
            $this->_connection = new PDO($connector, $user, $pass, $params);
        }

        return $this->_connection;
    }
}