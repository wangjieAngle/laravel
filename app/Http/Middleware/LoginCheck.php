<?php

namespace App\Http\Middleware;

use Closure;

class LoginCheck
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
//        return redirect()->action("Login\LoginController@index");
//        echo 1;exit;
        $key = $request->key;
        $date = $request->session()->get($key);
//        var_dump(Route('loginIndex'));exit;
//        var_dump(empty($date));exit;
        if (empty($date)) {
            return redirect(Route('loginIndex'));
        }
        return $next($request);
    }
}
