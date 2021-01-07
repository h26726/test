<?php

namespace App\Models\db;
use App\Models\baseModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
class UserAccount extends baseModel
{
    protected function setDBtable(){
        $this->table = 'account';
        $this->fillable = [];
    }
    protected function buildSheet(){
        Schema::create('account', function (Blueprint $table) {
            $table->increments('id');
            $table->string('userName', 50);
            $table->integer('user_id');
            $table->string('nickName', 50);
            $table->integer('power_id')->nullable()->default(null);
            $table->integer('enable')->default(1);
            $table->tinyInteger('deleted')->nullable()->default(0);
            $table->date('created_at');
            $table->integer('order_no')->nullable()->default(9999);
            $table->string('dep', 10)->nullable()->default(null);
            $table->integer('shift_vacation')->default(0);
            $table->timestamp('updated_at')->useCurrent();
        });

    }

    public function GetPowerCodeByUid($Uid){
        $item=$this::with('Power:id,power_code')->where('user_id',$Uid)->first();//
		return empty($item) ? null: $item->Power->power_code;
    }

    public function GetUserDepByUid($Uid){
        $userDep=$this::where('user_id',$Uid)->first()->dep;
        return empty($userDep) ? null:$userDep;
    }

    public function GetUserInfoByUid($Uid){
        return $this::with('Power:id,text')->where('user_id',$Uid)->first(['userName','power_id','nickName']);
    }

    public function GetAccDataPgByDepEnab($dep,$enable){
        $AccDataPgMod=$this::where('dep',$dep)
        ->where('enable',$enable)
        ->orderBy('enable', 'desc')
        ->orderBy('deleted')
        ->orderBy('order_no')
        ->orderBy('power_id')
        ->paginate(2);
        return $AccDataPgMod;
    }

    public function Power()
    {
        return $this->hasOne('App\Models\db\Power','id','power_id');
    }






}
