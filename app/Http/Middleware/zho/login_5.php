<?php

namespace App\Http\Middleware\zho;

use Closure;

class login_5
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
        if(empty($request->session()->has('date'))){
            return redirect('zho/login_5/index');
        }else{

        }
        return $next($request);
    }
}
