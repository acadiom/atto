<?php
namespace Atto\Cache\Storage;

use Atto\Cache\Item;
use Atto\Cache\Storage;

/**
 * NullStorage class
 *
 * @package   Atto
 *
 * @namespace Atto\Cache\Storage
 * @name      Atto\Cache\Storage\NullStorage
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
class NullStorage implements Storage {

	/**
	 * FileStorage constructor
	 */
	public function __construct() {
		
	}
	
	/**
	 * Saves a new Item with the given key
	 *
	 * @param string $key
	 * @param Item $item
	 */
	public function save($key, Item $item) {
		
	}
	
	/**
	 * Removes the indicated Item from the Storage
	 *
	 * @param string $key
	 */
	public function delete($key) {
		
	}

	/**
	 * Returns the Item associated with the given key
	 *
	 * @param string $key
	 *
	 * @return Item|null
	 */
	public function getItem($key) {
		return null;
	}
}
