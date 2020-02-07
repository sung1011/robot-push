<?php

namespace app\handler;

class Demo extends base
{
    public function getData()
    {
        $content = 'just a demo!';
        return $this->tpl_text($content);
    }
}
