<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserOrder extends Model
{
    protected $table 		= 'user_orders';
    protected $primaryKey 	= "user_id";
    // public $timestamps 		= false;

    protected $attributes   = [
        'money'     => 0,
        'status'    => 1,
    ];

    protected $fillable = [
        'user_id',
        'code',
        'money',
        'token',
        'status',
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
