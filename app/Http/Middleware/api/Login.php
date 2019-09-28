<?php

namespace App\Http\Middleware\api;
use App\Http\Controllers\model\login as logins;

use Closure;
use GuzzleHttp\Psr7\Request;

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


        $denglu = $this->denglu($request);
//        var_dump($denglu);die;
        $mid_params = ['token'=>$denglu];
//        dd($mid_params);
        $request->attributes->add($mid_params);//添加参数

        return $next($request);
    }

    public function denglu($request)
    {
//        $token = $request->input('token');
        $token = $_SERVER["HTTP_TOKEN"]??'';
//        $jsp = $_GET['jsp'];
//        $data = ['token'];
//        var_dump($token);die;
        if(empty($token)){
//            dd(1);
            echo json_encode(['code'=>203,'msg'=>'请先登录']);die;
        }
        $login = logins::where('token',$token)->first();
//        dd($login);
        if(!$login){
            echo json_encode(['code'=>204,'msg'=>'token值不正确']);die;
        }
//        dd(2);
        if(($login->time) < time()){
            echo json_encode(['code'=>205,'msg'=>'请先登录']);die;
        }

//        echo $_SERVER;die;

        logins::where('token',$token)->update(['time'=>(time()+3600)]);
        return $token;
    }
}
