@extends('app.admin')
@section('title','商品类型添加')
@section('body')
    <script src="{{asset('bootstrap/jquery.min.js')}}"></script>
    <form action="{{url('app/admin/insert1')}}" method="post">
        <table class="table">
            <tr>
                <td>分类类型</td>
                <td>
                    <input type="text" name="name">
                    <span id="sp">*</span>
                </td>
            </tr>
            <tr>
                <td>商品属性</td>
                <td>
                    <select name="name_id" id="">
                        <option value="0">请选择</option>
                        @foreach($data as $v)
                        <option value="{{$v->id}}"><?php echo str_repeat("&nbsp;",$v->kong)?>{{$v->name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td>是否显示</td>
                <td>
                    <input type="radio" name="xianshi" value="1" id="">规格
                    <input type="radio" name="xianshi" id="" value="2">参数
                </td>

                <td></td>
                <td><input type="submit" value="提交" id="tijiao"></td>
            </tr>
        </table>
    </form>
    <script>
        $('input[name="name"]').on('blur',function () {
            // alert(1);
            var name = $(this).val();
            // alert(name);
            $.ajax({
                url : "{{url('app/admin/insert_do')}}",
                data : {name:name},
                dataType : 'json',
                type : 'post',
                success : function (res) {
                    if(res.code==200){
                        $('#sp').html(res.msg);
                        $('#tijiao').attr('disabled','true');
                    }else{
                        $('#sp').html('√');
                        $('#tijiao').removeAttr('disabled');
                    }
                }
            })
        })
    </script>
@endsection