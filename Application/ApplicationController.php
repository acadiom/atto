<?php
namespace Application;

use Application\Helpers\LinkHelper;
use Atto\Config;
use Atto\Controller;
use Atto\Http\Message\Request;
use Atto\Http\Message\Response;
use Atto\Libraries\Router;
use Atto\Logger;
use Atto\Session\Handlers\File;
use Atto\Session\Session;

/**
 * ApplicationController class
 *
 * @package   Application
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
abstract class ApplicationController extends Controller
{
    /**
     * Session instance
     *
     * @var Session
     */
    protected $session;

    /**
     * Router instance
     *
     * @type Router
     */
    protected $router;

    /**
     * LinkHelper instance
     *
     * @var LinkHelper
     */
    protected $link;

    /**
     * Logger instance
     *
     * @var Logger
     */
    protected $logger;

    /**
     * ApplicationController constructor.
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response); 

        // Store the router instance
        $this->router = Config::getProperty(Router::class);

        // Session set up
        $this->session = new Session(new File(Config::getProperty('session.directory')));

        // Logger set up
        $this->logger = new Logger();

        // Link helper set up
        $this->data['link'] = new LinkHelper();
    }

    /**
     * Creates a new view and generate the page
     *
     * @param string $view
     * @param array $data
     *
     * @return Response
     */
    protected function view($view, array $data = []) : Response
    {
        $views = Config::getProperty('views.path');
        $cache = Config::getProperty('views.cache');

        $attoView = new ApplicationView($views, $cache);
        $contents = $attoView->render($view, array_merge($this->data, $data));

        $this->response->addHeader("HTTP/1.1 200 OK");
        $this->response->setBody($contents);

        return $this->response;
    }

}
