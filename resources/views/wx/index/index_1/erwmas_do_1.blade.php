@extends('index.layout.login')
@section('title','生成二维码')
@section('body')
    <center>
        <table border>
            <tr align="center">
                <td>编号</td>
                <td>openid</td>
                <td>关注时间</td>
            </tr>
            @foreach($data as $v)
            <tr>
                <td>{{$v->id}}</td>
                <td>{{$v->openid}}</td>
                <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
            </tr>
            @endforeach
        </table>
    </center>
@endsection
