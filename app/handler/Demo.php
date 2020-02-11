<?php

namespace app\handler;

class Demo extends base
{
    public function getData()
    {
        $o = \app\IO::getInstance('File')->flush();
        $o = \app\IO::getInstance('Json')->encode();
        $o = \app\IO::getInstance('Json')->decode();
        echo $o;

        $content = 'just a demo!';
        return $this->tpl_text($content);
    }
}
