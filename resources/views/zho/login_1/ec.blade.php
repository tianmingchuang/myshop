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
    <table>
        <tr>
            <td>编号</td>
            <td>卷名</td>
{{--            <td>操作</td>--}}
        </tr>
@foreach($data as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td><a href="{{url('zho/login_1/ea',['id'=>$v->id])}}">{{$v->c_name}}</a></td>
{{--            <td>答题</td>--}}
        </tr>
@endforeach
    </table>
</body>
</html>