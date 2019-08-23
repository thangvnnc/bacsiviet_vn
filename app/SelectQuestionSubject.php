<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SelectQuestionSubject extends Model
{
protected $table = "select_question_subject";
    public function questions(){
    	return $this->hasMany('select_questions','subject_id','id');
    }
}
