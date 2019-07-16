@extends('index.layout.login')
@section('title','添加')
@section('body')
{{--        <input type="submit" value="提交">--}}
    <form action="{{url('index/index/index_do')}}" method="post" enctype="multipart/form-data">
        @csrf
        <table border="">
            
            <tr>
                <td>商品名称:</td>
                <td><input type="text" name="c_name" id=""></td>
            </tr>
            <tr>
                <td>商品价格:</td>
                <td><input type="text" name="price" id=""></td>
            </tr>
            <tr>
                <td>图片:</td>
                <td><input type="file" name="pic" id=""></td>
            </tr>
            <tr>
                <td><input type="submit" value="提交"></td>
            </tr>
           
        </table>
    </form>
@endsection