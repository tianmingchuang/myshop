<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>展示</title>
</head>
<link href="{{asset('css/app.css')}}" rel="stylesheet">
<body>
    <table border>
        <tr>
            <td>项目</td>
            <td>操作</td>
        </tr>
        @foreach($data as $v)
        <tr>
            <td>{{$v->name}}</td>
            <td>
                <a href="{{url('zho/login_2/select',['id'=>$v->id])}}">启用</a>
                <a href="{{url('zho/login_2/delete',['id'=>$v->id])}}">删除</a>
            </td>
        </tr>
        @endforeach
    </table>
    {{ $data->links() }}
</body>
</html>