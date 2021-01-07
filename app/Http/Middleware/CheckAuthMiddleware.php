<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\db\UserAuth;
use App\Models\db\UserAccount;
class CheckAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $function=$request->route('function');
        $action=$request->route('action');
		// global $menu;
		if(!array_key_exists("XlMemTzAitUmm77oX0ga",$_COOKIE) || $_COOKIE["XlMemTzAitUmm77oX0ga"]==="")
		{
			return response()->view('errors.errors403',['msg' => 'AUTH_ERROR1']);//無sn的cookie
		}

        $sn = $_COOKIE["XlMemTzAitUmm77oX0ga"];//權限人員
        $ip = GetClientIP();
        $C_UserAuth = new UserAuth;
        $LoginInfoMod = $C_UserAuth->getLoginInfoBySnIp($sn,$ip);
		if($LoginInfoMod===null){
            setcookie("XlMemTzAitUmm77oX0ga", "", time()-3600, "/");
			return response()->view('errors.errors403',['msg' => 'AUTH_ERROR2']);//無登入紀錄
		}



        if($function != "Help")$C_UserAuth->changeTimeById(Now(),$LoginInfoMod->idx);
            setcookie("XlMemTzAitUmm77oX0ga", $sn, 0, "/"); //權限人員

        $C_UserAccount = new UserAccount;
        if(!$UserInfoMod = $C_UserAccount-> GetUserInfoByUid($LoginInfoMod->user_id)){ //撈userData
            return response()->view('errors.errors403',['msg' => 'AUTH_ERROR3']);//無此user
        }

        // $AUTH=$AuthMod->power_id;
        // $nickname=$AuthMod->nickName;

        $powerText = json_decode($UserInfoMod->Power->text,true); //登入紀錄中取出權限資料
        if(!array_key_exists($function,$powerText))
            return response()->view('errors.errors403',['msg' => 'AUTH_ERROR4']);//無此function
        if(!array_key_exists($action,$powerText[$function]))
            return response()->view('errors.errors403',['msg' => 'AUTH_ERROR5']);//無此action

        $userData=array(
            'sn'=>$sn,
            'Uid'=>$LoginInfoMod->user_id,
            'Uname'=>$UserInfoMod->userName,
            'powerText'=>$powerText,
            'AUTH'=>$UserInfoMod->power_id,
            'nickName'=>$UserInfoMod->nickName,
            'function'=>$function,
            'action'=>$action,
        );

        $request->attributes->add($userData); //存入資料 供controller使用
        return $next($request);
    }

}
