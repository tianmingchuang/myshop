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
        <h3><a href="{{url('zho/login_5/index_2')}}">添加门卫</a> </h3>
        <table border>
            <tr>
                <td width="60">名</td>
                <td width="60">号</td>
                <td width="60">操作</td>
            </tr>
            @foreach($data as $v)
            <tr>
                <td width="60">{{$v->name}}</td>
                <td width="60">{{$v->password}}</td>
                <td width="60"><a href="">移出</a></td>
            </tr>
                @endforeach
        </table>
    </center>
</body>
</html>