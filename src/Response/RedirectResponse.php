<?php

namespace Popo1h\PhaadminCore\Response;

use Popo1h\PhaadminCore\Response;
use Popo1h\PhaadminCore\ResponseOutput;

class RedirectResponse extends Response
{
    /**
     * @var string
     */
    protected $redirectUrl;

    /**
     * RedirectResponse constructor.
     * @param string $redirectUrl
     */
    public function __construct($redirectUrl)
    {
        $this->redirectUrl = $redirectUrl;
    }

    public function output()
    {
        $responseOutput = new ResponseOutput();
        $responseOutput->setStatusCode(302);
        $responseOutput->setHeaders([
            'Location' => $this->redirectUrl,
        ]);

        return $responseOutput;
    }
}