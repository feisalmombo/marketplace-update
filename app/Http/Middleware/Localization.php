<?php

namespace App\Http\Middleware;

use Closure;

class Localization
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
        if(\Session::has('locale')) {
            \App::setLocale(\Session::get('locale'));
        }

        // The default language in locale is English
        // So for this middleware will change language by Session
        return $next($request);
    }
}
