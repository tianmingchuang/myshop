@extends('index.layout.login')
@section('title','管理员注册')
@section('body')
    <table class="layui-table">
        <colgroup>
            <col width="150">
            <col width="200">
            <col>
        </colgroup>
        <thead>

        <tr>
            <th>昵称</th>
            <th>加入时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $v)
        <tr>
            <td>{{$v->name}}</td>
            <td>{{date('Y-m-d H:i:s',$v->reg_time)}}</td>
            <td>
                <a href="{{url('index/index/hmd',['id'=>$v->id])}}">加入黑名单</a>
            </td>
            <td>
                <a href="{{url('index/index/quanxian',['id'=>$v->id])}}">权限</a>
            </td>
        </tr>
            @endforeach
        </tbody>
    </table>
@endsection