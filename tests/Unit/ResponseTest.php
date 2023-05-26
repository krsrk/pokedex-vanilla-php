<?php

test('it can create a response object', function (){
    $response = new \Utils\Response\Response();

    expect($response)->toBeObject();
});

test('it can create a response object with closure', function (){
    $response = new \Utils\Response\Response('Hello World');

    expect($response)->toBeObject();
});

test('it can create a response object with string closure', function (){
    $response = new \Utils\Response\Response('Hello World');
    $closure = $response->getClosure();

    expect($closure['closure_type'])->toBe(\Utils\ValueObjects\ClosureTypes::CLOSURE_STRING->value);
});

test('it can create a response object with array closure', function (){
    $response = new \Utils\Response\Response(['pokemon' => 'Bulbasaur']);
    $closure = $response->getClosure();

    expect($closure['closure_type'])->toBe(\Utils\ValueObjects\ClosureTypes::CLOSURE_ARRAY->value);
});

test('it can create a response object with function closure', function (){
    $response = new \Utils\Response\Response(fn() => 'Hello World');
    $closure = $response->getClosure();

    expect($closure['closure_type'])->toBe(\Utils\ValueObjects\ClosureTypes::CLOSURE_FUNCTION->value);
});

test('it can create a response object with controller closure', function (){
    $response = new \Utils\Response\Response('PokemonController@test');
    $closure = $response->getClosure();

    expect($closure['closure_type'])->toBe(\Utils\ValueObjects\ClosureTypes::CLOSURE_CONTROLLER->value);
});

test('it expects "unknown" if there is an unknown closure', function (){
    $response = new \Utils\Response\Response(1);
    $closure = $response->getClosure();

    expect($closure['closure_type'])->toBe('unknown');
});

test('it can send a string response', function (){
    $_SERVER['REQUEST_URI'] = '/orders/products/1';
    $response = new \Utils\Response\Response('Hello World');
    $response->send(request());
})->expectNotToPerformAssertions();

test('it can send an array response', function (){
    $_SERVER['REQUEST_URI'] = '/orders/products/1';
    $response = new \Utils\Response\Response(['message' => 'Hello World']);
    $response->send(request());
})->expectNotToPerformAssertions();

test('it can send a closure function response', function (){
    $_SERVER['REQUEST_URI'] = '/orders/products/1';
    $response = new \Utils\Response\Response(fn() => 'Hello World');
    $response->send(request());
})->expectNotToPerformAssertions();

test('it can send a closure controller response', function (){
    $_SERVER['REQUEST_URI'] = '/orders/products/1';
    $response = new \Utils\Response\Response('PokemonController@test');
    $response->send(request());
})->expectNotToPerformAssertions();