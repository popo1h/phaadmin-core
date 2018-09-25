<?php

namespace Popo1h\PhaadminCore\Response;

use Popo1h\PhaadminCore\Response;
use Popo1h\PhaadminCore\ResponseOutput;

class ImageResponse extends Response
{
    /**
     * @var string
     */
    protected $imageContent;

    /**
     * ImageResponse constructor.
     * @param string $imageContent
     */
    public function __construct($imageContent)
    {
        $this->imageContent = $imageContent;
    }

    public function output()
    {
        $responseOutput = new ResponseOutput();

        $responseOutput->setContent($this->imageContent);

        $header = [];
        $header['Content-Type'] = 'image/jpg';
        $responseOutput->setHeaders($header);

        return $responseOutput;
    }
}
