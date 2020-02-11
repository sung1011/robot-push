<?php

namespace app;

class IO
{
    private static $_instance = [];

    private $_data = [];

    public function get($key)
    {
        if (empty($this->_data[$key])) {
            return null;
        }
        return $this->_data[$key];
    }

    public function set($key, $val)
    {
        return $this->_data[$key] = $val;
    }

    public function getAll()
    {
        return $this->_data;
    }

    public function del($key)
    {
        unset($this->_data[$key]);
    }

    public function clean()
    {
        $this->_data = [];
    }

    public static function getInstance($name)
    {
        if (!isset(self::$_instance[$name])) {
            $className = "\\app\\io\\{$name}";
            self::$_instance[$name] = new $className();
        }
        return static::$_instance[$name];
    }
}
