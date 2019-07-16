<?php

namespace App\Http\Controllers\zho;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class Index extends Controller
{
    public function index()
    {
        return view('zho/index');
    }

    public function insert(Request $request)
    {
        $data = $request->all();
        $file = $request->file('pic');
        if(empty($file)){
            echo '请上传图片';die;
        }else{
            $path = $file->store('zho');
            $path = ('/storage/'.$path);
        }
        $date = DB::table('zho')->insert(['name'=>$data['c_name'],'pic'=>$path,'time'=>time(),'ku'=>$data['ku']]);
        if($date){
            echo redirect('zho/ecaa');
        }else{
            echo 2;
        }
    }

    public function ecaa(Request $request)
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1','6379');
        $redis->incr('name');
        $name = $redis->get('name');
//        echo($name);
        $ss = $request->all();
        $sosuo = '';
        if(!empty($ss['sosuo'])){
            $sosuo = $ss['sosuo'];
            $data = DB::table('zho')->where('name','like','%'.$ss['sosuo'].'%')->paginate(2);
        }else{
            $data = DB::table('zho')->paginate(2);
        }

        return view('zho/ecaa',['data'=>$data,'sosuo'=>$sosuo,'name'=>$name]);
    }

    public function delete($id)
    {
        $res = DB::table('zho')->delete($id);
        if($res){
            return redirect('zho/ecaa');
        }else{
            echo 2;
        }
    }

    public function update($id)
    {
        $date = DB::table('zho')->where([['id','=',$id]])->first();
        return view('zho/update_do',['date'=>$date]);
    }

    public function update_do(Request $request)
    {
        $path = $request->file('pic');
        $data = $request->all();
//        dd($path);
        $file = '';
        if(empty($path)){
            $res = DB::table('zho')->where([['id','=',$data['id']]])->update(['name'=>$data['c_name'],'ku'=>$data['ku']]);
            if($res){
                return redirect('zho/ecaa');
            }else{
                echo '修改失败';
            }
        }else{
            $file = $path->store('zho');
            $file = ('/storage/'.$file);
            $res = DB::table('zho')->where([['id','=',$data['id']]])->update(['name'=>$data['c_name'],'ku'=>$data['ku'],'pic'=>$file]);
            if($res){
                return redirect('zho/ecaa');
            }else{
                echo '修改失败';
            }
        }
    }
}
