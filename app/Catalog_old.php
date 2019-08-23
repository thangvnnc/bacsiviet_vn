<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
class Catalog extends Model
{
    protected $table ='catalog';
    protected $primaryKey ='id';
    protected $guarded = [];

    public function article() {
    	return $this->hasMany('App\Article');
    }
}
