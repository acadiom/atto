<?php namespace Application;

use Atto\View;

/**
 * ApplicationView class
 *
 * @package   Application
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
class ApplicationView extends View {
    
    /**
     * ApplicationView constructor.
	 * 
	 * @param string $views
	 * @param string $cache
     */
    public function __construct($views, $cache) {
        parent::__construct($views, $cache);
    }
}
