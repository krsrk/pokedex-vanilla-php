<?php


namespace Utils\Configuration;

use Dotenv\Dotenv;

class Env implements Configuration
{
    protected $dirPath;
    protected $dotEnv;

    public function __construct(string $dirPath)
    {
        $this->dirPath = $dirPath;
    }

    public function load()
    {
        $dotEnv = Dotenv::createImmutable($this->dirPath);
        $this->_setDotEnv($dotEnv);
        $dotEnv->load();
    }

    private function _setDotEnv($dotEnv)
    {
        $this->dotEnv = $dotEnv;
    }

    public function getDotEnv()
    {
        return $this->dotEnv;
    }

    public static function checkIfVarEnvValueIsBoolean(string $value)
    {
        $varValue = strtolower($value);

        return [
            'result' => ($varValue == 'true' || $varValue == 'false'),
            'value' => ($varValue === 'true'),
        ];
    }
}
