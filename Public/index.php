<?php

use Atto\Logger;

$start = microtime(true);

// Root directory and sub-directories
define('DIRECTORY_ROOT', realpath('..') . '/');
define('DIRECTORY_ROOT_ATTO', DIRECTORY_ROOT . 'Atto/');
define('DIRECTORY_ROOT_APPLICATION', DIRECTORY_ROOT . 'Application/');
define('DIRECTORY_ROOT_LOGS', DIRECTORY_ROOT . 'Logs/');
define('DIRECTORY_ROOT_CACHE', DIRECTORY_ROOT . 'Cache/');
define('DIRECTORY_ROOT_VIEWS', DIRECTORY_ROOT_APPLICATION . 'Views/');
define('DIRECTORY_ROOT_SESSION', DIRECTORY_ROOT . 'Session/');

// Require and instantiate the loader
require_once DIRECTORY_ROOT . 'Atto/Loader.php';
$loader = new \Atto\Loader();
$loader->registerNamespace('Atto', DIRECTORY_ROOT_ATTO);
$loader->registerNamespace('Application', DIRECTORY_ROOT_APPLICATION);

// Get configuration and routes
$configuration = require DIRECTORY_ROOT_APPLICATION . 'Configuration.php';
$routes        = require DIRECTORY_ROOT_APPLICATION . 'Routes.php';

// Configurations
\Atto\Config::addProperties($configuration);

// New Atto instance
$atto = new \Atto\Atto();

// Add all routes
$atto->registerRoutes($routes);

// Run the application
$atto->run();

// Todo, remove this logger
$logger = new Logger();
$logger->debug("Total execution time: " . (microtime(true) - $start));
