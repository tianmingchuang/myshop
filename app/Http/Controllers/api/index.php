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
        if(empty($goods)){
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
        $name = $request->input('name')??'1';
        $pwd = $request->input('pwd')??'1';
        $data = login::where([['name','=',$name],['pwd','=',$pwd]])->first();
//        dd($data->login_id);
        if(!$data){
            return json_encode(['code'=>201,'msg'=>'请输入正确的用户名或密码']);
        }
        $token = md5(($data->login_id).time());
        $date = login::where('login_id',$data->login_id)->update([
            'token'=>$token,
            'time'=>time()+3600
        ]);
        if($data){
            return json_encode(['code'=>200,'msg'=>$token]);
        }
    }

    /**
     * 分类
     */
    public function index_fenlei()
    {
        $type = type::get();
        return json_encode(['msg'=>$type]);
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















    public function as(Request $request)
    {
        dd($request->input('token'));
    }
}
