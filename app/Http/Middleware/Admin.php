<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:44 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:41 AM
 * Copyright (c) 2019 . All rights reserved
 */

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
