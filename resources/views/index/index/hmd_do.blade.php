@extends('index.layout.login')
@section('title','黑名单')
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
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $v)
            <tr>
                <td>{{$v->name}}</td>
                <td>{{date('Y-m-d H:i:s',$v->reg_time)}}</td>
                <td>
                    <a href="{{url('index/index/hmd_dos',['id'=>$v->id])}}">移出黑名单</a>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endsection