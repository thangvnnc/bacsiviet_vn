<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    protected $table = "speciality";
    protected $primaryKey = "speciality_id";
    
    public function questions(){
    	return $this->hasMany('\App\Question','speciality_id','speciality_id');
    }
    public function doctors($specid){
    	
    	$spec= \App\DoctorSpeciality::where('speciality_id',$specid)->pluck('doctor_id')->all();
    	return \App\Doctor::whereIn('doctor_id',$spec)->get();
    }
    public function clinics($specid){
    	 
    	$spec= \App\ClinicSpeciality::where('speciality_id',$specid)->pluck('clinic_id')->all();
    	return \App\Clinic::whereIn('clinic_id',$spec)->get();
    }
}
