<?php
namespace Application\Controllers;

use Application\ApplicationController;
use Atto\Http\Message\Request;
use Atto\Http\Message\Response;


class RepositoryController extends ApplicationController
{
    /**
     * RepositoryController constructor
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);
    }

    /**
     * Lists all codes
     *
     * @return Response
     */
    public function list()
    {
        $codeList = [];

        return $this->view('repository.list', compact('codeList'));
    }
}
