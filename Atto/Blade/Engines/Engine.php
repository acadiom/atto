<?php
namespace Atto\Blade\Engines;

use Atto\Blade\Compilers\Compiler;

class Engine
{
    /**
     * The Blade compiler instance.
     *
     * @var Compiler
     */
    protected $compiler;

    /**
     * A stack of the last Cache templates.
     *
     * @var array
     */
    protected $lastCompiled = [];

    /**
     * Create a new Blade view engine instance.
     *
     * @param Compiler $compiler
     */
    public function __construct(Compiler $compiler)
    {
        $this->compiler = $compiler;
    }

    /**
     * Get the evaluated contents of the view at the given path.
     *
     * @param  string $__path
     * @param  array  $__data
     *
     * @return string
     */
    protected function evaluatePath($__path, $__data)
    {
        $obLevel = ob_get_level();
        ob_start();
        extract($__data);

        // We'll evaluate the contents of the view inside a try/catch block so we can
        // flush out any stray output that might get out before an error occurs or
        // an exception is thrown. This prevents any partial Views from leaking.
        try {
            include $__path;
        } catch (\Exception $e) {
            $this->handleViewException($e, $obLevel);
        }

        return ltrim(ob_get_clean());
    }

    /**
     * Get the evaluated contents of the view.
     *
     * @param  string $path
     * @param  array  $data
     *
     * @return string
     */
    public function get($path, array $data = [])
    {
        $this->lastCompiled[] = $path;

        // If this given view has expired, which means it has simply been edited since
        // it was last Cache, we will re-compile the Views so we can evaluate a
        // fresh copy of the view. We'll pass the compiler the path of the view.
        if ($this->compiler->isExpired($path)) {
            $this->compiler->compile($path);
        }

        $compiled = $this->compiler->getCompiledPath($path);

        // Once we have the path to the Cache file, we will evaluate the paths with
        // typical PHP just like any other templates. We also keep a stack of Views
        // which have been rendered for right exception messages to be generated.
        $results = $this->evaluatePath($compiled, $data);

        array_pop($this->lastCompiled);

        return $results;
    }

    /**
     * Get the compiler implementation.
     *
     * @return Compiler
     */
    public function getCompiler()
    {
        return $this->compiler;
    }

    /**
     * Handle a view exception.
     *
     * @param  \Exception $e
     * @param  int        $obLevel
     *
     * @return void
     *
     * @throws $e
     */
    protected function handleViewException(\Exception $e, $obLevel)
    {
        $e = new \ErrorException($this->getMessage($e), 0, 1, $e->getFile(), $e->getLine(), $e);

        while (ob_get_level() > $obLevel) {
            ob_end_clean();
        }

        throw $e;
    }

    /**
     * Get the exception message for an exception.
     *
     * @param  \Exception $e
     *
     * @return string
     */
    protected function getMessage(\Exception $e)
    {
        return $e->getMessage() . ' (View: ' . realpath(end($this->lastCompiled)) . ')';
    }
}
