<?php
namespace Atto\Cache;

/**
 * Storage Interface
 *
 * @package   Atto
 *
 * @namespace Atto\Cache
 * @name      Atto\Cache\Storage
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
interface Storage {
	
	/**
	 * Saves a new Item with the given key
	 * 
	 * @param string $key
	 * @param Item $item
	 */
	public function save($key, Item $item);
	
	/**
	 * Removes the indicated Item from the storage
	 * 
	 * @param string $key
	 */
	public function delete($key);
	
	/**
	 * Returns the Item associated with the given key
	 * 
	 * @param string $key
	 * 
	 * @return Item
	 */
	public function getItem($key);

	/**
	 * Clears the entire folder
	 */
	public function clear();
}
