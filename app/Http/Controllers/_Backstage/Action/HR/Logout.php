<?php
namespace App\Http\Controllers\_Backstage\Action\HR;
use Illuminate\Http\Request;
use App\Models\db\UserAuth;
class Logout extends \App\Http\Controllers\_Backstage\Action\BaseAction
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function show($request,$function,$action)
    {

        if(!array_key_exists('XlMemTzAitUmm77oX0ga',$_COOKIE)){
            return abort(403,'snError');
        }
        if(array_key_exists('sign',$_COOKIE)){
            setcookie("sign", "", time()-3600, "/");
        }
        setcookie("XlMemTzAitUmm77oX0ga", "", time()-3600, "/");
        $C_UserAuth = new UserAuth;
        $C_UserAuth->changeEnableBySn(0,$this->sn);
        $this->powerText=array(); //不顯示menu
        return view('Logout', $this->assignData());
    }

    function exeAjax($request)
    {

    }



}



?>
