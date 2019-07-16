@extends('index.layout.login')
@section('title','修改')
@section('body')
    <form action="{{url('index/index/update_do')}}" method="post" enctype="multipart/form-data">
        @csrf
        <table border="">
            <tr>
                <td>商品名称:</td>
                <td><input type="text" name="c_name" value="{{$data->goods_name}}" id=""></td>
            </tr>
            <tr>
                <td>商品价格:</td>
                <td><input type="text" name="price" value="{{$data->goods_price}}" id=""></td>
            </tr>
            <tr>
                <td>图片:</td>
                <td><input type="file" name="pic"   id="">
                <img src="{{$data->goods_pic}}" width="30" alt=""></td>
            </tr>
            <input type="hidden" name="id" value="{{$data->id}}">
            <tr>
                <td><input type="submit" value="修改"></td>
            </tr>

        </table>
    </form>
@endsection