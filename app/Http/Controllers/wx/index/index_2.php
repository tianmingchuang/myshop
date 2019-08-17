<?php

namespace App\Http\Controllers\wx\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use DB;
use App\Http\Tools\Wechat;
use Illuminate\Support\Facades\Storage;

class index_2 extends Controller
{
    public $request;
    public $wechat;
    public function __construct(Request $request,Wechat $wechat)
    {
        $this->request = $request;
        $this->wechat = $wechat;
    }


    //表白菜单展示
    public function index()
    {
        return view('wx/index/index_2/index');
    }

    public function index_do(Request $request)
    {
        $data = $request->all();
//        dd($data);
        if (empty($data['er_name'])){
//            echo 1;
            $date = DB::connection('access')->table('biaobai')->insert(['caidan'=>$data['caidan'],'yi_name'=>$data['yi_name'],'biaoshi'=>$data['biaoshi'],'leixing'=>$data['leixing']]);
            if($date){
                return redirect('wx/index/index_2/index_1');
            }
        }else{
//            echo 2;
            $date = DB::connection('access')->table('biaobai')->insert(['caidan'=>$data['caidan'],'yi_name'=>$data['yi_name'],'biaoshi'=>$data['biaoshi'],'leixing'=>$data['leixing'],'er_name'=>$data['er_name']]);
//            dd($date);
            if($date){
                return redirect('wx/index/index_2/index_1');
            }
        }
    }

    public function index_1()
    {
        $data = DB::connection('access')->table('biaobai')->get();
//        dd($data);
        return view('wx/index/index_2/index_1',['data'=>$data]);
    }

    public function index_2()
    {
//        dd(1);
        $data2 = DB::connection('access')->table('biaobai')->groupBy('yi_name')->select(['yi_name'])->get()->toArray();
//        dd($data);
        foreach($data2 as $vi){
            $data1 = DB::connection('access')->table('biaobai')->where('yi_name','=',$vi->yi_name)->get()->toArray();
//            dump($data1);
            $sub_button = [];
            foreach($data1 as $v){
//                dump($v);
                if($v->caidan==1){
//                    echo 1;
                    if($v->leixing=='click'){
                        $data['button'][] = [
                            'type' => $v->leixing,
                            'name' => $v->yi_name,
                            'key'  => $v->biaoshi
                        ];
                    }else{
                        $data['button'][] = [
                            'type' => $v->leixing,
                            'name' => $v->yi_name,
                            'url'  => $v->biaoshi
                        ];
                    }
                }else if ($v->caidan==2){
//                    echo 2;
                    if($v->leixing=='click'){
                        $sub_button[] = [
                            'type' => $v->leixing,
                            'name' => $v->yi_name,
                            'key'  => $v->biaoshi
                        ];
                    }else{
                        $sub_button[] = [
                            'type' => $v->leixing,
                            'name' => $v->yi_name,
                            'url'  => $v->biaoshi
                        ];
                    }
                }
            }
            if(!empty($sub_button)){
                $data['button'][] = ['name'=>$vi->yi_name,'sub_button'=>$sub_button];
            }
        }
//        dd($data);
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->wechat->index_1();
//        dd($url);
        $res = $this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
//        dd($res);
        $res = json_decode($res,1);
//        dd($res);
    }

    public function login()
    {
        $redirect_uri = 'http://www.my_shop.com/wx/index/index_2/code';
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
        header('location:'.$url);
    }

    public function code(Request $request)
    {
        $data = $request->all();
//        dd($data['code']);
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET').'&code='.$data['code'].'&grant_type=authorization_code';
//        dd($url);
        $url = file_get_contents($url);
        $data1 = json_decode($url,1);
//        dd($data1);
//        $data1 = 'otyo9wlzqGfvRSufGQvWJE-4Fumo';
        $url1 = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->wechat->index_1().'&openid='.$data1['openid'].'&lang=zh_CN';
//        dd($url1);
        $res = file_get_contents($url1);
//        dd($res);
        $res = json_decode($res,1);
//        dd($res);
//        return $res['nickname'];
//        $res1 = $res['nickname'];
//        $request->session()->forget('name');
//        $request->session()->put('name', $res);
        return redirect('index/index_2/index_3');

//        }
    }

    public function index_3()
    {
        return view('wx/index/index_2/index_3');
    }
//我要表白
    public function index_4(Request $request)
    {
        $data = $request->all();
//        dd($data);

//        dd(1);
//        $url = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$this->wechat->index_1().'&next_openid=';
//        $res = file_get_contents($url);
//        $res = json_decode($res,1)['data']['openid'];
//        dd($res);
//        foreach($res as $v){
//            dump($v);

//        }
        $data = DB::connection('access')->table('wechat_openid')->get();
//        dd($data);
        return view('wx/index/index_2/index_4',['data'=>$data]);

    }

    public function index_4_do(Request $request)
    {
//        $name = $this->code();
//        dd($name);
        $data = $request->all();
//        dd($data['id']);
        return view('wx/index/index_2/index_4_do',['openid'=>$data['id']]);
    }

    public function index_41(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->wechat->index_1();
        $data1 = [
            'touser' => $data['openid'],
            'template_id' => 's_YzwGdD1NrLBTStf4D_qD88Sqa5OG8oZ3M8cK2QVSs',
            'data' => [
                'first' => [
                    'value' => '来自'.$data['radio'].'的表白',
                    'color' => ''
                   ],
                'keyword1' => [
                    'value' => ':'.$data['desc'],
                    'color' => ''
                   ],
            ]
        ];
        $res = $this->wechat->post($url,json_encode($data1));
        $res = json_decode($res,1);
        dd($res);
    }
//收到表白
    public function index_5()
    {
        dd(2);
    }
}
