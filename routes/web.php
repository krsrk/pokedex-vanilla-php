<?php

$route = new \Utils\Routing\Route(request());

$route->add('/', function () {
    //echo '<h1>Hello Pokedex!</h1><br>';

    //$template = new Utils\View\View();
    //$template->render('pokedex.html');

    view('pokedex.html', ['pokemonName' => 'Balbusaur']);
});

$route->add('/str', 'Pikachu!!!');

$route->add('/arr', ['pokemon' => 'Charizard']);

$route->add('/id/:id', 'PokemonController@index');

$route->add('/api', function () {
    /*$data = [
        ['codigo' => '001', 'pokemon' => 'Bulbasaur'],
        ['codigo' => '002', 'pokemon' => 'Ivysaur'],
        ['codigo' => '003', 'pokemon' => 'Venusaur'],
        ['codigo' => '004', 'pokemon' => 'Charmander'],
        ['codigo' => '005', 'pokemon' => 'Charmeleon'],
    ];*/

    $data = \App\Models\Pokemon::all()->toArray();

    response()->json($data, 201);
});
