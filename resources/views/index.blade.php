<h2>歡迎使用人資系統</h2>

<div class="container">
    <p class="lead">歡迎使用人資系統</p>
    @if ($power)
    <form method="post" action="" id="iform" autocomplete="off">
        <div class="form-group">
            <label for="email">簽名:</label>
            <input type="text" class="form-control mr-sm-2" id="sign" name="sign" value="{{$oldsign}}" style=" text-align: center; ">
            <label for="email">(用於驗簽核)</label>
        </div>
        <button type="submit" class="btn btn-info">確定</button>
        <button type="submit" class="btn btn-danger" name="cc" value="cc">清除</button>
    </form>
    @endif

</div>