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


    <script src="{{asset('mstore/js/jquery.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
<center>
    <table>
    <h2>车辆管理</h2>
    <br>
    <br>
    <br>
    <h3>小区车位:&nbsp{{$data->name}}
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
        剩余车位:&nbsp
                @if($datas->name==0)
                    已停满
                @else
                    {{$datas->name}}
                @endif
    </h3>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <h3>
        <form action="{{url('zho/login_5/index_11')}}" method="get">
        <input type="submit" value="车辆入库">
        </form>
        &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp

        <input type="submit" onclick="chick()" value="车辆出库">
    </h3>
    </table>
</center>
<script>
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
</script>
    <script>
        function chick(){
            location.href = "{{url('zho/login_5/index_12')}}";

            }
{{--            else{--}}
{{--                $.post(--}}
{{--                    "{{url('zho/login_3/index_do')}}",--}}
{{--                    {name1:name1,name2:name2,shijian:shijian},--}}
{{--                    // alert(name1)--}}
{{--//             alert(name2)--}}
{{--                    function(res){--}}
{{--                        alert(res.msg);--}}
{{--                        if(res.code==1){--}}
{{--                            location.href = "{{url('zho/login_3/ecaa')}}"--}}
{{--                        }--}}
{{--                    },--}}
{{--                    'json'--}}
{{--                )--}}
{{--            }--}}
{{--        }--}}
    </script>
</body>
</html>