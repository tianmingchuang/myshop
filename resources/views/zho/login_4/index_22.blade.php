@extends('zho.login_4.index')
@section('title','展示')
@section('body')
    <center>
        <h3><a href="{{url('zho/login_4/index_2')}}">添加门卫</a> </h3>
        <table border>
            <tr>
                <td width="60">名</td>
                <td width="60">号</td>
                <td width="60">操作</td>
            </tr>
            @foreach($data as $v)
            <tr>
                <td width="60">{{$v->name}}</td>
                <td width="60">{{$v->password}}</td>
                <td width="60"><a href="{{url('zho/login_4/index_212',['id'=>$v->id])}}">移出</a></td>
            </tr>
                @endforeach
        </table>
    </center>
@endsection