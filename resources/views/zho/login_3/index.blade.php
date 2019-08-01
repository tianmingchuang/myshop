<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{asset('mstore/js/jquery.min.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<center>
{{--    <table></table>--}}
<h3>添加竞猜球队</h3>
<form action="{{url('zho/login_3/index_do')}}" method="post">
    @csrf
<input type="text" name="name1" class="id" id="input1">&nbsp&nbsp&nbsp&nbspVS&nbsp&nbsp&nbsp <input type="text" name="name2" class="ids" id="input2"><br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp     结束竞猜时间<input type="text" name="shijian" class="idss" id=""><br>
&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="button" onclick="chick()" value="提交" />
</form>

</center>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script language="javascript">
    function chick(){
        var name1 = $('.id').val();
        var name2 = $('.ids').val();
        var shijian = $('.idss').val();
        if(document.getElementById("input1").value==document.getElementById("input2").value){
            alert("不可相同");

        }else{
            $.post(
                "{{url('zho/login_3/index_do')}}",
                {name1:name1,name2:name2,shijian:shijian},
                // alert(name1)
//             alert(name2)
                function(res){
                    alert(res.msg);
                    if(res.code==1){
                        location.href = "{{url('zho/login_3/ecaa')}}"
                    }
                },
                'json'
            )
        }
    }

</script>
</body>
</html>