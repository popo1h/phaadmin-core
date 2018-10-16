<?php

namespace Popo1h\PhaadminCore\Response;

use Popo1h\PhaadminCore\Response;
use Popo1h\PhaadminCore\ResponseOutput;

class CommonResponse extends Response
{
    /**
     * @var string
     */
    protected $content;
    /**
     * @var int
     */
    protected $statusCode;
    /**
     * @var array [ 'header_name' => 'header_content' ]
     */
    protected $headers;

    /**
     * CommonResponse constructor.
     * @param string $content
     * @param int $statusCode
     * @param array $headers
     */
    public function __construct($content, $statusCode = 200, $headers = [])
    {
        $this->content = base64_encode($content);
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function output()
    {
        $responseOutput = new ResponseOutput();

        $responseOutput->setStatusCode($this->statusCode);
        $responseOutput->setContent(base64_decode($this->content));
        $responseOutput->setHeaders($this->headers);

        return $responseOutput;
    }
}
