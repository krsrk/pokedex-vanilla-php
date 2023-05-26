<?php

namespace Utils\Routing;

use Utils\Request;

interface RouteInterface
{
    public function getRoutes(): array;

    public function getRequest(): Request;

    public function setRequest($request): void;

    public function add(string $uriString, mixed $closure): void;

    public function run(): void;

    public function checkIfRoutesMatch($routeUri): bool;


}