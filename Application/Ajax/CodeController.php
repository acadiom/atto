<?php
namespace Application\Ajax;

use Application\ApplicationController;
use Application\Helpers\FileParserHelper;
use Application\Models\I18nCode;
use Atto\Http\Message\Request;
use Atto\Http\Message\Response;

class CodeController extends ApplicationController 
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
     * Search ajax 
     *
     * @return void
     */
    public function search()
    {
        $code = $_POST['code'];
        $i18nCodes = I18nCode::search($code);

        return $this->ajax($i18nCodes);
    }










    /**
     * Parses the file and returns the json
     *
     * @return void
     */
    public function getFile()
    {
        $fileParser = new FileParserHelper(DIRECTORY_ROOT_LOGS . "Codigos_Error_TARSAN_Pre.csv");

        // Return parsed file
        return $this->ajax($fileParser->parse());
    }

    public function getQuery() 
    {
        $fileParser = new FileParserHelper(DIRECTORY_ROOT_LOGS . "Codigos_Error_TARSAN_Pre.csv");
        $codes = $fileParser->parse();

        $query = "INSERT INTO i18n_codes(acronym, data_type, language, code, acronym_code, message) VALUES ";

        foreach ($codes as $code) {

            $query .= " ('";

            $query .= $code['acronym'] . '\', \'';
            $query .= $code['data_type'] . '\', \'';
            $query .= $code['language'] . '\', \'';
            $query .= $code['code'] . '\', \'';
            $query .= $code['acronym_code'] . '\', \'';
            $query .= $code['message'] . '\'';

            $query .= "),";

        }

        $query  = substr($query, 0, -1);

        return $this->ajax($query);
    }
}
