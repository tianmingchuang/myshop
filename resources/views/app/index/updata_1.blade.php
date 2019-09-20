@extends('layout.admin')
@section('title','展示')
@section('body')
    <center>

        <table class='table'>
            <tr>
                <td>姓名</td>
                <td><input type="text" name="c_name" id="c_name"></td>
            </tr>
            <tr>
                <td>年龄</td>
                <td><input type="text" name="c_sae" id="c_sae"></td>
            </tr>
            <input type="hidden" name="id" id="id">
            <tr>
                <td colspan="2"><input type="submit" value="修改" class="xiugai"></td>
            </tr>
        </table>
    </center>
    <script>
        function getQueryString(name) {
            var reg = new RegExp('(^|&)' + name + '=([^&]*)(&|$)', 'i');
            var r = window.location.search.substr(1).match(reg);
            if (r != null) {
                return unescape(r[2]);
            }
            return null;
        }
        var id = getQueryString('ids')
        // alert(id);
        $.ajax({
            url : "{{url('app/index_1')}}"+'/'+id,
            // data : {_ : id},
            dataType : 'json',
            type : 'get',
            success : function(res){
                $("[name='c_name']").val(res.msg.c_name);
                $("[name='c_sae']").val(res.msg.c_sae);
                $("[name='id']").val(res.msg.id);
            }
        })
        $('.xiugai').on('click',function(){
            // alert(1);
            // alert(data);
            var c_name = $('#c_name').val();
            var c_sae = $('#c_sae').val();
            var id = $('#id').val();

            $.ajax({
                url : "{{url('app/index_1')}}"+'/'+id,
                data : {_method:'PUT',c_name:c_name,c_sae:c_sae},
                dataType : 'json',
                type : 'POST',
                success : function(res){
                    alert(res.msg);
                    if(res.code == 200){
                        location.href = "select_1";
                    }

                }
            })
        })

    </script>
@endsection