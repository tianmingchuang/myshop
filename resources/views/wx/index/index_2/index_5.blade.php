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
            <td>发送人</td>
            <td>内容</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <td>{{$v->nr}}</td>
        </tr>
        @endforeach
    </table>
</center>
</body>
</html>