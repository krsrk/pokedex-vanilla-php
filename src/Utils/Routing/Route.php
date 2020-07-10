<?php


namespace Utils\Routing;


class Route
{
    const PARAMETER_PATTERN = '/:([^\/]+)/';
    const PARAMETER_REPLACEMENT = '(?<\1>[^/]+)';

    protected $requestUri;
    protected $routes = [];

    public function __construct()
    {
        $this->setRequestUri($_SERVER['REQUEST_URI']);
    }

    public function add(string $uriString, $closure)
    {
        array_push($this->routes, [
            'uri' => $uriString,
            'closure' => $closure
        ]);
    }

    public function run()
    {
        $response = false;
        $requestUri = $this->getRequestUri();

        foreach ($this->routes as $route)
        {
            if ($this->checkIfRoutesMatch($requestUri, $route['uri']))
            {
                $response = $route;
                break;
            }
        }

        /**
         * @todo Process the Response. Execture the closure.
         */

        return (is_array($response)) ? $response : '404 - Route Not Found';
    }

    public function checkIfRoutesMatch($requestUri, $routeUri)
    {
        $uriPattern = $this->getUriPattern($routeUri);

        /**
         * @todo resolve URL params.
         */

        return (preg_match($uriPattern, $requestUri, $matches));
    }

    public function getUriPattern(string $routeUri)
    {
        $uriPattern = preg_replace(self::PARAMETER_PATTERN, self::PARAMETER_REPLACEMENT, $routeUri);
        $uriPattern = str_replace('/', '\/', $uriPattern);
        $uriPattern = '/^' . $uriPattern . '\/*$/s';

        return $uriPattern;
    }

    /**
     * @return mixed
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * @param mixed $uri
     */
    public function setRequestUri($uri): void
    {
        $this->requestUri = $uri;
    }
}