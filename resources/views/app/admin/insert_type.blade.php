@extends('app.admin')
@section('title','商品类型')
@section('body')
    <center>
        <form action="{{url('app/admin/insert_type_1')}}" method="post">
            <table>
                <p>商品类型</p>
                <tr>
                    <td><input type="text" name="name" id=""></td>
                </tr>
                <tr>
                    <td><input type="submit" value="提交"></td>
                </tr>
            </table>
        </form>
    </center>
@endsection