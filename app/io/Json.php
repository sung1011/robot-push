<?php

namespace app\io;

class Json extends \app\IO
{
    public function encode()
    {
        $this->set('a', 123);
    }

    public function decode()
    {
        return $this->get('a');
    }
}
