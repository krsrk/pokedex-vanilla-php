<?php


namespace Utils;


class Request implements RequestInterface
{
    const PARAMETER_PATTERN = '/:([^\/]+)/';
    const PARAMETER_REPLACEMENT = '(?<\1>[^/]+)';

    protected string $uri = '';
    protected array $params = [];

    public function __construct()
    {
        $this->_setUri();
    }

    public function isRouteUrisMatch(string $uriPattern): object
    {
        $uri = explode('?', $this->getUri())[0];
        return (object)[
            'result' => (preg_match($uriPattern, $uri, $matches)),
            'matches' => $matches,
        ];
    }

    public function getUriPattern(string $routeUri): string
    {
        $uriPattern = preg_replace(self::PARAMETER_PATTERN, self::PARAMETER_REPLACEMENT, $routeUri);
        $uriPattern = str_replace('/', '\/', $uriPattern);

        return '/^' . $uriPattern . '\/*$/s';
    }

    public function processParams($uriMatches, $routeUri): void
    {
        preg_match_all(self::PARAMETER_PATTERN, $routeUri, $parameterNames);
        $paramNames = array_flip($parameterNames[1]);
        $this->_setParams(array_intersect_key($uriMatches, $paramNames));
    }

    public function isMethod(string $method): bool
    {
        return (strtoupper($method) == $_SERVER['REQUEST_METHOD']);
    }

    public function getUrlParams($castParamsToObject = false): mixed
    {
        return ($castParamsToObject) ? (object) $_REQUEST : $_REQUEST;
    }

    public function getHeaders(): mixed
    {
        return getallheaders();
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    private function _setParams(mixed $params): void
    {
        $this->params = $params;
    }

    private function _setUri(): void
    {
        $this->uri = $_SERVER['REQUEST_URI'];
    }
}
