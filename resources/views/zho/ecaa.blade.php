<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<link href="{{asset('css/app.css')}}" rel="stylesheet">
<form action="">
    <input type="text" name="sosuo" value="{{$sosuo}}" id="">
    <input type="submit" value="搜索">
</form>
<p>已浏览{{$name}}</p>
<a href="{{url('zho/index')}}">添加</a>
    <table border>
        <tr>
            <td>id</td>
            <td>商品名</td>
            <td>图片</td>
            <td>库存</td>
            <td>时间</td>
            <td>操作</td>
        </tr>
        @foreach ($data as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <td><img src="{{$v->pic}}" width="50" alt=""></td>
            <td>{{$v->ku}}</td>
            <td>{{date('Y-m-d H:i:s',$v->time)}}</td>
            <td>
                <a href="{{url('zho/update',['id'=>$v->id])}}">修改</a>
                <a href="{{url('zho/delete',['id'=>$v->id])}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $data->appends(['sosuo' => $sosuo])->links() }}
</body>
</html>