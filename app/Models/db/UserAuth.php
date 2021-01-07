<?php

namespace App\Models\db;
use App\Models\baseModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\GuardsAttributes;
class UserAuth extends baseModel
{
    protected function setDBtable(){
        $this->table = 'Auth';
        $this->fillable=['username','user_id','create_time','function_name','enable'];
        $this->primaryKey='idx';
    }

    protected function buildSheet(){
        Schema::create('Auth', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 50);
            $table->integer('user_id');
            $table->string('sn', 20)->nullable()->default(null);
            $table->string('function_name', 50);
            $table->tinyInteger('enable')->default(1);
            $table->dateTime('create_time');
            $table->timestamp('alive')->nullable()->useCurrent();
            $table->string('ip', 15)->nullable();
        });

    }

    function InsUserDataToAuth($Uname,$Uid,$powName,$time,$enable){
        $lastId=$this::create(['username' => $Uname ,'user_id' => $Uid ,
                'create_time'=>$time,'function_name'=>$powName,'enable'=>$enable])->idx;

        return $lastId;
    }
    function changeSnById($sn,$idx){ //
        $item= $this::where('idx', $idx)->first();
        if($item===null)return false;
        $item->sn=$sn;
        $item->save();
        return true;
    }
    function changeIpBySn($ip,$sn){ //
        $item= $this::where('sn', $sn)->first();
        if($item===null)return false;
        $item->ip=$ip;
        $item->save();
        return true;
    }
    function changeEnableBySn($enable,$sn){ //
        $item= $this::where('sn', $sn)->first();
        if($item===null)return false;
        $item->enable=$enable;
        $item->save();
        return true;
    }
    function changeTimeById($time,$idx){ //
        $item= $this::where('idx', $idx)->first();
        if($item===null)return false;
        $item->alive=$time;
        $item->save();
        return true;
    }
    function changeEnableByMid($enable,$id){ //
        $item= $this::where('user_id', $id)->first();
        if($item===null)return false;
        $item->enable=$enable;
        $item->save();
        return true;
    }
    function getLoginInfoBySnIp($sn,$ip=null){ //

        return $this::where('sn', $sn)
        ->where('enable', 1)
        ->where('ip', $ip)
        ->where('create_time','>', date('Y-m-d H:i:s',strtotime('-1day')))
        ->first(['idx','username','user_id','sn']);

    }


}
