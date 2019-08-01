@extends('zho.login_1.index')
@section('title','多选')
@section('body')

    <br>
    <form action="{{url('zho/login_1/index_do_2_do')}}" method="post">
        @csrf
    <table border>
        <tr>
            <td>题</td>
            <td><input type="text" name="name"></td>
        </tr>


        <tr>
            <td><input type="checkbox" name="name1[]" id="" value="A">A</td>
            <td><input type="text" name="name_1"></td>
        </tr>
        <tr>
            <td><input type="checkbox" name="name1[]" id="" value="B">B</td>
            <td><input type="text" name="name_2"></td>
        </tr>
        <tr>
            <td><input type="checkbox" name="name1[]" id="" value="C">C</td>
            <td><input type="text" name="name_3"></td>
        </tr>
        <tr>
            <td><input type="checkbox" name="name1[]" id="" value="D">D</td>
            <td><input type="text" name="name_4"></td>
        </tr>

        <tr><td><input type="submit" value="提交"></td></tr>

    </table></form>
@endsection