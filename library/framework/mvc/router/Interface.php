<?php

interface Framework_Mvc_Router_Interface
{
    public function getRoute();

    public function setRoute($route);

    public function getController();

    public function setController($controller);

    public function getMethod();

    public function setMethod($method);
}