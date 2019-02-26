<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if ($request->user() === null) {
            return redirect('/login');
        }

        $actions = $request->route()->getAction();

        if(isset($actions['roles'])) {
            $roles = $actions['roles'];
        } else {
            $roles = null;
        }

        if($request->user()->hasAnyRole($roles)) {
            return $next($request);
        } else {
            abort(401, 'Error 401, This action is unauthorized.');
        }

        return redirect('/');
    }
}
