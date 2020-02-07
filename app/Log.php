<?php

namespace app;

class Log
{
    private static $logs = [];

    public static function set($msg, $data = [])
    {
        array_push(self::$logs, ['msg' => $msg, 'data' => $data]);
    }

    public static function flush()
    {
        if (empty(self::$logs)) {
            return ;
        }

        //TODO
        print_r(self::$logs);
    }
}
