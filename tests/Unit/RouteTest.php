<?php

test('it can create a route object', function (){
    $_SERVER['REQUEST_URI'] = '/';
    $route = new \Utils\Routing\Route(request());

    expect($route)->toBeObject();
});

test('it can create a route', function (){
    $_SERVER['REQUEST_URI'] = '/';
    $route = new \Utils\Routing\Route(request());
    $route->add('/orders/:id', 'Hello World');

    expect($route->getRoutes()[0])->toHaveKeys(['uri', 'closure']);
});

test('it can bootstrap a routes', function (){
    $_SERVER['REQUEST_URI'] = '/orders';
    $route = new \Utils\Routing\Route(request());
    $route->add('/orders',  fn() => response()->json(['Charmander']));

    $route->run();
})->expectNotToPerformAssertions();
