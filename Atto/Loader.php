<?php
namespace Atto;

/**
 * PSR4 Loader
 *
 * @package   Atto
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
class Loader
{
    /**
     * PHP default file extension
     *
     * @var string
     */
    const PHP_EXTENSION = '.php';

    /**
     * Stores all namespaces and directories
     *
     * @var array
     */
    protected $prefixes = [];

    /**
     * Loader constructor
     *
     * @param boolean $register
     */
    public function __construct(bool $register = true)
    {
        if ($register === true) {
            spl_autoload_register([$this, 'loadClass'], false, true);
        }
    }

    /**
     * Registers a new namespace in the loader
     *
     * @param string $namespace The namespace
     * @param string $directory Path to the namespace
     * @param bool   $prepend
     *
     * @return void
     */
    public function registerNamespace(string $namespace, string $directory, bool $prepend = false)
    {
        if (is_dir($directory) === false || is_readable($directory) === false) {
            echo "The directory: [$directory] doesn't exist or is not readable!<br />";

            return;
        }

        $namespace = trim($namespace, '\\') . '\\';
        $directory = realpath($directory);
        $directory = str_replace('\\', '/', $directory) . '/';

        // If doesn't exist create a new array for the namespace.
        if (false === isset($this->prefixes[$namespace])) {

            $this->prefixes[$namespace] = [];

        } else if (in_array($directory, $this->prefixes[$namespace], true)) {

            // Already added ...
            return;
        }

        if ($prepend === true) {
            // Prepend this namespace
            $this->prefixes[$namespace] = array_unshift($this->prefixes[$namespace], $directory);
        } else {
            // A bit faster than array_push($array, $value1)
            $this->prefixes[$namespace][] = $directory;
        }

    }

    /**
     * PSR4 loadClass function.
     *
     * @param string $class
     *
     * @return string|null
     */
    protected function loadClass(string $class) : ?string
    {
        // the current namespace prefix
        $prefix = $class;

        // work backwards through the namespace names of the fully-qualified
        // class name to find a mapped file name
        while (false !== ($position = strrpos($prefix, '\\'))) {

            // retain the trailing namespace separator in the prefix
            $prefix = substr($class, 0, $position + 1);

            // the rest is the relative class name
            $relative = substr($class, $position + 1);

            // try to load a mapped file for the prefix and relative class
            $filename = $this->loadFile($prefix, $relative);
            if ($filename) {
                return $filename;
            }

            // remove the trailing namespace separator for the next iteration of string revers position
            $prefix = rtrim($prefix, '\\');
        }

        // never found a mapped file
        return null;

    }

    /**
     * If a file exists, require it.
     *
     * @param $filename
     *
     * @return bool True if the file exists, false if not.
     */
    protected function requireFile($filename)
    {

        if (is_readable($filename)) {
            require $filename;

            return true;
        }

        return false;
    }

    /**
     * Load the mapped file for a namespace prefix and relative class.
     *
     * @param string $prefix       The namespace prefix.
     * @param string $relativePath The relative class name.
     *
     * @return mixed Boolean false if no mapped file can be loaded, or the
     * name of the mapped file that was loaded.
     */
    protected function loadFile($prefix, $relativePath)
    {

        // are there any base directories for this namespace prefix?
        if (isset($this->prefixes[$prefix]) === false) {
            return false;
        }

        // look through base directories for this namespace prefix
        foreach ($this->prefixes[$prefix] as $directory) {

            $filename = $directory . str_replace('\\', '/', $relativePath) . self::PHP_EXTENSION;

            // if the mapped file exists, require it
            if ($this->requireFile($filename)) {
                return $filename;
            }
        }

        // never found it
        return false;
    }
}
