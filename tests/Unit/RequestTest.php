<?php

test('it can create a request object', function (){
    $_SERVER['REQUEST_URI'] = '/';
    $request = new \Utils\Request();

    expect($request)->toBeObject();
});

test('it can get a uri pattern', function (){
    $_SERVER['REQUEST_URI'] = '/orders/products/1';
    $routeUri = '/orders/products/:id';
    $request = new \Utils\Request();
    $uriPattern = $request->getUriPattern($routeUri);

    expect($uriPattern)->toBeString();
});

test('it can match uri pattern', function (){
    $_SERVER['REQUEST_URI'] = '/orders/products/1';
    $routeUri = '/orders/products/:id';
    $request = new \Utils\Request();
    $uriPattern = $request->getUriPattern($routeUri);
    $isUriMatch = $request->isRouteUrisMatch($uriPattern);

    expect($isUriMatch)->toBeObject();
});

test('it can process params from uri', function (){
    $_SERVER['REQUEST_URI'] = '/orders/products/1?foo=baz';
    $routeUri = '/orders/products/:id';
    $request = new \Utils\Request();
    $uriPattern = $request->getUriPattern($routeUri);
    $isUriMatch = $request->isRouteUrisMatch($uriPattern);
    $request->processParams($isUriMatch->matches, $routeUri);

    expect($request->getParams())->toBeArray();
});