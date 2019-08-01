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
<a href="{{url('zho/login_5/index_1')}}">回到首页</a>

    <center>
    <h3>尊敬的{{$data->name}}</h3>
    <h3>停车:{{$data->shijian}}</h3>
    <h3>收费:{{$data->qianshu}}元</h3>
    </center>
</body>
</html>