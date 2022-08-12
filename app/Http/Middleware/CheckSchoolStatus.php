<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckSchoolStatus
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
        if(auth()->guard('user')->user()->school->status!=1){
            abort(403, "Dasturdan foydalanishga ruxsat to'xtatilgan");
        }
        return $next($request);
    }
}
