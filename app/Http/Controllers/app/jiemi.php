<?php

namespace App\Http\Controllers\app;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\app\jieko\aes;
use App\Http\Controllers\app\jieko\rsa;
use DB;

class jiemi extends Controller
{
    public function jie1()
    {
        $string = 'hLlDHcFgKgfDJMNR8yWFVq3ZFRmKh1TXFbV0G/qFE+rtT98uUvbIYMxK+Du4/OJ8A1Eal28skNg6ie10w80Xc8IbBJRLtmavduUC5IkceDf/haoh56jPxgIBTbgBa0a9YRDb5FrDWyQdA8VWMqEJpSZ0Ck99CR5Uxu/zKUU5U+amdhjLrn8pVJ5nSYx4KF3s';
        $key = '1234567890123456';

        dd($this->jie($string, $key));
    }

    public function jiami()
    {

        $aes = new aes('1234567890123456');
//        $obj = new Aes('1234567890123456');
        $url = "name=田明闯&age=121&mobile=110";
//        $data =['name'=>'名','age'=>'年龄','mobile'=>'手机'];
//        $xxoo = json_encode($data,JSON_UNESCAPED_UNICODE);
        echo $eStr = $aes->encrypt($url);
//        echo "<hr>";
//        echo $aes->decrypt($eStr);
//        $url1 = '123.57.18.167/goodsinfo/xxoo';
//        $data = [
//            'authstr' => $eStr,
//        ];
//        $data = file_get_contents($url1,$eStr);
//        dd($data);
    }
//解密
    public static function jie($string, $key)
    {
        return openssl_decrypt(base64_decode($string), 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
    }
//加密
    public function encrypt($input,$key)
    {
        $data = openssl_encrypt($input, 'AES-128-ECB', $this->key, OPENSSL_RAW_DATA, $this->hexToStr($this->hex_iv));
        //$data = base64_encode($data);  //base64编码
        $data = bin2hex($data);  //普通编码转成16进制
        return $data;
    }

    /////
    public function rsa()
    {
        //举个粒子
        $Rsa = new rsa();
// $keys = $Rsa->new_rsa_key(); //生成完key之后应该记录下key值，这里省略
// p($keys);
        $privkey = "-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQC70BRPb1s6kL2GDUBz967aHIo8Vmimt+7qjw9Mx0Jfbxx3qZgQ
3l45X4Wh5ugn4KncgHsC8NhQjANuPibNIc+bZ2Mt6jkaV6FqEb1bcbhLY8g3ZlUm
GB8noYQI92PWwG1RVbjoRUkf6QqJA5vZjVWHlKb4aM4c7iB3QfLcEB0BywIDAQAB
AoGAdl06H6Hnle5Yc15wq2WCvhVUjZhLlh6/pPYKR3IhA3JMN6Iboy3xpijsWE/l
KhSuGLikTgMp4QGMu/LRk2BmrM2gJfz8+JkHDuwaGdyzT0M5MS2cIh/fV5gf+iYQ
WL/hsCbmWLdup5vzI9lmQLEB1SwGPWU6n2cVMhXQITNWpckCQQDwMak9Cm+Nq9u4
9T4AfxIF29jlhtjMZaJuvNw2RV2jt733LaH8NAVXVS0E8YMEUHwQrrRPJHUG8FLi
tcqCv8ClAkEAyCv/hzNbADUDMTzZphLaFiDAw0dNhmyJfArM8aWmB0FEplu5oijA
YhPegs7k0sYYk2aHDi1ywy36V7mhss09rwJBAO7mdg3gc1PVu5UbV6/ms2ZgZDrn
BHtIG2dJMT5Jf/l2p9tR5+uRUj6q2Twxer6vzrZJDc4p1LwyDD6x0dp6HoECQQCg
1clhJsBtsCq6ezweFnOo5/Q6c6Y05iypwDvfxctbdPPl/zlus/OwWmqlC/wL5yOD
/BN0LsxRSzYlGoB0HDj9AkAkS/47wWiO/NnWnBswoCj6D7O+1fBjxHp3so9cvzFA
FLDK48K2H6Itx6e8Jc9XAIWsc2oHTpOJ2MRY/JyijyzG
-----END RSA PRIVATE KEY-----";
        $pubkey  = "-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC70BRPb1s6kL2GDUBz967aHIo8
Vmimt+7qjw9Mx0Jfbxx3qZgQ3l45X4Wh5ugn4KncgHsC8NhQjANuPibNIc+bZ2Mt
6jkaV6FqEb1bcbhLY8g3ZlUmGB8noYQI92PWwG1RVbjoRUkf6QqJA5vZjVWHlKb4
aM4c7iB3QfLcEB0BywIDAQAB
-----END PUBLIC KEY-----
";
//echo $privkey;die;
//初始化rsaobject
        $Rsa->init($privkey, $pubkey,TRUE);


        $data = '来啊';
//私钥加密示例
        $encode = $Rsa->priv_encode($data);
        print_r($encode);
        $ret = $Rsa->pub_decode($encode);
        print_r($ret);
//公钥加密示例
        $encode = $Rsa->pub_encode($data);

        print_r($encode);
        $ret = $Rsa->priv_decode($encode);
        print_r($ret);


//
//        function p($str){
//            echo '<pre>';
//            print_r($str);
//            echo '</pre>';
//
//        }
    }

    public function index(Request $request)
    {
//        $name = $request->input('name');
//        if($name==''){
//            json_encode(['code'=>201,'msg'=>'参数不正确'],JSON_UNESCAPED_UNICODE);die;
//        }
        $re = 'd22a98197a9327eea3b7b21e9f68cd0513ac64f420da1201ac872ee738627f01cd32d9b6c85a9a39305720bab5e27cd0';
        $aes = new aes('1234567890123456    ');
        $aes = $aes->decrypt($re);
//        $aes = json_decode($aes,1);
//        dump($aes['name']);die;
//        $str = "abc&stat=100&remain=1589";
//        if($aes['name']=='' && $aes['age']=='' && $aes['mobile']==''){
//            json_encode(['code'=>201,'msg'=>'参数不够兄弟'],JSON_UNESCAPED_UNICODE);die;
//        }
//        $data = DB::connection('app')->table('jiami')->insert(['name'=>$aes['name'],'age'=>$aes['age'],'mobile'=>$aes['mobile']]);
//        if($data){
//            return json_encode(['code'=>200,'msg'=>'添加成功'],JSON_UNESCAPED_UNICODE);die;
//        }else{
//            json_encode(['code'=>202,'msg'=>'发生未知错误'],JSON_UNESCAPED_UNICODE);die;
//        }

        $date = explode('&',$aes);
        $dat = [];
        foreach($date as $k=>$v){
            $date = explode('=',$v);
            $dat[$date[0]] = $date[1];
        }
        dump($dat);die;
    }
}
