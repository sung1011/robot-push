<?php

namespace app\conf;

class Cron
{
    Const CronConfig = [
        'demo' => ['dst' => Cron::DINGDING_DST_DEMO, 'interval' => '5 * * * *', 'handler' => ['Demo', [3,2,1]]],
    ];
    // 钉钉关键词
    // TODO 与dst绑定 当前是所有dst都以此keyword做校验
    Const DINGDING_KEYWORDS = 'DING!';

    //------------dst-------------
    Const DINGDING_DST_DEMO = 'https://oapi.dingtalk.com/robot/send?access_token=xxx'; // 将钉钉机器人的token写到这里
}
