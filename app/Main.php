<?php

namespace app;

use app\conf\Cron;

define('ROBOT_PUSH_ROOT', dirname(__FILE__) . '/');

class Main
{
    /**
     * dst: 目标url
     * interval: 发送间隔
     * handler: 指定handler返回需要发送的msg
    */
    // private $conf = Cron::$CronConfig;

    public function run($key = null)
    {
        $this->beforeRun();

        $cronConf = Cron::$CronConfig;

        if (!empty($key) && isset($cronConf[$key])) {
            $this->exec($key);
        } else {
            foreach ($cronConf as $key => $conf) {
                if (!$this->isActive($key)) {
                    continue;
                }
                $this->exec($key);
            }
        }

        $this->afterRun();
    }

    public function exec($key)
    {
        $cronConf = Cron::$CronConfig;
        if (empty($cronConf[$key]['handler'][0])) {
            Log::set('conf '. $key .'no class');
            return ;
        }
        $class = $cronConf[$key]['handler'][0];
        $params = $cronConf[$key]['handler'][1];
        $data = Handler::handle($class, $params);
        $rs = Notify::notify($cronConf[$key]['dst'], $data);
    }

    private function isActive($key)
    {
        $cronConf = Cron::$CronConfig;
        $schedule = new Schedule();
        return isset($cronConf[$key]['interval']) && $schedule->checkInterval($cronConf[$key]['interval']);
    }

    private function beforeRun()
    {
    }

    private function afterRun()
    {
        Log::flush();
    }

    private static $instance = null;

    public static function &getInstance()
    {
        if (null == self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}

function &getApp()
{
    return Main::getInstance();
}
