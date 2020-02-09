# robot-push

```tree
├── README.md
├── app
│   ├── Handler.php
│   ├── Log.php
│   ├── Main.php
│   ├── Notifier.php
│   ├── Schedule.php
│   ├── conf
│   │   └── Cron.php // 核心配置
│   ├── handler
│   │   ├── Demo.php // 组装通知的内容
│   │   └── base.php // text, link, actioncard, markdown协议
│   └── notify
│       └── DingDing.php
│       └── Email.php
│       └── WeChat.php
├── composer.json
├── composer.lock
├── index.php // 配置于crontab
├── main.php // 手动运行
└── vendor
```

## feature

直接触发 （如: 项目发布时给个通知）  
定时触发 （如: 每天按时统计报错,报警）  
定时按逻辑触发（如: 游戏活动结束后，把统计数据直接发策划的钉钉群）  

## usage

`php main.php` // 手动执行一个handler

`* * * * * php index.php` // 配置于crontab(必须每分钟执行)，定时运行详情参见`conf/Cron.php`。

```php
namespace app\conf;

class Cron
{
    /**
     * 满足interval的条件下, 执行独立的handler逻辑产出data, 最后以notifyType方式向dst发送data。
     */
    Const CronConfig = [
        'demo' => [
            'dst' => Cron::DINGDING_DST_DEMO,
            'interval' => '5 * * * *', // 每5分钟
            'handler' => ['Demo', [3,2,1]]],
    ];
    // 钉钉关键词
    // TODO 与dst绑定 当前是所有dst都以此keyword做校验
    Const DINGDING_KEYWORDS = 'DING!';

    //------------dst-------------
    Const DINGDING_DST_DEMO = 'https://oapi.dingtalk.com/robot/send?access_token=xxx'; // 将钉钉机器人的token写到这里
}

```

## TODO

- 微信通知
- email通知
- log  
- 钉钉验签  
- bind keyword  
