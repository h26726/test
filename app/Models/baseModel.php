<?php
namespace App\Models;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
abstract class BaseModel extends Model
{
    protected $table;
    public $timestamps = false;
    protected $fillable=[];
    protected $primaryKey='id';


    function __construct($attributes = [])
    {
        $this->setDBtable();
        if (!Schema::hasTable($this->table)) {
            $this->buildSheet();
        }
        parent::__construct($attributes);
    }
    abstract protected function setDBtable();
    abstract protected function buildSheet();
}
