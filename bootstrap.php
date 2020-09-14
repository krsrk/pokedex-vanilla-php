<?php
/**
 * Welcome to the Pokedex Dev Project.
 */

(new \Utils\Exceptions\ExceptionHandler())->handle();

require __DIR__ . '/routes/web.php';

(new \Utils\App())($route);

