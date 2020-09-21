<?php

$route = new \Utils\Routing\Route(new \Utils\Request($_SERVER['REQUEST_URI']));

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
    $request = new \Utils\Request();
    echo ($request->isMethod('post')) ? 'Metodo: POST <br>' : 'Metodo: ANY OTHER METHOD <br>';
    $params = $request->getUrlParams();
    echo (count($params)) ? 'Has Params!' : 'No Params!';
    echo '<br>';
    var_dump($request->getHeaders()['Authorization']);
    echo '<br>';
    var_dump(request()->getUrlParams());
});
