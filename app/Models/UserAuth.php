<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAuth extends Model
{
    protected $table = 'Auth';
    public $timestamps = false;
    protected $fillable = ['username','user_id','create_time','function_name','enable'];

    function InsUserDataToAuth($Uname,$Uid,$powName,$time,$enable){
        $lastId=$this::create(['username' => $Uname ,'user_id' => $Uid ,
                'create_time'=>$time,'function_name'=>$powName,'enable'=>$enable])->id;

        return $lastId;
    }
    function changeSnById($sn,$idx){ //
        $this::where('idx', $idx)
          ->update(['sn' => $sn]);
    }
    function changeIpBySn($ip,$sn){ //
        return $this::where('sn', $sn)
          ->update(['ip' => $ip]);
    }
    function changeTimeById($time,$idx){ //
        return $this::where('idx', $idx)
          ->update(['alive' => $time]);
    }
    function changeEnableByMid($enable,$id){ //
         $this::where('user_id', $id)

          ->update(['enable' => $enable]);
    }
    function getDataModByUse($sn,$ip=Null){ //
        $a=date('Y-m-d H:i:s',strtotime('-7day'));
        return $this::where('sn', $sn)
        ->where('enable', 1)
        ->where('ip', $ip)
        ->where('create_time','>', date('Y-m-d H:i:s',strtotime('-1day')))
        ->first();
    }


}
// //$sql = "INSERT INTO HR_02(date,name, user_id, action_type) VALUES (NOW(),'".$username."',".$user_id.",-1)";
			// $lastID = InserLastID($sql);
			// if($lastID==-1)
			// 	ExitEcho("BS_AUTH 錯誤2 ");

			// $sn = IntToCodeString20($lastID);
			// $sql = "update Auth SET sn='".$sn."' WHERE idx=".$lastID;
			// $b = db_execute($sql);
			// if(!$b)
			// 	ExitEcho("BS_AUTH 錯誤3 ");

			// if(!defined ('RD_USERNAME')){
			// 	if(defined ('local')) $url = local."/XlMemTzAitUmm77oX0ga/".$sn;
			// 	else $url = HOSTURL."/XlMemTzAitUmm77oX0ga/".$sn;
			// 	ExitEcho("<".$url."|".$text."!!>");
			// }
			// else{
			// 	die("<a target='_bank' href='http://hrtest.v9ex.com:8088/pYq4gwyNjZN0iZi0zazCJDC1/XlMemTzAitUmm77oX0ga/".$sn."' >測試連結</a>");
			// }
