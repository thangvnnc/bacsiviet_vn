<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $table = 'social_accounts';
    protected $fillable = ['user_id', 'provider_user_id', 'provider'];    

    public function user()
    {
    	return $this->hasOne('App\Users','user_id');
    }
}

