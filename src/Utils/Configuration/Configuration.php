<?php


namespace Utils\Configuration;


use Dotenv\Dotenv;

interface Configuration
{
    public function load(): void;

    public function getDotEnv(): Dotenv;
}
