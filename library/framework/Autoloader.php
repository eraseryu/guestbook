<?php

class Framework_Autoloader
{
    private $_dirs = [];

    private static $_instance = null;

    private function __construct()
    {
        spl_autoload_register([$this, 'autoload']);
    }

    private function __clone() {}

    public static function getInstance()
    {
        if (!self::$_instance) {
            self::$_instance = new self;
        }

        return self::$_instance;
    }

    public function addDir($dir)
    {
        $this->_dirs[] = $dir;

        return $this;
    }

    public function autoload($className, $include = true)
    {
        $fileName = $this->_convertClassName($className);
        foreach ($this->_dirs as $dir) {

            $file = $dir . DIRECTORY_SEPARATOR . $fileName;
            if (file_exists($file)) {

                if ($include) {
                    require $file;
                    return true;
                }

                return $file;
            }
        }

        return false;
    }

    private function _convertClassName($className)
    {
        $name = '';
        $parts = explode('_', $className);

        $i = 1;
        $quantity = count($parts);

        foreach ($parts as $part) {

            if ($i == $quantity) {
                $name .= ucwords($part) . '.php';
            }
            else {
                $name .= strtolower($part) . DIRECTORY_SEPARATOR;
            }

            $i++;
        }

        return $name;
    }
}