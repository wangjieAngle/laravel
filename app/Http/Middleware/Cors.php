<?php

namespace App\Http\Middleware;

use Closure;

class Cors
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
//        $response = $next($request);
//        $response->header('Access-Control-Allow-Origin', '*');
//        $response->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept, multipart/form-data, application/json,authorization, maintainsource, maintaintoken, access-control-allow-origin');
//        $response->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS, DELETE');
//        $response->header('Access-Control-Allow-Credentials', 'true');
//        $response->header('Content-Security-Policy', 'upgrade-insecure-requests');

        return $next($request)->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Headers', 'Origin, Content-Type, Cookie, Accept, multipart/form-data, application/json,authorization, maintainsource, maintaintoken, access-control-allow-origin')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PATCH, PUT, OPTIONS, DELETE')
            ->header('Access-Control-Allow-Credentials', 'true')
            ->header('Content-Security-Policy', 'upgrade-insecure-requests');
    }
}
