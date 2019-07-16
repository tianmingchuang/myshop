@extends('index.layout.login')
@section('title','展示')
@section('body')
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <a href="{{url('index/index/index')}}">添加</a>
    <form action="">
        @csrf
        <input type="text" name="sosuo" value="{{$sosuo}}" id=""><button>搜索</button>
    </form>
    <table border>
        <tr>
            <td>商品编号</td>
            <td>商品名称</td>
            <td>商品图片</td>
            <td>商品价格</td>
            <td>添加时间</td>
            <td>商品操作</td>
        </tr>
    @foreach ($data as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->goods_name}}</td>
            <td><img src="{{$v->goods_pic}}" width="50" alt=""></td>
            <td>{{{$v->goods_price}}}</td>
            <td>{{date("Y-m-d H:i:s",$v->add_time)}}</td>
            <td>
                <a href="{{url('index/index/update',['id'=>$v->id])}}">修改</a>
                <a href="{{url('index/index/delete',[$v->id])}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{$data->appends(['sosuo' => $sosuo])->links()}}
@endsection
