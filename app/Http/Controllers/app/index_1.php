<?php

namespace App\Http\Controllers\app;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\model\kao;


class index_1 extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
//        echo 33;
        $c_name = $request->input('c_name')??'';
        $c_sae = $request->input('c_sae')??'';
        $model = new kao;
        $date = '';
        $date1 = '';
        if(empty($c_name)&&empty($c_sae)){
            $data = $model->paginate(3)->toArray();
//            dd($data);
        }else{
            $date = $c_name;
            $date1 = $c_sae;
            $data = $model->where('c_name','like','%'.$date.'%')->orwhere('c_sae','like','%'.$date.'%')->paginate(3)->toArray();
        }
//        dd($data);
//        if ($data){
        return json_encode(['code'=>200,'msg'=>$data,'c_name'=>$date,'c_sae'=>$date1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo 22;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        echo 77;
        $c_name = $request->input('c_name');
        $c_sae = $request->input('c_sae');
//        dd($c_name);
        if(empty($c_name) || empty($c_sae)){
            return json_encode(['code'=>201,'msg'=>'参数不够']);
        }
//        dd(1);
        $model = new kao;
//        dd($model);
        $data = $model->insert(['c_name'=>$c_name,'c_sae'=>$c_sae]);
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
//        dd($id);
        $aaa = new kao;
        $data = $aaa->where('id',$id)->first();
        if($data){
            return json_encode(['code'=>200,'msg'=>$data]);
//        }else{
//            return json_encode(['code'=>201,'msg'=>'失败']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
//        echo 44;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,$id)
    {
//        echo 55;
        $ids = $request->input();
//        dd($id['id']);
        if(empty($id) || empty($ids['c_sae']) || empty($ids['c_name'])){
            return json_encode(['code'=>202,'msg'=>'修改条件不符']);
        }
        $aaa = new kao;
        $data = $aaa->where('id',$id)->update(['c_name'=>$ids['c_name'],'c_sae'=>$ids['c_sae']]);
        if($data){
            return json_encode(['code'=>200,'msg'=>'修改成功']);
        }else{
            return json_encode(['code'=>201,'msg'=>'修改失败']);
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
//        echo 66;
//        $id = $request->input('id');
//        dd($id);
        $aaa = new kao;
        $data = $aaa->where('id',$id)->delete();
        if($data){
            return json_encode(['code'=>200,'msg'=>'删除成功']);
        }else{
            return json_encode(['code'=>201,'msg'=>'删除失败']);
        }
    }

}
