<?php

namespace App\Http\Controllers\wx\index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class index extends Controller
{
    public function index(Request $request)
    {
//        echo 111;
//        dd($request->all());
        if (empty($request->all()['access_token']) || $request->all()['access_token'] != '1234'){
            return json_encode(['error'=>'400']);
        }
        $data = DB::table('user')->get()->toArray();
        $data = json_decode(json_encode($data),1);
        echo json_encode($data);
    }
}
