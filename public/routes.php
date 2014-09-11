<?php

// define routes

$routes = array(
    array(
        "pattern" => "api/Books/",
        "controller" => "books",
        "action" => "getBooks",
        "httpMethod" => \Framework\HttpRequest::METHOD_GET,
    ),
    array(
        "pattern" => "api/Books/:params",
        "controller" => "books",
        "action" => "getBooks",
        "httpMethod" => \Framework\HttpRequest::METHOD_GET,
    ),

);

// add defined routes

foreach ($routes as $route)
{
    $router->addRoute(new Framework\Router\Route\Api($route));
}

// unset globals

unset($routes);
