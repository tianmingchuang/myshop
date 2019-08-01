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
<form action="{{url('zho/login_2/index_do_1')}}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{Session::get('id')}}">
    <p>研究问题: <input type="text" name="c_name" id=""></p>
    <p>问题选项: <input type="radio" name="a_name" id="" value="2">单选 <input type="radio" name="a_name" id="" value="3">多选</p>
    <p><input type="submit" value="问题添加"></p>
</form>
</body>
</html>