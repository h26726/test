<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../favicon.ico">

    <title>HR SYSTEM</title>
    <!-- Bootstrap core CSS -->
    <link href="../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../dist/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="../dist/daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="../dist/jquery-ui/jquery-ui.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/starter-template.css" rel="stylesheet">
    <link href="../public/css/custom.css" rel="stylesheet">
    <!-- javaScript -->
    <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->
    <script src="../dist/jquery/jquery.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script> -->
    <script src="../dist/jquery-ui/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="../dist/js/bootstrap.min.js"></script>

    <!-- datepicker -->
    <script src="../dist/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="../dist/bootstrap-datepicker/locales/bootstrap-datepicker.zh-TW.min.js" charset="UTF-8"></script>
    <!-- daterangepicker -->
    <script src="../dist/daterangepicker/moment.min.js" charset="UTF-8"></script>
    <script src="../dist/daterangepicker/daterangepicker.js" charset="UTF-8"></script>
    <!-- easypiechart -->
    <script src="../public/charts/easypiechart/jquery.easy-pie-chart.js"></script>
    <script src="../public/charts/sparkline/jquery.sparkline.min.js"></script>
    <script src="../public/charts/app.plugin.js"></script>
    <!-- custom script -->
    <script src="../public/custom.js"></script>
    <!-- HighChart -->
    <script src="../dist/highcharts-7.0.1/highcharts.js"></script>
    <script src="../dist/highcharts-7.0.1/modules/data.js"></script>
    <script src="../dist/highcharts-7.0.1/modules/drilldown.js"></script>
    
    <script src="../dist/highcharts-7.0.1/modules/series-label.js"></script> <!--顯示列表名稱-->
    <!-- HighChart_print chart -->
    {* <script src="../dist/highcharts-7.0.1/modules/exporting.js"></script>
    <script src="../dist/highcharts-7.0.1/modules/export-data.js"></script> *}

    <!-- ICON -->
    <link rel="stylesheet" href="../dist/fontawesome-5.2.0/css/all.css" >

  </head>

  <body  style="background-color:#FBFFF2; padding: 0px;">
     {* <nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="">{$TITLE}</a>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">

    			{if $FUNCTION_NAME!="Logout"}
          <li class="nav-item active">
            <a class="nav-link" href="./Logout">安全離開<span class="sr-only">(current)</span></a>
          </li>
          {/if}
    			{foreach from=$menu item=foo}
    				{if !is_array($foo[0])} 
    					<li class="nav-item active">
    						<a class="nav-link" href="{$foo[0]}">{$foo[1]}</a>
    					</li>
    				{else}
    					<li class="nav-item dropdown">
    						<a class="nav-link dropdown-toggle" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{$foo[1]}</a>
    						<div class="dropdown-menu">
    							{foreach from=$foo[0] item=foo2}
    							<a class="dropdown-item" href="{$foo2[0]}">{$foo2[1]}</a>
    							{/foreach}
    						</div>
    					</li>
    				{/if}
    			{/foreach}
        </ul>
        <!-- --------right----------- -->
        <ul class="navbar-nav justify-content-end">
          <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#"><i class="fas fa-bell" style="font-size: 14px;" id="bell"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- <a class="dropdown-item" href="#">通知</a> -->
              <!-- <div class="dropdown-divider"></div> -->
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-user" style="font-size: 18px;"></i>&nbsp;&nbsp;{$nickname}
            </a>
          </li>
        </ul>
      </div>
    </nav> *}
    <nav>
      <div class="sildebar">
          <div id = "menu-bar">
            <h5><a class="title" href="index">{$TITLE}</a></h5>
              <div id="menu-content">
                <ul class="navbar-nav justify-content-end">
                {* {if $FUNCTION_NAME!="Logout"}
                  <li class="nav-item active">
                    <a class="nav-link" href="./Logout">安全離開<span class="sr-only">(current)</span></a>
                  </li>
                {/if} *}
                {* <ul class="navbar-nav justify-content-end"> *}
                  <li class="nav-item">
                    <a class="nav-link"  data-toggle="collapse" href="#collapse-exit" role="button" aria-expanded="false" aria-controls="collapse-exit">
                      <i class="fas fa-user" style="font-size: 18px;"></i>&nbsp;&nbsp;{$nickname}
                      {if $FUNCTION_NAME!="Logout"}<img src="../dist/img/if_icon-arrow-down-b_211614.png"/> {/if}
                    </a>
                    <div class="collapse rounded" id="collapse-exit">
                      {if $FUNCTION_NAME!="Logout"}
                        <a class="nav-link" href="./Logout">安全離開<span class="sr-only">(current)</span></a>
                      {/if}
                    </div>
                  </li>
                  <li class="nav-item dropdown rounded" id="remind">
                   {* <i class="fas fa-bell" style="font-size: 14px;" id="bell"></i> *}
                    {* <div id="remind" class="rounded"></div> *}
                  </li>
                {* </ul> *}
                
                {foreach from=$menu key=key item=foo}
                  {if !is_array($foo[0])} 
                  <li>
                    <a class="nav-link" href="{$foo[0]}">{$foo[1]}</a>
                  </li>
                  {else}
                  <li>
                    <div class="menu">
                      <a class="menu_btn{$key} nav-link" data-toggle="collapse" href="#collapse_navbar{$key}" role="button" aria-expanded="false" aria-controls="collapse_navbar{$key}">{$foo[1]}
                          <img src="../dist/img/if_icon-arrow-down-b_211614.png"/>
                      </a>
                      <div class="collapse collapse_nav rounded" id="collapse_navbar{$key}">
                        {foreach from=$foo[0] item=foo2}
                          <a class="nav-link" href="{$foo2[0]}">{$foo2[1]}</a>
                        {/foreach}
                      </div>
                    </div>
                  </li>
                  {/if}
                {/foreach}
                </ul>
              </div>
          </div>
          <div id="sidebar-btn">
            <span></span>
            <span></span>
            <span></span>
          </div>
      </div>
    </nav>
    <div class="backTop" style="visibility:hidden">
    <i class="fas fa-arrow-circle-up font_size"></i>
    </div>
    <!-- timer -->
<div class="float-right" id="timer" style="margin-bottom: -1%">
  <div class="easypiechart" id="easypiechart" data-percent="100" data-line-width="5" data-track-Color="#f0f0f0" data-bar-color="#4cc0c1" data-rotate="0" data-scale-Color="false" data-size="60" data-animate="500">
    <span class="font-bold" id="t1"  style="color:#4cc0c1"></span>
  </div>
</div>
<!-- script -->
<script>
 {foreach from=$menu key=key item=foo}
		$(".menu_btn{$key}").click(function(){
			$('.collapse_nav').collapse('hide');
			$("#collapse_navbar{{$key}}").collapse('show')	
		})
	{/foreach}
</script>
<!-- script -->
<div class="container-full" style = "padding-top:1%" > 
    <div class="starter-template">
