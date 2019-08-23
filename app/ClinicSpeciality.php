<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicSpeciality extends Model
{
    protected $table = "clinic_speciality";
    protected $primaryKey = "id";
    public function clinic(){
    	return $this->hasOne('\App\Speciality','speciality_id','speciality_id');
    }
}
