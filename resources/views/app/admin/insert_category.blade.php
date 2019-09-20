@extends('app.admin')
@section('title','商品属性')
@section('body')
    <script src="{{asset('bootstrap/jquery.min.js')}}"></script>
    <center>
        <form action="{{url('app/admin/insert_category_1')}}" method="post">
            <table class="table">
                <tr align="">
                    <td>商品分类</td>
                    <td>
                        <select name="name_id" id="">
                            <option value="0">一级分类</option>
                            @foreach($data as $v)
                                <option value="{{$v->id}}"><?php echo str_repeat("&nbsp;",$v->kong)?>{{$v->name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr align="">
                    <td>商品类型</td>
                    <td>
                        <input type="text" name="name" id="">
                        <span id="sp">*</span>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" value="提交" id="tijiao"></td>
                </tr>
            </table>
        </form>
    </center>
    <script>
        $('input[name="name"]').on('blur',function () {
            // alert(1);
            var name = $(this).val();
            // alert(name);
            $.ajax({
                url : "{{url('app/admin/insert_category_do')}}",
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