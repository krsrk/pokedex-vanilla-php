<?php

$route = new \Utils\Routing\Route(request());

$route->add('/', 'PokemonController@index');
$route->add('/show', 'PokemonController@show');

$route->add('/str', 'Pikachu!!!');

$route->add('/arr', ['pokemon' => 'Charizard']);

//$route->add('/id/:id', 'PokemonController@index');

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
