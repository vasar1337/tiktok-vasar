<?php

namespace Illuminate\Support\Facades;

abstract class Facade
{
    protected static $resolvedInstance = [];

    public static function facade()
    {
        $class = static::class;

        if (!isset(static::$resolvedInstance[$class])) {
            static::$resolvedInstance[$class] = new static();
        }

        return static::$resolvedInstance[$class];
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array([static::facade(), $method], $args);
    }
}
