<?php

class Framework_Database_Adapter_Mysql implements Framework_Database_Adapter_Interface
{
    public function getConnector($name, $host)
    {
        return 'mysql:dbname=' . $name . ';host=' . $host;
    }

    public function getParams()
    {
        return array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        );
    }
}