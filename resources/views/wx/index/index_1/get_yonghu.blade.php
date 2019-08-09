@extends('index.layout.login')
@section('title','用户标签添加')
@section('body')
    <center>
        <form action="{{url('wx/index/index_1/post_yonghu')}}" method="post">
            @csrf
            <br>
            <br>
            <br>
            <br>
            <p>
            用户标签添加 :
                <input type="text" name="name" id="">
            </p>
            <br>
            <br>
            <p>
            <input type="submit" name="" value="提交">
            </p>
        </form>
    </center>
@endsection
