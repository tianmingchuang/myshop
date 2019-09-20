@extends('app.admin')
@section('title','商品属性')
@section('body')
    <center>
        <h6><a href="{{url('app/admin/insert')}}">添加</a></h6>
        <table class="table">
            <tr align="center">
                <td>编号</td>
                <td>名1称</td>
                <td>属性数量</td>
                <td>操作</td>
            </tr>
        @foreach($data as $v)
            <tr align="center">
                <td>{{$v->id}}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->shuliang}}</td>
                <td>
                    <a href="{{url('app/admin/select_shuxingchakan',['id'=>$v->id])}}">属性查看</a>
                    <a href="{{url('app/admin/insert_shuxing',['id'=>$v->id])}}">属性添加</a>
                </td>
            </tr>
            @endforeach
        </table>
    </center>
@endsection