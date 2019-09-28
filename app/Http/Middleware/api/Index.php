<?php

namespace App\Http\Middleware\api;

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
//        header("Access-Control-Allow-Origin:*");
//        header('Access-Control-Allow-Methods:POST');
//        header('Access-Control-Allow-Headers:x-requested-with, content-type');


        header('Access-Control-Allow-Origin:*');
        // 响应类型
        header('Access-Control-Allow-Methods:*');
        //请求头
        header('Access-Control-Allow-Headers:*');
        // 响应头设置
        header('Access-Control-Allow-Credentials:false');
        //数据类型
        header('content-type:application:json;charset=utf8');


//        header("Access-Control-Allow-Origin:*");
//        header('Access-Control-Allow-Methods:*');
//        header('Access-Control-Allow-Headers:x-requested-with,content-type,USER_ID,TOKEN');

        return $next($request);
    }
}
