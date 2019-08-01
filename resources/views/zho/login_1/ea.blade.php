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
    <table>
    @foreach($data as $v)
    <tr>
        <td>题号{{$v->id}}</td>
        <td>{{$v->a_name}}</td>
    </tr>
    <tr>
        <td><input type="radio" name="c_name" id="" value="A">A</td>
        <td>{{$v->name_1}}</td>
    </tr>
    <tr>
        <td><input type="radio" name="c_name" id="" value="B">B</td>
        <td>{{$v->name_2}}</td>
    </tr>
    <tr>
        <td><input type="radio" name="c_name" id="" value="C">C</td>
        <td>{{$v->name_3}}</td>
    </tr>
    <tr>
        <td><input type="radio" name="c_name" id="" value="D">D</td>
        <td>{{$v->name_4}}</td>
    </tr>
        <tr><td><input type="submit" value="提交"></td></tr>
    @endforeach</table>
</body>
</html>