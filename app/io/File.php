<?php

namespace app\io;

class File extends \app\IO
{
    public function flush()
    {
        $this->set('a', 123);
    }
}
