<?php

namespace app;

abstract class Handler
{
    abstract public function getData();

    public static function handle($className, $params = [])
    {
        $className = "\\app\\handler\\{$className}";
        $service = new $className();
        return $service->getData($params = []);
    }
}
