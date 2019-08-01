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
<form action="{{url('zho/login_2/index')}}" method="post">
    @csrf
    <p>研究项目: <input type="text" name="c_name"></p>
    <p><input type="submit" value="添加研究项目"></p>
</form>
</body>
</html>