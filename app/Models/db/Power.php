<?php

namespace App\Models\db;
use App\Models\baseModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
class Power extends baseModel
{
    protected function setDBtable(){
        $this->table = 'power_set';
        $this->fillable = [];
    }
    protected function buildSheet(){
        Schema::create('power_set', function (Blueprint $table) {
            $table->increments('id');
            $table->string('power_code', 50);
            $table->string('power_name', 55);
            $table->text('text');
            $table->dateTime('created_at');
            $table->dateTime('update_at');
        });
    }
    function getpowerData(){
        return $this::get();
    }

}
