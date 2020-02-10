<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotAnAdmin
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

        if(is_null($request->user()) || !$request->user()->isAdmin()) {
            if($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect(url('home'));
            }
        }

        return $next($request);
    }
}
