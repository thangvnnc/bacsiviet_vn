<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = "doctor";
    protected $primaryKey = "doctor_id";
    public function doctorspeciality(){
        return $this->hasOne('\App\DoctorSpeciality','doctor_id');
    }
    public function specialities(){
    	return $this->hasMany('\App\DoctorSpeciality','doctor_id');
    }
    public function clinics(){
    	return $this->hasMany('\App\DoctorClinic','doctor_id');
    }
    public function services(){
    	return $this->hasMany('\App\DoctorService','doctor_id');
    }
    public function activity(){
    	return $this->hasMany('\App\Answer','answer_user_id','user_id')->orderBy('created_at','DESC')->take(10);
    }
}
