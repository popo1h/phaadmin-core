<?php

namespace Popo1h\PhaadminCore\Response;

use Popo1h\PhaadminCore\Response;
use Popo1h\PhaadminCore\ResponseOutput;

class JsonResponse extends Response
{
    /**
     * @var mixed
     */
    protected $data;

    /**
     * JsonResponse constructor.
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    public function output()
    {
        $content = json_encode($this->data);

        $responseOutput = new ResponseOutput();
        $responseOutput->setHeaders([
            'Content-Type' => 'application/json',
        ]);
        $responseOutput->setContent($content);

        return $responseOutput;
    }
}
