<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\model\login;

class kao extends Controller
{
    /**
     * 注册
     * @return false|mixed|string
     */
    public function login(Request $request)
    {
        $name = $request->input('name');
        $pwd = $request->input('pwd');
        $appsecret = md5($name.$pwd);
//        dd($pwd);
        $appid = rand('1111',9999);
//        dd($appid);
        $login = login::insert(['name'=>$name,'pwd'=>$pwd,'appsecret'=>$appsecret,'appid'=>$appid]);
        if($login){
            return json_encode(['code'=>200,'msg'=>'注册成功']);
        }
    }

    /**
     * 登录
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login_do()
    {
        return view('api/kao/login_do');
    }
    public function login_do1(Request $request)
    {
        $date = $request->all();
//        dd($date);
        $login = login::where([['name','=',$date['name']],['pwd','=',$date['pwd']]])->first()->toArray();
//        dd($login);
        $request->session()->put('id',$login['login_id'] );
        if($login){
            return redirect('api/kao/index');
        }else{
            return '账号或密码错误';
        }
    }

    /**
     * 登录成功展示
     */
    public function index(Request $request)
    {
        $id = $request->session()->get('id');
//        dd($id);
        $login = login::where('login_id',$id)->first();
//        dd($login);
        return view('api/kao/index',['login'=>$login]);
    }

    /**
     * 安全域名设置
     * @param Request $request
     */
    public function index_do(Request $request)
    {
        $name = $request->input('name');
        $id = $request->input('login_id');
        if(empty($name)){
            return json_encode(['code'=>201,'msg'=>'安全域名不能设置为空']);
        }
        $login = login::where('login_id',$id)->update(['yming'=>$name]);
        if($login){
            return json_encode(['code'=>202,'msg'=>'安全域名设置成功']);
        }
    }

    /**
     * 服务器端
     *
     */
    public function admin1()
    {
        $url = 'http://www.my_shop.com/api/kao/admin?appid=4125&&appsecret=4297f44b13955235245b2497399d7a93';
        $data = file_get_contents($url);
        dd($data);
    }
    
    public function admin(Request $request)
    {
        $appid = $request->input('appid');
        $appsecret = $request->input('appsecret');
        if(empty($appid) || empty($appsecret)){
//            dd(1);
            return json_encode(['code'=>203],JSON_UNESCAPED_UNICODE);
        }
        $login = login::where([['appid','=',$appid],['appsecret','=',$appsecret]])->first();
        if($login){
            $token = md5(rand('1111',9999).$appid);
            $time = time()+7200;
            $login1 = login::where('login_id',$login->login_id)->update(['token'=>$token,'time'=>$time]);
//            dd($login1);
            return json_encode(['code'=>204,'access_token'=>$token],JSON_UNESCAPED_UNICODE);
        }
        dd(1);


    }

    
}
