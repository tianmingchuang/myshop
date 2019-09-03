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
        <form action="{{url('app/index/update_do')}}" method="post">
            @csrf
            <table border>
                <input type="hidden" name="id" value="{{$data->id}}">
                    <p>名   <input type="text" name="c_name" value="{{$data->c_name}}"> </p>
                    <p>年龄   <input type="text" name="c_sae" value="{{$data->c_sae}}"></p>
                    <p><input type="submit" value="修改"></p>

            </table>
        </form>
    </center>
</body>
</html>