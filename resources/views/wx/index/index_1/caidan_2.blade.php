@extends('index.layout.login')
@section('title','生成二维码')
@section('body')
    <center>
        <br>
            <h3>
                <a href="{{url('wx/index/index_1/caidan_1')}}">添加菜单</a>
                <br>
                <a href="{{url('wx/index/index_1/caidan_3')}}">应用</a>
            </h3>
        <table border>
            <tr align="center">
                <td>编号ID</td>
                <td>菜单级别</td>
                <td>一级菜单</td>
                <td>二级菜单</td>
                <td>菜单标识</td>
                <td>菜单类型</td>
                <td>菜单操作</td>
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
