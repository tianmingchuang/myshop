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
<center>
    <a href="{{url('wx/index/index_2/zhokao_3')}}?id={{$id}}">我的留言</a>
    <h3>欢迎{{$date}}登录</h3>
    <table>
        <tr>
            <td>编号</td>
            <td>用户名称</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <td>
                <a href="{{url('wx/index/index_2/zhokao_2',['uid'=>$v->id])}}?id={{$id}}">留言</a>
            </td>
        </tr>
        @endforeach
    </table>

</center>
</body>
</html>