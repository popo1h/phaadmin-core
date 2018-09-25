<?php

namespace Popo1h\PhaadminCore\Net;

use Popo1h\PhaadminCore\Net;
use Popo1h\PhaadminCore\Response\CommonResponse;

class HttpNet extends Net
{
    public function request($requestUrl, $requestStr, $hostIps = null)
    {
        $httpHeader = [];
        if (isset($hostIps)) {
            if (is_array($hostIps)) {
                $hostIp = $hostIps[mt_rand(0, count($hostIps) - 1)];
            } elseif (is_string($hostIps)) {
                $hostIp = $hostIps;
            }

            if (isset($hostIp)) {
                $startOffset = strpos($requestUrl, '//') + 2;
                $hostLength = strpos($requestUrl, '/', $startOffset) - $startOffset;

                $host = substr($requestUrl, $startOffset, $hostLength);
                $httpHeader[] = 'Host: ' . $host;
                $requestUrl = substr($requestUrl, 0, $startOffset) . $hostIp . substr($requestUrl, $startOffset + $hostLength);
            }
        }
        $postData = [
            'data' => $requestStr,
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $requestUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $httpHeader);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $responseStr = curl_exec($ch);
        curl_close($ch);

        return $responseStr;
    }

    public function receive()
    {
        $dataRes = $_POST['data'];

        return $dataRes;
    }

    public function respond($responseStr)
    {
        return new CommonResponse($responseStr, 200);
    }
}
