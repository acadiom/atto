<?php

/**
 * Every route must have at least a method (GET | POST), a route (users/profile)
 * and an action (UserController). Optionally you can define a name as the last parameter.
 *
 *
 * [$method, $route, $action, $name]
 */

$routes = [
    ['GET', '', 'Application\\Controllers\\HomeController::index', 'homepage']
];

// Returns the configured routes
return $routes;
