@extends('app.admin')
@section('title','商品属性')
@section('body')
    <center>
        <h6><a href="{{url('app/admin/insert_category')}}">添加</a></h6>
        <table class="table">
            <tr>
                <td>编号</td>
                <td>名称</td>
                <td>类型</td>
                <td>数量</td>
            </tr>
            @foreach($data as $v)
                <tr>
                    <td>{{$v->id}}</td>
                    <td>{{$v->name}}</td>
{{--                    <td>{{$v->type_id}}</td>--}}
{{--                    <td>{{$v->shuliang}}</td>--}}
                </tr>
            @endforeach
        </table>
    </center>
@endsection