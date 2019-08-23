<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorService extends Model
{
      protected $table = "doctor_service";
    protected $primaryKey = "doctor_service_id";
    public function service(){
    	return $this->hasOne('\App\Service','service_id','service_id');
    }
}
