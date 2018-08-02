<?php
namespace Atto\Cache;

/**
 * Cache Item
 *
 * @package   Atto
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
class Item {
	
	/**
	 * Time to live 
	 * 
	 * @var integer Number of seconds
	 */
	protected $ttl;
	
	/**
	 * Creation timestamp
	 * 
	 * @var integer
	 */
	protected $creation;
	
	/**
	 * Any data to be stored
	 * 
	 * @var mixed
	 */
	protected $data;
	
	/**
	 * Cache Item constructor
	 * 
	 * @param mixed $data
	 * @param integer $ttl In seconds
	 */
	public function __construct($data, $ttl) {
		$this->data     = $data;
		$this->ttl      = $ttl;
		$this->creation = time();
	}
	
	/**
	 * Returns the data stored
	 * 
	 * @return mixed
	 */
	public function getData() {
		return $this->data;
	}
	
	/**
	 * Indicates if the current Item has expired or not
	 * 
	 * @return boolean
	 */
	public function expired() {
		if ($this->ttl < 1) {
			return false;
		}
		
		return ($this->creation + $this->ttl) < time();
	}
}
