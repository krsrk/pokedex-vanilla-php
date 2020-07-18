<?php

use Utils\Request;
use Utils\Routing\Route;

$route = new Route(new Request($_SERVER['REQUEST_URI']));

$route->add('/', function () {
    echo '<h2>Hello Pokedex!</h2>';
});
