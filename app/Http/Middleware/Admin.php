<?php

namespace FixNairobi\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try{
            if (auth()->user()->isAdmin == 1) {
                return $next($request);
            }else{
                abort(404);
            }
        }catch (Exception $ex){
          abort(404);
        }

    }
}
