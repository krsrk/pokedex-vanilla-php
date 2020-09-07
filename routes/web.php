<?php

$route = new \Utils\Routing\Route(new \Utils\Request($_SERVER['REQUEST_URI']));

$route->add('/', function () {
    echo '<h1>Hello Pokedex!</h1>';
});

$route->add('/str', 'Pikachu!!!');

$route->add('/arr', ['pokemon' => 'Charizard']);

$route->add('/id/:id', 'PokemonController@index');