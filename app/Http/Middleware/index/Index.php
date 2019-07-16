<?php

namespace App\Http\Middleware\index;

use Closure;

class Index
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
//        dd($request->session()->has('data'));
        if(empty($request->session()->has('data'))){
            echo '请先登录';die;
        }else{

        }
        return $next($request);
    }
}
