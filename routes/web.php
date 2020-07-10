<?php

use Utils\Routing\Route;

$route = new Route();

$route->add('/', function () {
    echo 'Hello Pokedex!';
});
