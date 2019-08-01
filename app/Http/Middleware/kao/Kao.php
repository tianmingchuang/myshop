<?php

namespace App\Http\Middleware\kao;

use Closure;

class Kao
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
//        dd(1);
//        dd($request->session()->has('add'));
        if($request->session()->has('add')){

        }else{
            return redirect('kao/index/login');
        }
        return $next($request);
    }
}
