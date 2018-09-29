<?php

namespace Popo1h\PhaadminCore\Request;

use Popo1h\Support\Interfaces\StringPackInterface;
use Popo1h\Support\Traits\StringPack\JsonAutoTrait;

class File implements StringPackInterface
{
    use JsonAutoTrait {
        packToString as private commonPackToString;
        unpackString as private commonUnpackString;
    }

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var string
     */
    private $originName;

    /**
     * @var string
     */
    private $mimeType;

    /**
     * @var int
     */
    private $fileSize;

    /**
     * @var string
     */
    private $fileContent;

    /**
     * @param string $fileName
     * @param string $originName
     * @param string $mimeType
     * @param int $fileSize
     */
    public function __construct($fileName, $originName, $mimeType, $fileSize)
    {
        $this->fileName = $fileName;
        $this->originName = $originName;
        $this->mimeType = $mimeType;
        $this->fileSize = $fileSize;
    }

    public function __destruct()
    {
        @unlink($this->fileName);
    }

    /**
     * @param array $file item of $_FILES
     * @return File|null;
     */
    public static function buildByFile($file)
    {
        if (!isset($file['tmp_name']) || !isset($file['name']) || !isset($file['type']) || !isset($file['size']) || !is_file($file['tmp_name'])) {
            return null;
        }
        return new static($file['tmp_name'], $file['name'], $file['type'], $file['size']);
    }

    public function toFile()
    {
        return [
            'name' => $this->originName,
            'type' => $this->mimeType,
            'size' => $this->fileSize,
            'tmp_name' => $this->fileName,
            'error' => UPLOAD_ERR_OK,
        ];
    }

    /**
     * string
     */
    private function getFileContent()
    {
        if (!isset($this->fileContent)) {
            $this->fileContent = base64_encode(file_get_contents($this->fileName));
        }

        return $this->fileContent;
    }

    public function storeFile()
    {
        $dir = (ini_get('upload_tmp_dir') ? ini_get('upload_tmp_dir') : sys_get_temp_dir());

        $fileName = 'aadmin_upload_file_' . md5(time()) . mt_rand(1000, 9999);

        $this->fileName = $dir . DIRECTORY_SEPARATOR . $fileName;

        file_put_contents($this->fileName, base64_decode($this->fileContent));
    }

    public function packToString()
    {
        $this->getFileContent();

        return $this->commonPackToString();
    }

    public static function unpackString($string)
    {
        $instance = self::commonUnpackString($string);

        $instance->storeFile();

        return $instance;
    }
}
