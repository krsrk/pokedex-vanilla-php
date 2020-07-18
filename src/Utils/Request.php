<?php


namespace Utils;


class Request
{
    const PARAMETER_PATTERN = '/:([^\/]+)/';
    const PARAMETER_REPLACEMENT = '(?<\1>[^/]+)';

    protected $uri;
    protected $params;

    public function __construct(string $uri)
    {
        $this->setUri($uri);
    }

    public function isRouteUrisMatch(string $uriPattern)
    {
        return (preg_match($uriPattern, $this->getUri(), $matches));
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
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @param mixed $uri
     */
    public function setUri($uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @return mixed
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param mixed $params
     */
    public function setParams($params): void
    {
        $this->params = $params;
    }
}