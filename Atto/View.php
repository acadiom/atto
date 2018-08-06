<?php
namespace Atto;

use Atto\Blade\Compilers\Compiler;
use Atto\Blade\Engines\Engine;
use Atto\Blade\Factory;

/**
 * View class
 *
 * @package   Atto
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
class View
{
    /**
     * Views folder
     *
     * @var string
     */
    protected $views;

    /**
     * Cache folder
     *
     * @var string
     */
    protected $cache;

    /**
     * View constructor.
     *
     * @param string $views
     * @param string $cache
     */
    public function __construct($views, $cache)
    {
        $this->views = $views;
        $this->cache = $cache;
    }

    /**
     * Get the string contents of the view.
     *
     * @param string $view Full path to the view
     * @param array  $data Data needed inside the view
     *
     * @return string
     */
    public function render($view, $data)
    {
        $engine  = new Engine(new Compiler($this->cache));
        $factory = new Factory($engine, $this->views);

        return $factory->make($view, $data)->render();
    }

}
