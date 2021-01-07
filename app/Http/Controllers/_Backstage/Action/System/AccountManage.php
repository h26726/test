<?php
namespace App\Http\Controllers\_Backstage\Action\System;
use Illuminate\Http\Request;
use App\Models\db\UserAuth;
use App\Models\db\UserAccount;
use App\Models\db\Power;
use App\Models\db\Dep;
use App\Models\db\Card;
class AccountManage extends \App\Http\Controllers\_Backstage\Action\BaseAction
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function show($request,$function,$action)
    {
        $C_Dep=new Dep;
        $C_UserAccount=new UserAccount;
        $C_Power=new Power;
        $C_Card=new Card;

        $DepsData=$C_Dep->GetDepsData();
        $MapDeptoName=array_column($DepsData,'dep_name','dep');
        $isHRSysAUTH=$this->isHRSysAUTH();
        $enable = 1;
        $UserDep=$C_UserAccount->GetUserDepByUid($this->Uid);
        if($UserDep===null){
            $this->errorCode=1;
            $this->errorMsg='E001';
        }
        $Dep=$UserDep;
        if($isHRSysAUTH){ //排除主管
            $g_Status=$request->input('status','');
            $g_Dep=$request->input('dep','');
            if($g_Dep!='') $Dep=$g_Dep;
            $this->assign['DeptoNameData']=array_column($DepsData,'dep_name','dep');
        }
        $AccDataPgMod=$C_UserAccount->GetAccDataPgByDepEnab($Dep,1);
        $Uids=$AccDataPgMod->keyBy('user_id')->keys()->ToArray();
        $this->assign['CardDataMod'] =$C_Card->getCardDataByUids($Uids);
        $this->assign['AccDataPgMod']=$AccDataPgMod;
        $this->assign['powerDataMod']=$C_Power->getpowerData()->keyBy('id');
        return view('AccountManage', $this->assignData());
    }

    function exeAjax($request){

    }
}

?>
