<?php
namespace Atto\Blade;

use Atto\Blade\Engines\Engine;

class View {

    /**
     * The view factory instance.
     *
     * @var Factory
     */
    protected $factory;

    /**
     * The engine implementation.
     *
     * @var Engine
     */
    protected $engine;

    /**
     * The name of the view.
     *
     * @var string
     */
    protected $view;

    /**
     * The array of view data.
     *
     * @var array
     */
    protected $data;

    /**
     * The path to the view file.
     *
     * @var string
     */
    protected $path;

    /**
     * Create a new view instance.
     *
     * @param  Factory $factory
     * @param  Engine  $engine
     * @param  string  $view
     * @param  string  $path
     * @param  array   $data
     */
    public function __construct(Factory $factory, Engine $engine, $view, $path, $data = []) {
        $this->view    = $view;
        $this->path    = $path;
        $this->engine  = $engine;
        $this->factory = $factory;

        $this->data = (array) $data;
    }

    /**
     * Get the string contents of the view.
     *
     * @return string
     */
    public function render() {
        $contents = $this->renderContents();

        // Once we have the contents of the view, we will flush the sections if we are
        // done rendering all Views so that there is nothing left hanging over when
        // another view gets rendered in the future by the Application developer.
        if ($this->factory->doneRendering()) {
        	$this->factory->flushSections();
        }

        return $contents;
    }

    /**
     * Get the contents of the view instance.
     *
     * @return string
     */
    protected function renderContents() {
        // We will keep track of the amount of Views being rendered so we can flush
        // the section after the complete rendering operation is done. This will
        // clear out the sections for any separate Views that may be rendered.
        $this->factory->incrementRender();

        $contents = $this->getContents();

        // Once we've finished rendering the view, we'll decrement the render count
        // so that each sections get flushed out next time a view is created and
        // no old sections are staying around in the memory of an environment.
        $this->factory->decrementRender();

        return $contents;
    }

    /**
     * Get the evaluated contents of the view.
     *
     * @return string
     */
    protected function getContents() {
    	$data = array_merge($this->factory->getShared(), $this->data);
    	
        return $this->engine->get($this->path, $data);
    }

    /**
     * Get the string contents of the view.
     *
     * @return string
     */
    public function __toString() {
        return $this->render();
    }
}
