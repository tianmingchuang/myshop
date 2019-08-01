@extends('zho.login_4.index')
@section('title','车库管理')
@section('body')
    <center>
  <h2>车位添加</h2>
        <br>
        <br>
        <br>
        <form action="{{url('zho/login_4/asd_do')}}" method="post">
            @csrf
        车位数:<input type="text" name="c_name" id="">
        <input type="submit" value="确定添加车位">
        </form>
    </center>
@endsection