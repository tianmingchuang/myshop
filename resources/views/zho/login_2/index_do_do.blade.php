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
@foreach($data as $v)
    <p>项目</p>
    <p><a href="{{url('zho/login_2/index_do',['id'=>$v->id])}}">{{$v->name}}</a></p>
@endforeach
</body>
</html>