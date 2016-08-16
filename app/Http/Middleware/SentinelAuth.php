<?php

namespace App\Http\Middleware;

use Closure;
use Sentinel;

class SentinelAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Sentinel::guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Unauthorized.'], 401);
            }

            return redirect()->action('Auth\AuthController@getLogin');
        }

        return $next($request);
    }
}
