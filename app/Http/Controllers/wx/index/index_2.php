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
        dd($res);
    }

    public function login()
    {
        $redirect_uri = env('APP_URL').'/wx/index/index_2/code';
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
        $request->session()->forget('add');
        $request->session()->put('add', $res);
//        dd($res);
//        return $res['nickname'];
//        $res1 = $res['nickname'];
//        $request->session()->forget('name');
//        $request->session()->put('name', $res);
        return redirect('wx/index/index_2/index_3');

//        }
    }

    public function index_3(Request $request)
    {
//        dd($request->session()->has('add'));
        $value = $request->session()->get('add');
//        dd($value);
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
//        dd($data);
        $data = DB::connection('access')->table('wechat_openid')->where('id','=',$data['id'])->first();
//        dd($data);
        $value = $request->session()->get('add');
//        dd($value);
        return view('wx/index/index_2/index_4_do',['openid'=>$data->openid,'name'=>$value['nickname']]);
    }

    public function index_41(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $data21 = DB::connection('access')->table('wechat_openid')->where('openid','=',$data['openid'])->first();
        $value = $request->session()->get('add');
//        dd($value);
        $date = DB::connection('access')->table('kao')->insert(['faname'=>$value['openid'],'shoname'=>$data['openid'],'nr'=>$data['desc'],'name'=>$data21->ming]);
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
                    'value' => ': '.$data['desc'],
                    'color' => ''
                   ],
            ]
        ];
//        dd($data1);
        $res = $this->wechat->post($url,json_encode($data1));
        $res = json_decode($res,1);
        dd($res);
    }
//收到表白
    public function index_5(Request $request)
    {
//        dd(2);
        $value = $request->session()->get('add');
//        dd($value);

        $data = DB::connection('access')->table('kao')->where('shoname','=',$value['openid'])->get();
//        dd($data);
        return view('wx/index/index_2.index_5',['data'=>$data]);
    }
    //我的表白
    public function index_biao()
    {
//        dd(1);
        
    }
    //周考
    public function zhokao()
    {
//        dd(1);
        $redirect_uri = env('APP_URL').'/wx/index/index_2/zhokao_1';
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
//        dd($url);
        header('location:'.$url);
    }

    public function zhokao_1(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_APPSECRET').'&code='.$data['code'].'&grant_type=authorization_code';
        $res = file_get_contents($url);
        $res = json_decode($res,1)['openid'];
//        dd($res);
//        $url1 = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->wechat->index_1().'&openid='.$res.'&lang=zh_CN';
//        $res1 = file_get_contents($url1);
//        $res1 = json_decode($res1);
        $res1 = DB::connection('access')->table('wechat_openid')->where('openid','=',$res)->first();
//        dd($res1->ming);
        $url =  'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->wechat->index_1();
        $data1 = [
            'touser' => $res,
            'template_id' => 's_YzwGdD1NrLBTStf4D_qD88Sqa5OG8oZ3M8cK2QVSs',
            'data' => [
                'first' => [
                    'value' => '欢迎用户',
                    'color' => ''
                ],
                'keyword1' => [
                    'value' => ': '.$res1->ming.'登录成功',
                    'color' => ''
                ],
            ]
        ];
        $res = $this->wechat->post($url,json_encode($data1));
//        $res = json_decode($res,1);
        $data = DB::connection('access')->table('user')->get();
        return view('wx/index/index_2/zhokao_1',['data'=>$data,'date'=>$res1->ming,'id'=>$res1->id]);
    }

    public function zhokao_2(Request $request,$uid)
    {
        $data = $request->all();
//        dd($data);
//        dd($id);
//        $data1 = DB::connection('access')->table('openid')->where('id','=',$data['id'])->first();
//        dd($data);
        return view('wx/index/index_2/zhokao_2',['uid'=>$uid,'id'=>$data['id']]);
    }

    public function zhokao_2_do(Request $request)
    {
        $data = $request->all();
//        dd($data['id']);
        $date = DB::connection('access')->table('openid')->where('uid','=',$data['uid'])->first();
        $date2 = DB::connection('access')->table('wechat_openid')->where('id','=',$data['id'])->first();
//        dd($date);
        $date1 = DB::connection('access')->table('wechat_openid')->where('id','=',$data['uid'])->first();
//        dd($date1);
        $data1 = DB::connection('access')->table('zhokao')->insert(['liuyanxinxi'=>$data['desc'],'name'=>$date1->ming,'uid'=>$date1->id,'ly'=>$data['id']]);
//        dd($date->openid);
        $url =  'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->wechat->index_1();
        $data1 = [
            'touser' => $date->openid,
            'template_id' => 's_YzwGdD1NrLBTStf4D_qD88Sqa5OG8oZ3M8cK2QVSs',
            'data' => [
                'first' => [
                    'value' => '来自',$date2->ming,
                    'color' => ''
                ],
                'keyword1' => [
                    'value' => ': '.$data['desc'],
                    'color' => ''
                ],
            ]
        ];
        $res = $this->wechat->post($url,json_encode($data1));
        $res = json_decode($res,1);
        dd($res);

    }

    public function zhokao_3(Request $request)
    {
//        dd(1);
        $data = $request->all();

        $data = DB::connection('access')->table('zhokao')->where('ly','=',$data['id'])->get();
        return view('wx/index/index_2/zhokao_3',['data'=>$data]);
    }

    //油价
    public function youjia()
    {
//        dd(1);
//        $nextOpenId = 'otyo9wlzqGfvRSufGQvWJE-4Fumo';
//        $data = $this->wechat->app->user->list();  // $nextOpenId 可选
//        dd($data);
        $data = file_get_contents('http://apis.juhe.cn/cnoil/oil_city?key=cd7e681bc143aa60df4720461028a14f');
        dd($data);
//        $data = json_decode($data,1);
//        dd($data);
    }

    public function ceshi()
    {
//        $data = file_get_contents(env('APP_URL').'/youjia');
        $data = file_get_contents('http://www.tianmingchuang.com/youjia');
//        dd($data);
        dd(json_decode($data,1));
    }

    public function aaa()
    {
        $data = DB::table('kao')->get();
        dd($data);
    }
}
