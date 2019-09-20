<?php

namespace App\Http\Controllers\app\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\model\goods;
use App\Http\Controllers\model\attribute;

class index extends Controller
{

    public function denglu()
    {
//        dd(1);
        return view('app/denglu');
    }

    public function denglu_do(Request $request)
    {
        $data = $request->input();
//        dd($data);
        $datas = DB::connection('app')->table('admin')->where([['name','=',$data['name']],['pwd','=',$data['pwd']]])->first();
//        dd($datas);
//        dd($request->session()->get('admin'));
        if($datas){
            $request->session()->forget('admin');
            $request->session()->put('admin',$datas);
//            dd($value = $request->session()->get('admin'));
            return redirect('app/admin/index');
        }else{
            return redirect('app/denglu');
        }
    }

//    public function aa()
//    {
//        $data = DB::connection('app')->belongsToMany('category\attribute')->find(1)->get();
////        $data = $this->wuxian($data);
//                dd($data);
//    }
    public function wuxian($data ,$name_id=0 , $kong=2)
    {
        static $date = [];
        foreach ($data as $v){
            if ($v->name_id == $name_id){
                    $v->kong=$kong*2;
                    $date[] = $v;
                    $this->wuxian($data,$v->id,$v->kong);
            }
        }
        return $date;
    }
    public function index()
    {
//        dd(1);
        return view('app/admin/index');
    }

    public function select_category()
    {
        $category = DB::connection('app')->table('category')->get();
//        dd();
        return view('app/admin/select_category',['data'=>$category]);
    }
    public function insert()
    {
        $data = DB::connection('app')->table('category')->get()->toArray();
        $data = $this->wuxian($data);
        return view('app/admin/insert',['data'=>$data]);
    }

    public function insert1(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $re = DB::connection('app')->table('category')->where('id',$data['name_id'])->first();
//        dd($re->shuliang);
        $shuliang = ($re->shuliang)+1;
        $re = DB::connection('app')->table('category')->where('id',$data['name_id'])->update(['shuliang'=>$shuliang]);
        $date = DB::connection('app')->table('attribute')->insert(['name'=>$data['name'],'category_id'=>$data['name_id'],'xianshi'=>$data['xianshi']]);
        if($date){
            return redirect('app/admin/select_attribute');
        }else{
            dd(1);
        }
    }

    public function insert_do(Request $request)
    {
        $name = $request->input('name');
//        dd($name);
        $data = DB::connection('app')->table('attribute')->where('name',$name)->count();
//        dd($data);
        if($data){
//            dd(1);
            return json_encode(['code'=>200,'msg'=>'重命名']);
        }else{
//            dd(2);
            return json_encode(['code'=>201,'msg'=>'*']);
        }
    }

    public function select_type()
    {
        $type = DB::connection('app')->table('type')->get();
//        dd($type);
        return view('app/admin/select_type',['data'=>$type]);
    }
    public function insert_type()
    {
        return view('app/admin/insert_type');
    }

    public function insert_type_1(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $date = DB::connection('app')->table('type')->insert(['name'=>$data['name']]);
        if($date){
         return redirect('app/admin/select_type');
        }else{
            dd(1);
        }
    }
    //商品属性
    public function insert_category()
    {
        $data = DB::connection('app')->table('category')->get()->toArray();
//        $type = DB::connection('app')->table('type')->get();
        $data = $this->wuxian($data);
        return view('app/admin/insert_category',['data'=>$data]);
    }

    public function insert_category_do(Request $request)
    {
        $name = $request->input('name');
//        dd($name);
        $data = DB::connection('app')->table('category')->where('name',$name)->count();
//        dd($data);
        if($data){
//            dd(1);
            return json_encode(['code'=>200,'msg'=>'重命名']);
        }else{
//            dd(2);
            return json_encode(['code'=>201,'msg'=>'*']);
        }
    }

    public function insert_category_1(Request $request)
    {
        $data = $request->all();
//        dd($data);
        $date = DB::connection('app')->table('category')->insert(['name'=>$data['name'],'name_id'=>$data['name_id']]);
        if($date){
            return redirect('app/admin/select_category');
        }else{
            dd(1);
        }
    }

    public function select_attribute()
    {
//        dd(1);
        $attribute = DB::connection('app')->table('category')->get();
//        dd($attribute);
        return view('app/admin/select_attribute',['data'=>$attribute]);
    }

    public function insert_shuxing($id)
    {
//        dd(11);
//        $category = DB::connection('app')->table('category')->get();
        return view('app/admin/insert_shuxing',['id'=>$id]);
    }

    public function select_shuxingchakan($id)
    {
        $data = DB::connection('app')->table('attribute')->where('category_id',$id)->get();
//        dd($data);
        return view('app/admin/select_shuxingchakan',['data'=>$data]);
    }

    /**
     * //属性批删
     *
     */
    public function shuxingchakan_do(Request $request)
    {
        $ids = $request->input('ids');
//        dd($ids);
        $attribute = new attribute;
        $data = $attribute->destroy($ids);
//        dump($data);
        return json_encode(['code'=>200,'msg'=>'删除成功']);
    }

    /**
     * //商品添加
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function insert_sptianjia()
    {
        $category = DB::connection('app')->table('category')->get();

        $type = DB::connection('app')->table('type')->get();

        return view('app/admin/insert_sptianjia',['category'=>$category,'type'=>$type]);
    }

    public function insert_sptianjia_do(Request $request)
    {
        $data = $request->input();
        $file = $request->file('file');
//        dd($data);
        $path = '';
        if(!empty($file)){
            $path = $file->store('shangpin/'.date('Y-n-j'));
            $path = '/tupian/'.$path;
        }
        $model = new goods;
//        $model = new goods;
//        $goods = $model->create(['goods_name'=>$data['goods_name'],'cat_id'=>$data['cat_id'],'goods_price'=>$data['goods_price'],'goods_hao'=>$data['goods_hao'],'type_id'=>$data['type_id']]);
        $goods = DB::connection('app')->table('goods')->insertGetId([
            'goods_name'=>$data['goods_name'],
            'type_id'=>$data['type_id'],
            'goods_price'=>$data['goods_price'],
            'goods_hao'=>$data['goods_hao'],
            'cat_id'=>$data['cat_id'],
            'goods_img'=>$path
        ]);
//        dd($goods);
//        $data['att_price_lrist']=[];
        foreach($data['attr_id_list'] as $k=>$v){
            $goods_attr = DB::connection('app')->table('goods_attr')->insert([
                'goods_id'=>$goods,
                'attribute_id'=>$v,
                'shuxingzhi'=>$data['attr_value_list'][$k],
                'price'=>$data['attr_price_list'][$k]??0,
            ]);
        }
//        dd($goods_attr);
        if($goods_attr){
            return redirect('app/admin/care'.'/'.$goods);
        }
    }

        public function care($goods)
    {
//        $goods_id = $request->input();
//        dd($goods);
        $goods = DB::connection('app')->table('goods')->where('goods_id',$goods)->first();
        $goods_attr = DB::connection('app')->table('goods_attr')->Join('attribute','goods_attr.attribute_id','=','attribute.id')->where([['goods_id','=',$goods->goods_id],['xianshi','=',2]])->get()->toArray();
//        dd($goods_attr);
        $data = [];
        foreach($goods_attr as $k=>$v){
            $data[$v->name][] = $v;
        }
//        dd($data);
//        groupBy('yi_name')->select(['yi_name'])->orderBy('yi_name')->get()->toArray()
        return view('app/admin/care',['goods'=>$goods,'data'=>$data]);
    }

    public function care_do(Request $request)
    {
        $data = $request->input();
//        dd($data);
        $shu = count($data['goods_attr']) / count($data['product_number']);
//        dd($shu);
        $goods_attr = array_chunk($data['goods_attr'],$shu);
//        dd($goods_attr);
        foreach($goods_attr as $k=>$v){
            $date = DB::connection('app')->table('care')->insert([
                'goods_id' => $data['goods_id'],
                'shuxingzhi'=>implode(',',$v),
                'kucun'=>$data['product_number'][$k]
            ]);
        }
        dump($date);
    }

    //商品展示
    public function admin(Request $request)
    {
        $sosuo = $request->input('sosuo')??'';
        $type_name = $request->input('type_name');
//        dump($name);
        $where = [];
        if(isset($type_name)){
            $where[] = ['type_id','=',$type_name];
        }
        if($sosuo != ''){
            $where[] = ['goods_name','like','%'.$sosuo.'%'];
        }
        $goods = DB::connection('app')->table('goods')->leftJoin('type','goods.type_id','=','type.id')->where($where)->orwhere([['goods_price','like','%'.$sosuo.'%']])->orwhere([['goods_hao','like','%'.$sosuo.'%']])->paginate(2);
        $type = DB::connection('app')->table('type')->get();
        return view('app/admin/admin',['goods'=>$goods,'sosuo'=>$sosuo,'type'=>$type]);
    }

    public function admin_gai(Request $request)
    {
        $name = $request->input('name');
        $id = $request->input('id');
//        dd($id);
        if($name == '下架'){
            $data = DB::connection('app')->table('goods')->where('goods_id',$id)->update(['zhuangtai'=>2]);
            $datas = '上架';
        }else{
            $data = DB::connection('app')->table('goods')->where('goods_id',$id)->update(['zhuangtai'=>1]);
            $datas = '下架';
        }
        return json_encode(['code'=>200,'msg'=>$datas]);
    }

    public function admin_do(Request $request)
    {
        $name = $request->input('name');
        $id = $request->input('id');
//        dd($name);
        $data = DB::connection('app')->table('goods')->where('goods_id',$id)->update(['goods_name'=>$name]);
    }

    public function select_type1(Request $request)
    {
//        dd(1);
        $type_id = $request->input('type_id');
//        dd($type_id);
        $data = DB::connection('app')->table('attribute')->where('category_id','=',$type_id)->get();
//        dd($data);
        return json_encode(['code'=>200,'msg'=>$data]);
    }
    
}
