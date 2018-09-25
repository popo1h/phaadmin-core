<?php

namespace Popo1h\PhaadminCore;

use Popo1h\Support\Interfaces\StringPackInterface;
use Popo1h\Support\Traits\StringPack\JsonAutoTrait;

abstract class Response implements StringPackInterface
{
    use JsonAutoTrait;

    /**
     * Server用渲染方法
     * @return ResponseOutput
     */
    abstract public function output();
}
