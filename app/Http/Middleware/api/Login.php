<?php

namespace App\Http\Middleware\api;
use App\Http\Controllers\model\login as logins;

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
        $token = $request->input('token');
        if(empty($token)){
//            dd(1);
            return json_encode(['code'=>203,'msg'=>'请先登录']);
        }
        $login = logins::where('token',$token)->first();
//        dd($login);
        if(!$login){
            return json_encode(['code'=>204,'msg'=>'token值不正确']);
        }
//        dd(2);
        if(($login->time) < time()){
            return json_encode(['code'=>205,'msg'=>'请先登录']);
        }
        logins::where('token',$token)->update(['time'=>(time()+3600)]);
        return $next($request);
    }
}
