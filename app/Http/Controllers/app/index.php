<?php

namespace App\Http\Controllers\app;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Tools\Wechat;
use App\http\model\kao;

class index extends Controller
{
    public $request;
    public $wechat;
    public function __construct(Request $request,Wechat $wechat)
    {
        $this->request = $request;
        $this->wechat = $wechat;
    }

    public function index(Request $request)
    {
//        dd(1);
        $name = $request->all();
//        dump($name);
//        $date1 = $name['name'];
//        $date2 = $name['sae'];
        $date = '';
        $date1 = '';
        if(empty($name)){
            $data = DB::table('aaa')->paginate(4);
        }else{
//            dump(11);
            $date = $name['name']??'';
            $date1 = $name['sae']??'';
//            dump($date1);
//            dd($date);
            $data = DB::table('aaa')->where([['c_name','like','%'.$date.'%'],['c_sae','like','%'.$date1.'%']])->paginate(4);
//            dd($data);
        }
//        dd();
        return view('app/index/index',['data'=>$data,'name'=>$date,'sae'=>$date1]);
    }

    public function update($id)
    {
        $data = DB::table('aaa')->where('id','=',$id)->first();
//        dd($data);
        return view('app/index/update',['data'=>$data]);
    }

    public function update_do(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $data = DB::table('aaa')->where('id','=',$data['id'])->update(['c_name'=>$data['c_name'],'c_sae'=>$data['c_sae']]);
        if($data){
            return redirect('app/index/index');
        }
    }

    public function delete($id)
    {
        $data = DB::table('aaa')->delete(['id'=>$id]);
//        dd($data);
        if($data){
            return redirect('app/index/index');
        }
    }

    public function kao()
    {
        $isContinue=false;//是否连续签到
		//签到功能
		$data = DB::table('dao')->where('u_id',1)->orderBy('id','desc')->first();//取当前用户最后一次签到的数据
        if($data){
        	$time =$data->time;
        	//获取当前凌晨的时间
        	$time0 = date("Y-m-d");//当前凌晨格式化时间
        	$time0=strtotime($time0);
        	if ($time>$time0) {
        		echo "<script>window.location.href='/',alert('亲，您已签到过了');</script>";
        	}
        	//判断时间是否是连续签到
        	if ($time<$time0 && $time>$time0-86400) {
        		$isContinue=true;
        	}
        }
		DB::table('dao')->insert([
              'time'=>time(),
              'u_id'=>1
		]);
		//送分 修改用户积分表
		$userDdata = DB::table('qian')->where("u_id",1)->first();
		//dd($userDdata);
		$day = $userDdata->day;
		$fen = $userDdata->fen;
		if ($isContinue && $day<5) {
			$day = $day+1;
			$fen = $fen+$day*5;
		}else{
			$day = 1;
			$fen =$fen+5;
		}
		$res=DB::table('qian')->where('u_id',1)->update([
			'fen'=>$fen,'day'=>$day
		]);
		echo "<script>window.location.href='/',alert('签到成功');</script>";

    }

    public function app()
    {
//        dd(1);
        $url = 'http://www.tianmingchuang.com/youjia';
        $data = $this->wechat->get($url);
        dd($data);
    }

    ///post方法
    function do_post($url, $params, $headers) {

        $ch = curl_init ();

        curl_setopt ( $ch, CURLOPT_URL, $url );

        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );

        curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );

        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $params );

        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );

        curl_setopt ( $ch, CURLOPT_TIMEOUT, 60 );        $result = curl_exec ( $ch );

        curl_close ( $ch );        return $result;

    }

    public function model()
    {
        $model = new kao;
        $data = $model->get();
//        dd($data);
        $data = json_encode($data);
//        dd($data);
        echo $data;
    }

    public function jieko()
    {
        $url = 'http://www.tianmingchuang.com/model';
        $data = $this->wechat->get($url);
        dd($data);
        dd(json_decode($data,1));
    }

}
