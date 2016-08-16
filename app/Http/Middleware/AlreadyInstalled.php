<?php

namespace App\Http\Middleware;

use Closure;

class AlreadyInstalled
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
        if (! $this->checkApp()) {
            return redirect('install');
        }

        return $next($request);
    }

    /**
     * Check if the app is already installed.
     *
     * @return bool
     */
    public function checkApp()
    {
        return file_exists(storage_path('installed'));
    }
}
