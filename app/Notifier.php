<?php

namespace app;

abstract class Notifier
{
    abstract public function send($dst, $data);

    public static function notify($dst, $data, $servicesName = 'DingDing')
    {
        $className = "\\app\\notify\\{$servicesName}";
        $service = new $className();
        return $service->send($dst, $data);
    }
}
