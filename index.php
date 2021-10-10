<?php
session_name('login_session');
session_set_cookie_params(0, '/', '.localhost');
session_start();
require_once 'vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    //tasks
    $r->addRoute('GET', '/', 'TasksController@index');
    $r->addRoute('GET', '/newTask', 'TasksController@new');
    $r->addRoute('POST', '/', 'TasksController@save');
    $r->addRoute('GET', '/task/{id}', 'TasksController@open');
    $r->addRoute('POST', '/task/{id}', 'TasksController@delete');

    //users
    $r->addRoute('GET', '/register', 'UsersController@register');
    $r->addRoute('POST', '/register', 'UsersController@save');
    $r->addRoute('GET', '/error', 'UsersController@error');
    $r->addRoute('GET', '/login', 'UsersController@login');
    $r->addRoute('POST', '/login', 'UsersController@logout');
    $r->addRoute('POST', '/account', 'UsersController@account');

});

function base_path(): string
{
    return __DIR__;
}

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        var_dump("404");
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        var_dump("405");
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        // ... call $handler with $vars

        [$controller, $method] = explode('@', $handler);

        $controller = 'App\Controllers\\' . $controller;
        $controller = new $controller();
        $controller->$method($vars);
        break;
}