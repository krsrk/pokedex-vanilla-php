<?php
/**
 * Welcome to the Pokedex Dev Project.
 */

require __DIR__ . '/routes/web.php';

use Utils\App;

$app = new App();

$app->run($route);

