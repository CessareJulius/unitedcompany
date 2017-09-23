<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
class CheckMembership
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
        $mem = Auth::user()->membership;
        if (isset($mem)) {
            if ($mem->status=='Activo') {
                return $next($request);
            }
        }
        Session::flash('membership','inactivo');
        return redirect('clientarea\membership');


    }
}
