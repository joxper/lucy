<?php

namespace App\Lucy;

use Route as R;

class Route
{
    /**
     * Name of the middleware for permissions management.
     *
     * @var string
     */
    const MIDDLEWARE = 'sentinel_hasaccess';

    /**
     * GET route.
     * 
     * @param  string  $uri
     * @param  mixed   $callback
     * @param  string  $permission
     * @return \Route
     */
    public static function get($uri, $callback, $permission)
    {
        return static::generate(__FUNCTION__, $uri, $callback, $permission);
    }

    /**
     * POST route.
     * 
     * @param  string  $uri
     * @param  mixed   $callback
     * @param  string  $permission
     * @return \Route
     */
    public static function post($uri, $callback, $permission)
    {
        return static::generate(__FUNCTION__, $uri, $callback, $permission);
    }

    /**
     * PUT route.
     * 
     * @param  string  $uri
     * @param  mixed   $callback
     * @param  string  $permission
     * @return \Route
     */
    public static function put($uri, $callback, $permission)
    {
        return static::generate(__FUNCTION__, $uri, $callback, $permission);
    }

    /**
     * DELETE route.
     * 
     * @param  string  $uri
     * @param  mixed   $callback
     * @param  string  $permission
     * @return \Route
     */
    public static function delete($uri, $callback, $permission)
    {
        return static::generate(__FUNCTION__, $uri, $callback, $permission);
    }

    /**
     * Generate route.
     * 
     * @param  string  $type
     * @param  string  $uri
     * @param  mixed   $callback
     * @param  string  $permission
     * @return \Route
     */
    private static function generate($type, $uri, $callback, $permission)
    {
        $route = R::{$type}($uri, $callback);

        if (is_string($permission)) {
            return $route->middleware(static::MIDDLEWARE.':'.$permission);
        }

        return $route;
    }
}
