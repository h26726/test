<?php

namespace App\Models\db;
use App\Models\baseModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\GuardsAttributes;
class Card extends baseModel
{
    protected function setDBtable(){
        $this->table = 'card_list';
        $this->fillable=['idx','user_id','card_id'];
        $this->primaryKey='idx';
    }

    protected function buildSheet(){
        Schema::create('card_list', function (Blueprint $table) {
            $table->increments('idx');
            $table->integer('user_id');
            $table->string('card_id', 50)->unique();
        });
    }

    function getCardDataByUids($Uids){
        return $this::whereIn('user_id', $Uids)
        ->get();
    }




}
