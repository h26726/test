<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="{{ URL::asset('favicon.ico') }}">
        <link type="text/css" href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::asset('bootstrap/css/bootstrap.min.css') }}">
        <script src="{{ URL::asset('jquery/jquery.js') }}"></script>
        <script src="{{ URL::asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <!-- <script src="{{ URL::asset('jquery/jquery.easy-pie-chart.js') }}"></script> -->
        <script src="{{ URL::asset('js/app.js') }}"></script>
        <script src="https://kit.fontawesome.com/29b684afdb.js" crossorigin="anonymous"></script>

        <title>HR SYSTEM</title>
    </head>
    <body style="background-color:#FBFFF2; padding: 0px;">
            <nav class="">
                <div id="menu-bar" class="scrollable">
                    <h5>
                        <a data-toggle="collapse" class="title" href="http://hr.fa88999.com:8088/pYq4gwyNjZN0iZi0zazCJDC1/XlMemTzAitUmm77oX0gasn/index">HR System</a>
                    </h5>
                    &ensp;<a id="fold_btn" style="cursor: pointer;"><i class="far fa-minus-square fa-lg"></i></a>
                    <div id="menu-content">

                        <ul class="navbar-nav justify-content-end">

                            @foreach ($menu as $key => $v)
                            <li class="nav-item" id="remind"></li>
                            <li>

                                <div class="menu">

                                    <a id=""
                                        class="menu_btn{{$key}} nav-link "
                                        data-toggle="collapse"
                                        role="button"
                                        aria-expanded="false"
                                        aria-controls="collapse_navbar{{$key}}"
                                        style="font-size: 18px;"
                                    >
                                    @if ($v[2]=='HR')
                                        <i class="fas fa-user"></i> {{$nickName}}
                                    @else
                                        {{$v[1]}}
                                    @endif
                                        <i class="fas fa-caret-down"></i>
                                    </a>
                                    <div class="collapse collapse_nav rounded" id="collapse_navbar{{$key}}">
                                        @foreach ($v[0] as $v2)
                                        <a class="nav-link" href="{{$v[2]}}-{{$v2[0]}}">{{$v2[1]}}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </nav>
            <div id="main">
                <div id="banner" style="text-align: center;">
                    @yield('content')
                </div>
            </div>
    </body>
</html>
<script>
    @foreach ($menu as $key => $v)
		$(".menu_btn{{$key}}").click(function(){
			$("#collapse_navbar{{$key}}").collapse('toggle')
		})
    @endforeach
        $(".menu_btn_user").click(function(){
			$("#collapse_navbar_user").collapse('toggle')
		})

        $("#fold_btn").click(function(){
            $(".collapse").collapse('hide')

        })


</script>
<script type="text/javascript"></script>
