<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
        $time = time();
//        dd($time);
//        $yi = 1563157429;
//        dd(strtotime(date('Y-m-d 09:00:00',time())));
//        $er = 1563181202;
        if($time<=strtotime(date('Y-m-d 09:00:00',time()))){
            echo '修改只有在九点之后才能操作';die;
        }else if($time>=strtotime(date('Y-m-d 17:00:00',time()))){
            echo '修改只有在十七点之前才能操作';die;
        }
        return $next($request);
    }
}
