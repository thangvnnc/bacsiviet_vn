<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Clinic extends Model
{
    protected $table = "clinic";
    protected $primaryKey = "clinic_id";
    public function specialities() {
    	return $this->hasMany('\App\ClinicSpeciality','clinic_id');
    }
    public function doctors(){
    	return $this->hasMany('\App\DoctorClinic','clinic_id');
    }
    public function services(){
    	return $this->hasMany('\App\ClinicService','clinic_id');
    }
    public function activity(){
    	return $this->hasMany('\App\Answer','answer_user_id','user_id')->orderBy('created_at','DESC')->take(10);
    }
}
