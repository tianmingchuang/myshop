<?php

namespace App\Http\Middleware\zho;

use Closure;

class Login_2
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
            return redirect('zho/login_2/login');
        }else{

        }
        return $next($request);
    }
}
