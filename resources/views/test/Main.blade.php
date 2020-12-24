<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>
        td {
            height: 50px;
            width: 100px;
            text-align: center;
        }

    </style>
</head>

<body>

    <table>
        <tr>
            <td>id</td>
            <td>NAME</td>
            <td>PASSWORD</td>
            <td>TIME</td>
            <td>WINRATE</td>
        </tr>
        @unless(!isset($data))
            @foreach ($data as $v)
                <tr style="">
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->UserName }}</td>
                    <td>{{ $v->UserPassword }}</td>
                    <td>{{ $v->LoginTime }}</td>
                    <td>{{ $v->win_rate }}</td>
                    <td>
                        <input type="button" value="修改" class="edit" data-toggle="modal" data-target="#myModal"
                            data-id="{{ $v->id }}" data-UserName="{{ $v->UserName }}"
                            data-UserPassword="{{ $v->UserPassword }}" data-LoginTime="{{ $v->LoginTime }}"
                            data-win_rate="{{ $v->win_rate }}">
                        <form method="POST" action="test/{{ $v->id }}">
                            {{ csrf_field() }}
                            {!! method_field('delete') !!}
                            {{-- <input type="button" onclick="deletew({{ $v->id }})"
                                value="刪除"> --}}
                            <input type="submit" value="刪除">
                        </form>
                    </td>
                </tr>
            @endforeach
        @endunless
    </table>
    <input type="button" value="ajax" onclick="aa()">
    <form action="test" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="cmd" value="newdata">
        <input type="text" name="UserName" value="">
        <input type="text" name="UserPassword" value="">
        <input type="text" name="LoginTime" value="">
        <input type="text" name="win_rate" value="">
        <input type="submit" value="Send Request">

    </form>
    <form action="test" enctype="multipart/form-data" method="post">
        {{ csrf_field() }}
        <input type="hidden" name="cmd" value="upfile">
        <input type="file" name="file1" id="fileUpload">
        <input type="submit" value="上傳檔案">
    </form>
    <div>
        <form id="upd" action="" method="post">
            {{ csrf_field() }}
            {!! method_field('patch') !!}
            {{-- <input id="id" type="hidden" name="id" value="">
            --}}
            <input id="UserName" type="text" name="UserName" value="">
            <input id="UserPassword" type="text" name="UserPassword" value="">
            <input id="LoginTime" type="text" name="LoginTime" value="">
            <input id="win_rate" type="text" name="win_rate" value="">
            <input type="submit" value="修改">
        </form>
    </div>
</body>

</html>

<script>
    function deletew(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: 'test/' + id,
            type: 'DELETE',
            success: function(result) {
                location.href = 'test'
            }
        });
    }

    $(".edit").click(function(event) {
        $("#upd").attr("action", "test/" + event.target.attributes[5].nodeValue);
        $("#UserName").val(event.target.attributes[6].nodeValue);
        $("#UserPassword").val(event.target.attributes[7].nodeValue);
        $("#LoginTime").val(event.target.attributes[8].nodeValue);
        $("#win_rate").val(event.target.attributes[9].nodeValue);
    })

    function aa() {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type:'Delete',
            url:"",
            dataType:'json',
            contentType : 'application/json; charset=utf-8',
            data:{
              'name':'name'
            },
            success: function(result) {
                console.log(result); // result是json物件
            },
        });
    }

</script>
