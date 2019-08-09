@extends('index.layout.login')
@section('title','标签')
@section('body')
    <center>
        <br>
        <br>
        <br>
        <h3>用户标签</h3>
        <br>
        <form action="{{url('wx/index/index_1/yonghu_select_do')}}" method="post">
            @csrf
        <table border>
            <tr>
                <td>存在标签</td>
{{--                <td>选择</td>--}}
            </tr>
            <input type="hidden" name="openid" value="{{$openid}}">
            @foreach($vo as $v)
                <tr>
                <td>{{$v}}</td>
{{--                    <td><input type="checkbox" name="tagid[]" value="" id=""></td>--}}
                </tr>
            @endforeach
        </table>
{{--        <input type="submit" value="移出">--}}
        </form>

    </center>
@endsection
