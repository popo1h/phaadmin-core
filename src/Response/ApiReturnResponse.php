<?php

namespace Popo1h\PhaadminCore\Response;

use Popo1h\PhaadminCore\Response;
use Popo1h\PhaadminCore\ResponseOutput;

class ApiReturnResponse extends Response
{
    const CODE_SUCCESS = 1;
    const CODE_ERROR = 0;

    /**
     * @var int
     */
    private $code;
    /**
     * @var string
     */
    private $msg;
    /**
     * @var mixed
     */
    private $data;

    /**
     * ApiReturnResponse constructor.
     * @param int $code
     * @param string $msg
     * @param mixed $data
     */
    public function __construct($code, $msg = '', $data = null)
    {
        $this->code = $code;
        $this->msg = $msg;
        $this->data = $data;
    }

    public function output()
    {
        $responseOutput = new ResponseOutput();
        $responseOutput->setHeaders([
            'Content-Type' => 'application/json',
        ]);
        $responseOutput->setContent(json_encode([
            'code' => $this->code,
            'msg' => $this->msg,
            'data' => $this->data,
        ]));

        return $responseOutput;
    }
}
