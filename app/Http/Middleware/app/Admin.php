<?php

namespace App\Http\Middleware\app;

use Closure;

class Admin
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
        if(empty($request->session()->has('admin'))){
            return redirect('app/denglu');
        }else{
//            dd(2);

        }
        return $next($request);
    }
}
