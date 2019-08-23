<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicService extends Model
{
	protected $table = "clinic_service";
	protected $primaryKey  = "id";
	public function service(){
		return $this->hasOne('\App\Service','service_id','service_id');
	}
}
