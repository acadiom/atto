<?php
namespace Atto\Http\Message;

/**
 * Request class
 *
 * @package   Atto
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
class Request
{

    /**
     * The base path
     *
     * @var string
     */
    protected $basepath;

    /**
     * @var array
     */
    protected $acceptableEncodings;

    /**
     * Requet constructor.
     */
    public function __construct($basepath = '/')
    {
        if ($basepath === null) {
            throw new RuntimeException("The basepath is not valid.", 10001);
        }

        $this->basepath = $basepath;
    }

    /**
     * Returns the requested path relative to the script name.
     *
     * http://www.atto.dev/index.php returns ""
     * http://www.atto.dev/index.php/controller/action returns "controller/action"
     * http://www.atto.dev/directory/index.php/controller returns "controller"
     * http://www.atto.dev/directory/controller/?query=string returns "controller"
     *
     * @return string The requested uri
     */
    public function uri()
    {
        // Set Request Url if it isn't passed as parameter
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Strip base path from request url
        $uri = substr($uri, strlen($this->basepath));

        // Remove any slashes from the uri
        return trim($uri, '/');;
    }

    /**
     * Returns the absolute path to the script file.
     *
     * http://www.atto.dev/index.php returns "/"
     * http://www.atto.dev/directory/index.php returns "/directory/"
     *
     * @returns string Base path
     */
    public function basepath()
    {
        return $this->basepath;
    }

    /**
     * Returns the request method
     *
     * @return mixed
     */
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Returns the protocol used by the client browser
     *
     * @return mixed
     */
    public function protocol()
    {
        return $_SERVER['SERVER_PROTOCOL'];
    }

    /**
     * Indicates if the user browser accepts the specified encoding
     *
     * @param $encoding string The encoding (gzip, deflate, etc...)
     *
     * @return bool
     */
    public function acceptEncoding($encoding)
    {
        if (!isset($_SERVER['HTTP_ACCEPT_ENCODING'])) {
            return false;
        }

        return strpos($_SERVER['HTTP_ACCEPT_ENCODING'], $encoding) === false ? false : true;
    }

    /**
     * Returns the client IP address
     *
     * @return mixed
     */
    public function ipAddress()
    {
        $client = isset($_SERVER['HTTP_CLIENT_IP']) ? $_SERVER['HTTP_CLIENT_IP'] : null;
        $forward = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : null;
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }
}
