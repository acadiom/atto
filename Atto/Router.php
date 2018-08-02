<?php
namespace Atto;

/**
 * Class Router
 *
 * @package Atto
 *
 * @author Andrei Alexandru Romila
 * @version v1.0
 *
 * @method get(string $route, mixed $action, string $name = null)
 * @method post(string $route, mixed $action, string $name = null)
 */
class Router
{
    /**
     * Can be used to ignore leading part of the Request URL
     * (if main file lives in subdirectory of host)
     *
     * @var string
     */
    protected $basepath = "";

    /**
     * The route names that have been matched.
     *
     * @var array
     */
    protected $names = [];

    /**
     * All of the routes that have been registered.
     *
     * @var array
     */
    protected $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * The wildcard patterns supported by the router.
     *
     * @var array
     */
    protected $patterns = [
        '(:num)' => '([0-9]+)',
        '(:str)' => '([a-zA-Z]+)',
        '(:hex)' => '([a-fA-F0-9]+)',
        '(:slug)' => '([a-z0-9-]+)',
        '(:any)' => '([a-zA-Z0-9\.\-_]+)'
    ];

    /**
     * The optional wildcard patterns supported by the router.
     *
     * @var array
     */
    protected $optional = [
        '/(:num?)' => '(?:/([0-9]+)',
        '/(:str?)' => '(?:/([a-zA-Z]+)',
        '/(:hex?)' => '(?:/([a-fA-F0-9]+)',
        '/(:slug?)' => '(?:/([a-z0-9-]+)',
        '/(:any?)' => '(?:/([a-zA-Z0-9\.\-_]+)'
    ];

    /**
     * Router constructor
     *
     * @param string $basepath
     */
    public function __construct($basepath = '')
    {
        $this->basepath = $basepath;
    }

    /**
     * Magic method for get|post routes
     *
     * @param $method
     * @param $arguments
     *
     * @throws \Exception
     */
    public function __call($method, $arguments)
    {
        $this->register($method, ...$arguments);
    }

    /**
     * Register a route with the router.
     *
     * @param  string $method
     * @param  string $route
     * @param  mixed  $action
     * @param  string $name
     *
     * @return void
     *
     * @throws \Exception
     */
    public function register($method, $route, $action, $name = null)
    {
        $method = strtoupper($method);
        if (!isset($this->routes[$method])) {
            throw new \Exception("Invalid method '$method'.");
        }

        if ($name !== null) {
            if (isset($this->names[$name])) {
                throw new \Exception("Can not redeclare route '$name'.");
            }

            $this->names[$name] = $route;
        }

        $this->routes[$method][$route] = $action;
    }

    /**
     * Registers all routes from the $routes array
     *
     * @param array $routes
     * 
     * @return void
     * 
     * @throws \Exception
     */
    public function registerArray(array $routes)
    {
        foreach ($routes as list($method, $route, $action, $name)) {
            $this->register($method, $route, $action, $name);
        }
    }

    /**
     * Search the routes for the route matching a method and URI.
     *
     * @param  string $method
     * @param  string $uri
     *
     * @return array|false
     */
    public function match($method, $uri)
    {
        $routes = $this->routes[$method];

        // If the destination key exists in the routes array we can just return that
        if (array_key_exists($uri, $routes)) {
            return [
                'action' => $routes[$uri],
                'params' => []
            ];
        }

        foreach ($routes as $route => $action) {
            if (strpos($route, '(') !== false) {

                $pattern = '#^' . $this->regex($route) . '$#';
                if (preg_match($pattern, $uri, $parameters)) {

                    return [
                        'action' => $action,
                        'params' => array_slice($parameters, 1)
                    ];
                }
            }
        }

        return false;
    }

    /**
     * Translate route URI wildcards into actual regular expressions.
     *
     * @param  string $key
     *
     * @return string
     */
    protected function regex($key)
    {
        list($search, $replace) = $this->divide($this->optional);
        $key = str_replace($search, $replace, $key, $count);

        if ($count > 0) {
            $key .= str_repeat(')?', $count);
        }

        return strtr($key, $this->patterns);
    }

    /**
     * Divide an array into two arrays. One with keys and the other with values.
     *
     * @param $array
     *
     * @return array
     */
    protected function divide($array)
    {
        return [array_keys($array), array_values($array)];
    }

    /**
     * Generate a URL from a route name.
     *
     * @param $name
     * @param array $params
     *
     * @return string
     *
     * @throws \Exception
     */
    public function generate($name, $params = [])
    {
        // Check if named route exists
        if (!isset($this->names[$name])) {
            throw new \Exception("Error creating URL for undefined route '$name'.");
        }

        $route = $this->names[$name];
        $uri = $this->basepath . $route;

        return $this->transpose($uri, $params);
    }

    /**
     * Substitute the parameters in a given URI.
     *
     * @param  string $uri
     * @param  array $parameters
     *
     * @return string
     */
    protected function transpose($uri, $parameters)
    {
        foreach ($parameters as $parameter) {
            if (!is_null($parameter)) {
                $uri = preg_replace('/\(.+?\)/', $parameter, $uri, 1);
            }
        }

        // Remove any remaining optional place-holders
        return preg_replace('/\/\(.+?\)/', '', $uri);
    }
}
