<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  $role
     *
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {

        if(Auth::check()){
            $user = \Auth::user();

            foreach($roles as $role) {
                // Check if user has the role This check will depend on how your roles are set up
                if($user->hasRole($role))
                    return $next($request);
            }
        }

        // Check if a role is required for the route, and
        // if so, ensure that the user has that role.
//        if ($request->user()->hasRole($role) || !$role) {
//            return $next($request);
//        }

        abort(403, 'This action is unauthorized.');
    }
}
