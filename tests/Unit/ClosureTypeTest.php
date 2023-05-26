<?php

test('it can create a closure type object', function (){
    $closureType = \Utils\Response\ClosureTypes\ClosureType::from('string', 'Hello World');

    expect($closureType)->toBeObject();
});

test('it fails to execute a unknown closure', function (){
    $closureType = \Utils\Response\ClosureTypes\ClosureType::from('str', 'Hello World');
    $closureType->execute();

    expect($closureType)->toBeObject();
})->throws(Error::class);

test('it can execute a closure', function (){
    $closureType = \Utils\Response\ClosureTypes\ClosureType::from('string', 'Hello World');
    $closureType->execute();
})->expectNotToPerformAssertions();

test('it can execute an array closure', function (){
    $closureType = \Utils\Response\ClosureTypes\ClosureType::from('array', ['pokemon' => 'Bulbasaur']);
    $closureType->execute();
})->expectNotToPerformAssertions();

test('it can execute a function closure', function (){
    $closureType = \Utils\Response\ClosureTypes\ClosureType::from('function', function () {
        echo 'Hello World';
    });
    $closureType->execute();
})->expectNotToPerformAssertions();

test('it can execute a controller closure', function (){
    $controllerNamespace = '\App\Controllers\PokemonController';
    $controller = new $controllerNamespace;
    $controllerMethod = 'test';
    $controllerInfo = [
        'class_instance' => $controller,
        'method' => $controllerMethod,
    ];
    $closureType = \Utils\Response\ClosureTypes\ClosureType::from('controller', $controllerInfo);
    $closureType->execute();
})->expectNotToPerformAssertions();