<?php


namespace Utils;


use Utils\Routing\Route;

class App
{
    public function __invoke(Route $route)
    {
        return $route->run();
    }
}