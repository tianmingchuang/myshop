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
    <h3>竞猜结果</h3>
    <h4>对战结果:
        @if(($data->shijian)>=time())
            未到时间
        @elseif(($data->daan)==1)
            {{$data->name1}} &nbsp&nbsp&nbsp胜  &nbsp&nbsp&nbsp{{$data->name2}}
        @elseif(($data->daan)==2)
            {{$data->name1}} &nbsp&nbsp&nbsp平  &nbsp&nbsp&nbsp{{$data->name2}}
        @elseif(($data->daan)==3)
            {{$data->name1}} &nbsp&nbsp&nbsp负  &nbsp&nbsp&nbsp{{$data->name2}}
        @endif
    </h4>
    <h4>您的竞猜:
        @if(($data->daan)==0)
            未到时间
        @elseif(($data->daans)==1)
            {{$data->name1}} &nbsp&nbsp&nbsp胜  &nbsp&nbsp&nbsp{{$data->name2}}
        @elseif(($data->daans)==2)
            {{$data->name1}} &nbsp&nbsp&nbsp平  &nbsp&nbsp&nbsp{{$data->name2}}
        @elseif(($data->daans)==3)
            {{$data->name1}} &nbsp&nbsp&nbsp负  &nbsp&nbsp&nbsp{{$data->name2}}
        @endif
    </h4>
    <h4>
        结果:
        @if(($data->shijian)>=time())
                未到时间
        @elseif(($data->daan)==($data->daans))
            恭喜您   猜中
        @elseif(($data->daan)!==($data->daans))
            很遗憾   未猜中
        @endif
    </h4>
</center>
</body>
</html>