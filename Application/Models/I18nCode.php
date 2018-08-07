<?php
namespace Application\Models;

use Application\ApplicationModel;

/**
 * I18n Code Model class
 * 
 * @author Andrei Alexandru Romila <andrei.romila@gmail.com>
 */
class I18nCode extends ApplicationModel
{
    /**
     * Code unique identifier
     *
     * @var integer
     */
    private $id;

    /**
     * Application acronym
     *
     * @var string
     */
    private $acronym;

    /**
     * Code data type
     *
     * @var string
     */
    private $dataType;

    /**
     * Code language
     *
     * @var string
     */
    private $language;

    /**
     * Code
     *
     * @var string
     */
    private $code;

    /**
     * Concatenated value of the acronym and code
     *
     * @var string
     */
    private $acronymCode;

    /**
     * Translated message of the code for the current language
     *
     * @var string
     */
    private $message;

    /**
     * Deleted indicator
     *
     * @var string Can be S or N
     */
    private $deleted;

    /**
     * Timestamp of the creation
     *
     * @var integer
     */
    private $createdAt;

    /**
     * Timestamp of the updated code
     *
     * @var integer
     */
    private $updatedAt;

	/**
	 * Table name
	 *
	 * @var string
	 */
    protected $tableName = 'i18n_codes';
    
    /**
     * Model constructor
     */
	public function __construct() {
		parent::__construct();
	}

    /**
     * Code identifier
     *
     * @return  integer
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of acronym
     * 
     * @return  string
     */ 
    public function getAcronym()
    {
        return $this->acronym;
    }

    /**
     * Set the value of application
     *
     * @return  void
     */ 
    public function setAcronym(string $acronym)
    {
        $this->acronym = $acronym;
    }

    /**
     * Get the value of dataType
     * 
     * @return  string
     */ 
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     * Set the value of dataType
     *
     * @return  void
     */ 
    public function setDataType(string $dataType)
    {
        $this->dataType = $dataType;
    }

    /**
     * Get code language
     *
     * @return  string
     */ 
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set code language
     *
     * @param  string  $language  Code language
     *
     * @return void
     */ 
    public function setLanguage(string $language)
    {
        $this->language = $language;
    }

    /**
     * Get code
     *
     * @return  string
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set code
     *
     * @param  string  $code  Code
     *
     * @return  self
     */ 
    public function setCode(string $code)
    {
        $this->code = $code;
    }

    /**
     * Get concatenated value of the acronym and code
     *
     * @return  string
     */ 
    public function getAcronymCode()
    {
        return $this->acronymCode;
    }

    /**
     * Set concatenated value of the acronym and code
     *
     * @param  string  $acronymCode  Concatenated value of the acronym and code
     *
     * @return  self
     */ 
    public function setAcronymCode(string $acronymCode)
    {
        $this->acronymCode = $acronymCode;
    }

    /**
     * Get translated message of the code for the current language
     *
     * @return  string
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set translated message of the code for the current language
     *
     * @param  string  $message  Translated message of the code for the current language
     *
     * @return  self
     */ 
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * Get can be S or N
     *
     * @return  string
     */ 
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set can be S or N
     *
     * @param  string  $deleted  Can be S or N
     *
     * @return  self
     */ 
    public function setDeleted(string $deleted)
    {
        $this->deleted = $deleted;
    }

    /**
     * Get timestamp of the creation
     *
     * @return  integer
     */ 
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get timestamp of the updated code
     *
     * @return  integer
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;

    }


    public function getLanguages()
    { 
        $query  = 'SELECT DISTINCT(language) AS language FROM ';
        $query .= $this->getTableName() . ' ';
        $query .= 'ORDER BY language';

        $this->database->prepare($query);
        if ($this->database->execute()) {
            return $this->database->fetchColumn(0);
        }

        return [];
    }

    public function getAcronyms()
    { 
        $query  = 'SELECT DISTINCT(acronym) AS acronym FROM ';
        $query .= $this->getTableName() . ' ';
        $query .= 'ORDER BY acronym';

        $this->database->prepare($query);
        if ($this->database->execute()) {
            return $this->database->fetchColumn(0);
        }

        return [];
    }

    /**
     * Search codes 
     *
     * @param string $acronym
     * @param string $language
     * @param string $code
     * @param integer $limit
     * @param integer $offset
     * 
     * @return array List of codes
     */
    public function search($acronym = '', $language = '', $code = '', $limit = 50, $offset = 0)
    {
        $types  = '';
        $params = [];

        $query  = 'SELECT id, acronym, data_type, language, code, acronym_code, message, deleted, created_at, updated_at ';
        $query .= 'FROM ';
        $query .= $this->getTableName() . ' ';
        $query .= 'WHERE ';

        // Check for acronym filter
        if ($acronym !== '') {
            $query .= 'acronym = ? AND ';
            $types .= 's';
            $params[] = $acronym;
        }

        // Check for language code
        if ($language !== '') {
            $query .= 'language = ? AND ';
            $types .= 's';
            $params[] = $language;
        }

        // Check for the code filter
        if ($code !== '') {
            $query .= 'code like ? AND ';
            $types .= 's';
            $params[] = "%$code%";
        }

        // Only active codes are allowed
        $query .= 'deleted = ? ';
        $types .= 's';
        $params[] = 'N';

        // Get total results
        $this->database->prepare($query);
        $this->database->execute($types, ...$params);
        $totalResults = $this->database->resultsCount();

        // Order and limit the results
        $query .= 'ORDER BY code DESC, created_at DESC ';
        $query .= 'LIMIT ? OFFSET ?';

        $types .= 'i';
        $params[] = $limit;

        $types .= 'i';
        $params[] = $offset;

        // Prepare the statement
        $this->database->prepare($query);
        $this->database->bindArray($types, $params);

        if ($this->database->execute() === false) {
            throw new \RuntimeException($this->database->getError());
        }

        $results['totalResults'] = $totalResults;
        $results['codeList'] = $this->database->fetchObject();

        return $results;
    }
}
