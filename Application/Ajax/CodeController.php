<?php
namespace Application\Ajax;

use Application\ApplicationController;
use Application\Helpers\FileParserHelper;
use Application\Models\I18nCode;
use Atto\Http\Message\Request;
use Atto\Http\Message\Response;
use Atto\Config;
use Atto\Cache\Cache;
use Atto\Cache\Storage\FileStorage;
use Atto\Validator;

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
     * Clears the current cache storage
     *
     * @return void
     */
    public function clearCache()
    {
        // Create the cache object and cleare storage
        $cache = new Cache(new FileStorage());
        $cache->clear();

        // Log activity
        $this->logger->debug("Cache cleared successfully.");

        return $this->ajax(true);
    }

    /**
     * Search ajax 
     *
     * @return void
     */
    public function search()
    {
        $this->logger->debug("Ajax call recieved.");

        $offset = ! isset($_POST['offset']) || $_POST['offset'] == '' ? 0 : $_POST['offset'];
        $limit = Config::getProperty('application.pagination.limit');

        try {

            $code = $_POST['code'];
            $this->logger->debug("Searching for codes with code [$code], offset [$offset] and limit [$limit].");

            // Create a cache key
            $key = sha1($code . $limit . $offset);
            // Cache instance
            $cache = new Cache(new FileStorage());

            // Lets search in cache for the current key / page
            if (($i18nCodes = $cache->get($key)) === null) {
                // Log cache entry not found
                $this->logger->debug("Cache entry not found for key [$key].");

                // Search again
                $i18nCodes = I18nCode::search($code, $limit, $offset);

                // Store the results in cache
                $cache->store($key, $i18nCodes); 

                // Log cache stored
                $this->logger->debug("Cache entry stored successfully with key [$key].");
            } else {
                // Log cache entry found
                $this->logger->debug("Cache entry found with key [$key], returning cached data.");
            }

            return $this->ajax($i18nCodes);

        } catch (\Exception $e) {

            // Log the error 
            $this->logger->error($e->getMessage());
            $this->logger->error($e->getTraceAsString());

            $returnValue = [];
            $returnValue['code']    = $e->getCode();
            $returnValue['message'] = $e->getMessage();

            // Error trying to connect to the database server: 
            // Only one usage of each socket address (protocol/network address/port) is normally permitted.
            // Todo: Implement a error response ajax
            return $this->ajax($returnValue, "HTTP/1.1 500 Internal Server Error");

        }

    }

    public function create() 
    {
        // concatenated=ACRONY_000000022
        // acronym=ACRONY
        // code=000000022
        // dataType=CODIGO_ERROR_APP
        // language=+es-ES
        // description=Usted+no+tiene+permisos+para+ejecutar+la+operaci%C3%B3n+solicitada.

        if (true !== ($result = $this->validateFormData())) {

            // Return the validation message
            return $this->ajax($result);

        }

        $concatenated = $_POST['concatenated'];
        $acronym = $_POST['acronym'];
        $code = $_POST['code'];
        $dataType = $_POST['dataType'];
        $language = $_POST['language'];
        $description = $_POST['description'];

        return $this->ajax(true);

    }

    protected function validateFormData()
    {
        $validator = new Validator();
        $validator['concatenated'] = [
            'validate' => 'required|regex:/^[a-z0-9]{6}_[a-z0-9]+$/i',
            'message' => 'The code must match the following regex: "/^[a-z0-9]{6}_[a-z0-9]+$/i", e.g. ABCDEF_000001'
        ];

        $validator['acronym'] = [
            'validate' => 'regex:/^[A-Z0-9]{6}$/',
            'message' => 'The acronym must have only 6 uppercase characters / numbers e.g. (ABC123)'
        ];

        $validator['code'] = [
            'validate' => 'required',
            'message' => 'The code is required'
        ];

        $validator['dataType'] = [
            'validate' => 'required',
            'message' => 'The data type is required, use CODIGO_ERROR_APP or CODIGO_MENSAJE_APP.'
        ];

        $validator['language'] = [
            'validate' => 'required',
            'message' => 'The language is required, use " es-ES" or " en-US".'
        ];

        $validator['description'] = [
            'validate' => 'required',
            'message' => 'The code message / description is required.'
        ];

        if ($validator->valid($_POST)) {
            return true;
        }

        return $validator->getMessages();
    }

}
