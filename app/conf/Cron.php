<?php

namespace app\conf;

class Cron
{
    /**
     * 满足interval的条件下, 执行独立的handler逻辑产出data, 最后以notifyType方式向dst发送data。
     */
    public static $CronConfig = [
        'demo' => [
            'dst' => Cron::DINGDING_DST_DEMO,
            'interval' => '5 * * * *',
            'handler' => ['Demo', [3,2,1]]],
    ];
    // 钉钉关键词
    // TODO 与dst绑定 当前是所有dst都以此keyword做校验
    const DINGDING_KEYWORDS = 'DING!';

    //------------dst-------------
    const DINGDING_DST_DEMO = 'https://oapi.dingtalk.com/robot/send?access_token=xxx'; // 将钉钉机器人的token写到这里
}
