<?php

$route = new \Utils\Routing\Route(new \Utils\Request($_SERVER['REQUEST_URI']));

$route->add('/', function () {
    //echo '<h1>Hello Pokedex!</h1><br>';

    //$template = new Utils\View\View();
    //$template->render('pokedex.html');

    view('pokedex.html');
});

$route->add('/str', 'Pikachu!!!');

$route->add('/arr', ['pokemon' => 'Charizard']);

$route->add('/id/:id', 'PokemonController@index');