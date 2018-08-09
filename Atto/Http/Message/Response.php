<?php
namespace Atto\Http\Message;

/**
 * Class Response
 *
 * @package   Atto
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
class Response
{
    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var string
     */
    protected $body;

    /**
     * @var int
     */
    protected $bodySize = 0;

    /**
     * Response constructor.
     */
    public function __construct()
    {
        $this->setBody();
    }

    /**
     * @param $header
     */
    public function addHeader($header)
    {
        $this->headers[] = $header;
    }

    /**
     * @param $body
     */
    public function setBody($body = null)
    {
        $this->body = $body;
        $this->bodySize = $this->body == null ? 0 : strlen($this->body);
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Returns the body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Returns the size of the body
     */
    public function getBodySize()
    {
        return $this->bodySize;
    }
}
