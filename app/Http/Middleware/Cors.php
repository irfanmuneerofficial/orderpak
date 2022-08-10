<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        return $next($request)
                ->header('Access-Control-Allow-Origin', "*")
                ->header('Access-Control-Allow-Methods', "PUT,POST,DELETE,GET,OPTIONS")
                ->header('Access-Control-Allow-Credentials', 'true')
                ->header('Access-Control-Max-Age', '86400')
                ->header('Access-Control-Allow-Headers', "Origin,Accept,Authorization,Content-Type,X-Requested-With,X-Custom-Auth,cache-control,X-Auth-Token,application/json");
    }
}
