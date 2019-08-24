<?php

namespace App\Http\Controllers\wx\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use DB;
use App\Http\Tools\Wechat;
use Illuminate\Support\Facades\Storage;

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
//            dd($openid);
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
                        "value" => "欢迎{$name}登录",//gqmn
                        "color" => ""
                    ]
                ]
            ];
            $re = $this->wechat->post($url,json_encode($datas));
            $request->session()->put('data', $date);
            return redirect('index/index/index');
        }else{
            $data = DB::connection('access')->table('openid')->insert(['openid'=>$openid]);
            if($data){//xwgnqb
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
        $openid = 'otyo9wmGl_uhySBPgi1C-Kx2GOH4';
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
        $upload_type = $request['up_type'];
        $re = '';
//        dd($upload_type);
        if($request->hasFile('image')){
            //图片
            $re = $this->wechat->upload_source($upload_type,'image');
        }elseif($request->hasFile('voice')){
            //音频
            $re = $this->wechat->upload_source($upload_type,'voice');
        }elseif($request->hasFile('video')){
            //视频
            $re = $this->wechat->upload_source($upload_type,'video','视频标题','视频描述');
        }elseif($request->hasFile('thumb')){
            //缩略图
            $path = $request->file('thumb')->store('wechat/thumb');
        }
        echo $re;
        dd();
//        $client = new Client();
//        $data = $request->all('up_type');
////        dd($data);
//        $data = $data['up_type'];
////        dd($data);
//        if($data==2){
////            dd(2);
//            $path = $request->file('image')->store('index_5');
//            $path = './storage/' . $path;
//            $url = 'https://api.weixin.qq.com/cgi-bin/material/add_news?access_token='. $this->wechat->index_1() ;
////            $url = 'https://api.weixin.qq.com/cgi-bin/material/add_material?access_token='.$this->get_access_token().'&type='.$type;
//        }else if($data==1) {
//
////            dd(1);
//            if ($request->hasFile('image')) {
////            dd($request->file('image'));
//                $path = $request->file('image')->store('index_5');
//                $path = './storage/' . $path;
////            dd($path);
//                $url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=' . $this->wechat->index_1() . '&type=image';
////            dd($url);
//                $res = $client->request('POST', $url, [
//                    'multipart' => [
//                        [
//                            'name' => 'username',
//                            'contents' => 'xiaojiu'
//                        ], [
//                            'name' => 'media',
//                            'contents' => fopen(realpath($path), 'r')
//                        ]
//                    ]
//                ]);
////            dd($res);
//                //返回的信息
//                echo $res->getBody();
//                unlink($path);
//                dd();
//            } else if ($request->hasFile('voice')) {
//                //语音上传
////            dd($request->file('voice'));
//                $img_file = $request->file('voice');
//                $file_ext = $img_file->getClientOriginalExtension();
//                //新的重命名
//                $new_file_name = time() . rand(1000, 9999) . '.' . $file_ext;
////            dd($new_file_name);
//                $save_file_name = $img_file->storeAs('index_5', $new_file_name);
//                $path = './storage/' . $save_file_name;
//                $url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=' . $this->wechat->index_1() . '&type=voice';
//                $response = $client->request('POST', $url, [
//                    'multipart' => [
//                        [
//                            'name' => 'media',
//                            'contents' => fopen(realpath($path), 'r')
//                        ],
//                    ]
//                ]);
////            dd($res);
//                echo $response->getBody();
//                unlink($path);
//                dd();
//            } else if ($request->hasFile('video')) {
//                //上传视频
////            dd($request->hasFile('video'));
//                $img_file = $request->file('video');
//                $file_ext = $img_file->getClientOriginalExtension();
//                //新名
//                $new_file_name = time() . rand(1000, 9999) . '.' . $file_ext;
//                $save_file_name = $img_file->storeAs('index_5', $new_file_name);
//                $path = './storage/' . $save_file_name;
//                $url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=' . $this->wechat->index_1() . '&type=video';
//                $response = $client->request('POST', $url, [
//                    'multipart' => [
//                        [
//                            'name' => 'media',
//                            'contents' => fopen(realpath($path), 'r')
//                        ]
//                    ]
//                ]);
//                echo $response->getBody();
//                unlink($path);
//                dd();
//            } else if ($request->hasFile('thumb')) {
////            dd($request->hasFile('thumb'));
//            }
//        }
    }

    //获取临时素材
    public function get_source()
    {
        $media_id = "fD2slPOaReZOloT_ykvEV1lOxnb7yzONvX2Y0DfqG2YNq2PlGvXeJci_etPGyYD_";
//        $media_id = 'PTIrULXFMhz7CI4hfgR3h18YXwIxEju309xq6utOKTs';
        $url = 'https://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->wechat->index_1().'&media_id='.$media_id;
//        dd($url);
        $client = new Client();
        $response = $client->get($url);
//        dd($response);
        //获取文件名
        $file_info = $response->getHeader('Content-disposition');
//        dd($file_info);
        $file_name = substr(rtrim($file_info[0],'"'),-20);
        $path = 'wechat/image/'.$file_name;
        $res = Storage::disk('local')->put($path,$response->getBody());
        echo env('APP_URL').'/storage/'.$path;
        dd($res);
    }
    //获取临时视频文件
    public function get_video_source()
    {
        $media_id = "e5Z_WbPT_2s5acwidFjjYxn4XcdokGHtqy_QTkw8KBbayWY_vULZcg2EHo3sxACG";
        $url = 'http://api.weixin.qq.com/cgi-bin/media/get?access_token='.$this->wechat->index_1().'&media_id='.$media_id;
        $client = new Client();
        $responae = $client->get($url);
//        dd(json_decode($responae->getBody(),1));
        $video_url = json_decode($responae->getBody(),1)['video_url'];
//        dd($video_url);
        $file_name = explode('/',parse_url($video_url)['path'])[2];
        $opts = array(
            'http' => array(
                'method' => 'GET',
                'timeout' => 3
            )
        );
        $context = stream_context_create($opts);
////        dd($opts);
        $read = file_get_contents($video_url,false, $context);
////        dd($read);
        $res = file_put_contents('./storage/wechat/video/'.$file_name,$read);
        var_dump($res);
        dd();
    }
//    public function get_sources()
//    {
////        $media_id = '3aQvqKaKoOglqWYQ2OPXN9LxDHH6fgAv8-U6gNvlAmMjezpN-rwUJidpgR4ZEcqO';
//        $media_id = 'PTIrULXFMhz7CI4hfgR3h18YXwIxEju309xq6utOKTs';
//        $url = 'https://api.weixin.qq.com/cgi-bin/material/get_material?access_token='.$this->wechat->index_1().'&media_id='.$media_id;
////        dd($url);
//        $client = new Client();
//        $response = $client->get($url);
////        dd($response);
//        //获取文件名
//        $file_info = $response->getHeader('Content-disposition');
////        dd($file_info);
//        $file_name = substr(rtrim($file_info[0],'"'),-20);
//        $path = 'wechat/image/'.$file_name;
//        $res = Storage::disk('local')->put($path,$response->getBody());
//        echo env('APP_URL').'/storage/'.$path;
//        dd($res);
//    }

    //用户标签管理
    public function get_yonghu()
    {
        return view('wx/index/index_1/get_yonghu');
    }
    public function post_yonghu(Request $request)
    {
        $name = $request->all()['name'];
//        dd($name);
        $index_1 = $this->wechat->index_1();
//        dd($index_1);
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/create?access_token='.$index_1;
//        dd($url);
        $data = [
            "tag" => ["name" => $name]
        ];
//        dd($data);
        $re = $this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
//        dd($re);
        //如果已有了创建的标签 重命名 返回45157
        $re = json_decode($re,1);
//        dd($re);
        if(array_key_exists('tag',$re)){
            return redirect('wx/index/index_1/get_yonghu_do');
        }else{
            echo '反生未知错误标签创建失败';
        }
    }

    public function get_yonghu_do()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.$this->wechat->index_1();
        $data = file_get_contents($url);
//        dd($data);
        $data = json_decode($data,1);
        $data = $data['tags'];
//        dd($data);
        return view('wx/index/index_1/get_yonghu_do',['data'=>$data]);
    }
    //标签删除
    public function yonghu_delete($id)
    {
//        $name = $request->all();
//        dd($id);
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/delete?access_token='.$this->wechat->index_1();
        $data = [
            'tag' => ['id'=>$id]
        ];
        $re = $this->wechat->post($url,json_encode($data));
        $res = json_decode($re);
//        dd($res);
        if($res->errcode == 0){
            return redirect('wx/index/index_1/get_yonghu_do');
        }else{
          echo "未知错误删除失败";
        }
    }
    //用户标签添加
    public function yonghu_insert($id)
    {
//        dd($id);
        $data = DB::connection('access')->table('wechat_openid')->get();
        return view('wx/index/index_1/yonghu_insert',['data'=>$data,'id'=>$id]);
    }
    public function yonghu_insert_do(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $tagid = $data['tagid'];
        $data = DB::connection('access')->table('wechat_openid')->whereIn('id',$data['id_list'])->get();
//        dd($tagid);
        $data1 = [];
        foreach($data as $v){
            $data1[] = $v->openid;
        }
//        dd($data1);
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchtagging?access_token='.$this->wechat->index_1();
        $data2 = [
          'openid_list' => $data1,
            'tagid' => $tagid,
        ];
//        dd($data2);
        $data3 = $this->wechat->post($url,json_encode($data2));
        $res = json_decode($data3,1);
//        dd($res);
        if($res['errcode'] == 0){
            return redirect('wx/index/index_1/get_yonghu_do');
        }else{
            echo "未知错误删除失败";
        }
    }
    //查看用户标签
    public function yonghu_select_1($id)
    {
//        dd($id);
        $data = DB::connection('access')->table('wechat_openid')->where('id','=',$id)->first();
//        dd($data);
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/getidlist?access_token='.$this->wechat->index_1();
        $data1 = [
          'openid' => $data->openid
        ];
//        dd($data1);
        $res = $this->wechat->post($url,json_encode($data1));
        $data2 = json_decode($res,1)['tagid_list'];
//       dd($data2);
        $url1 = 'https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.$this->wechat->index_1();
        $re = file_get_contents($url1);
//        dd($re);
        $tag_info = json_decode($re,1)['tags'];
//        dd($tag_info);
        $vo1[] = '';
        foreach($data2 as $v){
//            echo $v;
            foreach($tag_info as $vo){
                if($vo['id'] == $v){
//                    echo $vo['name'];
                    $vo1[] = $vo['name'];
                }
            }
        }

//        dd($vo1);
//        echo $vo;
        return view('wx/index/index_1/yonghu_select_1',['vo'=>$vo1,'openid'=>$data->openid]);
    }

    //获取标签下面的用户
    public function yonghu_select($id)
    {
//        dd($id);
        $url = 'https://api.weixin.qq.com/cgi-bin/user/tag/get?access_token='.$this->wechat->index_1();
        $date = [
            'tagid' => $id,
        ];
        $data = $this->wechat->post($url,json_encode($date));
        $res = json_decode($data,1);
//        dd($res);
        if($res['count']==0){
            echo '此标签下没有用户';die;
        }
        $res = $res['data']['openid'];
//        $data1 = DB::connection('access')->table('wechat_openid')->get();
//        dd($data1);
        return view('wx/index/index_1/yonghu_select',['data'=>$res,'id'=>$id]);
    }
    //批量删除标签用户
    public function yonghu_select_do(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $tagid = $data['tagid'];
        $openid = $data['openid'];
//        dd($openid);
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/members/batchuntagging?access_token='.$this->wechat->index_1();
        $data = [
          'openid_list' => $openid,
            'tagid' => $tagid
        ];
//        dd($data);
        $res = $this->wechat->post($url,json_encode($data));
//        dd($res);
        $res = json_decode($res,1);
//        dd($res);
        if($res['errcode'] == 0){
            echo "<script>history.go(-1)</script>";
        }else{
            echo "未知错误删除失败";
        }
    }
    //修改标签名
    public function yonghu_update(Request $request,$id)
    {
//        dd($request->all()['name']);
        return view('wx/index/index_1/yonghu_update',['id'=>$id,'name'=>$request->all()['name']]);
    }
    public function yonghu_update_do(Request $request)
    {
        $data = $request->all();
//        dd($data['id']);
        $url = 'https://api.weixin.qq.com/cgi-bin/tags/update?access_token='.$this->wechat->index_1();
        $datas = [
          'tag' => [
              'id' => $data['id'],
              'name' => $data['name']
          ]
        ];
        $res = $this->wechat->post($url,json_encode($datas,JSON_UNESCAPED_UNICODE));
        $res = json_decode($res,1);
//        dd($res);
        if($res['errcode'] == 0){
            return redirect('wx/index/index_1/get_yonghu_do');
        }else{
            echo "未知错误修改失败";
        }
    }
    //标签消息推送
    public function yonghu_xiaoxi($id)
    {
        return view('wx/index/index_1/yonghu_xiaoxi',['id'=>$id]);
    }
    public function yonghu_xiaoxi_do(Request $request)
    {
        $data = $request->all();
//        dd($data['tag_id']);
        $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token='.$this->wechat->index_1();
        $data = [
            "filter" => [
                "is_to_all" => false,
                "tag_id" => $data['tag_id']
                    ],
            "text" => [
                "content" => $data['desc']
                    ],
            "msgtype" => "text"
        ];
        $res = $this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $res = json_decode($res,1);
//        dd($res);
        if($res['errcode'] == 0){
            return redirect('wx/index/index_1/get_yonghu_do');
        }else{
            echo "未知错误修改失败";
        }
    }

    //自动回复接收普通消息
    public function event()
    {
//        echo $_GET['echostr'];
//        die(stash);
        $data = file_get_contents("php://input");
//        dd($data);
        $xml = simplexml_load_string($data,'SimpleXMLElement',LIBXML_NOCDATA);
//        dd($xml);
        $xml = (array)$xml;     //转化成数组
//        dd($xml);
        $log_str = date('Y-m-d H:i:s') . "\n" . $data . "\n<<<<<<<";
        file_put_contents(storage_path('logs/wx_event.log'),$log_str,FILE_APPEND);
        if ($xml['MsgType'] == 'event'){
                if($xml['Event'] == 'subscribe'){
                    if(isset($xml['EventKey'])){
                        $agent_code = explode('_',$xml['EventKey'])[1];
//                        dd($agent_code);
                        $data1 = DB::connection('access')->table('user_agent')->where(['openid'=>$xml['FromUserName']])->first();
//                        dd($data1);
                        if(empty($data1)){
                            $data2 = DB::connection('access')->table('user_agent')->insert(['uid'=>$agent_code, 'openid' => $xml['FromUserName'], 'add_time' => time()]);
//                            dd($data2);
                            $data3 = DB::connection('access')->table('user_agent')->where('uid','=',$agent_code)->count();
//                            dd($data3);
                            $data4 = DB::connection('access')->table('user')->where('id','=',$agent_code)->update(['agent'=>$data3]);
//                            dd($data4);
                        }
                        $message = '欢迎使用本公司提供的油价查询功能!';
                        $xml_str = '<xml>
                    <ToUserName><![CDATA['.$xml['FromUserName'].']]>
                    </ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]>
                    </FromUserName>
                        <CreateTime>'.time().'</CreateTime>
                        <MsgType><![CDATA[text]]></MsgType>
                        <Content><![CDATA['.$message.']]></Content>
                     </xml>';
                        echo $xml_str;

                    }
                }else if($xml['Event']=='CLICK'){
                    if($xml['EventKey']!==''){
                        $message = '欢迎前来充值';
                        $xml_str = '<xml>
                                          <ToUserName><![CDATA['.$xml['FromUserName'].']]></ToUserName>
                                          <FromUserName><![CDATA['.$xml['ToUserName'].']]></FromUserName>
                                          <CreateTime>'.time().'</CreateTime>
                                          <MsgType><![CDATA[text]]></MsgType>
                                          <Content><![CDATA['.$message.']]></Content>
                                    </xml>';
                        echo $xml_str;
                    }
//                    dd(123);
                }
        }else if ($xml['MsgType'] == 'text'){
//            \Log::Infencode($xml));
            $city = $xml['Content'];
            $redis = new \Redis();
            $redis->connect('127.0.0.1','6379');
            $redis->incr("$city");
            dump($redis->get("$city"));
//            $dat = '111';
//            dump($dat);
//            $redis->set("明","天");
//            $data = $redis->get("明");
//            dd($data);

            $re = '/^.*?油价$/';
            $info = file_get_contents('http://www.tianmingchuang.com/youjia');
            $info = json_decode($info,1);
            $data = preg_match($re,$city);
//            dd($data);
            $city1 = substr($city,0,-6);
            if(($redis->get("$city"))>11){
                $data = $redis->get("$city1");
//                dd($data);
                $date = json_decode($data,1);
            }else {
                if(($redis->get("$city"))>=10){
//                    dd(11);
                    $re = '/^.*?油价$/';
                    $info = file_get_contents('http://www.tianmingchuang.com/youjia');
                    $info = json_decode($info,1);
                    $data = preg_match($re,$city);
//            dd($data);
                    $city = substr($city,0,-6);
//            dd($city);
                    $date = '';
                    foreach($info['result'] as $v){
                        if($v['city'] == $city){
//                    dump($v);
                            unset($v['city'],$v['b90'],$v['0h']);
//                    dump($v);
                            foreach($v as $k=>$vi){
//                        dump($vi);
//                        dump($k);
                                $date .= $k.': 每升'.$vi."\n";
                            }
//                    dd();
                        }
                    }
                    $date = json_encode($date);
//                    dd($date);
                    $redis->set("$city1","$date");
                }else{
//                    dd(12);
                    $re = '/^.*?油价$/';
                    $info = file_get_contents('http://www.tianmingchuang.com/youjia');
                    $info = json_decode($info,1);
                    $data = preg_match($re,$city);
//            dd($data);
                    $city = substr($city,0,-6);
//            dd($city);
                    $date = '';
                    foreach($info['result'] as $v){
                        if($v['city'] == $city){
//                    dump($v);
                            unset($v['city'],$v['b90'],$v['0h']);
//                    dump($v);
                            foreach($v as $k=>$vi){
//                        dump($vi);
//                        dump($k);
                                $date .= $k.': 每升'.$vi."\n";
                            }
//                    dd();
                        }
                    }
                }
            }

//            dd($date);
            $message = $date;
            $xml_str = '<xml>
                    <ToUserName><![CDATA['.$xml['FromUserName'].']]>
                    </ToUserName><FromUserName><![CDATA['.$xml['ToUserName'].']]>
                    </FromUserName>
                        <CreateTime>'.time().'</CreateTime>
                        <MsgType><![CDATA[text]]></MsgType>
                        <Content><![CDATA['.$message.']]></Content>
                     </xml>';
            echo $xml_str;
        }


    }
    
    //生成带参数的二维码
    public function erwmas()
    {
//        dd(storage_path('app/public'));
//        echo 1;
        $data = DB::connection('access')->table('user')->get();
//        dd($data);
        return view('wx/index/index_1/erwmas',['data'=>$data]);
    }

    public function erwmas_do($id)
    {
//        dd($id);
        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->wechat->index_1();
        $data =  [
//            'action_name' => 'QR_LIMIT_STR_SCENE',
//            'action_info' => [
//                'scene' => [
//                    'scene_str' => $id
//                ]
//            ]

            'expire_seconds' => 3600 * 30,
            'action_name'  => 'QR_STR_SCENE',
            'action_info' => [
                'scene' => [
                    'scene_str' => $id,
        ]
    ]

        ];
//        dd($data);
        $re = $this->wechat->post($url,json_encode($data));
        $re = json_decode($re,1);
//        dd($re);
        $res = DB::connection('access')->table('user')->where('id','=',$id)->update(['agent_code'=>$re['ticket']]);
//        dd($res);/
        $url1 = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$re['ticket'];
//        dd($url1);
        $client = new Client();
        $response = $client->get($url1);
        //获取文件名
        $wjian = $response->getHeaders();
        $ext = explode('/',$wjian['Content-Type'][0])[1];
//        dd($ext);
        $file_name = time().rand(1000,9999).'.'.$ext;
//        dd($file_name);
        $path = 'qrcode/'.$file_name;
//        dd($path);
        $re1 = Storage::disk('local')->put($path,$response->getBody());
//        dd($re1);
        $qrcode_url = env('APP_URL').'/storage/'.$path;
        $res1 = DB::connection('access')->table('user')->where('id','=',$id)->update(['qrcode_url'=>$qrcode_url]);
        if ($res&&$res1){
            return redirect('wx/index/index_1/erwmas');
        }else{
            echo '失败';
        }
    }

    public function erwmas_do_1($id)
    {
//        dd($id);
        $data = DB::connection('access')->table('user_agent')->where('uid','=',$id)->get();
//        dd($data);
        return view('wx/index/index_1/erwmas_do_1',['data'=>$data]);
    }
    //添加二维码推广商户
    public function shanghu()
    {
        return view('wx/index/index_1/shanghu');
    }
    public function shanghu_do(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $date = DB::connection('access')->table('user')->insert(['name'=>$data['name']]);
        if($date){
            return redirect('wx/index/index_1/erwmas');
        }
    }
    
    //微信菜单
    public function caidan_1()
    {
        return view('wx/index/index_1/caidan_1');
    }

    public function caidan_1_do(Request $request)
    {
        $data = $request->all();
//        dd($data);
//        $date = DB::commection('access')->table('caidan')->
        if (empty($data['er_name'])){
//            echo 1;
            $date = DB::connection('access')->table('caidan')->insert(['caidan'=>$data['caidan'],'yi_name'=>$data['yi_name'],'biaoshi'=>$data['biaoshi'],'leixing'=>$data['leixing']]);
            if($date){
                return redirect('wx/index/index_1/caidan_2');
            }
        }else{
//            echo 2;
            $date = DB::connection('access')->table('caidan')->insert(['caidan'=>$data['caidan'],'yi_name'=>$data['yi_name'],'biaoshi'=>$data['biaoshi'],'leixing'=>$data['leixing'],'er_name'=>$data['er_name']]);
//            dd($date);
            if($date){
                return redirect('wx/index/index_1/caidan_2');
            }
        }

    }
    //微信菜单展示
    public function caidan_2()
    {
        $data = DB::connection('access')->table('caidan')->get();
//        dd($data);
        return view('wx/index/index_1/caidan_2',['data'=>$data]);
    }

    public function caidan_delete($id)
    {
//        dd($id);
        $data = DB::connection('access')->table('caidan')->where('id','=',$id)->delete();
        if($data){
            return redirect('wx/index/index_1/caidan_2');
        }
    }
    
    public function caidan_3()
    {
        $data1 = DB::connection('access')->table('caidan')->groupBy('yi_name')->select(['yi_name'])->orderBy('yi_name')->get()->toArray();
//        dd($data1);
        foreach ($data1 as $vo){
//            dump($vo);
            $data2 = DB::connection('access')->table('caidan')->where('yi_name','=',$vo->yi_name)->get()->toArray();
            $sub_button = [];
            foreach($data2 as $v){
//                 dump($v);
                if($v->caidan==1){
                    if($v->leixing=='click'){
                        $data['button'][] = [
                            "type" => $v->leixing,
                            "name" => $v->yi_name,
                            "key" =>  $v->biaoshi
                        ];

                    }else if($v->leixing=='view'||$v->leixing=='miniprogram'){
                        $data['button'][] = [
                            "type" => $v->leixing,
                            "name" => $v->yi_name,
                            "url" =>  $v->biaoshi
                        ];
                    }
                }else if ($v->caidan==2){
//                    dump($v);
//                    dd();
                    if ($v->leixing=='click'){
                        $sub_button[] = [
                            "type" => $v->leixing,
                            "name" => $v->er_name,
                            "key" =>  $v->biaoshi
                        ];
                    }else{
                        $sub_button[] = [
                            "type" => $v->leixing,
                            "name" => $v->er_name,
                            "url" =>  $v->biaoshi
                        ];
                    }
                }
            }
            if (!empty($sub_button)){
                $data['button'][]=[
                    'name'=>$vo->yi_name,
                    'sub_button'=>$sub_button
                ];
            }
        }

//        dd($data);
//        dd($datas1);
//        echo $sub_button;
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->wechat->index_1();
        $res = $this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $res = json_decode($res,1);
        dd($res);
    }




    public function caidan()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->wechat->index_1();
        $data = [
            "button"=>[
                [
                    "type"=>"click",
                    "name"=>"今日歌曲",
                    "key"=>"V1001_TODAY_MUSIC"
                ],
                [
                    "name"=>"菜单",
                    "sub_button"=>[
                        [
                            "type"=>"view",
                            "name"=>"搜索",
                            "url"=>"http://www.soso.com/"
                        ],
                        [
                            "type"=>"miniprogram",
                            "name"=>"wxa",
                            "url"=>"http://mp.weixin.qq.com",
                            "appid"=>"wx286b93c14bbf93aa",
                            "pagepath"=>"pages/lunar/index"
                        ],
                        [
                            "type"=>"click",
                            "name"=>"赞一下我们",
                            "key"=>"V1001_GOOD"
                        ]
                    ]
                ]
            ]
        ];
        dd($data);
        $re = $this->wechat->post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $re = json_decode($re,1);
        dd($re);
    }

    public function caidan_4()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$this->wechat->index_1();
        $res = file_get_contents($url);
//        dd($res);
        $res = json_decode($res,1);
        $data = json_decode(json_encode($res['menu']['button']),1);
//        dd($data);
        $data1 = [];
        foreach($data as $v){
//            dump($v);

            if(!empty($v['sub_button'])){
//                echo 1;
//                dump($v);
                $data1[] = [
                    'yi_name' => $v['name'],
                    'er_name' => '',
                    'biaoshi' => '',
                    'leixing' => '',
                    'dengji'  => 2,
                ];
                foreach($v['sub_button'] as $vo){
//                    dump($vo);
                    if($vo['type']=='click'){
                        $data1[] = [
                            'yi_name' => '',
                            'er_name' => $vo['name'],
                            'biaoshi' => $vo['type'],
                            'leixing' => $vo['key'],
                            'dengji'  => 2,
                        ];
                    }else{
                        $data1[] = [
                            'yi_name' => '',
                            'er_name' => $vo['name'],
                            'biaoshi' => $vo['type'],
                            'leixing' => $vo['url'],
                            'dengji'  => 2,
                        ];
                    }


                }
            }
            if(empty($v['sub_button'])){
//                echo 2;
                if($v['type']=='click'){
                    $data1[] = [
                        'yi_name' => $v['name'],
                        'er_name' => '',
                        'biaoshi' => $v['type'],
                        'leixing' => $v['key'],
                        'dengji'  => 1,
                    ];
                }else{
                    $data1[] = [
                        'yi_name' => $v['name'],
                        'er_name' => '',
                        'biaoshi' => $v['type'],
                        'leixing' => $v['url'],
                        'dengji'  => 1,
                    ];
                }

            }
        }
//        dd($data1);
        return view('wx/index/index_1/caidan_1',['data'=>$data1]);
    }

    ///////油价查询













    public function chakanerwma($id)
    {
//        dd($id);
        $url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$id;
//        dd($url);
        header("location:$url");
    }
    public function erwma_1()
    {
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=APPID&redirect_uri=REDIRECT_URI&response_type=code&scope=SCOPE&state=STATE#wechat_redirect';
    }







////////////生成带参数的二维码
    public function erwma()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$this->wechat->index_1();
//        dd($url);
        $data = [
          'expire_seconds' => 3600,
            'action_name'  => 'QR_SCENE',
            'action_info' => [
                'scene' => [
                    'scene_id' => 123,
                ]
            ]
        ];
//        dd($data);
        $res = $this->wechat->post($url,json_encode($data));
        $res = json_decode($res,1)['ticket'];
//        dd($res);
        $url1 = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$res;
        header("location:$url1");
//        dd($url1);
    }





//////////清零接口调用频次
    public function aa()
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/clear_quota?access_token='.$this->wechat->index_1();
        $data = [
          'appid' => env('WECHAT_APPID'),
        ];
        $datas = $this->wechat->post($url,json_encode($data));
//        dd(json_decode($datas));

    }
}
