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
    <table border>
        <tr>
            <td>姓名</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->ming}}</td>
            <td>
                <a href="{{url('wx/index/index_2/index_4_do')}}?id={{$v->openid}}">表白</a>
            </td>
        </tr>
        @endforeach
    </table>
</center>
</body>
</html>