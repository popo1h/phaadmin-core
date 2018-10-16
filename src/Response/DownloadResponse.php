<?php

namespace Popo1h\PhaadminCore\Response;

use Popo1h\PhaadminCore\Response;
use Popo1h\PhaadminCore\ResponseOutput;

class DownloadResponse extends Response
{
    /**
     * @var string
     */
    protected $filename;
    /**
     * @var string
     */
    protected $fileContent;

    /**
     * DownloadResponse constructor.
     * @param string $filename
     * @param string $fileContent
     */
    public function __construct($filename, $fileContent)
    {
        $this->filename = $filename;
        $this->fileContent = base64_encode($fileContent);
    }

    public function output()
    {
        $responseOutput = new ResponseOutput();

        $responseOutput->setContent(base64_decode($this->fileContent));

        $header = [];
        $header['Content-Type'] = 'application/octet-stream';
        $header['Content-Disposition'] = 'attachment; filename="' . $this->filename . '"';
        $responseOutput->setHeaders($header);

        return $responseOutput;
    }
}
