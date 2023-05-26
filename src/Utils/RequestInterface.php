<?php

namespace Utils;

interface RequestInterface
{
    public function getParams(): array;

    public function getUri(): string;

    public function isRouteUrisMatch(string $uriPattern): object;

    public function getUriPattern(string $routeUri): string;

    public function processParams($uriMatches, $routeUri): void;

    public function isMethod(string $method): bool;

    public function getUrlParams($castParamsToObject = false): mixed;

    public function getHeaders(): mixed;
}