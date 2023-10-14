<?php
namespace src\helpers;

class ExecuteController
{
    public static function run($controller, $method){
        $class = new \ReflectionClass('src\controllers\\' . $controller);
        $class = $class->newInstance();
        $class->$method();
    }
}