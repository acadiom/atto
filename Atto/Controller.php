<?php
namespace Atto;

use Atto\Http\Message\Request;
use Atto\Http\Message\Response;

/**
 * Controller class
 *
 * @package   Atto
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
abstract class Controller
{
    /**
     * Request object
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
     * Stores all data for the view
     *
     * @var array
     */
    protected $data = [];

    /**
     * View instance
     *
     * @var View
     */
    protected $view;

    /**
     * Controller constructor.
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Generates a ajax response
     *
     * @param mixed $object
     * @param string $header The response code header
     *
     * @return Response
     */
    protected function ajax($object, $header = "HTTP/1.1 200 OK"): Response
    {
        $this->response->addHeader($header);
        $this->response->addHeader('Content-type: application/json; charset=utf-8');
        $this->response->setBody(json_encode($object));

        return $this->response;
    }

    /**
     * Creates a new view and generate the page
     *
     * @param string $view
     * @param array $data
     *
     * @return Response
     */
    protected function view(string $view, array $data = []): Response
    {
        $views = Config::getProperty('views.path');
        $cache = Config::getProperty('views.cache');

        $attoView = new View($views, $cache);
        $contents = $attoView->render($view, array_merge($this->data, $data));

        $this->response->setBody($contents);

        return $this->response;
    }

    /**
     * Redirects the user to $url
     *
     * @param string $url
     *
     * @return Response
     */
    protected function redirect(string $url): Response
    {
        $this->response->addHeader($this->request->protocol() . ' 302 Found');
        $this->response->addHeader('Location: ' . $url);

        return $this->response;
    }

    /**
     * Debugging function
     *
     * @param mixed $data
     */
    protected function dd($data)
    {
        var_dump($data);
        die();
    }
}
