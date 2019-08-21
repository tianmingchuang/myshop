<?php

namespace App\Http\Middleware\wx\index_2;

use Closure;

class Zhokao
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
//        if(!empty($request->session()->has('add'))){
//            dd(1);
//        }else{
//            dd(2);
//        }
        return $next($request);
    }
}
