<?php

namespace App\Http\Controllers\zho;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class login_3 extends Controller
{
    public function index()
    {
        return view('zho/login_3/index');
    }

    public function index_do(Request $request)
    {
        $data = $request->input();
//        dd($data['name1']);
//        $data = $request->all();
//        dd($data);
        $shijian = $data['shijian'];
//        $shijians = time()+600;
//        dd($shijian);
        $shijians = strtotime(date("Y-m-d $shijian",time()));
//        dd($shijians);
        $date = DB::table('login_3')->insert(['name1'=>$data['name1'],'name2'=>$data['name2'],'shijian'=>$shijians]);
//        dd($date);
        if ($date){
//            return redirect('zho/login_3/ecaa');
            echo json_encode(['msg'=>'添加成功','code'=>1]);
        }else{
            echo 2;
        }
    }

    public function ecaa()
    {
        $data = DB::table('login_3')->get();
//        dd($data);
        return view('zho/login_3/ecaa',['data'=>$data]);
    }

    public function ecaa_do($id)
    {
//        dd($id);
        $data = DB::table('login_3')->where('id','=',$id)->get();
//        dd($data);
        return view('zho/login_3/ecaa_do',['data'=>$data]);
    }

    public function ecaa_do_1(Request $request)
    {
        $data = $request->all();
//        dd($data['name1']);
        $value = $request->session()->pull('daan');
        $date = DB::table('login_3')->where('id','=',$data['id'])->update(['daan'=>$data['daan']]);
        if($date){
            $daan = $data['daan'];
//            dd($daan);
            $sss = $request->session()->put('daan',$daan );
            return redirect('zho/login_3/ecaa');
        }else{
            echo 2;
        }
    }

    public function login()
    {
        $data = DB::table('login_3')->get();
//        dd($data);
        return view('zho/login_3/login',['data'=>$data]);
    }

    public function login_do($id)
    {
        $data = DB::table('login_3')->where('id','=',$id)->get();
//        dd($data);
        return view('zho/login_3/login_do_1',['data'=>$data]);
    }

    public function login_do_1(Request $request)
    {
        $data = $request->all();
//        dd($data);
//        $value = $request->session()->pull('daan');
        $date = DB::table('login_3')->where('id','=',$data['id'])->update(['daans'=>$data['daans']]);
        if($date){
//            $daan = $data['daan'];
//            dd($daan);
//            $sss = $request->session()->put('daan',$daan );
            return redirect('zho/login_3/login');
        }else{
            echo 2;
        }
    }

    public function ec($id)
    {
        $data = DB::table('login_3')->where('id','=',$id)->first();
//        $shijian = $data->shijian;
//        if($shijian<time()){
//
//        }else{
//
//        }
//        dd($data->shijian);
        return view('zho/login_3/ec',['data'=>$data]);
    }

    public function login_do_2($id)
    {
//        dd($id);
        $data = DB::table('login_3')->where('id','=',$id)->first();
        return view('zho/login_3/login_do_2',['data'=>$data]);
    }
}
