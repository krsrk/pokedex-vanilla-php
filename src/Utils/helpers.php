<?php

use Utils\View\View;
use Utils\Configuration\Env;
use Utils\Request;
use Utils\Response;


if (! function_exists('view')) {
    function view(string $viewFile, array $opts = []): void
    {
        $template = new View();
        $template->render($viewFile, $opts);
    }
}

if (! function_exists('env_var')) {
    function env_var(string $varName, string $fallBackValue = '')
    {
        $envVarValue = $fallBackValue;

        if (! empty($_ENV[$varName])) {
           $checkIfValIsBool = Env::checkIfVarEnvValueIsBoolean($_ENV[$varName]);
           $envVarValue = ($checkIfValIsBool['result']) ? $checkIfValIsBool['value'] : $_ENV[$varName];
        }

        return $envVarValue;
    }
}

if (! function_exists('request')) {
    function request(): Request
    {
        return new Request();
    }
}

if (! function_exists('response')) {
    function response(mixed $closure = null): Response
    {
        return new Response($closure);
    }
}
