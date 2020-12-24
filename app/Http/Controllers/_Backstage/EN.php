<?php
namespace App\Http\Controllers\_Backstage;
use Illuminate\Http\Request;
use App\Models\UserAccount;
use App\Models\UserAuth;
use App\Models\HR_2;


class EN extends \App\Http\Controllers\Controller
{
    protected $ExitData= array();
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {

    }



    public function index(Request $request)
    {
        $this->ExitData=$request->all();
        if($request->input('token') && $request->input('token')===config('sys.TOKEN_HR'))
        {
            $username = $request->input('username');
            $user_id  = $request->input('user_id');
            $text 	  = $request->input('text');
            $this->AUTH($username,$user_id);
            $this->ExitEcho("");
        }
        // else if(CheckToken(TOKEN))
        // {
        // 	$username =  param('username','');
        // 	$user_id = param("user_id",'');
        // 	$text 	 = param("text",'');
        // 	$text = param("text",'');
        // 	if($text=="/hr")
        // 		AUTH($username,$user_id);
        // 	else if($text=="hrtest")	{

        // 	}
        // 	else if($text=="rdtest"){
        // 		define("local","http://localhost/pYq4gwyNjZN0iZi0zazCJDC1");
        // 		AUTH($username,$user_id);
        // 	}
        // 	else
        // 		ExitEcho("Hello");
        // }
        // else if( defined ('RD_USERNAME')){//測試登入位置
        // 	$username =  RD_USERNAME;
        // 	$user_id = RD_USERID;
        // 	AUTH($username,$user_id);
        // }
        // else{
        // 	ExitEcho("Hi");
        // }
        // // function F1($username,$user_id,$text,$atext) t
        // // {

        // // }
    }

    private function AUTH($username,$user_id){ //針對AUTH的操作

        $C_UserAccount = new UserAccount;
        $powerCode = $C_UserAccount->GetAuthCodeByUid($user_id); //透過使用者ID取得powerCode
        if($powerCode){
            $C_UserAuth = new UserAuth;
            // $ClassUserAuth->InsAUTH($username,$user_id,$powerCode,"前往人資系統");
            $C_UserAuth->changeEnableByMid(0,$user_id); //關閉使用者先前的登入
            $lastID=$C_UserAuth->InsUserDataToAuth($username,$user_id,$powerCode,now(),1); //新增使用者登入
            $sn = IntToCodeString20($lastID);
            $C_UserAuth->changeSnById($sn,$lastID);
            if(!config('sys.RD_USERNAME')){
				if(config('sys.local')) $url = config('sys.local')."/XlMemTzAitUmm77oX0ga/".$sn;
                else $url = config('sys.HOSTURL')."/XlMemTzAitUmm77oX0ga/".$sn;
                die($url);
				$this->ExitEcho("<".$url."|前往人資系統!!>");
			}
			else{
				die("<a target='_bank' href='http://hrtest.v9ex.com:8088/pYq4gwyNjZN0iZi0zazCJDC1/XlMemTzAitUmm77oX0ga/".$sn."' >測試連結</a>");
			}

            // $this->ExitData=$powerCode;
            $this->ExitEcho("000");
        }
        else
        {
            $this->ExitEcho("n");
        }

    }
    function ExitEcho($message){
        $this->ExitData["text"] = $message;
        echo json_encode($this->ExitData, JSON_UNESCAPED_UNICODE); //JSON_UNESCAPED_UNICODE 中文處理
		exit();
    }

}
