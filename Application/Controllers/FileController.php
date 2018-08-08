<?php
namespace Application\Controllers;

use Application\ApplicationController;
use Application\Helpers\FileParserHelper;
use Atto\Http\Message\Request;
use Atto\Http\Message\Response;
use Atto\Database;

class FileController extends ApplicationController
{
    /**
     * FileController constructor
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        parent::__construct($request, $response);
    }

    
    public function getQuery() 
    {
        $database = new Database();

        $fileParser = new FileParserHelper(DIRECTORY_ROOT_LOGS . "MULIDI_PAGHCE_Export.csv");
        $codes = $fileParser->parse();

        $query = "INSERT INTO i18n_codes(acronym, data_type, language, code, acronym_code, message) VALUES ";

        foreach ($codes as $code) {

            $query .= " ('";

            $query .= $code['acronym'] . '\', \'';
            $query .= $code['data_type'] . '\', \'';
            $query .= $code['language'] . '\', \'';
            $query .= $code['code'] . '\', \'';
            $query .= $code['acronym_code'] . '\', \'';
            $query .= $database->escape(trim($code['message'])) . '\'';

            $query .= "),";

        }

        $query  = substr($query, 0, -1);

        echo $query;

        die();
        // return $this->ajax($query);
    }
}
