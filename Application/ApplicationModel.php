<?php
namespace Application;

use Atto\Model;
use Atto\Libraries\Database\MySQLi;
use Atto\Libraries\Logger;
use Atto\Config;

/**
 * ApplicationModel class
 *
 * @package   Application
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
abstract class ApplicationModel extends Model {
	
	/**
	 * Table name
	 *
	 * @var string
	 */
	protected $tableName = null;
	
	/**
	 * Logger instance
	 * 
	 * @var \Atto\Libraries\Logger
	 */
	protected $log;
	
	/**
	 * Database driver
	 * 
	 * @var \Atto\Libraries\Database\MySQLi
	 */
	protected $database;

    /**
     * Application model constructor
     */
	public function __construct() {
		parent::__construct();
		
		// Create database connection
		$this->database = static::getConnection();
		
		// Create logger instance
		$this->log = static::getLogger();
	}
	
	/**
	 * Creates database connection
	 */
	protected static function getConnection() {
		static $database;
		
		// Create database connection
		if ($database === null) {
			$database = new MySQLi();
		}
		
		return $database;
	}
	
	/**
	 * Creates logger object
	 */
	protected static function getLogger() {
		static $logger;
	
		// Create database connection
		if ($logger === null) {
			$logger = new Logger();
		}
	
		return $logger;
	}
	
	/**
	 * This simple method must return the table name
	 * 
	 * @return string
	 */
	public function getTableName() {
		if ($this->tableName === null) {
			throw new \Exception('No table name defined for the model: ' . get_class($this));
		}
		
		// Get configured table prefix
		$tablePrefix = Config::getProperty('application.table.prefix');
		
		return ($tablePrefix === null) ? $this->tableName : $tablePrefix . $this->tableName;
	}
}
