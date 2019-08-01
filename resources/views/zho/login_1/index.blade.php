<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title','首页')</title>
</head>
<body>


{{--<meta name="csrf-token" content="{{ csrf_token() }}">--}}


{{--<form action="{{url('zho/login_1/index_do')}}" method="post">--}}
{{--    @csrf--}}
    请选择题型:
{{--<select name="xz" id="" class="id">--}}
{{--        <option value="">请选择</option>--}}
{{--        <option value="1" class="id">单选</option>--}}
{{--        <option value="2" class="id">复选</option>--}}
{{--        <option value="3" class="id">判断</option>--}}
{{--    </select>--}}
    <a href="{{url('zho/login_1/index_do_1')}}">单选</a>
    <a href="{{url('zho/login_1/index_do_2')}}">复选</a>
    <a href="{{url('zho/login_1/index_do_3')}}">判断</a>


@section('body')


@show
{{--</form>--}}
{{--<form action="" method="post">--}}
{{--    <table border>--}}
{{--        <tr>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--            <td></td>--}}
{{--        </tr>--}}
{{--    </table>--}}
{{--</form>--}}
{{--<script>--}}
{{--    $('.id').click(function(){--}}
{{--        alert(1)--}}
{{--        // $.ajax({--}}
{{--        //     type: 'POST',--}}
{{--        //     url: 'zho/login_1/index_do',--}}
{{--        //     data:{ date:data} ,--}}
{{--        //     dataType: 'json',--}}
{{--        //     headers: {--}}
{{--        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--        //     }--}}
{{--        // },--}}

{{--        // )--}}
{{--        //--}}

{{--    });--}}


{{--</script>--}}

</body>
</html>