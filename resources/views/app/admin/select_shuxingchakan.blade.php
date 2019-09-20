@extends('app.admin')
@section('title','商品属性')
@section('body')
    <script src="{{asset('bootstrap/jquery.min.js')}}"></script>
    <center>
        <h6><a href="{{url('app/admin/insert')}}">添加</a></h6>
        <table class="table">
            <tr align="center">
                <td>选择
                    <input type="checkbox" id="shan">
                </td>
                <td>编号</td>
                <td>名称</td>
                <td>类型</td>
                <td>操作</td>
            </tr>
            @foreach($data as $v)
                <tr align="center">
                    <td><input type="checkbox" name="id[]" value="{{$v->id}}" class="shan"></td>
                    <td>{{$v->id}}</td>
                    <td>{{$v->name}}</td>
                    <td>

                        @if($v->xianshi == 1)
                        规格
                        @else
                        参数
                        @endif
                    </td>
                    <td>
                        <a href="{{url('app/admin/select_shuxingchakan',['id'=>$v->id])}}">属性查看</a>
                        <a href="{{url('app/admin/insert_shuxing',['id'=>$v->id])}}">属性添加</a>
                    </td>
                </tr>
            @endforeach
            <tr align="center">
                <td clospan="5"><input type="submit" value="删除"></td>
            </tr>
        </table>
    </center>
    <script>
        $('#shan').on('click',function () {
            // alert(1);
            var name = $(this).prop('checked');
            // console.log(name);
            $('.shan').prop('checked',name);
        })
        $('[type="submit"]').on('click',function () {
            // alert(1);
            var name = $('.shan');
            var ids = new Array();
            name.each(function () {
                var na = $(this).prop('checked');
                if(na ==true){
                    id = $(this).val();
                }else{
                    return;
                }
                ids.push(id);
            })
            $.ajax({
                url : "{{url('app/admin/shuxingchakan_do')}}",
                data : {ids:ids},
                dataType : 'json',
                type : 'post',
                success : function (res) {
                    alert(res.msg);
                    name.each(function () {
                        var na = $(this).prop('checked');
                        if(na ==true){
                           $(this).parent().parent().remove();
                        }
                    })

                    // $(true).remove();
                }
            })
        })
    </script>
@endsection