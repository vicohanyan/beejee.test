<?php

namespace core;


final class Router
{
    static function start(): void
    {
        $controller_name = 'Main';
        $action_name = 'Index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);
        if (!empty($routes[1])) {
            $controller_name = $routes[1];
        }
        if (!empty($routes[2])) {
            $action_name = $routes[2];
        }

        $controller = "engine\Controllers\\". $controller_name . 'Controller';
        $action = 'action' . ucfirst($action_name);
        if (!class_exists("$controller")) {
            Router::ErrorPage404();
        }
        $execute = new $controller();
        if (!method_exists($execute, $action) || !is_callable(array($execute, $action))) {
            Router::ErrorPage404();
        }
        $execute->$action();
    }

    static function ErrorPage404(): void
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
    }
}