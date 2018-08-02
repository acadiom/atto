<?php
namespace Application\Controllers;

use Atto\Http\Message\Request;
use Atto\Http\Message\Response;
use Application\ApplicationController;


class HomeController extends ApplicationController
{
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);
    }

    public function index()
    {
        return $this->view('home.index');
    }
}