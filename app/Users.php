<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    
    protected $table = 'user';
    protected $primaryKey = "user_id";
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'user_id','fullname', 'email', 'password','user_status','user_type_id','id_facebook','paid','balance',
    ];

    
    public function answers(){
    	return $this->hasOne('App\Answer','answer_user_id');
    }
    public function type(){
    	return $this->hasOne('App\UserType','user_type_id');
    }
    public function review(){
    	return $this->hasMany('App\Review','user_id');
    }
    public function doctor() {
    	return $this->hasOne('App\Doctor','user_id');
    }
    public function clinic(){
    	return $this->hasOne('App\Clinic','user_id');
    }
    public function orders(){
        return $this->hasMany('App\Model\UserOrder','user_id');
    }

    // Thắng add 20181107 start
    public function patient(){
        return $this->hasOne('App\Patient','user_id');
    }

    public function createPatient(){
        $patient = new Patient();
        $patient->user_id = $this->user_id;
        $patient->profile_image = $this->avatar;;
        $patient->email = $this->email;
        return $patient;
    }

    public function savePatient(){
        $this->patient->user_id = $this->user_id;
        if($this->avatar != null || $this->avatar != "")
        {
            $string = $this->avatar;
            $tmp = explode("/",$string);
            $this->patient->profile_image = end($tmp);
        }
        $this->patient->email = $this->email;
        $this->patient->save();
    }
    // Thắng add 20181107 end


    public function getBalance(){
        $unit           = \App\Config::where('id', 2)->first();
        $unit           = (!empty($unit))? intval($unit->content) : 1000;
        $balance        = 0;
        if ( isset($this->email) ) {
            $totalCall  = \App\Calltime::where('user_email', $this->email)->sum('times');
            $balance    =  $this->balance - $totalCall*$unit;
        }
        if ($balance <= 0)
            $this->unActivePaid();
        $result = number_format($balance, 0, ',', '.') . ' đ';
        return ($balance <= 0)? 0 : $result;
    }

    public function getBalanceTime(){
        $unit           = \App\Config::where('id', 2)->first();
        $unit           = (!empty($unit))? intval($unit->content) : 1000;
        $balance        = $this->balance/$unit;
        if ( isset($this->email) ) {
            $totalCall  = \App\Calltime::where('user_email', $this->email)->sum('times');
            $balance    = $balance - $totalCall;
        }
        return ($balance < 0)? 0 : $balance;
    }

    public function unActivePaid(){
        $this->paid = 0;
        if ( $this->save() )
            return true;
        return false;
    }
}
