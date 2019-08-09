@extends('index.layout.login')
@section('title','用户标签添加')
@section('body')
    <center>
        <form action="{{url('wx/index/index_1/yonghu_update_do')}}" method="post">
            <br>
            @csrf
            <br>
            <br>
            <br>
            <input type="hidden" name="id" value="{{$id}}">
            <input type="text" name="name" id="" value="{{$name}}">
            <br>
            <input type="submit" value="修改">
        </form>
    </center>
@endsection
