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
<h3>竞猜列表</h3>
    <table border>
        @foreach($data as $v)
        <tr>
            <td>{{$v->name1}}  &nbsp&nbsp&nbsp&nbspVS&nbsp&nbsp&nbsp {{$v->name2}}</td>

            <td>
                @if(($v->daan)==0)
{{--                    {{$v->daan}}--}}
                    <a href="{{url('zho/login_3/ecaa_do',['id'=>$v->id])}}">添加竞猜结果</a>
                @elseif(($v->daan)==1)
                    {{$v->name1}} &nbsp&nbsp&nbsp胜  &nbsp&nbsp&nbsp{{$v->name2}}
                @elseif(($v->daan)==2)
                    {{$v->name1}} &nbsp&nbsp&nbsp平  &nbsp&nbsp&nbsp{{$v->name2}}
                @elseif(($v->daan)==3)
                    {{$v->name1}} &nbsp&nbsp&nbsp负  &nbsp&nbsp&nbsp{{$v->name2}}
                @endif

            </td>
        </tr>
        @endforeach
    </table>
</center>
</body>
</html>