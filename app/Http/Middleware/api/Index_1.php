<?php

namespace App\Http\Middleware\api;
use DB;

use Closure;

class Index_1
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
//        $token = $request->input('token');
//        if(empty($token)){
//            return redirect('api/index_1/login');
//        }
//        $login = DB::connection('app')->table('login')->where('token',$token)->first();
//        if(!$login){
//           return redirect('api/index_1/login');
//        }
//        if(($login->time)<time()){
//            return redirect('api/index_1/login');
//        }
//        $time = time()+14400;
//        DB::connection('app')->table('login')->where('login_id',$login->login_id)->update(['time'=>$time]);
        return $next($request);
    }
}
