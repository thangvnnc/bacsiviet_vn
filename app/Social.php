<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Social extends Model
{
    protected $table = "socials";
    protected $primaryKey = "social_id";
    
    public function user(){
    	return $this->hasOne('\App\User','user_id','user_id');
    }
    
}
