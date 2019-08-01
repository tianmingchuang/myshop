<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>登录</title>
</head>
<body>
<form action="{{url('zho/login_5/login_do')}}" method="post">
    @csrf
    <h3>账号: &nbsp&nbsp&nbsp&nbsp <input type="text" name="name1" id=""> </h3>
    <h3>密码: &nbsp&nbsp&nbsp&nbsp <input type="password" name="pwd" id=""></h3>
    <h3><input type="submit" value="登录"></h3>
</form>
</body>
</html>