@extends('index.layout.login')
@section('title','表白菜单')
@section('body')
    <center>
        <br>
        <h3><a href="{{url('wx/index/index_2/index_2')}}">上传</a></h3>
        <table border>
            <tr align="center">
                <td>编号</td>
                <td>菜单等级</td>
                <td>一级菜单</td>
                <td>二级菜单</td>
                <td>标识</td>
                <td>类型</td>
                <td>操作</td>
            </tr>
            @foreach($data as $v)
            <tr align="center">
                <td>{{$v->id}}</td>
                <td>{{$v->caidan}}</td>
                <td>{{$v->yi_name}}</td>
                <td>{{$v->er_name}}</td>
                <td>{{$v->biaoshi}}</td>
                <td>{{$v->leixing}}</td>
                <td>
                    <a href="">删除</a>
                </td>
            </tr>
            @endforeach
        </table>
    </center>
@endsection
