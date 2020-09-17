<?php

use Utils\View\View;
use Utils\Configuration\Env;


if (! function_exists('view')) {
    function view(string $viewFile, array $opts = [])
    {
        $template = new View();
        $template->render($viewFile, $opts);
    }
}

if (! function_exists('env_var')) {
    function env_var(string $varName, $fallBackValue = '')
    {
        $envVarValue = $fallBackValue;

        if (! empty($_ENV[$varName])) {
           $checkIfValIsBool = Env::checkIfVarEnvValueIsBoolean($_ENV[$varName]);
           $envVarValue = ($checkIfValIsBool['result']) ? $checkIfValIsBool['value'] : $_ENV[$varName];
        }

        return $envVarValue;
    }
}
