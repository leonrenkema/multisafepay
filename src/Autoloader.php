<?php

namespace MultiSafePay\API;

class Autoloader {

    public static function autoload($class_name) {

        if (strpos($class_name, "MultiSafePay\\") === 0) {
            $file_name = str_replace("\\", "/", $class_name);
            $file_name = realpath(dirname(__FILE__) . "/../../{$file_name}.php");

            if (file_exists($file_name)) {
                require $file_name;
            }
        }
    }
    

    public static function register() {
        return spl_autoload_register(array(__CLASS__, "autoload"));
    }


    public static function unregister() {
        return spl_autoload_unregister(array(__CLASS__, "autoload"));
    }
}

Autoloader::register();
