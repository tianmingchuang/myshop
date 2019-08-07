<?php

namespace App\Http\Controllers\wx\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use DB;
use App\Http\Tools\Wechat;

class index_1 extends Controller
{
    public $request;
    public $wechat;
    public function __construct(Request $request,Wechat $wechat)
    {
        $this->request = $request;
        $this->wechat = $wechat;
    }


    public function index()
    {
        $data = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".env('WECHAT_APPID')."&secret=".env('WECHAT_APPSECRET'));
//        dd($data);
        $data = json_decode($data);
        $data = $data->access_token;
        $data = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/get?access_token={$data}&next_openid=");
//        dd($data);
        $data = json_decode($data,1);
        dd($data);
    }



    public function index_2()
    {
        $redis = $this->wechat->index_1();
//        dd($redis);
        $data1 = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/get?access_token={$redis}&next_openid=");
//        dd($data);
        $data2 = json_decode($data1,1);
        $data3 = $data2['data'];
        foreach($data3['openid'] as $v){
            $datas  = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$redis."&openid=".$v."&lang=zh_CN");
            $datas = json_decode($datas,1);
//            dump($datas);
            $datass[] = $datas;
        }
        foreach($datass as $v){
            $info = DB::connection('access')->table('wechat_openid')->where(['openid'=>$v['openid']])->value('openid');
            if(empty($info)){
                $date = DB::connection('access')->table('wechat_openid')->insert(['openid'=>$v['openid'],'add_time'=>$v['subscribe_time'],'subscribe'=>$v['subscribe'],'toxiang'=>$v['headimgurl'],'ming'=>$v['nickname']]);

            }
        }

            echo "<script>history.go(-1)</script>";

    }
    public function index_3()
    {
        $data = DB::connection('access')->table('wechat_openid')->get();
//        dd($data);
        return view('wx/index/index_1/index_3',['data'=>$data]);
    }

    public function index_4($id)
    {
        $redis = $this->wechat->index_1();
//        dd($redis);
        $data = DB::connection('access')->table('wechat_openid')->where('id','=',$id)->first();
//        dd($data->id);
//        dd($id);
        $data  = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$redis."&openid=".$data->openid."&lang=zh_CN");
//        dd($data);
        $data = json_decode($data,1);
//        dd($data);
        return view('wx/index/index_1/index_4',['data'=>$data]);
    }

    public function code(Request $request)
    {
//        dd(1);
        $req = $request->all();
//        dd($req['code']);
        $code = $req['code'];
//        dd($code);
        $url = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".env('WECHAT_APPID')."&secret=".env('WECHAT_APPSECRET')."&code=".$code."&grant_type=authorization_code");
//        dd($url);
        $data1 = json_decode($url,1);
//        dd($data1);
        $access_token = $data1['access_token'];
        $openid = $data1['openid'];

//        dd($openid);
        $date = DB::connection('access')->table('openid')->where('openid','=',$openid)->first();
//        dd($date);
        if($date){
            $redis = $this->wechat->index_1();
            $openid = $openid;
            dd($openid);
            $data12  = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$redis."&openid=".$openid."&lang=zh_CN");
            $data13 = json_decode($data12,1);
            $name = $data13['nickname'];
            $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->wechat->index_1();
//            $data14  = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$redis."&openid=".$openid."&lang=zh_CN");
            $datas = [
                'touser' => $openid,
                "template_id" => "53w5j-cN7LVvHUNRDsemMqS--etWGo35oucNIshifmk",
//                "url" => "http://www.baidu.com",
                'data' => [
                    "first" => [
                        "value" => "欢迎{$name}登录",
                        "color" => ""
                    ]
                ]
            ];
            $re = $this->wechat->post($url,json_encode($datas));
            $request->session()->put('data', $date);
            return redirect('index/index/index');
        }else{
            $data = DB::connection('access')->table('openid')->insert(['openid'=>$openid]);
            if($data){
                $request->session()->put('data', $data);
                return redirect('index/index/index');
            }else{
                echo "失败";
            }

        }
    }

    public function login()
    {
//        dd(11);
        $redirect_uri = 'http://www.my_shop.com/wx/index/index_1/code';
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect';
        header('location:'.$url);
    }


    //模板列表
    public function template_list()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/template/get_all_private_template?access_token='.$this->wechat->index_1();
        $res = file_get_contents($url);
        dd(json_decode($res));
    }
    
    //模板删除
    public function del_temlate()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/template/del_private_template?access_token='.$this->wechat->index_1();
        $data = [
            "template_id" => "Il3uuNaukr8qmefHiX8BLoEMHg5QdnqDQAygCtfbfug"
        ];
        $res = $this->wechat->post($url,json_encode($data));
        dd($res);
    }
    
    //模板信息推送
    public function push_template()
    {
        $openid = 'otyo9wpROjxQB1BvKyAugQZQo-7I';
        $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$this->wechat->index_1();
        $datas = [
            'touser' => $openid,
            "template_id" => "yWIucYjcgx9YKMANULEsN0PFK9gg0LuLqF4P9Hc75js",
            "url" => "http://www.baidu.com",
            'data' => [
                "first" => [
                    "value" => "欢迎",
                    "color" => ""
                ]
            ]
        ];
        $res = $this->wechat->post($url,json_encode($datas));
        dd($res);
    }


    //图片  音频   视频  缩略图 上传
    public function index_5()
    {
        return view('wx/index/index_1/index_5');
    }

    //接收
    public function index_5_do(Request $request,Client $client)
    {
//
//        $upload_type = $request['up_type'];
//        $re = '';
//        if($request->hasFile('image')){
//            //图片类型
//            $re = $this->wechat->upload_source($upload_type,'image');
//        }elseif($request->hasFile('voice')){
//            //音频类型
//            //保存文件
//            $re = $this->wechat->upload_source($upload_type,'voice');
//        }elseif($request->hasFile('video')){
//            //视频
//            //保存文件
//            $re = $this->wechat->upload_source($upload_type,'video','视频标题','视频描述');
//        }elseif($request->hasFile('thumb')){
//            //缩略图
//            $path = $request->file('thumb')->store('wechat/thumb');
//        }
//        echo $re;
//        dd();

        $client = new Client();
        $data = $request->all('up_type');
//        dd($data);
        $data = $data['up_type'];
//        dd($data);
        if($data==2){
//            dd(2);
            $path = $request->file('image')->store('index_5');
            $path = './storage/' . $path;
            $url = 'https://api.weixin.qq.com/cgi-bin/material/add_news?access_token='. $this->wechat->index_1() ;
//            $url=  'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=' . $this->get_access_token().'&type='.$type;
//            $url = 'https://api.weixin.qq.com/cgi-bin/material/add_material?access_token='.$this->get_access_token().'&type='.$type;
        }else if($data==1) {

//            dd(1);
            if ($request->hasFile('image')) {
//            dd($request->file('image'));
                $path = $request->file('image')->store('index_5');
                $path = './storage/' . $path;
//            dd($path);
                $url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=' . $this->wechat->index_1() . '&type=image';
//            dd($url);
                $res = $client->request('POST', $url, [
                    'multipart' => [
                        [
                            'name' => 'username',
                            'contents' => 'xiaojiu'
                        ], [
                            'name' => 'media',
                            'contents' => fopen(realpath($path), 'r')
                        ]
                    ]
                ]);
//            dd($res);
                //返回的信息
                echo $res->getBody();
                unlink($path);
                dd();
            } else if ($request->hasFile('voice')) {
                //语音上传
//            dd($request->file('voice'));
                $img_file = $request->file('voice');
                $file_ext = $img_file->getClientOriginalExtension();
                //新的重命名
                $new_file_name = time() . rand(1000, 9999) . '.' . $file_ext;
//            dd($new_file_name);
                $save_file_name = $img_file->storeAs('index_5', $new_file_name);
                $path = './storage/' . $save_file_name;
                $url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=' . $this->wechat->index_1() . '&type=voice';
                $response = $client->request('POST', $url, [
                    'multipart' => [
                        [
                            'name' => 'media',
                            'contents' => fopen(realpath($path), 'r')
                        ],
                    ]
                ]);
//            dd($res);
                echo $response->getBody();
                unlink($path);
                dd();
            } else if ($request->hasFile('video')) {
                //上传视频
//            dd($request->hasFile('video'));
                $img_file = $request->file('video');
                $file_ext = $img_file->getClientOriginalExtension();
                //新名
                $new_file_name = time() . rand(1000, 9999) . '.' . $file_ext;
                $save_file_name = $img_file->storeAs('index_5', $new_file_name);
                $path = './storage/' . $save_file_name;
                $url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=' . $this->wechat->index_1() . '&type=video';
                $response = $client->request('POST', $url, [
                    'multipart' => [
                        [
                            'name' => 'media',
                            'contents' => fopen(realpath($path), 'r')
                        ]
                    ]
                ]);
                echo $response->getBody();
                unlink($path);
                dd();
            } else if ($request->hasFile('thumb')) {
//            dd($request->hasFile('thumb'));
            }
        }
    }


    //
}
