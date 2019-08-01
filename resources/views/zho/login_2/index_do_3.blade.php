<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>复选</title>
</head>
<body>
<form action="{{url('zho/login_2/index_do_3_do')}}" method="post">
    @csrf
    <table border>
        <tr>
            <td>问题</td>
            @foreach($date as $v)
                <td>{{$v}}</td>
            @endforeach
        </tr>


        <tr>
            <td><input type="checkbox" name="name1[]" id="" value="A">A</td>
            <td><input type="text" name="name_1"></td>
        </tr>
        <tr>
            <td><input type="checkbox" name="name1[]" id="" value="B">B</td>
            <td><input type="text" name="name_2"></td>
        </tr>
        <tr>
            <td><input type="checkbox" name="name1[]" id="" value="C">C</td>
            <td><input type="text" name="name_3"></td>
        </tr>
        <tr>
            <td><input type="checkbox" name="name1[]" id="" value="D">D</td>
            <td><input type="text" name="name_4"></td>
        </tr>

        <tr><td><input type="submit" value="提交"></td></tr>

    </table></form>
</body>
</html>