<?php
namespace Atto;

/**
 * Configuration class
 *
 * @package   Atto
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
class Config
{

    /**
     * All configurations properties
     *
     * @var array
     */
    protected static $config;

    /**
     * Sets or adds a new configuration key / value pair to the container
     *
     * @param string $key
     * @param mixed $value
     */
    public static function addProperty($key, $value)
    {
        static::$config[$key] = $value;
    }

    /**
     * Returns the value for the given key
     *
     * @param string $key
     *
     * @return mixed|NULL
     */
    public static function getProperty($key)
    {
        if (isset(static::$config[$key])) {
            return static::$config[$key];
        }

        return null;
    }

    /**
     * Removes a key property from the configuration container
     *
     * @param string $key
     *
     * @return boolean
     */
    public static function removeProperty($key)
    {
        if (isset(static::$config[$key])) {
            unset(static::$config[$key]);

            return true;
        }

        return false;
    }

    /**
     * Adds all properties to the configuration container
     *
     * @param array $properties
     *
     * @throws \InvalidArgumentException
     */
    public static function addProperties($properties)
    {
        if (!is_array($properties)) {
            throw new \InvalidArgumentException('Expected type was array, [' . gettype($properties) . '] given.');
        }

        foreach ($properties as $key => $value) {
            static::addProperty($key, $value);
        }
    }

    /**
     * Returns all configuration array
     *
     * @return array
     */
    public static function getConfiguration()
    {
        return static::$config;
    }
}
