<?php


namespace Utils\Routing;


use Utils\Request;

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
        $response = false;

        foreach ($this->routes as $route) {
            if ($this->checkIfRoutesMatch($route['uri'])) {
                $response = $route;
                break;
            }
        }

        return (is_array($response)) ? $this->sendResponse($response) : '404 - Route Not Found';
    }

    public function checkIfRoutesMatch($routeUri)
    {
        $uriPattern = $this->request->getUriPattern($routeUri);

        /**
         * @todo resolve URL params.
         */

        return $this->request->isRouteUrisMatch($uriPattern);
    }

    public function sendResponse($response)
    {
        return $this->execute($response['closure']);
    }

    public function execute($responseClosure)
    {
        $closure = $responseClosure;
        //$parameters = $this->getParameters();
        return call_user_func_array($closure, []);
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