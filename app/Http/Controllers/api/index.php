<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\model\goods;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\model\type;
use App\Http\Controllers\model\category;
use App\Http\Controllers\model\attribute;
use App\Http\Controllers\model\goods_attr;
use App\Http\Controllers\model\login;
use App\Http\Controllers\model\order;
use App\Http\Controllers\model\ip;

class index extends Controller
{
    /*
     * 首页
     */
    public function index()
    {
        $category = category::get();
        $data = Cache::get('goods');
//        dd($data);
        if(empty($data)){
            $data = goods::orderBy('goods_id','desc')->limit(4)->get();
            Cache::put('goods',$data,86400);
        }
        return json_encode(['msg'=>$data,'category'=>$category]);
    }

    /**
     * 商品详情
     * @return string
     */
    public function index_xiang(Request $request)
    {
        $goods_id = $request->input('id');
        $name = $_GET['callback'];
//        dd($name);
        $goods = goods::where('goods_id',$goods_id)->first();
//        dd($goods);
        $goods_attr = goods_attr::join('attribute','goods_attr.attribute_id','=','attribute.id')->where('goods_id',$goods_id)->get();
//        dd($goods_attr);
        $data = [];
        foreach($goods_attr as $k=>$v){
//            if($v['xianshi']==2){
                $data[$v['name']][] = $v;
//            }else{
//                $data[$v['name']] = $v;
//            }
        }
//        dd($data);
        $res= [
          'data' => $data,
          'goods' => $goods,
        ];
        $res = json_encode($res);
        return $name."(".$res.")";
    }

    /**
     * 商品分类
     */
    public function index_fen(Request $request)
    {
        $category_id = $request->input('id');
        $name = $_GET['jsp'];
//        $category_id = 8;
        $category = goods::where('cat_id',$category_id)->get();
//        dd($category);
        $category = json_encode($category);
        return $name."(".$category.")";
    }

    /**
     * 商品类型价格
     */
    public function index_attr(Request $request)
    {
        $jsp = $_GET['jsp'];
        $attr_id = $request->input('attr_id');
        $price = $request->input('price');
        $goods_attr = goods_attr::where('attr_id',$attr_id)->first();
        $goods_attr = $goods_attr->price+$price;
        $goods_attr = json_encode($goods_attr);
        return $jsp."(".$goods_attr.")";
    }

    /**
     * 接口登录
     */
    public function login(Request $request)
    {
        $name = $request->input('name')??'';
        $pwd = $request->input('pwd')??'';
        $jsp = $_GET['jsp'];
//        dd(1);
        $data = login::where([['name','=',$name],['pwd','=',$pwd]])->first();
//        dd($data->login_id);
        if(!$data){
            $json = json_encode(['code'=>201,'msg'=>'请输入正确的用户名或密码']);
            return $jsp.'('.$json.')';
        }
        $token = md5(($data->login_id).time());
        $date = login::where('login_id',$data->login_id)->update([
            'token'=>$token,
            'time'=>time()+3600
        ]);
        if($data){
            $json = json_encode(['code'=>200,'msg'=>$token]);
            return $jsp.'('.$json.')';
        }
    }

    /**
     * 分类
     */
    public function index_fenlei()
    {
        $type = type::get();
        $type_id = type::limit(1)->first();
//        dd($type_id);
        $goods = goods::where('type_id',$type_id->id)->get();
//        dd($goods);
        return json_encode(['msg'=>$type,'goods'=>$goods]);
    }

    /**
     * 分类详情
     * @param Request $request
     */
    public function index_fenlei_do(Request $request)
    {
        $type_id = $request->input('type_id');
        $goods = goods::where('type_id',$type_id)->get();
        return json_encode(['goods'=>$goods]);
    }


    /**
     * 商品添加
     * @param Request $request
     */
    public function as(Request $request)
    {
//        dd(1);
        $token = $request->input('token');
        $goods_id = $request->input('goods_id');
        $attr_ids = $request->input('attr_ids');
        $attr_names = $request->input('attr_names');
//        dd(11);
        if(empty($attr_ids)){
            return json_encode(['code'=>201,'msg'=>'请选择购买的商品属性']);
        }
        //数组转字符串
        $attr_ids = implode(',',$attr_ids);
        $attr_names = implode(' ',$attr_names);
//        dd($attr_ids);
        //登录表查询
        $login = login::where('token',$token)->first();
//        dd($goods_id);
        //订单表添加
        $order = order::insert(['login_id'=>($login->login_id),'goods_id'=>$goods_id,'attr_ids'=>$attr_ids,'add_time'=>time(),'shuliang'=>1,'attr_names'=>$attr_names]);
//        dump($order);die;
        if($order){
            return json_encode(['code'=>200,'msg'=>'购物车添加成功']);
        }
    }

    public function order_select(Request $request)
    {
        $goods_ids = $request->input('goods_ids');
//        dd($goods_ids);
        if(empty($goods_ids)){
            $order = order::join('goods','order.goods_id','=','goods.goods_id')->get()->toArray();
        }else{
            $order = [];
            $goods_ids = explode(',',$goods_ids);
            foreach($goods_ids as $v){
                $order[] = order::join('goods','order.goods_id','=','goods.goods_id')->where('order_id','like','%'.$v.'%')->first()->toArray();
//                dd($v);
            }
        }
//        dd($order);
        foreach($order as $k=>$v){
            $attr_id = explode(',',$v['attr_ids']);
            $attr = goods_attr::join('attribute','goods_attr.attribute_id','=','attribute.id')->whereIn('attr_id',$attr_id)->get()->toArray();
//            dump($order);
            $attr_name = '';
            $attr_price = 0;
            $price = [];
            foreach($attr as $kk=>$vi){
            $attr_name .= $vi['name'].':'.$vi['shuxingzhi'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
            $price[$vi['shuxingzhi']] = $vi['price'];
//            dd($vi);
            }
            foreach($price as $ko=>$vo){
                $attr_price += $vo ;
//                dump($vo);
            }
            $attr_price += $v['goods_price'];
//            dump($attr_price);
            $order[$k]['attr_ids'] = $attr_name;
            $order[$k]['goods_price'] = $attr_price;
            $order[$k]['goods_img'] = env('APP_URL').$order[$k]['goods_img'];
        }
//        dump($order);
//        $goods = goods::where('goods_id')
        return json_encode(['code'=>200,'msg'=>$order]);
    }

    public function orders_insert(Request $request)
    {
//        $redis = new \Redis();
////        dd($redis);
//        $redis->connect('127.0.0.1','6379');
//        $redis->incr('name');
//        dd($redis->get('name'));
        $ip = $_SERVER['REMOTE_ADDR'];
        $ip1 = ip::where('ip',$ip)->first();
        if($ip1){
            if (time() < $ip1->time){
                if($ip1->ci > 4){
                    $ip2 = ip::where('ip',$ip)->update(['ci'=>($ip1->ci+1)]);
                }else{
                    $ip2 = ip::where('ip',$ip)->update(['ci'=>($ip1->ci+1)]);
                }
            }else{
             return;
            }
        }else{
            $ip2 = ip::insert(['ip'=>$ip,'time'=>time()+60]);
        }
        dd($ip1);
//        if(!empty($_SERVER["HTTP_CLIENT_IP"]))
//        {
//            $cip = $_SERVER["HTTP_CLIENT_IP"];
//        }
//        else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
//        {
//            $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
//        }
//        else if(!empty($_SERVER["REMOTE_ADDR"]))
//        {
//            $cip = $_SERVER["REMOTE_ADDR"];
//        }
//        else
//        {
//            $cip = '';
//        }
//        preg_match("/[\d\.]{7,15}/", $cip, $cips);
//        $cip = isset($cips[0]) ? $cips[0] : 'unknown';
//        unset($cips);
//
//        return $cip;

//        $token = 'c72df5aeac7b84e4e6ca9b0b13f4c450';
//        $order_ids = [
//            '0'=>'5',
//            '1'=>'6',
//        ];
////        $order_ids = $request->input('order_ids');
////        $token = $request->input('token');
//        $login_id = login::where('token',$token)->first('login_id');
//        $order = order::join('goods','order.goods_id','=','goods.goods_id')->whereIn('order_id',$order_ids)->orwhere('login_id',$login_id)->get()->toArray();
//        dump($order);
//        foreach($order as $v){
//
//        }
    }

    /**->orderby('time','desc')
     *  商品购买数量加减
     */
    public function jiajian(Request $request)
    {
        $fu = $request->input('fu');
        $token = $request->input('token');
        $shuliang = $request->input('shuliang');
        $order_id = $request->input('order_id');
//        dd($fu);
        $login = login::where('token',$token)->first();
//        dd($login->login_id);
        if($fu == '+'){
            order::where([['login_id',($login->login_id)],['order_id',$order_id]])->update(['shuliang'=>$shuliang]);
        }
        if($fu == '-'){
            order::where([['login_id',($login->login_id)],['order_id',$order_id]])->update(['shuliang'=>$shuliang]);
        }

    }
}
