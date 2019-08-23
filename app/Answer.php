<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = "answer";
    protected $primaryKey="answer_id";
    
    public function user(){
    	return $this->hasOne('App\Users','user_id','answer_user_id');
    }
    public function question(){
    	return $this->hasOne('\App\Question','question_id','question_id');
    }
}
