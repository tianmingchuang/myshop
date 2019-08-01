<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>展示</title>
</head>
<body>

<form action="{{url('zho/login_1/eca')}}" method="post">
    <table>
        <tr>
            <td>卷名:<input type="text" name="c_name" id=""></td>
        </tr>
        @csrf
        @foreach($data as $v)

            <tr>
                <td>选题<input type="checkbox" name="name1[]" value="{{$v->id}}"></td>
                {{--        <td>题号{{$v->id}}</td>--}}
                <td>{{$v->a_name}}</td>
            </tr>
        @endforeach
        <tr>
            <td><input type="submit" value="生成试卷"></td>
        </tr>
    </table>
</form>

{{--<table>--}}
{{--    @foreach($data as $v)--}}
{{--    <tr>--}}
{{--        <td>题号{{$v->id}}</td>--}}
{{--        <td>{{$v->a_name}}</td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <td><input type="radio" name="c_name" id="" value="A">A</td>--}}
{{--        <td>{{$v->name_1}}</td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <td><input type="radio" name="c_name" id="" value="B">B</td>--}}
{{--        <td>{{$v->name_2}}</td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <td><input type="radio" name="c_name" id="" value="C">C</td>--}}
{{--        <td>{{$v->name_3}}</td>--}}
{{--    </tr>--}}
{{--    <tr>--}}
{{--        <td><input type="radio" name="c_name" id="" value="D">D</td>--}}
{{--        <td>{{$v->name_4}}</td>--}}
{{--    </tr>--}}
{{--        <tr><td><input type="submit" value="提交"></td></tr>--}}
{{--    @endforeach--}}

{{--    @foreach($datas as $v)--}}
{{--            <tr>--}}
{{--                <td>题号{{$v->id}}</td>--}}
{{--                <td>{{$v->a_name}}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td><input type="checkbox" name="name1[]" id="" value="A">A</td>--}}
{{--                <td>{{$v->name_1}}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td><input type="checkbox" name="name1[]" id="" value="B">B</td>--}}
{{--                <td>{{$v->name_2}}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td><input type="checkbox" name="name1[]" id="" value="C">C</td>--}}
{{--                <td>{{$v->name_3}}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td><input type="checkbox" name="name1[]" id="" value="D">D</td>--}}
{{--                <td>{{$v->name_4}}</td>--}}
{{--            </tr>--}}
{{--            --}}{{--        <tr><td><input type="submit" value="提交"></td></tr>--}}
{{--        @endforeach--}}

{{--        @foreach($datass as $v)--}}
{{--            <tr>--}}
{{--                <td>题号{{$v->id}}</td>--}}
{{--                <td>{{$v->a_name}}</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td></td>--}}
{{--                <td><input type="radio" name="c_name" id="" value="对">对  <input type="radio" name="c_name" id="" value="错">错</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--</table>--}}

</body>
</html>