<?php

/**
 * 
 * Verb	        URI	                    Action	Route Name
 * ---------------------------------------------------------
 * GET	        /photos	                index	photos.index
 * GET	        /photos/create	        create	photos.create
 * POST	        /photos	                store	photos.store
 * GET	        /photos/{photo}	        show	photos.show
 * GET	        /photos/{photo}/edit	edit	photos.edit
 * PUT/PATCH	/photos/{photo}	        update	photos.update
 * DELETE	    /photos/{photo}	        destroy	photos.destroy
 * 
 * Every route must have at least a method, a route (users/profile)
 * and an action (UserController::index). Optionally you can define 
 * a name as the last parameter (needed if you want to generate the 
 * url).
 *
 *
 * [$method, $route, $action, $name]
 */

$routes = [
    ['GET', '/', 'Application\\Controllers\\HomeController::index', 'homepage'],
    ['GET', '/codes', 'Application\\Ajax\\CodeController::index', 'codes.index']
];

// Returns the configured routes
return $routes;
