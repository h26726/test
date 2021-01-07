@extends('Outside')

@section('content')
<!-- script -->
<div class="container-full" style="padding-top:1%">
    <div class="starter-template">
        <style>
@media only screen and (max-width: 480px) {
  .table .amLarge{
      display: none;
  }
  .refresh {
      display: none;
  }
}
.borderless td, .borderless th {
  border: none;
}
        </style>
        <div class="container">
            <h1>帳號管理</h1>
            <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group mr-2">
                    <button
                        type="button"
                        class="btn btn-info "
                        data-toggle="modal"
                        data-target="#myModalSort"
                    >排序</button>
                </div>
                <div class="btn-group mr-2">
                    <button type="button" class="btn btn-info refresh" onclick="AccountRenew()">更新帳號</button>
                </div>
            </div>
            <form
                method="post"
                action="AccountManage"
                autocomplete="off"
                id="iform"
            >
                <div class="input-group mb-3">
                    <select class="form-control" id="dep" name="dep">
                        <option value="RD" selected>研發一部</option>
                        <option value="CRM">客服一部</option>
                        <option value="CF">客服二部</option>
                        <option value="MARKET">營運一部</option>
                        <option value="IT">IT網管部</option>
                        <option value="MIS">IT系統部</option>
                        <option value="SEO">SEO部門</option>
                        <option value="HR">人力資源部</option>
                        <option value="AD">行政部門</option>
                        <option value="ACCOUNT">財務部</option>
                        <option value="MANAGER">總經理室</option>
                    </select>
                    <div class="input-group-prepend">
                        <div class="input-group">
                            <select class="custom-select mr-sm-2" id="status" name="status">
                                <option value="1" selected>在職</option>
                                <option value="0">離職</option>
                            </select>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive shadow">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr class="bgcolor">
                            <!-- <th style="text-align: center;">#</th> -->
                            <th style="text-align: center;" class="amLarge">群組</th>
                            <th style="text-align: center;" class="amLarge">帳號</th>
                            <th style="text-align: center;">名稱</th>
                            <th style="text-align: center;">卡號</th>
                            <th style="text-align: center;" class="amLarge">狀態</th>
                            <th style="text-align: center;">項目</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($AccDataPgMod as $v)
                        <tr id="1">
                            <td class="align-middle amLarge">{{$powerDataMod[$v->power_id]->power_name }}</td>
                            <td class="align-middle amLarge">
                                {{$v->userName}}
                                @if (false)
                                <input
                                    type="text"
                                    class="form-control"
                                    hidden="hidden"
                                    id="isMA"
                                    name="isMA"
                                    value="0"
                                >
                                <br>
                                (研發一部)
                                @endif
                            </td>
                            <td class="align-middle"> {{$v->nickName}}</td>
                            <td class="align-middle">
                                @foreach ($CardDataMod->where('user_id', $v->user_id) as $card)
                                    {{$card->card_id}}
                                <br>
                                @endforeach
                            </td>
                            <td class="align-middle amLarge">
                                {{ $v->enable ? '在職' : '離職' }}
                            </td>
                            <td class="align-middle">
                                <button
                                    type="button"
                                    class="btn btn-success edit"
                                    data-toggle="modal"
                                    data-target="#myModal"
                                    data-uid="{{$v->user_id}}"
                                    data-name="{{$v->userName}}"
                                    data-type="4"
                                    data-enable="1"
                                    data-created="2014-11-12"
                                >帳戶編輯</button>
                                <button
                                    type="button"
                                    class="btn btn-dark "
                                    data-toggle="modal"
                                    data-target="#myModalCard"
                                    data-idx="1"
                                    data-uid="11"
                                >卡號設定</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div
            class="modal fade"
            id="myModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">帳號編輯</h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="" method="post" autocomplete="off">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <span class="input-group-text form-inline">帳號:</span>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="iname"
                                    name="iname"
                                    readonly="true"
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    hidden="hidden"
                                    id="iid"
                                    name="iid"
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    hidden="hidden"
                                    name="dep"
                                    value="RD"
                                >
                            </div>
                            <div class="input-group mb-3 form-inline">
                                <label for="sel1">權限變更:</label>
                                <select class="form-control" id="sel" name="sel">
                                    <option value="1">人資</option>
                                    <option value="2">主管</option>
                                    <option value="3">員工</option>
                                    <option value="4">系統人員</option>
                                    <option value="6">測試</option>
                                </select>
                            </div>
                            <div class="input-group mb-3 form-inline">
                                <label for="enable">人員異動:</label>
                                <select class="form-control" id="enable" name="enable"></select>
                            </div>
                            <div class="input-group mb-3 form-inline">
                                <label for="enable">報到日期:</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="create_at"
                                    name="create_at"
                                >
                            </div>
                            <div class="input-group mb-3 form-inline">
                                <label for="enable">主管:</label>
                                <input
                                    type="checkbox"
                                    class=""
                                    id="check_MA"
                                    style="zoom:180%"
                                >
                                <select class="form-control" id="depMA" name="depMA">
                                    <option value="0">無</option>
                                    <option value="RD">研發一部</option>
                                    <option value="CRM">客服一部</option>
                                    <option value="CF">客服二部</option>
                                    <option value="MARKET">營運一部</option>
                                    <option value="IT">IT網管部</option>
                                    <option value="MIS">IT系統部</option>
                                    <option value="SEO">SEO部門</option>
                                    <option value="HR">人力資源部</option>
                                    <option value="AD">行政部門</option>
                                    <option value="ACCOUNT">財務部</option>
                                    <option value="MANAGER">總經理室</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                id="close"
                                data-dismiss="modal"
                            >關閉</button>
                            <button
                                type="submit"
                                class="btn btn-primary"
                                name="cmd"
                                value="modify"
                            >儲存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div
            class="modal fade"
            id="myModalSort"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">排序</h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <ul id="sortable" class="list-group gutter list-group-lg list-group-sp sortable">
                            <li
                                class="ui-state-default"
                                id="11"
                                draggable="true"
                                " >
                          <span class="
                                pull-left
                                media-xs
                                "><i class="
                                fa
                                fa-sort
                                text-muted
                                fa
                                m-r-sm
                                "></i></span>
                          &nbsp;
                          <font color="
                                red
                                ">[系統人員]</font>
                          <a class="
                                h4
                                " >小涼</a>
                      </li>

                      <li class="
                                ui-state-default
                                " id="
                                225
                                " draggable="
                                true
                                " "
                            >
                                <span class="pull-left media-xs">
                                    <i class="fa fa-sort text-muted fa m-r-sm"></i>
                                </span>
                                &nbsp;
                                <font color="red">[員工]</font>
                                <a class="h4">世偉</a>
                            </li>
                            <li
                                class="ui-state-default"
                                id="224"
                                draggable="true"
                                orderid="2"
                                " >
                          <span class="
                                pull-left
                                media-xs
                                "><i class="
                                fa
                                fa-sort
                                text-muted
                                fa
                                m-r-sm
                                "></i></span>
                          &nbsp;
                          <font color="
                                red
                                ">[系統人員]</font>
                          <a class="
                                h4
                                " >霆豫</a>
                      </li>

                      <li class="
                                ui-state-default
                                " id="
                                168
                                " draggable="
                                true
                                "  orderid="
                                3
                                " "
                            >
                                <span class="pull-left media-xs">
                                    <i class="fa fa-sort text-muted fa m-r-sm"></i>
                                </span>
                                &nbsp;
                                <font color="red">[員工]</font>
                                <a class="h4">喬安</a>
                            </li>
                        </ul>
                        <center>
                            <a
                                class="btn btn-success btn-cons sendData"
                                data-dismiss="modal"
                                onclick="sortitem()"
                                href="#"
                            >确定</a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
        <div
            class="modal fade"
            id="myModalCard"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">卡號設定</h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="CardIdManage">
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <span class="input-group-text form-inline">名稱：</span>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="cnick"
                                        name="cnick"
                                        readonly="true"
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        hidden="hidden"
                                        id="cid"
                                        name="cid"
                                    >
                                    <input
                                        type="text"
                                        class="form-control"
                                        hidden="hidden"
                                        name="dep"
                                        value="RD"
                                    >
                                </div>
                                <table class="table borderless" id="showCard">
                                    <thead>
                                        <tr>
                                            <th>
                                                <a href="#" class="badge badge-info" onclick="AddInput()">新增</a>
                                            </th>
                                            <th>卡號</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                                <button type="submit" class="btn btn-primary">儲存</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <style>
#sortable { list-style-type: none; margin: 0; padding: 0; }
#sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; }
#sortable li span { position: absolute; margin-left: -1.3em; }
        </style>

        <!-- <script> $('.sortable').sortable(); </script> -->
        <div class="d-flex" style="margin-top: 30px;">
            <div class="mx-auto">
                {!! $AccDataPgMod->links() !!}
            </div>
        </div>
        <script type="text/javascript">
  $(function(){
      $("#dep").change(function(event) {
          $( "#iform" ).submit();
      });
      $("#status").change(function(event) {
          $( "#iform" ).submit();
      });
      $(".edit").click(function(event){
        //   $("#depMA").val(0);
        //   $("#check_MA").attr('checked',false);
        //   $("#depMA").attr('disabled',true);
          $('#myModal').on('show.bs.modal', function (e) {
            //   var id = e.relatedTarget.attributes[6].nodeValue;
            //   var user_id = e.relatedTarget.attributes[4].nodeValue
            //                   console.log("11");
            //       if ("11"==user_id)
            //       {
            //           $("#depMA").val("RD")
            //       }


          })
      });
      $("#check_MA").click(function(){
          if($("#check_MA").prop('checked'))
          {
              $("#depMA").attr('disabled',false);
          }
          else{
              $("#depMA").attr('disabled',true);
          }
      })

    //   $('#create_at').daterangepicker({
    //       "startDate": "",
    //       "singleDatePicker": true,
    //       "showDropdowns": true,
    //       "locale": {
    //       "direction": "ltr",
    //       "format": "YYYY-MM-DD",
    //       "separator": " ~ ",
    //       "applyLabel": "Apply",
    //       "cancelLabel": "Cancel",
    //       "fromLabel": "From",
    //       "toLabel": "To",
    //       "customRangeLabel": "Custom",
    //       "monthNames" : [ "1月", "2月", "3月", "4月", "5月", "6月","7月", "8月", "9月", "10月", "11月", "12月" ],
    //       "daysOfWeek" : [ "日", "一", "二", "三", "四", "五", "六" ]}
    //   });
  })

  $('#myModal').on('show.bs.modal', function (e) {
        console.log(e);
        //var id = e.relatedTarget.attributes[6].nodeValue;
        $("#iname").val(e.relatedTarget.attributes[5].nodeValue);
        $("#iid").val(e.relatedTarget.attributes[4].nodeValue);

      $("#create_at").val($(e.relatedTarget).attr('data-created')); //bor liang 20181017
    //   $('#create_at').data('daterangepicker').setStartDate($(e.relatedTarget).attr('data-created'));
        /*$("#sel").children().each(function() {
            // console.log($(this).val());
            if($(this).val() == id){
                $(this).attr("selected", "true");
            }
        });*/
        var enable_active = e.relatedTarget.attributes[7].nodeValue;
        var enable = (enable_active == 1)?0:1;
        var text_active = (enable_active == 1)?"在職":"離職";
        var text = (enable == 1)?"在職":"離職";
        $("#enable").html("");
        $("#enable").html("<option value="+enable_active+">"+text_active+"</option> <option value="+enable+">"+text+"</option>");




  })

  $('#myModalCard').on('show.bs.modal', function (e) {
        // console.log(e);
        var idx = e.relatedTarget.attributes[4].nodeValue;
        var card = $("#"+idx+" td").eq(3).children();

        $("#cnick").val($("#"+idx+" td").eq(2).text());
        $("#cid").val(e.relatedTarget.attributes[5].nodeValue);
        $("#showCard").children("tbody").children("tr").remove();

        card.find("li").each(function(){
            // console.log($("#showCard").children('tbody').attr("id"));
            AddInput($(this).text());
            // console.log($(this).text());
        });
  })

  function DeleteCard(e)
  {
      // $(e).attr('disabled', 'disabled');
      // $(e).parent().parent().addClass("table-danger");
      // $(e).parent().next().children().attr("readonly",true);
      $(e).parent().parent().remove();
  }

  function AddInput(val = '')
  {
      $("#showCard").children('tbody').append(
                '<tr>'+
                '<td><button type="button" class="close" aria-label="Close" onclick="DeleteCard(this)"><span aria-hidden="true">&times;</span></button></td>'+
                '<td><input type="text" name="card[]" value="'+val+'" class="form-control"></td>'+
                '</tr>');
  }

  function AccountRenew()
  {
      $.ajax({
        type: 'POST',
        url: 'AccountRenewAjax',
        data: {},
        dataType: 'json',
        success: function(respond){
            // console.log(respond);
            alert(respond['ErrorMessage']);
        },
        error:function(xhr) {
            console.log(xhr);
        }
      });
  }

  function sortitem()
  {
      var sort = new Array();
      var orderid = '';
      $("#sortable").find("li").each(function(){
          var t = $(this);
          sort.push(t.attr("id"));
          if(typeof(t.attr("orderid")) != "undefined")
              orderid = t.attr("orderid");
      });

      $.ajax({
          url:"AccountManage",
          type:"POST",
          dataType: 'json',
          data: { 'sort':sort,'id':orderid,'cmd':'sort'},
          success:function(res){
              if(res['ErrorCode'])
                  alert(res['ErrorMessage']);
              else
                  Link("?dep=RD");
          },
          error:function (xhr) {
              console.log(xhr);
          }
      });
  }
        </script>
    </div>
    <!-- /.container -->
</div>

<!-- /starter-template -->
</body>
</html>
<script type="text/javascript">
  var SYS_FUNCTION = ''
  var SYS_ENV = ''
</script>
@endsection



