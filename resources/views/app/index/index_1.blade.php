@extends('layout.admin')
@section('title','展示')
@section('body')
<center>
    <table>
        <tr>
            <td>姓名 :</td>
            <td><input type="text" id="c_name" name="c_name"></td>
        </tr>
        <tr>
            <td>年龄 :</td>
            <td><input type="text" id="c_sae" name="c_sae"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="添加" id="sb"></td>
        </tr>
    </table>
    </center>
    <script>
        $("#sb").on('click',function () {
            // alert(1);

            var c_name = $('#c_name').val();
            var c_sae = $('#c_sae').val();
            // alert(c_name);
            // alert(c_sae);
            $.ajax({
                url : "{{url('app/index_1')}}",
                data : {c_name:c_name,c_sae:c_sae},
                type : 'post',
                dataType : 'json',
                success:function(res){
                    if(res.code==200){
                        alert(res.msg);
                        location.href = "http://www.my_shop.com/app/index/select_1";
                    }else{
                        alert(res.msg);
                    }

                }

            })
        })
    </script>
@endsection