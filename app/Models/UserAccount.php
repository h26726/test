<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $table = 'account';
    public $timestamps = false;

    public function GetAuthCodeByUid($user_id){
        $powerCode=$this::where('user_id',$user_id)->first()->Power->power_code;
        // $tep=array();
		if($powerCode)
			return $powerCode;
        return false;

    }

    public function GetAuthModByUid($user_id){
        $powerMod=$this::where('user_id',$user_id)->first();
        // $tep=array();
		if($powerMod)
			return $powerMod;
        return false;

    }

    public function Power()
    {
        return $this->hasOne('App\Models\Power','id','power_id');
    }






}
