<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UserActiveSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->guard('user')->check()) {
            $userId=auth()->guard('user')->id();
            $expires_after = Carbon::now()->addMinutes(15);
            Cache::put('user-'.$userId, true, $expires_after);
        }
        return $next($request);
    }
}
