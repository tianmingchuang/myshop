@extends('layout.admin')
@section('title','天气展示')
@section('body')
    <center>
{{--        <div align="right">--}}
{{--            <a href="{{url('api/index_1/login_dd')}}?token={{'dc84daed1ef4b31a9bab7b467610e3d5'}}">登录退出</a>--}}
{{--        </div>--}}
{{--        <table>--}}
        <table class="table">
{{--            <tr>--}}
{{--                <td>1</td>--}}
{{--                <td>2</td>--}}
{{--                <td>3</td>--}}
{{--                <td>4</td>--}}
{{--                <td>5</td>--}}
{{--                <td>6</td>--}}
{{--            </tr>--}}
           <tbody id="zhan">

           </tbody>
        </table>
    </center>
    <script>
        $.ajax({
            url : 'http://www.my_shop.com/api/index_1/se',
            dataType : 'json',
            type : 'post',
            success : function(res){
                $.each(res,function(k,v){
                    var tr = $("<tr></tr>");
                        tr.append('<td>'+v.week+'</td>');
                        tr.append('<td>'+v.citynm+'</td>');
                        tr.append('<td>'+v.temperature+'</td>');
                        tr.append('<td>'+v.weather+'</td>');
                        tr.append('<td>'+v.wind+'</td>');
                        tr.append('<td>'+v.winp+'</td>');
                    // alert(v);
                    $('#zhan').append(tr);
                })

                // alert(res);
            }
        })
    </script>
@endsection