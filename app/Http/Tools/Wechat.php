<?php
/**
 * Created by PhpStorm.
 * User: baiwei
 * Date: 2019/8/6
 * Time: 10:37
 */
namespace  App\Http\Tools;
class Wechat{
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
    public function update_source($up_type , $type , $title='' , $desc='')
    {
        $file = $this->request->file($type);
        dd($file);
    }
}
