<?php
namespace Application\Ajax;

use Application\ApplicationController;
use Atto\Http\Message\Request;
use Atto\Http\Message\Response;

class CodesController extends ApplicationController 
{
    /**
     * CodesController constructor
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function list()
    {
        $codeList = [
            ['acronym' => 'TARSAN', 'code' => '102001', 'language' => ' es-ES', 'description' => 'Some description here']
        ];

        return $this->ajax($codeList);
    }
}
