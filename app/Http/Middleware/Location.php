<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Location
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        $location = \Stevebauman\Location\Facades\Location::get('45.151.236.110');
//        dd($location);
//        if ($location && $location->countryCode == "RU" && !Auth::check()) {
//            return redirect(route('home-auth'));
//        }
        return $next($request);
    }
}
