<?php

namespace Popo1h\PhaadminCore;

use Popo1h\PhaadminCore\Request\File;
use Popo1h\Support\Interfaces\StringPackInterface;
use Popo1h\Support\Traits\StringPack\JsonAutoTrait;

class Request implements StringPackInterface
{
    use JsonAutoTrait;

    const SERVER_NAME_ACTION_NAME = 'action_name';
    const SERVER_NAME_CATE_NAME = 'cate_name';
    const SERVER_NAME_USER_ID = 'user_id';
    const SERVER_NAME_REQUIRED_AUTH_STATUS = 'require_auth_status';

    /**
     * @var array
     */
    private $server;
    /**
     * @var array
     */
    private $post;
    /**
     * @var array
     */
    private $get;
    /**
     * @var File[]
     */
    private $file;

    /**
     * @return array
     */
    public function getServer()
    {
        return $this->server;
    }

    /**
     * @param array $server
     */
    public function setServer($server)
    {
        $this->server = $server;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @param callable $dealFunction
     * @return mixed
     */
    public function getServerDataByName($name, $default = null, $dealFunction = null)
    {
        if (!isset($this->server[$name])) {
            return $default;
        }

        $data = $this->server[$name];
        if (isset($dealFunction) && is_callable($dealFunction)) {
            $data = $dealFunction($data);
        }

        return $data;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function setServerDataByName($name, $value)
    {
        $this->server[$name] = $value;
    }

    /**
     * @return array
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param array $post
     */
    public function setPost($post)
    {
        $this->post = $post;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @param callable $dealFunction
     * @return mixed
     */
    public function getPostDataByName($name, $default = null, $dealFunction = null)
    {
        if (!isset($this->post[$name])) {
            return $default;
        }

        $data = $this->post[$name];
        if (isset($dealFunction) && is_callable($dealFunction)) {
            $data = $dealFunction($data);
        }

        return $data;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function setPostDataByName($name, $value)
    {
        $this->post[$name] = $value;
    }

    /**
     * @return array
     */
    public function getGet()
    {
        return $this->get;
    }

    /**
     * @param array $get
     */
    public function setGet($get)
    {
        $this->get = $get;
    }

    /**
     * @param string $name
     * @param mixed $default
     * @param callable $dealFunction
     * @return mixed
     */
    public function getGetDataByName($name, $default = null, $dealFunction = null)
    {
        if (!isset($this->get[$name])) {
            return $default;
        }

        $data = $this->get[$name];
        if (isset($dealFunction) && is_callable($dealFunction)) {
            $data = $dealFunction($data);
        }

        return $data;
    }

    /**
     * @param string $name
     * @param mixed $value
     */
    public function setGetDataByName($name, $value)
    {
        $this->get[$name] = $value;
    }

    /**
     * @return array
     */
    public function getFile()
    {
        $result = [];
        foreach ($this->file as $key => $file) {
            $result[$key] = $file->toFile();
        }
        return $result;
    }

    /**
     * @param array $files
     */
    public function setFileByFiles($files)
    {
        $this->file = [];
        foreach ($files as $key => $file) {
            $fileObj = File::buildByFile($file);
            if ($fileObj) {
                $this->file[$key] = $fileObj;
            }
        }
    }

    /**
     * @param string $name
     * @return array|null
     */
    public function getFileDataByName($name)
    {
        if (!isset($this->file[$name])) {
            return [];
        }

        return $this->file[$name]->toFile();
    }

    /**
     * @param string $name
     * @param array $file
     */
    public function setFileDataByName($name, $file)
    {
        $fileObj = File::buildByFile($file);
        if ($fileObj) {
            $this->file[$name] = $fileObj;
        }
    }

    /**
     * @param string $name
     * @param mixed $default
     * @param callable $dealFunction
     * @return mixed
     */
    public function getDataByName($name, $default = null, $dealFunction = null)
    {
        $result = $this->getPostDataByName($name, null, $dealFunction);

        if (!isset($result)) {
            $result = $this->getGetDataByName($name, null, $dealFunction);
        }

        if (!isset($result)) {
            $result = $default;
        }

        return $result;
    }
}
