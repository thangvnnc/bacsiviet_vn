<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table ='article';
    protected $primaryKey ='article_id';
    protected $guarded = [];
    // public function setCreatedAtAttribute($date)
  //{
  //    return $this->attributes['created_at'] = Carbon::createFromFormat('Y-m-d',$date);
 // }

}
