<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use DB;

class index_1 extends Controller
{
    public function index()
    {
        $data = Cache::get('name1');
        if(empty($data)){
            $url = 'http://api.k780.com/?app=weather.future&weaid=1&appkey=45489&sign=39cd1885bffd65feeae2d1886434b358&format=json';
            $data = file_get_contents($url);
            $data = json_decode($data,1);
//        dd($data);
            $time = strtotime(date('Y-m-d 24:00:00'));
//            dd($time,time());
            Cache::put('name1',$data,$time);
//            dd(1);
        }
        return $data;

    }
    public function login()
    {
        return view('api/index_1/login');
    }
    public function login_do(Request $request)
    {
        $name = $request->input('name');
        $pwd = $request->input('pwd');
//        dd($date);
        $login = DB::connection('app')->table('login')->where([['name',$name],['pwd',$pwd]])->first();
//        dd($login);
        if(!$login){
            return json_encode(['code'=>201,'msg'=>'登录失败账号或密码错误']);
        }
        $token = md5($login->login_id.time());
        $time = time()+14400;
        $data = DB::connection('app')->table('login')->where('login_id',$login->login_id)->update(['token'=>$token,'time'=>$time]);
        if($data){
            return json_encode(['code'=>200,'msg'=>$token]);
        }
    }

    public function login_dd(Request $request)
    {
//        dd(1);
        $token = $request->input('token');
        $login = DB::connection('app')->table('login')->where('token',$token)->first();
        $time = time();
        $data = DB::connection('app')->table('login')->where('login_id',$login->login_id)->update(['time'=>$time]);
//        if($data){
//            return redirect('api/index_1/login');
//        }
    }

    public function select()
    {
        $index = $this->index()['result'];
//        dd($index);
//        $data = [];
//        $data[] = $index['result']['realTime'];
//        foreach($index['result']['futureDay'] as $v){
//            $data[] = $v;
//        }
//        dump($data);
        return json_encode($index);
//        return view('api/index_1/select',['data'=>$index]);
    }
}
