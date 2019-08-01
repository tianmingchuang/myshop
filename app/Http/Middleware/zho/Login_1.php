<?php

namespace App\Http\Middleware\zho;

use Closure;

class Login_1
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
        if(empty($request->session()->has('user'))){
            return redirect('zho/login_1/login');
        }else{

    }
        return $next($request);
    }
}
