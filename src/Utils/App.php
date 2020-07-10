<?php


namespace Utils;


use Utils\Routing\Route;

class App
{
    public function __construct()
    {
        
    }

    public function run(Route $route)
    {
        return $route->run();
    }
}