<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RestrictIpAddressMiddleware
{

    // Blocked IP addresses
    public $restrictedIp = [];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $collection_block_ips = collect(\App\Models\BlockedIp::select('ip')->get()->map->toArray());
        $blocked_ips = $collection_block_ips->pluck('ip');

        if (in_array($request->ip(), $blocked_ips->all())) {
            return response()->json(['message' => "You are not allowed to access this site."]);
        }
        return $next($request);
    }
}
