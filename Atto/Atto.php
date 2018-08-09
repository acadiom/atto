<?php
namespace Atto;

use Atto\Http\Message\Request;
use Atto\Http\Message\Response;
use Atto\Http\Sender;
use Atto\Router;

/**
 * Atto core class
 *
 * @package   Atto
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
class Atto
{
	/**
	 * Request
	 * 
	 * @var Request
	 */
	protected $request;

	/**
	 * Response object
	 * 
	 * @var Response
	 */
	protected $response;

	/**
	 * Router
	 * 
	 * @var Router
	 */
	protected $router;

	/**
	 * Logger
	 *
	 * @var Logger
	 */
	protected $logger;

	/**
	 * Atto constructor
	 */
	public function __construct()
	{
		// Create and save a new router instance 
		$this->router = new Router(Config::getProperty('application.basepath'));
		Config::addProperty(Router::class, $this->router);

		// Create and save a new logger instance
		$this->logger = new Logger();
		Config::addProperty(Logger::class, $this->logger);
	}

	/**
	 * Main method that boots everything up
	 */
	public function run()
	{
		$this->request  = new Request(Config::getProperty('application.basepath'));
		$this->response = new Response();

		$method = $this->request->method();
		$uri    = $this->request->uri();
		$this->logger->debug("Trying to dispatch uri [$uri] on method [$method]");

		if (($match = $this->router->match($method, $uri)) === null) {
			// We must return an response
			$this->logger->error("Route not found $uri", 404);
			throw new \RuntimeException("404 Not found $uri", 404);
		}

		$closure = $match['action'];
		$params  = $match['params'];

		list($controller, $action) = explode('::', $closure);

		$object = new $controller($this->request, $this->response);
		$this->response = call_user_func_array([$object, $action], $params);

		// Send the response
		$this->sendResponse();
	}

	/**
	 * Creates a new Sender object and sends the response to the client
	 */
	protected function sendResponse()
	{
		$sender = new Sender($this->request, $this->response);
		$sender->send();
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
	public function registerRoutes(array $routes)
	{
		$this->router->registerArray($routes);
	}
}
