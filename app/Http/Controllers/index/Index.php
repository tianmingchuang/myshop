<?php

namespace App\Http\Controllers\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Index extends Controller
{
    public function index()
    {
//        $redis = new \Redis();
//        $redis->connect('127.0.0.1','6379');
//        $redis->incr('num');
//        $num = $redis->get('num');
//        var_dump($num);
        return view('index/index/index');
    }
    public function index_do(Request $request)
    {
        $date = $request->all();
//        dd($date);
        $path = $request->file('pic');
//        dd($path);
        $file = '';
        if(empty($path)){
            echo '请选择上传图片';die;
        }else{
            $file = $path->store('goods');
            $file = ('/storage/'.$file);
        }
//        dd($file);
        $data = DB::table('goods')->insert(['goods_name'=>$date['c_name'],'goods_price'=>$date['price'],'goods_pic'=>$file,'add_time'=>time()]);
        if($data){
            return redirect('index/index/ecaa');
        }else{
            echo '添加失败';
        }
    }

    public function ecaa(Request $request)
    {
        $c_name = $request->all()??'';
//        dd($c_name);
        $sosuo = '';
        if(!empty($c_name['sosuo'])){
            $sosuo = $c_name['sosuo'];
            $data = DB::table('goods')->where('goods_name','like','%'.$c_name['sosuo'].'%')->paginate(2);
        }else{
            $data = DB::table('goods')->paginate(2);
        }
//        dd($data);
        return view('index/index/ecaa',['data'=>$data,'sosuo'=>$sosuo]);
    }

    public function update($id)
    {
        $data = DB::table('goods')->where([['id','=',$id]])->first();
//        dd($data);
        return view('index/index/update_do',['data'=>$data]);
    }
    public function update_do(Request $request)
    {
//        echo 111;
        $path = $request->file('pic');
        $data = $request->all();
//        dd($path);
        $file = '';
        if(empty($path)){
            $res = DB::table('goods')->where([['id','=',$data['id']]])->update(['goods_name'=>$data['c_name'],'goods_price'=>$data['price']]);
            if($res){
                return redirect('index/index/ecaa');
            }else{
                echo '修改失败';
            }
        }else{
            $file = $path->store('goods');
            $file = ('/storage/'.$file);
            $res = DB::table('goods')->where([['id','=',$data['id']]])->update(['goods_name'=>$data['c_name'],'goods_price'=>$data['price'],'goods_pic'=>$file]);
            if($res){
                return redirect('index/index/ecaa');
            }else{
                echo '修改失败';
            }
        }
    }

    public function delete($id)
    {
//        dd($id);
        $res = DB::table('goods')->delete($id);
        if($res){
            return redirect('index/index/ecaa');
        }else{
            echo '删除失败';
        }
    }

    public function login()
    {
        return view('index/index/login');
    }
    public function login_do(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $res = DB::table('user')->insert(['name'=>$data['c_name'],'password'=>$data['password'],'reg_time'=>time(),'yx'=>$data['yx']]);
        if($res){
            return redirect('index/index/logins');
        }else{
            echo 2;
        }
    }

    public function logins()
    {
        return view('index/index/logins');
    }
    public function logins_do(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $res = DB::table('user')->where([['name','=',$data['c_name']],['password','=',$data['password']]])->first();
//        dd($res->state);
        if($res){
            if(($res->state)<=1){
                echo '您为普通用户无法登录';die;
            }else{
                $request->session()->put('data', $res);
                return redirect('index/index/loginss');
            }
        }else{
            echo '账号或密码错误';
        }

    }
    public function tl(Request $request)
    {
        $request->session()->forget('data');
        return redirect('index/index/logins');
    }

    public function loginss(Request $request)
    {
        $value = $request->session()->get('data');
        if(($value->state)<=2){
            $data = DB::table('user')->where('state','<=',1)->get();
//            dd($data);
        }else if(($value->state)<=3){
            $data = DB::table('user')->where('state','<=',2)->get();
//            dd($data);
        }

//        dd($data);
        return view('index/index/loginss',['data'=>$data]);
    }

    public function hmd($id)
    {
//        dd($id);
        $data = DB::table('user')->where([['id','=',$id]])->update(['state'=>4]);
//        dd($data);
//        $res = DB::table('user')->where('')
        if($data){
            return redirect('index/index/loginss');
        }else{
            echo 2;
        }
    }
    public function hmd_do()
    {
//        if(){
            $data = DB::table('user')->where([['state','=',4]])->get();
            return view('index/index/hmd_do',['data'=>$data]);
//        }

//        dd($data);

    }
    public function hmd_dos($id)
    {
        $data = DB::table('user')->where([['id','=',$id]])->update(['state'=>1]);
//        dd($data);
        return redirect('index/index/loginss');
    }


    public function quanxian()
    {
        return view('index/index/quanxian');
    }

}
