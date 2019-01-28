<?php

interface Framework_Mvc_Dispatcher_Interface
{
    public function setRoute($route);

    public function testRoute();

    public function loadRoute();
}