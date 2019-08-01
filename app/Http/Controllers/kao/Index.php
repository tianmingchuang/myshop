<?php

namespace App\Http\Controllers\kao;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Index extends Controller
{
    public function login()
    {
        return view('kao/index/login');
    }

    public function login_do(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $date = DB::table('user')->where([['name','=',$data['c_name']],['password','=',$data['pwd']]])->first();
//        dd($date);
        if($date){
            $request->session()->forget('add');
            $request->session()->put('add', $date);
            return redirect('kao/index/index');
        }else{
            echo "账号或密码错误";
        }
    }

    public function index(Request $request)
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $redis->incr('add');
        $name = $redis->get('add');
        $value = $request->session()->get('add');
//        dd($data);
        $c_name = $request->all();
//        var_dump($c_name['c_name']);
        $xm = '';
        if(!empty($c_name['c_name'])){
            $xm = $c_name['c_name'];
//            dd($xm);
            $data = DB::table('kao')->where('xm','like','%'.$xm.'%')->get();
//            var_dump(3);
        }else{
//            dd(1);
            $data = DB::table('kao')->get();
//            $datas = json_encode($data);
////            dd($datas);
//            $redis->incr('asd',$datas);
//            $name = $redis->get('asd');
////            var_dump(2);
//            dd($name);


        }
        return view('kao/index/index',['data'=>$data,'value'=>$value,'name'=>$name]);

    }

    public function index_do(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $value = $request->session()->get('add');
//        dd($value);
        $date = DB::table('kao')->insert(['user'=>($value->id),'ly'=>$data['a_name'],'c_name'=>($value->name),'time'=>time(),'xm'=>($value->name)]);
//        dd($date);
        if($date){
            return redirect('kao/index/index');
        }else{
            echo "发布失败";
        }
    }

    public function index_1($id)
    {
        $data = DB::table('kao')->where('id','=',$id)->delete();
//        dd($data);
        if($data){
            return redirect('kao/index/index');
        }else{
            echo "删除失败";
        }
    }
}
