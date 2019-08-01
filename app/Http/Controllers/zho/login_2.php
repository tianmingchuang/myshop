<?php

namespace App\Http\Controllers\zho;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class login_2 extends Controller
{
    public function login()
    {
        return view('zho/login_2/login');
    }
    public function login_do(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $res = DB::table('user')->where([['name','=',$data['c_name']],['password','=',$data['password']]])->first();
//         dd($res);
        if($res){
            $sss = $request->session()->put('user', $res);
            return redirect('zho/login_2/ecaa');
        }else{
            echo '账号或密码不正确';
        }
    }

    public function ecaa()
    {
//        dd(1);
        return view('zho/login_2/ecaa');
    }

    public function index(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $date = DB::table('login_2')->insertGetId(['name'=>$data['c_name']]);
//        dd($date);
        if ($date){
            $value = $request->session()->pull('id');
            $sss = $request->session()->put('id', $date);
            return redirect('zho/login_2/index_do');
//            echo 1;
        }else{
            echo 2;
        }
    }

//    public function index_do_do()
//    {
//        $date = DB::table('login_2')->get();
////        dd($date);
////        dd(1);
//        return view('zho/login_2/index_do_do',['data'=>$date]);
//    }

    public function index_do()
    {
//        dd($id);
        return view('zho/login_2/index_do');
    }

    public function index_do_1(Request $request)
    {
        $data = $request->all();
//        dd($data);

        $value = $request->session()->pull('ids');
//        dd($value);
        if($data['a_name']==2){
            $res = DB::table('login_21')->insertGetId(['name'=>$data['c_name'],'tixing'=>$data['a_name'],'login_2'=>$data['id']]);
            if($res){

                $sss = $request->session()->put('ids', $res);
                return redirect('zho/login_2/index_do_2');
            }else{
                echo 2;
            }
        }else if($data['a_name']==3){
            $res = DB::table('login_21')->insertGetId(['name'=>$data['c_name'],'tixing'=>$data['a_name'],'login_2'=>$data['id']]);
            if($res){
//                $value = $request->session()->pull('id', $res);
                $sss = $request->session()->put('ids', $res);
                return redirect('zho/login_2/index_do_3');
            }else{
                echo 4;
            }
        }
    }

    public function index_do_2(Request $request)
    {
        $value = $request->session()->get('ids');
        $date = DB::table('login_21')->where('id','=',$value)->first('name');
//        dd($date);
        return view('zho/login_2/index_do_2',['date'=>$date]);
    }

    public function index_do_2_do(Request $request)
    {
//        dd($request->session()->has('id'));
        $login_2 = $request->session()->get('id');
//        dd($login_2);
        $login_21 = $request->session()->get('ids');
        $data = $request->all();
//        dd($data);
        $date = DB::table('login_22')->insert(['name1'=>$data['name_1'],'name2'=>$data['name_2'],'name3'=>$data['name_3'],'name4'=>$data['name_4'],'daan'=>$data['c_name'],'login_2'=>$login_2,'login_21'=>$login_21]);
        if($date){
            return redirect('zho/login_2/eca');
        }else{
            echo 2;
        }

    }

    public function index_do_3(Request $request)
    {
        $value = $request->session()->get('ids');
        $date = DB::table('login_21')->where('id','=',$value)->first('name');
//        dd($date);
        return view('zho/login_2/index_do_3',['date'=>$date]);
    }
    public function index_do_3_do(Request $request)
    {
        $login_2 = $request->session()->get('id');
//        dd($login_2);
        $login_21 = $request->session()->get('ids');
        $data = $request->all();
//        dd($data);
        $daan = implode(",", $data['name1']);
        $date = DB::table('login_22')->insert(['name1'=>$data['name_1'],'name2'=>$data['name_2'],'name3'=>$data['name_3'],'name4'=>$data['name_4'],'daan'=>$daan,'login_2'=>$login_2,'login_21'=>$login_21]);
        if($date){
            return redirect('zho/login_2/eca');
        }else{
            echo 2;
        }
    }


    public function eca()
    {
//        dd(1);
        $data = DB::table('login_2')->paginate(5);
        return view('zho/login_2/eca',['data'=>$data]);
    }

    public function delete($id)
    {
        $data = DB::table('login_2')->where('id','=',$id)->delete();
        $data = DB::table('login_21')->where('login_2','=',$id)->delete();
        $data = DB::table('login_22')->where('login_2','=',$id)->delete();
        if($data){
            return redirect('zho/login_2/eca');
        }
    }


    public function select(Request $request,$id)
    {
        $value = $request->session()->pull('idss');
        $sss = $request->session()->put('idss', $id);
        return view('zho/login_2/select');
    }

    public function select_do($id)
    {
//        dd($id);
        $data = DB::table('login_2')->where('id','=',$id)->get();
//        dd($data);
        $datas = DB::table('login_21')->where('login_2','=',$id)->get();
//        dd($datas);
        $datass = DB::table('login_22')->where('login_2','=',$id)->get();
        return view('zho/login_2/select_do',['data'=>$data,'datas'=>$datas,'datass'=>$datass]);
    }
}
