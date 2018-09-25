<?php

namespace Popo1h\PhaadminCore\Response;

use Popo1h\PhaadminCore\Response;
use Popo1h\PhaadminCore\ResponseOutput;

class ErrorResponse extends Response
{
    /**
     * @var string
     */
    private $errorInfo;
    /**
     * @var mixed
     */
    private $errorDetail;

    /**
     * ErrorResponse constructor.
     * @param string $errorInfo
     * @param mixed $errorDetail
     */
    public function __construct($errorInfo, $errorDetail = '')
    {
        $this->errorInfo = $errorInfo;
        $this->errorDetail = $errorDetail;
    }

    /**
     * @return string
     */
    public function getErrorInfo()
    {
        return $this->errorInfo;
    }

    /**
     * @return mixed
     */
    public function getErrorDetail()
    {
        return $this->errorDetail;
    }

    public function output()
    {
        $responseOutput = new ResponseOutput();
        $responseOutput->setStatusCode(500);
        $responseOutput->setHeaders([
            'Content-Type' => 'application/json',
        ]);
        $responseOutput->setContent(json_encode([
            'error_info' => $this->errorInfo,
            'error_detail' => $this->errorDetail,
        ]));

        return $responseOutput;
    }
}
