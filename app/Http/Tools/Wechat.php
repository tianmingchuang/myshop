<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/8/6
 * Time: 10:37
 */
namespace  App\Http\Tools;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class Wechat{

    public  $request;
    public  $client;
    public  $app;
    public function __construct(Request $request,Client $client)
    {
        $this->request = $request;
        $this->client = $client;
        $this->app=app('wechat.official_account');
    }

    public function wechat_user_info($openid){
        $access_token = $this->get_access_token();
        $wechat_user = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN");
        $user_info = json_decode($wechat_user,1);
        return $user_info;
    }
    public function post($url, $data){
        //初使化init方法
        $ch = curl_init();
        //指定URL
        curl_setopt($ch, CURLOPT_URL, $url);
        //设定请求后返回结果
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //声明使用POST方式来进行发送
        curl_setopt($ch, CURLOPT_POST, 1);
        //发送什么数据
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //忽略证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //忽略header头信息
        curl_setopt($ch, CURLOPT_HEADER, 0);
        //设置超时时间
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        //发送请求
        $output = curl_exec($ch);
        //关闭curl
        curl_close($ch);
        //返回数据
        return $output;
    }

    function get($url, $params=[]) {
        $url = "{$url}?" . http_build_query ( $params );

        $ch = curl_init ();

        curl_setopt ( $ch, CURLOPT_URL, $url );

        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );

        curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );

        curl_setopt ( $ch, CURLOPT_TIMEOUT, 60 );

        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $params );        $result = curl_exec ( $ch );

        curl_close ( $ch );        return $result;

    }

    public function index_1()
    {
        $access_token="";
        $redis=new \Redis();
        $redis->connect('127.0.0.1','6379');
        $access_token_key='wechat_access_token';
//        $redis->del('wechat_access_token');
//        dd();
        if($redis->exists($access_token_key)){
            // 去缓存拿
            $access_token=$redis->get($access_token_key);
        }else{
            // 去微信接口拿
            $access_info=file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".env('WECHAT_APPID')."&secret=".env('WECHAT_APPSECRET'));
            $access_data=json_decode($access_info,1);
//        dd($access_info);
            $access_token=$access_data['access_token'];
            $expire_time=$access_data['expires_in'];
            // 加人缓存
            $redis->set($access_token_key,$access_token,$expire_time);
        }

        return $access_token;
    }

    //微信上传素材资源
    public function upload_source($up_type,$type,$title='',$desc=''){
        $file = $this->request->file($type);
//        dd($file);
        $file_ext = $file->getClientOriginalExtension();
        $new_file_name = time().rand(1000,9999). '.'.$file_ext;
        $save_file_path = $file->storeAs('index_5',$new_file_name);
        $path = './storage/'.$save_file_path;
        if($up_type  == 1){
            $url='https://api.weixin.qq.com/cgi-bin/media/upload?access_token=' . $this->index_1().'&type='.$type;
        }elseif($up_type == 2){
            $url = 'https://api.weixin.qq.com/cgi-bin/material/add_material?access_token='.$this->index_1().'&type='.$type;
        }
        $multipart = [
            [
                'name'     => 'media',
                'contents' => fopen(realpath($path), 'r')
            ],
        ];
        if($type == 'video' && $up_type == 2){
            $multipart[] = [
                'name'     => 'description',
                'contents' => json_encode(['title'=>$title,'introduction'=>$desc])
            ];
        }
        $response = $this->client->request('POST',$url,[
            'multipart' => $multipart
        ]);
        $body = $response->getBody();
        unlink($path);
        return $body;
    }
}
