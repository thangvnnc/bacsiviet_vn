<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = "user_review";
    
 	public function user(){
 		return $this->hasOne('App\Users','user_id');
 	}
}
