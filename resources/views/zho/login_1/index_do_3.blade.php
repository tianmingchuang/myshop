@extends('zho.login_1.index')
@section('title','多选')
@section('body')

    <br>
    <form action="{{url('zho/login_1/index_do_3_do')}}" method="post">
        @csrf
    <table border>
        <tr>
            <td>题</td>
            <td><input type="text" name="name"></td>
        </tr>



        <tr>
            <td>判断</td>
            <td><input type="radio" name="c_name" id="" value="对">对  <input type="radio" name="c_name" id="" value="错">错</td>
        </tr>

        <tr><td><input type="submit" value="提交"></td></tr>

    </table></form>
@endsection