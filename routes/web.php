<?php

$route = new \Utils\Routing\Route(new \Utils\Request($_SERVER['REQUEST_URI']));

$route->add('/id/:id', 'PokemonController@index');