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

<form action="{{url('zho/login/insert')}}" method="post">
    <table border>
        @csrf
    <tr>
        <td>车次</td>
        <td>出发地</td>
        <td>到达地</td>
        <td>价钱</td>
        <td>票数</td>
        <td>出发时间</td>
        <td>到达时间</td>
    </tr>
    <tr>
        <td><input type="text" name="cc"></td>
        <td><input type="text" name="cfd" id=""></td>
        <td><input type="text" name="ddd" id=""></td>
        <td><input type="text" name="jq" id=""></td>
        <td><input type="text" name="ps" id=""></td>
        <td>
            <input type="text" name="cfsj" id="">
        </td>
        <td>
            <input type="text" name="ddsj" id="">
        </td>
    </tr>
    </table>
    <input type="submit" value="提交">
</form>
</body>
</html>