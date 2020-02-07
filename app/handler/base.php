<?php

/**
 * 参考dingding文档 https://ding-doc.dingtalk.com/doc#/serverapi2/qf2nxq/e9d991e2
 */

namespace app\handler;

use app\conf\Cron;

class base extends \app\handler
{
    private $_keyword = '';

    public function __construct()
    {
        $this->_keyword = empty(Cron::DINGDING_KEYWORDS) ? '' : Cron::DINGDING_KEYWORDS;
    }

    public function getData()
    {
    }

    public function tpl_text($content, $atMobiles = [], $isAtAll = false)
    {
        return [
            'msgtype' => 'text',
            'text' => [
                'content' => $this->_keyword . ' ' . $content,
            ],
            'at' => [
                'atMobiles' => $atMobiles,
            ],
            'isAtAll' => $isAtAll,
        ];
    }

    public function tpl_link($title, $text, $messageUrl, $picUrl = '')
    {
        return [
            'msgtype' => 'link',
            'link' => [
                'title' => $this->_keyword . ' ' . $title,
                'text' => $text,
                'messageUrl' => $messageUrl,
                'picUrl' => $picUrl,
            ],
        ];
    }

    public function tpl_markdown()
    {
    }

    public function tpl_actioncard()
    {
    }

    public function tpl_feedcard()
    {
    }
}
