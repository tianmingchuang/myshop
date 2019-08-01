<?php

namespace App\Http\Controllers\zho;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Login_1 extends Controller
{
    public function login()
    {
        return view('zho/login_1/login');
    }
    public function login_do(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $res = DB::table('user')->where([['name','=',$data['c_name']],['password','=',$data['password']]])->first();
//         dd($res);
        if($res){
            $sss = $request->session()->put('user', $res);
            return redirect('zho/login_1/ecaas');
        }else{
            echo '账号或密码不正确';
        }
    }

    public function index()
    {
        return view('zho/login_1/index');
    }

    public function index_do(Request $request)
    {
        $data = $request->all();
        dd($data);
    }
    public function index_do_1()
{
//        echo 1;die;
    return view('zho/login_1/index_do_1');
}
    public function index_do_2()
    {
        return view('zho/login_1/index_do_2');
    }
    public function index_do_3()
    {
        return view('zho/login_1/index_do_3');
    }
    public function index_do_1_do(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $datas = DB::table('ti')->insert(['a_name'=>$data['name'],'c_name'=>$data['c_name'],'name_1'=>$data['name_1'],'name_2'=>$data['name_2'],'name_3'=>$data['name_3'],'name_4'=>$data['name_4'],'name2'=>1]);
        if($datas){
            return redirect('zho/login_1/ecaa');
        }else{
            echo 2;
        }
    }
    public function index_do_2_do(Request $request)
    {
        $data = $request->all();
        $name1 = implode(",", $data['name1']);
//        dd($name1);
//        dd($data['name1']);
        $datas = DB::table('ti')->insert(['a_name'=>$data['name'],'name_1'=>$data['name_1'],'name_2'=>$data['name_2'],'name_3'=>$data['name_3'],'name_4'=>$data['name_4'],'name1'=>$name1,'name2'=>2]);
        if($datas){
            return redirect('zho/login_1/ecaa');
        }else{
            echo 2;
        }
    }
    public function index_do_3_do(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $datas = DB::table('ti')->insert(['c_name'=>$data['c_name'],'a_name'=>$data['name'],'name2'=>3]);
        if($datas){
            return redirect('zho/login_1/ecaa');
        }else{
            echo 2;
        }
    }

    public function ecaa()
    {
        $data = DB::table('ti')->get();
//        dd($data);
//        $datas = DB::table('ti')->where('name2','=',2)->get();
//        $datass = DB::table('ti')->where('name2','=',3)->get();
        return view('zho/login_1/ecaa',['data'=>$data]);
    }

    public function ecaas()
    {
        return view('zho/login_1/ecaas');
    }

    public function eca(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $name3 = implode(",", $data['name1']);
//        $name3 = $data['name1'];
//        $name3 = json_encode($name3);
//        dd($name3);
        $date = DB::table('tis')->insert(['name'=>$name3,'c_name'=>$data['c_name']]);
        if($date){
            return redirect('zho/login_1/ec');
        }else{
            echo 2;
        }
    }

    public function ec()
    {
        $data = DB::table('tis')->get();
//        dd($data);
        return view('zho/login_1/ec',['data'=>$data]);
    }

    public function ea($id)
    {
//        dd($id);
        $data = DB::table('tis')->where('id','=',$id)->first('name');
        dd($data);
//        $data = json_encode($data);
//        $date = json_decode($data,1);
//        dd($date);
//        foreach ($data as $v){
//            $vs = print_r(explode(',', $v));
//                echo $vs;


           $datas = DB::table('ti')->where([['id','=',$data['name']]])->get();
        return view('zho/login_1/ea',['data'=>$datas]);

//        }

    }
}
