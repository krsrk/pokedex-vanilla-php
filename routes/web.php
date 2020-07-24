<?php

$route = new \Utils\Routing\Route(new \Utils\Request($_SERVER['REQUEST_URI']));

$route->add('/', function () {
    echo '<h2>Hello Pokedex!</h2>';
});