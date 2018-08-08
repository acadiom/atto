<?php
namespace Atto;

/**
 * Model class
 *
 * @package   Atto
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
abstract class Model
{
    /**
     * Table name for the current model
     *
     * @var string
     */
    protected static $table;

    /**
     * Database driver instance
     *
     * @var Database
     */
    protected static $database;

    /**
     * Sets the connection to the database
     *
     * @return Database
     */
    protected static function database() 
    {
        if (static::$database === null) {
            static::$database = new Database();
        }

        return static::$database;
    }

    /**
     * Returns the table name with the configured prefix (if we have one)
     *
     * @return string Table name for the current model
     */
    protected static function tableName()
    {
		if (static::$table === null) {
			throw new \Exception('No table name defined for the model: ' . get_class(self));
		}
		
		// Get configured table prefix
		$prefix = Config::getProperty('application.table.prefix');
        
        // Add a prefix to the table name if we have one configured
		return ($prefix === null) ? static::$table : $prefix . static::$table;
    }
}
