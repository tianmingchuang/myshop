<!doctype html>
<html lang="`">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <center>
        <h3>欢迎登陆</h3>
        <form action="{{url('kao/index/login_do')}}" method="post">
            @csrf
        <p>
            用户名:
            <input type="text" name="c_name" id="">
        </p>
            <p>
                密码 :
                <input type="password" name="pwd" id="">
            </p>
            <p>
                <input type="submit" value="登陆">
            </p>
        </form>
    </center>
</body>
</html>