<?php

namespace App\Models\db;
use App\Models\baseModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\GuardsAttributes;
use Illuminate\Support\Collection;
class Dep extends baseModel
{
    protected function setDBtable(){
        $this->table = 'departments';
        $this->fillable=[];
    }

    protected function buildSheet(){
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dep_name', 30);
            $table->string('dep', 30);
            $table->integer('manage_id');
            $table->string('Bar_color', 10);
        });
    }
    function GetDepsData(){

        $item= $this::get(['manage_id','dep','dep_name']);
        return empty($item) ? array():$item->toArray();
    }


}
