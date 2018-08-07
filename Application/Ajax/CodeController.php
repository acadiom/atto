<?php
namespace Application\Ajax;

use Application\ApplicationController;
use Atto\Http\Message\Request;
use Atto\Http\Message\Response;
use Application\Models\I18nCode;
use Application\Helpers\FileParserHelper;

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
     * Undocumented function
     *
     * @return void
     */
    public function index()
    {
        $model    = new I18nCode();
        
        $codeList = $model->search();

        // Create pagination data


        return $this->ajax($codeList);
    }

<<<<<<< HEAD:Application/Ajax/CodeController.php
    /**
     * Searches a code in the database
     *
     * @param string $acronym
     * @param string $code
     * @param integer $limit
     * @param integer $offset
     * 
     * @return array 
     */
    public function search($acronym, $code, $limit = 10, $offset = 0)
    {
        // 
=======
    public function languages()
    {
        $model     = new I18nCode();
        $languages = $model->getLanguages();

        // Create pagination data
        return $this->ajax($languages);
    }

    public function acronyms()
    {
        $model    = new I18nCode();
        $acronyms = $model->getAcronyms();

        // Create pagination data
        return $this->ajax($acronyms);
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
>>>>>>> d7c2ae97a7f35504f2811638db551feb93763c8f:Application/Ajax/CodesController.php
    }
}
