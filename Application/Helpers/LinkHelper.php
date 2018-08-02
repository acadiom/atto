<?php
namespace Application\Helpers;

use Atto\Config;
use Atto\Router;


class LinkHelper 
{
    /**
     * Basepath where the public folder is located
     *
     * @var string
     */
    private $basepath;

    /**
     * Router instance
     *
     * @var Router
     */
    private $router;

    /**
     * LinkHelper constructor
     */
    public function __construct()
    {
        $this->basepath = Config::getProperty('application.basepath');
        $this->router   = Config::getProperty(Router::class);
    }

    /**
     * Creates a resource link for the filename
     *
     * @param string $filename
     * 
     * @return string
     */
    public function resource($filename)
    {
        return $this->basepath . $filename;
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
    public function generate($name, array $args = []) 
    {
        return $this->router->generate($name, $args);
    }
}