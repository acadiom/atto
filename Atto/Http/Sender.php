<?php
namespace Atto\Http;

use Atto\Http\Message\Request;
use Atto\Http\Message\Response;

/**
 * Class Sender
 *
 * @package   Atto
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
class Sender
{
    /**
     * Request object
     *
     * @var Request
     */
    protected $request;

    /**
     * The response
     *
     * @var Response
     */
    protected $response;

    /**
     * Sender constructor.
     *
     * @param Request  $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Sends the response to the user
     */
    public function send()
    {
        // Send all headers, in case of redirection we also need to send the headers
        $this->sendHeaders();

        // If there is a body, send it
        if ($this->response->getBodySize() > 0) {

            // Turn on output buffering
            ob_start();

            // Echo the body
            echo $this->response->getBody();

            // Flush (send) the output buffer and turn off output buffering
            ob_end_flush();
        }
    }

    /**
     * Send all response headers to the user
     */
    protected function sendHeaders()
    {
        foreach ($this->response->getHeaders() as $header) {
            header($header);
        }
    }
}
