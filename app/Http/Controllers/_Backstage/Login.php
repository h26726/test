<?php
namespace App\Http\Controllers\_Backstage;
use Illuminate\Http\Request;
use App\Models\UserAuth;

class Login extends \App\Http\Controllers\Controller
{
    protected $ExitData= array();
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct() {

    }
    public function index($sn)
    {
        $ip = GetClientIP();

        if($ip == '211.73.7.73'||$ip == '211.72.117.114'||$ip=="211.72.153.168")
		    echo "<title>歡迎使用人資系統</title>";
        elseif($sn == '')
            return abort(404,"發生錯誤，請重新連結 [1]");
        else
        {

            $C_UserAuth = new UserAuth;
            // $ClassUserAuth->InsAUTH($username,$user_id,$powerCode,"前往人資系統");
            $dataMod=$C_UserAuth->getDataModByUse($sn); //是否有sn
        	if($dataMod)
        	{
                $isChange=$C_UserAuth->changeIpBySn($ip,$sn);
                if($isChange){
                    setcookie("XlMemTzAitUmm77oX0ga", $sn, 0, "/");
                    return redirect('../XlMemTzAitUmm77oX0gasn/HR-index');
                }
                else
                    return abort(404,"發生錯誤，請重新連結 [2]");
            }
            else
         		abort(404,"發生錯誤，請重新連結 [3]");
        }
    }


}
?>
