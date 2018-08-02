<?php
namespace Atto\Cache;

/**
 * Simple extensible cache system
 *
 * @package   Atto
 *
 * @namespace Atto\Cache
 * @name      Atto\Cache\Cache
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
class Cache {
	
	/**
	 * Storage engine
	 * 
	 * @var Storage 
	 */
	protected $storage;
	
	/**
	 * Time to live (default value)
	 * 
	 * @var integer Time to live in seconds
	 */
	protected $ttl;

	/**
	 * Default constructor
	 *
	 * @param Storage $storage Storage engine
	 * @param int     $ttl     Time to live in seconds (ttl less than or equal to 0 means no expiration)
	 */
	public function __construct(Storage $storage = null, $ttl = 0) {
		$this->storage = $storage;
		$this->ttl     = $ttl;
	}

	/**
	 * Returns the data for the indicated $key or null if was not found or expired
	 *
	 * @param string $key
	 *
	 * @return mixed|NULL The data saved for the key or null if is expired or not found
	 */
	public function get($key) {
		
		$item = $this->storage->getItem($key);
		
		if ($item === null || $item->expired()) {
			$this->invalidate($key);
			
			return null;
		}
		
		return $item->getData();
	}
	
	/**
	 * Stores a new item
	 * 
	 * @param string  $key     The name of the item
	 * @param mixed   $object  The data to store
	 * @param integer $ttl     Time to live in seconds, using less than 1 means no expiration
	 */
	public function store($key, $object, $ttl = null) {
		
		// If no seconds are passed we use the default value
		if ($ttl === null) {
			$ttl = $this->ttl;
		}
		
		// Create a new item
		$item = new Item($object, $ttl);
		
		// Store
		$this->storage->save($key, $item);
	}
	
	/**
	 * Invalidates the indicated item
	 * 
	 * @param string $key The name of the item
	 */
	public function invalidate($key) {
		$this->storage->delete($key);
	}
}
