<?php

namespace Illuminate\Support\Facades;

class Route
{
    protected static $routes = [];

    public static function get($path, $callback)
    {
        self::$routes['GET'][$path] = $callback;
    }

    public static function post($path, $callback)
    {
        self::$routes['POST'][$path] = $callback;
    }

    public static function dispatch($method, $path)
    {
        $method = strtoupper($method);

        if (isset(self::$routes[$method][$path])) {
            $callback = self::$routes[$method][$path];

            if (is_callable($callback)) {
                return call_user_func($callback);
            }

            if (is_array($callback) && count($callback) === 2) {
                [$controller, $action] = $callback;
                if (is_object($controller)) {
                    return call_user_func([$controller, $action]);
                }
                if (class_exists($controller)) {
                    $instance = new $controller();
                    return call_user_func([$instance, $action]);
                }
            }
        }

        return null;
    }
}
