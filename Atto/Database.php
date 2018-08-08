<?php
namespace Atto;

use Atto\Config;

/**
 * MySQLi driver class
 *
 * @package   atto
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
class Database {

    /**
     * Connection to the MySQL database
     *
     * @var \mysqli
     */
    protected $connection;

    /**
     * MySQLi statement
     *
     * @var \mysqli_stmt
     */
    protected $statement;

    /**
     * Parameter types for binding
     *
     * @var string
     */
    protected $types;

    /**
     * Parameters
     *
     * @var array
     */
    protected $params;

    /**
     * Latest executed query
     *
     * @var string
     */
    protected $query;

    /**
     * Latest result set
     *
     * @var array
     */
    protected $results;

    /**
     * Number of returned rows
     *
     * @var int
     */
    protected $resultsCount;

    /**
     * Affected rows by the latest executed query
     *
     * @var int
     */
    protected $affectedRows;

    /**
     * Latest insert id
     *
     * @var int
     */
    protected $insertId;

    /**
     * MySQLi constructor.
     */
    public function __construct() {
    	
        // Try to connect to the database server
        $this->connect();

        // Initialize / set default parameters
        $this->resetAttributes();
    }

    /**
     * Connects to the database server
     *
     * @throws \Exception
     */
    protected function connect() {

        $this->connection = @mysqli_init();

        $connected = @mysqli_real_connect(
            $this->connection,
            Config::getProperty('database.host'),
        	Config::getProperty('database.user'),
        	Config::getProperty('database.password'),
        	Config::getProperty('database.name'),
        	Config::getProperty('database.port')
        );

        if ($connected === false) {
            throw new \Exception("Error trying to connect to the database server: " . mysqli_connect_error(), mysqli_connect_errno());
        }

        if (@mysqli_set_charset($this->connection, Config::getProperty('database.charset')) === false) {
            throw new \Exception("Error trying to set the charset. Please check the 'database.charset' configuration: " . $this->getError(), $this->getErrorCode());
        }

    }

    /**
     * Returns the error code
     *
     * @return string
     */
    public function getErrorCode() {
        return mysqli_errno($this->connection);
    }

    /**
     * Returns the error
     *
     * @return string
     */
    public function getError() {
        return mysqli_error($this->connection);
    }

    /**
     * Binds the indicated parameters and executes the statement
     *
     * @param null $type     string The types for the parameters
     * @param      ...$param mixed  The parameters needed to be bind to the statement
     *
     * @return bool
     */
    public function execute($type = null, ...$param) {
        if ($type !== null) {
            $this->bind($type, ...$param);
        }

        // If there are no parameters we dont need to call this function
        if ($this->types !== '' && count($this->params) > 0) {
            // Bind all parameters
            if (false === mysqli_stmt_bind_param($this->statement, $this->types, ...$this->params)) {
                throw new \Exception('There was a problem trying to bind the parameters: ' . $this->getError(), $this->getErrorCode());
            }
        }

        // Execute
        return mysqli_stmt_execute($this->statement);
    }

    /**
     * Binds a parameter to the prepared statement
     *
     * @param       $type string The type used
     * @param array ...$param
     */
    public function bind($type, ...$param) {
        $this->bindArray($type, $param);
    }

    /**
     * Binds an array of parameters to the prepared statement
     *
     * @param $type string The type used
     * @param $param array
     */
    public function bindArray($type, array $param) {
        $this->types .= $type;
        $this->params = array_merge($this->params, $param);
    }

    /**
     * Returns the number of rows from the latest executed query
     *
     * @return int Number of rows
     */
    public function resultsCount() {
        if ($this->resultsCount < 0) {
            $this->storeResults();
        }

        return $this->resultsCount;
    }

    /**
     * Prepares a statement for execution
     *
     * @param $query string The query to prepare
     *
     * @return bool
     */
    public function prepare($query) {
        // Reset all attributes
        $this->resetAttributes();

        // Store the last query
        $this->query = $query;

        // Prepare the statement
        $this->statement = mysqli_prepare($this->connection, $this->query);

        if ($this->statement === false) {
            throw new \Exception('Error while preparing the statement: ' . $this->getError(), $this->getErrorCode());
        }

        return true;
    }

    /**
     * Close the statement if there is one
     */
    protected function closeStatement() {
        if ($this->statement instanceof \mysqli_stmt) {
            mysqli_stmt_close($this->statement);
            $this->statement = null;
        }
    }

    /**
     * Resets all attributes
     */
    protected function resetAttributes() {
        // Reset everything
        $this->query        = '';
        $this->types        = '';
        $this->params       = [];
        $this->results      = [];
        $this->resultsCount = -1;
        $this->affectedRows = -1;
        $this->insertId     = -1;

        $this->closeStatement();
    }

    /**
     * Closes the connection and the latest statement
     */
    public function __destruct() {
        $this->closeStatement();

        // Close the connection
        mysqli_close($this->connection);
    }

    /**
     * Returns the number of affected rows by the latest executed query
     *
     * @return int|string
     */
    public function affectedRows() {
        if ($this->affectedRows === -1) {
            $this->affectedRows = mysqli_stmt_affected_rows($this->statement);
        }

        return $this->affectedRows;
    }

    /**
     * Returns the latest inserted id
     *
     * @return mixed|int
     */
    public function insertId() {
        if ($this->insertId === -1) {
            $this->insertId = mysqli_stmt_insert_id($this->statement);
        }

        return $this->insertId;
    }

    /**
     * Just an alias to fetchResults method
     *
     * @return array
     */
    public function fetchObject() {
        return $this->fetchResults();
    }

    /**
     * Returns all results from the latest query
     *
     * @param string $output
     *
     * @return array
     */
    public function fetchResults($output = 'object') {

        // Store the results first
        $this->storeResults();

        $results = [];

        foreach ($this->results as $result) {
            $results[] = $this->formatOutput($result, $output);
        }

        return $results;
    }

    /**
     * Stores the results from the previously executed query
     */
    protected function storeResults() {
        // Already stored
        if (isset($this->results[0])) {
            return;
        }

        $result = mysqli_stmt_get_result($this->statement);

        // Store the number of rows
        $this->resultsCount = mysqli_num_rows($result);

        while ($row = mysqli_fetch_assoc($result)) {
            $this->results[] = $row;
        }

        mysqli_stmt_free_result($this->statement);
    }

    /**
     * Formats the result: array | assoc | object
     *
     * @param $results
     * @param $output
     *
     * @return array|object
     */
    protected function formatOutput($results, $output) {
        if ($output === 'array')
            return array_values($results);

        if ($output === 'object')
            return (object) $results;

        return $results;
    }

    /**
     * Just an alias to fetchResults method
     *
     * @return array
     */
    public function fetchArray() {
        return $this->fetchResults('array');
    }

    /**
     * Just an alias to fetchResults method
     *
     * @return array
     */
    public function fetchAssoc() {
        return $this->fetchResults('assoc');
    }

    /**
     * Returns an entire column from the result set
     *
     * @param int $column Column index
     *
     * @return array
     */
    public function fetchColumn($column = 0) {
        // Store the results first
        $this->storeResults();

        $result = [];

        for ($i = 0; $i < $this->resultsCount; $i++) {
            $result[$i] = $this->fetchValue($i, $column);
        }

        return $result;
    }

    /**
     * Returns only one value from the result set. If is not set null will be returned
     *
     * @param int $row
     * @param int $col
     *
     * @return mixed The value
     */
    public function fetchValue($row = 0, $col = 0) {
        $result = $this->fetchRow($row, 'array');

        return isset($result[$col]) ? $result[$col] : null;
    }

    /**
     * Return only one row based on $row index or null if the index is not set
     *
     * @param int    $row
     * @param string $output
     *
     * @return array|null|object
     */
    public function fetchRow($row = 0, $output = 'object') {
        // Store the results first
        $this->storeResults();

        if (!isset($this->results[$row]))
            return null;

        return $this->formatOutput($this->results[$row], $output);
    }

}
