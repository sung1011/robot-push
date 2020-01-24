<?php

namespace app;

/**
 * 流程: 满足interval的条件下, 执行独立的handler逻辑产出data, 最后以notifyType方式向dst发送data。
 */

class Main
{
    private $conf = [
        'demo' => ['dst' => 'www.baidu.com', 'interval' => '* * * * *', 'handler' => ['Demo', [3,2,1]]],
    ];

    public function run($key = null)
    {
        $this->beforeRun();

        if (!empty($key) && isset($this->conf[$key])) {
            $this->exec($key);
        } else {
            foreach ($this->conf as $key => $conf) {
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
        if (empty($this->conf[$key]['handler'][0])) {
            Log::set('conf '. $key .'no class');
            return ;
        }
        $class = $this->conf[$key]['handler'][0];
        $params = $this->conf[$key]['handler'][1];
        $data = Handler::handle($class, $params);
        $rs = Notifier::notify($this->conf[$key]['dst'], $data);
    }

    private function isActive($key)
    {
        $schedule = new Schedule();
        return isset($this->conf[$key]['interval']) && $schedule->checkInterval($this->conf[$key]['interval']);
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