@extends('app.admin')
@section('title','商品属性')
@section('body')
    <center>
        <h6><a href="{{url('app/admin/insert_type')}}">添加</a></h6>
        <table class="table">
            <tr>
                <td>编号</td>
                <td>名称</td>
            </tr>
            @foreach($data as $v)
                <tr>
                    <td>{{$v->id}}</td>
                    <td>{{$v->name}}</td>
                </tr>
            @endforeach
        </table>
    </center>
@endsection