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



    <form action="login" method="post">
        {{ csrf_field() }}

        <input type="text" name="UserName" value="">
        <input type="text" name="UserPassword" value="">

        <input type="submit" value="登入">
    </form>

</body>

</html>

<script>


</script>
