<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LogoutUser
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
        $user = auth()->guard('user')->user();
        if ($user->is_active===false) {
            auth()->guard('user')->logout();
            return redirect()->route('schoolLoginForm');
        }
        return $next($request);
    }
}
