@extends('zho.login_4.index')
@section('title','车辆入库')
@section('body')
    <center>
        <h2>车辆入库</h2>
        <br>
        <br>
        <br>
        <form action="{{url('zho/login_4/index_111')}}" method="post">
            @csrf
            <h4>车牌号: <input type="text" name="c_name" id=""></h4>
            <br>
            <br>
            <h4>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                <input type="submit" value="车辆进入">
            </h4>
        </form>
    </center>
@endsection