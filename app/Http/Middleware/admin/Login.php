<?php

namespace App\Http\Middleware\admin;

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
//        dd($request->session()->has('res'));
        if (empty($request->session()->has('res'))) {
            return redirect('admin/login/login');
        }else{

        }
        return $next($request);
    }
}
