
@extends('Outside')

@section('content')

<h1 style="margin: 100px 0 50px 0; font-size:50px ;">歡迎使用人資系統</h1>

<div class="container">
        <div class="form-group" style="margin-bottom: 20px;">
            <label for="email">簽名:</label>
            <input type="text" class="" id="sign" name="sign" value="{{$sign}}" style=" text-align: center; ">
            <label for="email">(用於驗簽核)</label>
        </div>
        <button id="useSign" class="btn btn-info">確定</button>&ensp;
        <button id="clearSign" class="btn btn-danger" name="cc" value="cc">清除</button>
</div>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#useSign').on('click',function(){
        var data={'sign': $('#sign').val()};
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "",
            type: "POST",
            cache:false,
            dataType: 'json',
            data:{cmd:"useSign", data:data},
            success: function(result){
                console.log(result);//test
                if (result['errorCode']===1) {
                    alert('簽名更新失敗!，請聯繫系統人員')
                    return;
                }
                $('#sign').val(result['Data']['sign']);
                alert('簽名更新成功!')
            },
            error: function(xhr){
                console.log(xhr);
                alert('簽名更新失敗!，請聯繫系統人員')
            }
        });
    });

    $('#clearSign').on('click',function(){
        var data={};
        $.ajax({
            url: "",
            type: "POST",
            cache:false,
            dataType: 'json',
            data:{cmd:"clearSign", data:data},
            success: function(result){
                console.log(result);//test
                if (result['errorCode']===1) {
                    alert('簽名清除失敗!，請聯繫系統人員')
                    return;
                }
                $('#sign').val('');
                alert('簽名清除成功!')
            },
            error: function(xhr){
                console.log(xhr);
                alert('簽名清除失敗!，請聯繫系統人員')
            }
        });
    });

</script>
@endsection


