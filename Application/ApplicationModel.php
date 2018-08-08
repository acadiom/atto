<?php
namespace Application;

use Atto\Config;
use Atto\Logger;
use Atto\Model;

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
	 * Logger instance
	 * 
	 * @var Logger
	 */
	protected $log;

    /**
     * Application model constructor
     */
	public function __construct() {
		// Create logger instance
		$this->log = static::getLogger();
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
	
}
