<?php


namespace Utils\Routing;


use Utils\Request;
use Utils\Response;

class Route
{
    protected $routes = [];
    protected $request;

    public function __construct(Request $request)
    {
        $this->setRequest($request);
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

        (new Response($response['closure']))->send($this->request);
    }

    public function checkIfRoutesMatch($routeUri)
    {
        $isRoutesMatch = false;
        $uriPattern = $this->request->getUriPattern($routeUri);
        $routeAndUriMatch = $this->request->isRouteUrisMatch($uriPattern);

        if ($routeAndUriMatch->result) {
            $this->request->processParams($routeAndUriMatch->matches);
            $isRoutesMatch = true;
        }

        return $isRoutesMatch;
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

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request): void
    {
        $this->request = $request;
    }
}