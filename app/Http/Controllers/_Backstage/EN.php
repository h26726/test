<?php
namespace App\Http\Controllers\_Backstage;
use Illuminate\Http\Request;
use App\Models\db\UserAccount;
use App\Models\db\UserAuth;



class EN extends \App\Http\Controllers\Controller
{
    protected $InputData= array();
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {

    }



    public function index(Request $request)
    {

        $this->InputData=$request->all();
        if(!$request->input('token') || $request->input('token')!=config('sys.TOKEN_HR'))
        {
           return abort(404,'E001,請重新取得連結');
        }
        $Uname = $this->InputData['username'];
        $Uid  = $this->InputData['user_id'];
        $C_UserAccount = new UserAccount;
        $PowerCode = $C_UserAccount->GetpowerCodeByUid($Uid); //透過使用者ID取得powerCode
        if($PowerCode===null){
            return abort(404,'E002,請重新取得連結');
        }
        $C_UserAuth = new UserAuth;
        $C_UserAuth->changeEnableByMid(0,$Uid); //關閉使用者先前的登入
        $lastID=$C_UserAuth->InsUserDataToAuth($Uname,$Uid,$PowerCode,now(),1); //新增使用者登入
        $sn = IntToCodeString20($lastID);
        $C_UserAuth->changeSnById($sn,$lastID);
        if(config('sys.RD_USERNAME')){
            die("<a target='_bank' href='http://hrtest.v9ex.com:8088/pYq4gwyNjZN0iZi0zazCJDC1/XlMemTzAitUmm77oX0ga/".$sn."' >測試連結</a>");
        }
        $url = config('sys.HOSTURL').config('sys.DIR_CODE').'/'.$sn;
        if(config('sys.local')) $url = config('sys.local').config('sys.DIR_CODE').'/'.$sn;
        die($url);//test
        $this->InputData["text"] = "<".$url."|前往人資系統!!>";
        echo json_encode($this->InputData, JSON_UNESCAPED_UNICODE); //JSON_UNESCAPED_UNICODE 中文處理
        return;
    }
}
