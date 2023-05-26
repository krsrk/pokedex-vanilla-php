<?php


namespace Utils\Configuration;

use Dotenv\Dotenv;

class Env implements Configuration
{
    protected string $dirPath;
    protected Dotenv $dotEnv;

    public function __construct(string $dirPath)
    {
        $this->dirPath = $dirPath;
    }

    public function load(): void
    {
        $dotEnv = Dotenv::createImmutable($this->dirPath);
        $this->_setDotEnv($dotEnv);
        $dotEnv->load();
    }

    private function _setDotEnv($dotEnv): void
    {
        $this->dotEnv = $dotEnv;
    }

    public function getDotEnv(): Dotenv
    {
        return $this->dotEnv;
    }

    public static function checkIfVarEnvValueIsBoolean(string $value): array
    {
        $varValue = strtolower($value);

        return [
            'result' => ($varValue == 'true' || $varValue == 'false'),
            'value' => ($varValue === 'true'),
        ];
    }
}
