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
<form action="{{url('zho/login_2/login_do')}}" method="post">
    <table>
        @csrf
        <p>账号:<input type="text" name="c_name"></p>
        <p>密码:<input type="password" name="password" id=""></p>
        <p><input type="submit" value="登录"></p>
    </table>
</form>
</body>
</html>