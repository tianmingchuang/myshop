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
<form action="{{url('zho/update_do')}}" method="post" enctype="multipart/form-data">
    @csrf
    <table border>
        <tr>
            <td>名称:</td>
            <td><input type="text" name="c_name" value="{{$date->name}}"></td>
        </tr>
        <tr>
            <td>图片:</td>
            <td><input type="file" name="pic" id=""><img src="{{$date->pic}}" width="50" alt=""></td>
        </tr>
        <tr>
            <td>库存:</td>
            <td><input type="text" name="ku" id="" value="{{$date->ku}}"></td>
        </tr>
        <input type="hidden" name="id" value="{{$date->id}}">
        <tr>
            <td></td>
            <td><input type="submit" value="提交"></td>
        </tr>
    </table>
</form>
</body>
</html>