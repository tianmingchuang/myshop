<?php

namespace App\Http\Controllers\app;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\model\shangpin;

class index_2 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $model = new shangpin;
        $name = $request->input('name')??'';
        $price = $request->input('price')??'';
        $page = $request->input('page')??'';
        $a = '商品名称'.$name.'商品价格'.$price.'第'.$page.'页';
            if(empty($redis->get($a))){
                $data = $model->where([['name','like','%'.$name.'%'],['price','like','%'.$price.'%']])->paginate(3)->toArray();
                $date = json_encode($data,JSON_UNESCAPED_UNICODE);
                $redis->set("$a","$date");
            }else{
                $data = json_decode($redis->get("$a"),1);
            }
        foreach ($data['data'] as $k => $v) {
            $data['data'][$k]['name'] = str_replace($name, "<b style='color:red'>" . $name . "</b>", $v['name']);
//                        print_r(str_replace($name, "<b style='color:red'>" . $name . "</b>", $v['name']));
            $data['data'][$k]['price'] = str_replace($price, "<b style='color:red'>" . $price . "</b>", $v['price']);
//                        print_r($data);
        }
        return json_encode(['code'=>200,'msg'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input();
//        dd($name['name']);
        if(empty($name['name'])||empty($name['price'])){
//            dd(11);
            return json_encode(['code'=>201,'msg'=>'参数不够']);
        }
        $page = '';
        $path = $request->file('file')->store('shangpin/'.date('Y-j-n'));
//        dd($path);
        $shangpin = new shangpin;
//        dd($shangpin);
        $data = $shangpin->insert(['name'=>$name['name'],'price'=>$name['price'],'pic'=>$path]);
        if($data){
            return json_encode(['code'=>200,'msg'=>'添加成功']);
        }else{
            return json_encode(['code'=>202,'msg'=>'添加失败']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aaa = new shangpin;
        $data = $aaa->where('id',$id)->first();
        if($data) {
            return json_encode(['code' => 200, 'msg' => $data]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name = $request->input();
//        dd($name['name']);
        if(empty($name['name'])||empty($name['price'])){
//            dd(11);
            return json_encode(['code'=>201,'msg'=>'参数不够']);
        }
        $page = '';
        $path = $request->file('file')->store('shangpin/'.date('Y-j-n'));
//        dd($path);
        $shangpin = new shangpin;
//        dd($shangpin);
        $data = $shangpin->where('id',$id)->update(['name'=>$name['name'],'price'=>$name['price'],'pic'=>$path]);
        if($data){
            return json_encode(['code'=>200,'msg'=>'修改成功']);
        }else{
            return json_encode(['code'=>202,'msg'=>'修改失败']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        dd($id);
        $model = new shangpin;
        $data = $model->where('id','=',$id)->first();
//        dd(env('APP_URL').'/public/'.$data->pic);
//        rmdir(env('APP_URL').'/tupian/'.$data->pic);
        $data = $model->where('id','=',$id)->delete();
        if($data){
            return json_encode(['code'=>200,'msg'=>'删除成功']);
        }else{
            return json_encode(['code'=>201,'msg'=>'删除失败']);
        }
    }


}
