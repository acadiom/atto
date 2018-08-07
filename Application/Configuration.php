<?php
/**
 * Configuration file
*/



return [
		// Application configuration - here you can configure you're own Application
        'application.environment' => 'development',
		
		// Application basepath, if the application is not "/" you should 
		// configure it here without the ending slash, use blank "" for base url
        'application.basepath' => '/ssl.atto.dev/public',

		// Database tables prefix
		'application.table.prefix' => '',
		
		// Error and exception handler, if you need another handlers
		'error.handler'			  => null,
		'exception.handler'		  => null,

		// Cache configuration
		'cache.ttl'       => 10,
        'cache.directory' => DIRECTORY_ROOT_CACHE,
        
    	// Session configuration
    	'session.directory' => DIRECTORY_ROOT_SESSION,

		// Application views path and cache
		'views.path'  => DIRECTORY_ROOT_VIEWS,
		'views.cache' => DIRECTORY_ROOT_CACHE,

		// Logger configuration
		'logs.level' => 15,
		'logs.directory' => DIRECTORY_ROOT_LOGS,
		'logs.filesize'  => 500 * 1024, // 500 KB each log file

		// Database configuration
		'database.host'     => '127.0.0.1',
		'database.port'     => 3306,
		'database.user'     => 'root',
		'database.password' => 'parola',
		'database.name'     => 'proyectos_isban',
		'database.charset'  => 'utf8',
];
