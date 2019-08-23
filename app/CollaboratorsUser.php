<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollaboratorsUser extends Model
{
    protected $table = 'collaborators_user';
    protected $primaryKey = "user_id";
    public $timestamps = false;
}
