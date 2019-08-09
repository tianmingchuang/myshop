@extends('index.layout.login')
@section('title','用户标签添加')
@section('body')
    <center>
        <form action="{{url('wx/index/index_1/yonghu_select_do')}}" method="post">
            @csrf
        <table border>
            <tr>
                <td>选择</td>
                <td align="center">openid号</td>
            </tr>
            <input type="hidden" name="tagid" value="{{$id}}">
            @foreach($data as $v)
                <tr>
                    <td><input type="checkbox" name="openid[]" value="{{$v}}"></td>
                    <td>{{$v}}</td>
                </tr>
            @endforeach
        </table>
            <input type="submit" value="确定移出">
        </form>
    </center>
@endsection
