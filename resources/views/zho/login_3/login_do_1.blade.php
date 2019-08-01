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
<form action="{{url('zho/login_3/login_do_1')}}" method="post">
    @csrf
    @foreach($data as $v)
        <td>{{$v->name1}}  &nbsp&nbsp&nbsp&nbspVS&nbsp&nbsp&nbsp {{$v->name2}}</td>
    @endforeach
    <br>
    <input type="radio" name="daans" id="" value="1">{{$v->name1}}胜
    <input type="radio" name="daans" id="" value="2">平
    <input type="radio" name="daans" id="" value="3">{{$v->name2}}胜
    <br>
    <input type="hidden" name="id" value="{{$v->id}}">
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="submit" value="添加">
</form>
</center>
</body>
</html>