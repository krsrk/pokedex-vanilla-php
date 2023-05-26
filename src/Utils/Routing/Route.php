<?php


namespace Utils\Routing;


use Utils\Request;

class Route implements RouteInterface
{
    protected $routes = [];
    protected $request;

    public function __construct(Request $request)
    {
        $this->setRequest($request);
    }

    public function add(string $uriString, mixed $closure): void
    {
        $this->routes[] = [
            'uri' => $uriString,
            'closure' => $closure
        ];
    }

    public function run(): void
    {
        $response = [
            'uri' => '',
            'closure' => false,
        ];

        foreach ($this->routes as $route) {
            if ($this->checkIfRoutesMatch($route['uri'])) {
                $response = $route;
                break;
            }
        }

        response($response['closure'])->send($this->request);
    }

    public function checkIfRoutesMatch($routeUri): bool
    {
        $isRoutesMatch = false;
        $uriPattern = $this->request->getUriPattern($routeUri);
        $routeAndUriMatch = $this->request->isRouteUrisMatch($uriPattern);

        if ($routeAndUriMatch->result) {
            $this->request->processParams($routeAndUriMatch->matches, $routeUri);
            $isRoutesMatch = true;
        }

        return $isRoutesMatch;
    }

    /**
     * @return mixed
     * @deprecated
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * @param mixed $uri
     * @deprecated
     */
    public function setRequestUri($uri): void
    {
        $this->requestUri = $uri;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function setRequest($request): void
    {
        $this->request = $request;
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}