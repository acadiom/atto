<?php
namespace Application\Controllers;

use Application\ApplicationController;
use Atto\Http\Message\Request;
use Atto\Http\Message\Response;


class UserController extends ApplicationController
{
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);
    }
}