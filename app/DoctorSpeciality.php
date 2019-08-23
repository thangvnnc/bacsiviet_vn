<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorSpeciality extends Model
{
      protected $table = "doctor_speciality";
    protected $primaryKey = "doctor_speciality_id";
    public function speciality(){
    	return $this->hasOne('\App\Speciality','speciality_id','speciality_id');
    }
}
