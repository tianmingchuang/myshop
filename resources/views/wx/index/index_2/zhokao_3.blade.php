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
    <table>
        <tr>
            <td>编号</td>
            <td>信息</td>
            <td>名称</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->uid}}</td>
            <td>{{$v->liuyanxinxi}}</td>
            <td>{{$v->name}}</td>
        </tr>
        @endforeach
    </table>
</center>
</body>
</html>