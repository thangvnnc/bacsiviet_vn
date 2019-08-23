<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorClinic extends Model
{
      protected $table = "doctor_clinic";
    protected $primaryKey = "doctor_clinic_id";
    public function clinic(){
    	return $this->hasOne('\App\Clinic','clinic_id','clinic_id');
    }
}
