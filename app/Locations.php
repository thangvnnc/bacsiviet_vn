<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locations extends Model
{
    protected $table = 'location';
    protected $primaryKey = "id";
    public $timestamps = false;    

    protected $fillable = [
        'id', '	user_id', 'lat','lng','status','created_at','updated_at'
    ];
}
