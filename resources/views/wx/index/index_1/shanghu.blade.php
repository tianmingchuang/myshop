@extends('index.layout.login')
@section('title','二维码商户添加')
@section('body')
    <center>
        <form action="{{url('wx/index/index_1/shanghu_do')}}" method="post">
            <table>
                @csrf
                <tr>
                    <td>推广用户名: </td>
                    <td><input type="text" name="name" id=""></td>
                    <td><input type="submit" value="提交"></td>
                </tr>
            </table>
        </form>
    </center>
@endsection