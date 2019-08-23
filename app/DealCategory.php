<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DealCategory extends Model
{
	protected $table = "deal_category";
	protected $primaryKey = "id";
	public function deals(){
		return $this->hasMany('\App\Deals','deal_id','id');
	}
}
