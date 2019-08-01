<?php

namespace App\Http\Controllers\zho;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Login extends Controller
{
    public function index()
    {

//        dd($begin);
        return view('zho/login/index');
    }

    public function insert(Request $request)
    {
        $data = $request->all();
//        dd($data);

        $datas = DB::table('dd')->insert(['cc'=>$data['cc'],'cfd'=>$data['cfd'],'ddd'=>$data['ddd'],'jq'=>$data['jq'],'ps'=>$data['ps'],'cfsj'=>time(),'ddsj'=>time()+19689]);
        if ($datas){
            return redirect('zho/login/select');
        }else{
            echo 2;
        }
    }

    public function select(Request $request)
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $name='';
        $ss = $request->all()??'';
//        $sosuo = '';
        $ddd = $ss['ddd']??'';
        $cfd = $ss['cfd']??'';
        if(!empty($ss['cfd'])||!empty($ss['ddd'])){

//            if(!$redis->get('ticket_info')){
//                $data = json_decode($redis->get('ticket_info'),true);
//                $datas = $data['data'];
////                dd($datas);
//            }else{


//                $redis->incr("$ss[cfd]-$ss[ddd]");
//                $name = $redis->get("$ss[cfd]-$ss[ddd]");

//                $sosuo = $ss['cfd']||$ss['ddd'];
                $data = DB::table('dd')->where([['cfd','like','%'.$ss['cfd'].'%']])->where([['ddd','like','%'.$ss['ddd'].'%']])->paginate(6);
                $data = json_decode(json_encode($data),1);
                $datas = $data['data'];
                if($name>5){
                    $redis_info = json_encode($data);
                    $redis->set('ticket_info',$redis_info,3 * 6);
                }
//            }

            }else{
            $data = DB::table('dd')->paginate(10);
            $data = json_decode(json_encode($data),1);
            $datas = $data['data'];
        }
//        echo $ss;
        return view('zho/login/select',['datas'=>$datas,'ddd'=>$ddd,'cfd'=>$cfd,'name'=>$name]);
    }

    public function update($id)
    {
//        dd($id);
        $data = DB::table('dd')->where('id','=',$id)->first();
//        dd($data->ps);
        $datas = DB::table('dd')->where('id','=',$id)->update(['ps'=>($data->ps)-1]);
        if($datas){
            return redirect('zho/login/select');
        }
    }
}
