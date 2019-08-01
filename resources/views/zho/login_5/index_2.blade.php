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
  <form action="{{url('zho/login_5/index_21')}}" method="post">
  <p>添加门卫信息</p>
    @csrf
  <p>名 : <input type="text" name="c_name" id=""></p>
  <p>号 : <input type="password" name="pwd" id=""></p>
  <p>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <input type="submit" value="添加">
  </p>
  </form>
</center>
</body>
</html>