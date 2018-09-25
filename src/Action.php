<?php

namespace Popo1h\PhaadminCore;

abstract class Action
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * need override
     * @return string
     */
    public static function getName()
    {
        return '';
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }

    /**
     * 判断当前是否有指定权限, 需Action指定require-auth
     * @param string $authName
     * @return bool
     */
    public function checkAuth($authName)
    {
        $requiredAuthStatus = $this->request->getServerDataByName(Request::SERVER_NAME_REQUIRED_AUTH_STATUS);

        if (!is_array($requiredAuthStatus) || !isset($requiredAuthStatus[$authName])) {
            return false;
        }

        return ($requiredAuthStatus[$authName] ? true : false);
    }

    /**
     * action请求入口
     * @return Response
     */
    abstract public function doAction();
}