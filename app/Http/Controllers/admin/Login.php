<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Login extends Controller
{
    public function login()
    {
        return view('admin/login/login');
    }
    public function login_do(Request $request)
    {   
        $data = $request->all();
        $res = DB::table('user')->where([['name','=',$data['c_name']],['password','=',$data['password']]])->first();
//         dd($res);
        if($res){
            $sss = $request->session()->put('res', $res);
//            dd($sss);
//            $data = $request->session()->all();
//            dd($data);
            return redirect('admin/login/index');
        }else{
            echo '账号或密码不正确';
        }
    }
    public function tc(Request $request)
    {
        $request->session()->flush();
        return redirect('admin/login/login');
    }

    public function about()
    {
        return view('admin/login/about');
    }

    public function register()
    {
        return view('admin/login/register');
    }
    public function register_do(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $res = DB::table('user')->insert(['name'=>$data['c_name'],'password'=>$data['password'],'yx'=>$data['yx'],'reg_time'=>time()]);
        if($res){
            return redirect('admin/login/login');
        }else{
            echo '注册失败';
        }
    }

    public function index()
    {
        $data = DB::table('goods')->get();
//        dd($data);
        return view('admin/login/index',['data'=>$data]);
    }

    public function shop_single($id)
    {
//        dd($id);
        $data = DB::table('goods')->where([['id','=',$id]])->first();
//        dd($data);
        return view('admin/login/shop_single',['data'=>$data]);
    }


    public function cart_do(Request $request)
    {
        $id = $request->all();
//      dd($id);
        $value = $request->session()->get('res');
        $ress = DB::table('cart')->where([['goods_id','=',$id['id']],['uid','=',$value->id]])->first();
//        dd($ress);
        if($ress){
            $shuliang = ($ress->shuliang)+1;
            $res = DB::table('cart')->where([['id','=',($ress->id)],['uid','=',$value->id]])->update(['shuliang'=>$shuliang]);
            if($res){
                return redirect('admin/login/cart');
            }
        }else{
            $ids = DB::table('goods')->where([['id','=',$id['id']]])->first();
//          dd($ids->id);


//            Route::get('home', function () {
//
//                $value = session('res', 'id');
//
//            });
//            dd($value->id);
            $res = DB::table('cart')->insert(['goods_id'=>($ids->id),'goods_name'=>($ids->goods_name),'goods_pic'=>($ids->goods_pic),'goods_price'=>($ids->goods_price),'add_time'=>time(),'uid'=>($value->id)]);
            if($res){
                return redirect('admin/login/cart');
            }
        }

    }

    public function cart(Request $request)
    {
        $jiage = 0;
//        dd($res);
        $value = $request->session()->get('res');
        $data = DB::table('cart')->where([['uid','=',$value->id]])->get();
//        dd($data);
        foreach ($data as $v){
            $v = ($v->shuliang) * ($v->goods_price);
            $jiage +=$v;
        }
//        dd($jiage);
        return view('admin/login/cart',['data'=>$data,'jiage'=>$jiage]);
    }

}
