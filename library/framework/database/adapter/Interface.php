<?php

interface Framework_Database_Adapter_Interface
{
    public function getConnector($name, $host);

    public function getParams();
}