<?php
namespace Atto\Cache\storage;

use Atto\Cache\Item;
use Atto\Cache\Storage;
use Atto\Config;

/**
 * FileStorage class
 *
 * @package   Atto
 *
 * @namespace Atto\Cache\Storage
 * @name      Atto\Cache\Storage\FileStorage
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
class FileStorage implements Storage {
	
	/**
	 * Directory path where the files are stored
	 * 
	 * @var string
	 */
	protected $directory;
	
	/**
	 * FileStorage constructor
	 * 
	 * @param string $directory Directory path where the cache file are stored
	 */
	public function __construct($directory = null) {

		if ($directory === null) {
            $directory = Config::getProperty('cache.directory');
        }

		if (!is_dir($directory) && !@mkdir($directory, 0777, true)) {
			throw new \InvalidArgumentException("The directory $directory is invalid.");
		}

        if (!is_writable($directory)) {
            throw new \RuntimeException('Cache directory is not writable: "' . $directory . '".');
        }

		$this->directory = realpath($directory) . '/';
	}
	
	/**
	 * Saves a new Item with the given key
	 *
	 * @param string $key
	 * @param Item $item
	 */
	public function save($key, Item $item) {
		// Get filename and contents
		$filename = $this->getFilename($key);
		$contents = serialize($item);
		
		// Write to the file
		file_put_contents($filename, $contents, LOCK_EX);
	}
	
	/**
	 * Removes the indicated Item from the storage
	 *
	 * @param string $key
	 */
	public function delete($key) {
		// Get filename
		$filename = $this->getFilename($key);
		
		if (is_file($filename)) {
			unlink($filename);
		}
	}

	/**
	 * Returns the Item associated with the given key
	 *
	 * @param string $key
	 *
	 * @return Item|null
	 */
	public function getItem($key) {
		$filename = $this->getFilename($key);
		
		if (is_file($filename)) {
			return unserialize(file_get_contents($filename));
		}
		
		return null;
	}

	/**
	 * Returns the filename for the current key
	 *
	 * @param string $key
	 *
	 * @return string
	 */
	protected function getFilename($key) {
		return $this->directory . sha1($key);
	}
}
