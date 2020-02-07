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

## TODO

log  
验签  
bind keyword  
