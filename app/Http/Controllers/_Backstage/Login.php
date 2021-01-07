<?php
namespace App\Http\Controllers\_Backstage;
use Illuminate\Http\Request;
use App\Models\db\UserAuth;

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

        if($sn == '')//sn是空白
            return abort(404,"發生錯誤，請重新連結 [1]");

        $C_UserAuth = new UserAuth;
        $LoginInfoMod=$C_UserAuth->getLoginInfoBySnIp($sn); //sn
        if($LoginInfoMod===null)
        {
            return abort(404,"發生錯誤，請重新連結 [2]");
        }
        $isChange=$C_UserAuth->changeIpBySn($ip,$sn);
        if(!$isChange){
            return abort(404,"發生錯誤，請重新連結 [3]");
        }
        setcookie("XlMemTzAitUmm77oX0ga", $sn, 0, "/");
        return redirect('../'.config('sys.DIR_CODE_sn').'/HR-index');


    }


}
?>
