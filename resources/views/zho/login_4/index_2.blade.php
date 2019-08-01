@extends('zho.login_4.index')
@section('title','车辆入库')
@section('body')
<center>
  <form action="{{url('zho/login_4/index_21')}}" method="post">
  <p>添加门卫信息</p>
    @csrf
    <br>
    <br>
  <p>名 : <input type="text" name="c_name" id=""></p>
    <br>
    <br>
  <p>号 : <input type="password" name="pwd" id=""></p>
  <p>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="submit" value="添加">
  </p>
  </form>
</center>
@endsection