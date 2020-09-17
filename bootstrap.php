<?php
/**
 * Welcome to the Pokedex Dev Project.
 */

(new \Utils\Exceptions\ExceptionHandler())->handle();

(new \Utils\Configuration\Env(__DIR__))->load();

require __DIR__ . '/routes/web.php';

(new \Utils\App())($route);

