<?php

class Framework_Controller_Redirect
{
    public function gotoRoute($controller, $method, $params = null)
    {
        $paramsStr = '';

        if ($params) {
            foreach ($params as $key => $val) {
                $paramsStr .= '&' . $key . '=' . $val;
            }
        }

        header('Location: index.php?controller=' . $controller . '&method=' . $method . $paramsStr);
        die('bye');
    }
}