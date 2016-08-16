<?php

namespace App\Http\Middleware;

use Closure;
use LucyGuard;

class SentinelHasAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string    $permission
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        if (! LucyGuard::hasAccess($permission)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['message' => 'Unauthorized.'], 403);
            }

            return response()->view('unauthorized');
        }
        
        return $next($request);
    }
}
