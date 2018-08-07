<?php
namespace Application\Controllers;

use Application\ApplicationController;
use Application\Models\I18nCode;
use Atto\Http\Message\Request;
use Atto\Http\Message\Response;

class HomeController extends ApplicationController
{
    /**
     * HomeController constructor
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);
    }

    /**
     * First page and index to the application
     *
     * @return Response
     */
    public function index()
    {
        $model     = new I18nCode();
        $languages = $model->getLanguages();
        $acronyms  = $model->getAcronyms();

        // Create a new View
        return $this->view('home.index', compact('languages', 'acronyms'));
    }
}
