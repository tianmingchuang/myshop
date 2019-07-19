<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Pay;
use DB;
use App\Admin\Order;
class PayController extends Controller
{
    public $app_id;
    public $gate_way;
    public $notify_url;
    public $return_url;
    public $rsaPrivateKeyFilePath = '';  //路径
    public $aliPubKey = '';  //路径
    public $privateKey = 'MIIEpAIBAAKCAQEA0zbXpb3Q/mXpSZdFGZqWAb0wMvPernBVeA87mqopOY2obp1v21yJ5fq5oUFEx3O8+xDa870gxfZsm6VfQQDqgqclkF2lvnvbyZ8H0T9srYBxGMcQh08JXeQU3QON7EusCdfS/UChTr9d07Fu6uzEo0W7I8Xx9o2OsVuOwocH4XDi9Nscy0SekxY9G+xvwTtACnqiWdtFqwgl4xdrNf/bjWBwayNr9fwmuWGaU8afOCbjW3Ql33RzFyCoj9anStSr2not4cLnClM24AwotKpyhObNimP5rJ5KEMWDSWUNYHahvL0LUHPVdGo1mMmOiTUB9iVKIa2so3ok0VD1MoDxCQIDAQABAoIBAQCUHVNgcRoMLF9KMgBNEjC7i3YvZQD1huUIynXb4hQCviotV85HID+7vPVL9b9LtwgBcDJ61lgTOtmy1GdV6FSLxrb65BEE4Uqhuxn6TOXjTb0BySb4HB7PbtCKpKFz4SUFygm1ewsjc+NSPo0vxVWnwZCYZ4lkgqRcD36vP43xMrhrljGG8T3g85rOYAEI60vD2aGapC6TVMDSkkrrscZUI7SIAWK0LEBRJcEng5lYzbod+u2U3qVmoPOEZyaSFTnF2t7kFf36/48V2n6sN04OayZ8tPqMmK2EX4uv3hEWzas1Cvvj3ZQ3O+zdH3uKxg18ZcBF5MuEovcQJyn+nQhhAoGBAOvHj4R0d5b10BfczgY5S8cUSfoYvJPWCH5xu0UCuyo9MjEGQFJknPln/V+wobNckin+fysT1MOgJbqCNnE2rAV/9Bf7eTgVYaQB2tFRCNRuOHM5jSy4fWN1tqcU0r8I2bG0GcX24lSArqx1N9appQhkYLvZzwsIE8XsPy2bzWXdAoGBAOVT9f7e8ir+73kRj3K3g99qW0XqKy0u/C1mtudHN5/jyEj6BAcN/DwMljRB/nKwtLb7DCeSFM4bAFrEUSE6UQYwsscKgELJgk0FBSTGAMSXkje8cvwi7zw/svu22ePmaLuRk7l8aHM7xFYTYUZzCGoe1Zu6vAgl+aazb9ESERMdAoGAbh0KErMN8uukHrDZayCxGi2IiwuobmakGuFks0sePBDOcwTXX2NryDLfqyPjsM+H16LqoySk1iPh2uPbJy6AUiU6y0R/jUi3DBBtsBnnRMahCHcVTpBuxtd/0TIxZlRszsgszT6K3yol6Zbo2BDsaSnv32tOfXltOp8ltlgwKeUCgYAM6X9OTGtCNHxzSqPTB7YrHCfrddXcg2q7e68MspvVKtQaF8mmRAlRsDu80YJsHrruGpCCodz+BdMtSSRwRIJPYOqP/m1eVU462++ANI3Sg949uSSYQbdKoyOGvLLj/BMljHrO1MxkwJa7affuKYftwbKxRABWTR0TX8MJ+IRxmQKBgQCTmaM498s2B64wtG/aSZMI7DlljWT/kTNExkohY/HQtLCDF07fDjt8iaWLseOqo/5UDoMxSdNrGWHYrL3spu48K0qe5iKuefwZx7q8BEeARQOWigOXE571L0szqut+fFSSBxTnlQk3lyDMoh42qC/H3cb+WchhNPLnGUZTU01EEA==';
    public $publicKey = 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA0zbXpb3Q/mXpSZdFGZqWAb0wMvPernBVeA87mqopOY2obp1v21yJ5fq5oUFEx3O8+xDa870gxfZsm6VfQQDqgqclkF2lvnvbyZ8H0T9srYBxGMcQh08JXeQU3QON7EusCdfS/UChTr9d07Fu6uzEo0W7I8Xx9o2OsVuOwocH4XDi9Nscy0SekxY9G+xvwTtACnqiWdtFqwgl4xdrNf/bjWBwayNr9fwmuWGaU8afOCbjW3Ql33RzFyCoj9anStSr2not4cLnClM24AwotKpyhObNimP5rJ5KEMWDSWUNYHahvL0LUHPVdGo1mMmOiTUB9iVKIa2so3ok0VD1MoDxCQIDAQAB';
    public function __construct()
    {
        $this->app_id = '2016101100657570';
        $this->gate_way = 'https://openapi.alipaydev.com/gateway.do';
        $this->notify_url = env('APP_URL').'/notify_url';
        $this->return_url = env('APP_URL').'/return_url';
    }

    public function do_pay(Request $request){
        $jiage = 0;
        $value = $request->session()->get('res');
        $data = DB::table('cart')->where([['uid','=',$value->id]])->get();
//        dd($data);
        foreach ($data as $v){
            $v = ($v->shuliang) * ($v->goods_price);
            $jiage +=$v;
        }
//        dd($jiage);
//        dd($request->all());
//        $value = $request->session()->get('res');
        $oid = time().mt_rand(1000,1111);  //订单编号
        $data = Order::insert(['uid'=>($value->id),'oid'=>$oid,'add_time'=>time(),'pay_money'=>$jiage]);
//        dd($data);
//        dd($oid);
        if($data){
            return redirect('admin/login/order');
        }else{
            echo '请重新添加';
        }
//        $this->ali_pay($oid);
//        $order = [
//          'out_trade_no'=>$oid,
//          'total_amount'=>"$jiage",
//          'subject'=>'七月商城',
//        ];
//        dd($order);
//        return Pay::alipay()->web($order);
    }

    public function do_pays(Request $request , $id)
    {
//        dd($id);
        $value = $request->session()->get('res');
        $data = Order::where([['uid','=',$value->id],['id','=',$id]])->first();
//        dd($data);
        $order = [
          'out_trade_no'=>$data->oid,
          'total_amount'=>"$data->pay_money",
          'subject'=>'七月商城',
        ];
//        dd($order);
        return Pay::alipay()->web($order);
    }

    public function rsaSign($params) {
        return $this->sign($this->getSignContent($params));
    }
    protected function sign($data) {
    	if($this->checkEmpty($this->rsaPrivateKeyFilePath)){
    		$priKey=$this->privateKey;
			$res = "-----BEGIN RSA PRIVATE KEY-----\n" .
				wordwrap($priKey, 64, "\n", true) .
				"\n-----END RSA PRIVATE KEY-----";
    	}else{
    		$priKey = file_get_contents($this->rsaPrivateKeyFilePath);
            $res = openssl_get_privatekey($priKey);
    	}
        
        ($res) or die('您使用的私钥格式错误，请检查RSA私钥配置');
        openssl_sign($data, $sign, $res, OPENSSL_ALGO_SHA256);
        if(!$this->checkEmpty($this->rsaPrivateKeyFilePath)){
            openssl_free_key($res);
        }
        $sign = base64_encode($sign);
        return $sign;
    }
    public function getSignContent($params) {
        ksort($params);
        $stringToBeSigned = "";
        $i = 0;
        foreach ($params as $k => $v) {
            if (false === $this->checkEmpty($v) && "@" != substr($v, 0, 1)) {
                // 转换成目标字符集
                $v = $this->characet($v, 'UTF-8');
                if ($i == 0) {
                    $stringToBeSigned .= "$k" . "=" . "$v";
                } else {
                    $stringToBeSigned .= "&" . "$k" . "=" . "$v";
                }
                $i++;
            }
        }
        unset ($k, $v);
        return $stringToBeSigned;
    }

    

    /**
     * 根据订单号支付
     * [ali_pay description]
     * @param  [type] $oid [description]
     * @return [type]      [description]
     */
    public function ali_pay($oid){
        $order = [];
        $order_info = $order;
        //业务参数
        $bizcont = [
            'subject'           => 'Lening-Order: ' .$oid,
            'out_trade_no'      => $oid,
            'total_amount'      => 10,
            'product_code'      => 'FAST_INSTANT_TRADE_PAY',
        ];
        //公共参数
        $data = [
            'app_id'   => $this->app_id,
            'method'   => 'alipay.trade.page.pay',
            'format'   => 'JSON',
            'charset'   => 'utf-8',
            'sign_type'   => 'RSA2',
            'timestamp'   => date('Y-m-d H:i:s'),
            'version'   => '1.0',
            'notify_url'   => $this->notify_url,        //异步通知地址
            'return_url'   => $this->return_url,        // 同步通知地址
            'biz_content'   => json_encode($bizcont),
        ];
        //签名
        $sign = $this->rsaSign($data);
        $data['sign'] = $sign;
        $param_str = '?';
        foreach($data as $k=>$v){
            $param_str .= $k.'='.urlencode($v) . '&';
        }
        $url = rtrim($param_str,'&');
        $url = $this->gate_way . $url;
        dd($url);
        header("Location:".$url);
    }
    protected function checkEmpty($value) {
        if (!isset($value))
            return true;
        if ($value === null)
            return true;
        if (trim($value) === "")
            return true;
        return false;
    }
    /**
     * 转换字符集编码
     * @param $data
     * @param $targetCharset
     * @return string
     */
    function characet($data, $targetCharset) {
        if (!empty($data)) {
            $fileType = 'UTF-8';
            if (strcasecmp($fileType, $targetCharset) != 0) {
                $data = mb_convert_encoding($data, $targetCharset, $fileType);
            }
        }
        return $data;
    }
    /**
     * 支付宝同步通知回调
     */
    public function aliReturn()
    {
        header('Refresh:2;url=/order_list');
        echo "<h2>订单： ".$_GET['out_trade_no'] . ' 支付成功，正在跳转</h2>';
    }
    /**
     * 支付宝异步通知
     */
    public function aliNotify()
    {
        $data = json_encode($_POST);
        $log_str = '>>>> '.date('Y-m-d H:i:s') . $data . "<<<<\n\n";
        //记录日志
        file_put_contents(storage_path('logs/alipay.log'),$log_str,FILE_APPEND);
        //验签
        $res = $this->verify($_POST);
        $log_str = '>>>> ' . date('Y-m-d H:i:s');
        if($res){
            //记录日志 验签失败
            $log_str .= " Sign Failed!<<<<< \n\n";
            file_put_contents(storage_path('logs/alipay.log'),$log_str,FILE_APPEND);
        }else{
            $log_str .= " Sign OK!<<<<< \n\n";
            file_put_contents(storage_path('logs/alipay.log'),$log_str,FILE_APPEND);
            //验证订单交易状态
            if($_POST['trade_status']=='TRADE_SUCCESS'){
                
            }
        }
        
        echo 'success';
    }
    //验签
    function verify($params) {
        $sign = $params['sign'];
        if($this->checkEmpty($this->aliPubKey)){
            $pubKey= $this->publicKey;
            $res = "-----BEGIN PUBLIC KEY-----\n" .
                wordwrap($pubKey, 64, "\n", true) .
                "\n-----END PUBLIC KEY-----";
        }else {
            //读取公钥文件
            $pubKey = file_get_contents($this->aliPubKey);
            //转换为openssl格式密钥
            $res = openssl_get_publickey($pubKey);
        }
        
        
        ($res) or die('支付宝RSA公钥错误。请检查公钥文件格式是否正确');
        //调用openssl内置方法验签，返回bool值
        $result = (bool)openssl_verify($this->getSignContent($params), base64_decode($sign), $res, OPENSSL_ALGO_SHA256);
        
        if(!$this->checkEmpty($this->aliPubKey)){
            openssl_free_key($res);
        }
        return $result;
    }
    public function return_url()
    {
        header('Refresh:2;url=admin/login/order');
        echo "<h2>订单:  ".$_GET['out_trade_no'] . ' 支付成功, 正在跳转</h2>';
    }

    public function notify_url()
    {
       $data = file_get_contents("php://input");
//       dd($data);
       \Log::Info($data);
       $post = json_decode($data,1);

    }
}
