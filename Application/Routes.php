<?php

/**
 * 
 * Every route must have at least a method, a route (users/profile)
 * and an action (UserController::index). Optionally you can define 
 * a name as the last parameter (needed if you want to generate the 
 * url).
 *
 * Verb       URI                     Action   Route Name
 * GET        /photos                 index    photos.index
 * GET        /photos/create          create   photos.create
 * POST       /photos                 store    photos.store
 * GET        /photos/{photo}         show     photos.show
 * GET        /photos/{photo}/edit    edit     photos.edit
 * PUT/PATCH  /photos/{photo}         update   photos.update
 * DELETE     /photos/{photo}         destroy  photos.destroy
 * 
 * [$method, $route, $action, $name]
 */

$routes = [
    ['GET', '/', 'Application\\Controllers\\HomeController::index', 'home'],
    ['GET', '/codes', 'Application\\Ajax\\CodeController::index', 'codes.index'],

    ['GET', '/acronyms', 'Application\\Ajax\\CodesController::acronyms', 'acronyms'],
    ['GET', '/languages', 'Application\\Ajax\\CodesController::languages', 'languages'],

    ['GET', '/codes', 'Application\\Ajax\\CodesController::list', 'codes-list'],
    ['GET', '/file', 'Application\\Ajax\\CodesController::getFile', 'file'],
    ['GET', '/query', 'Application\\Ajax\\CodesController::getQuery', 'query']
];

// Returns the configured routes
return $routes;
