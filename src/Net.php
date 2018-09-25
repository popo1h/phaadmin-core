<?php

namespace Popo1h\PhaadminCore;

abstract class Net
{
    /**
     * 请求provider(server用)
     * @param string $apiUrl
     * @param string $requestStr
     * @param array|null $hostIps
     * @return string responseStr
     */
    abstract public function request($apiUrl, $requestStr, $hostIps = null);

    /**
     * 接收请求参数(provider用)
     * @return string
     */
    abstract public function receive();

    /**
     * 返回处理结果(provider用)
     * @param string $responseStr
     * @return Response
     */
    abstract public function respond($responseStr);
}
