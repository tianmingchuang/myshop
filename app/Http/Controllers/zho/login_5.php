<?php

namespace App\Http\Controllers\zho;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class login_5 extends Controller
{
    public function login()
    {
        return view('zho/login_5/login');
    }

    public function login_do(Request $request)
    {
//        echo 1;die;
        $data = $request->all();
//        dd($data);
        $date = DB::table('user')->where([['name','=',$data['name1']],['password','=',$data['pwd']]])->first();
//        dd($date);
        if ($date){
            $sss = $request->session()->put('date', $date);
            return redirect('zho/login_5/index_1');
        }else{
            echo "密码或账号错误";die;
        }
    }


    public function index_1()
    {
        $data = DB::table('login_41')->where('id','=',1)->first();
//        dd($data);
//        $shu = $data->name;
//        dd($shu);
        $datas = DB::table('login_41')->where('id','=',2)->first();
//        $date = DB::table('login_4')->get();

//        $shuliang = $shu -
        return view('zho/login_5/index_1',['data'=>$data,'datas'=>$datas]);
    }

    //车辆入库
    public function index_11()
    {
        return view('zho/login_5/index_11');
    }
    public function index_111(Request $request)
    {
//        echo 1;die;
        $data = $request->all();
//        dd($data);
        $date = DB::table('login_4')->insert(['name'=>$data['c_name'],'add_time'=>time()]);
        if($data){
            $datas = DB::table('login_41')->where('id','=',2)->first();
            $res = ($datas->name)-1;
            $datas = DB::table('login_41')->where('id','=',2)->update(['name'=>$res]);
//            return redirect('zho/login_4/index_1');
            header('Refresh:2;url=index_1');
            echo "<h2>车辆入库成功</h2>";
        }
    }

    //车辆出库
    public function index_12()
    {
        return view('zho/login_5/index_12');
    }

    public function index_121(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $date = DB::table('login_4')->where('name','=',$data['c_name'])->first();
//        dd($date->zhuangtai);
        if(($date->zhuangtai)==0){
            echo "已出库";die;
        };
        $time = time()-($date->add_time);
//        dd($time);
//        $times = ($time/60);

        $hour=floor($time%86400/60);
        $hours=floor($time%86400/3600);
        $times = $hour%60;
//        dd($hour);
        $shijian = ("$hours 时 $times 分");
//        dd($shijian);

        $value = $request->session()->pull('ids');
        $sss = $request->session()->put('ids', $date);

        if($hour>15){
            if($hour>15 && $hour<360){
                $aa = ceil($hour/30);
//                dd($aa);
                $aaa = $aa*2;
//                dd($aaa);
                $dates = DB::table('login_4')->where('name','=',$data['c_name'])->update(['zhuangtai'=>0,'time'=>time(),'qianshu'=>$aaa,'shijian'=>$shijian]);
                if($data){
                    $datas = DB::table('login_41')->where('id','=',2)->first();
                    $res = ($datas->name)+1;
                    $datas = DB::table('login_41')->where('id','=',2)->update(['name'=>$res]);
//            return redirect('zho/login_4/index_1');
                    header('Refresh:2;url=index_13');
                    echo "<h2>车辆出库成功</h2>";
                }
            }
            if($hour>15 && $hour>360){
                $aa = $hour-360;
//                dd($aa);
                $as = 12*2;
                $aaa = ceil($aa/60)*1;
                $ass = $as+$aaa;
//                dd($aaa);
                $dates = DB::table('login_4')->where('name','=',$data['c_name'])->update(['zhuangtai'=>0,'time'=>time(),'qianshu'=>$ass,'shijian'=>$shijian]);
                if($data){
                    $datas = DB::table('login_41')->where('id','=',2)->first();
                    $res = ($datas->name)+1;
                    $datas = DB::table('login_41')->where('id','=',2)->update(['name'=>$res]);
//            return redirect('zho/login_4/index_1');
                    header('Refresh:2;url=index_13');
                    echo "<h2>车辆出库成功</h2>";
                }
            }
        }else{
            $dates = DB::table('login_4')->where('name','=',$data['c_name'])->update(['zhuangtai'=>0,'time'=>time(),'qianshu'=>0,'shijian'=>$shijian]);
            if($data){
                $datas = DB::table('login_41')->where('id','=',2)->first();
                $res = ($datas->name)+1;
                $datas = DB::table('login_41')->where('id','=',2)->update(['name'=>$res]);
//            return redirect('zho/login_4/index_1');
                header('Refresh:2;url=index_13');
                echo "<h2>车辆出库成功</h2>";
            }
        }


    }

    public function index_13(Request $request)
    {
        $ids = $request->session()->get('ids');
        $data = DB::table('login_4')->where('id','=',$ids->id)->first();
//        dd($data);
        return view('zho/login_5/index_13',['data'=>$data]);
    }
}
