<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deals extends Model
{
     protected $table ='deals';
    protected $primaryKey ='deal_id';
    protected $guarded = [];
    public function province(){
    	
    }
    public function clinic(){
    	return $this->hasOne('\App\Clinic','clinic_id','clinic_id');
    }
    public static function strtoUrl($strTitle){
    	{
    		$strTitle=strtolower($strTitle);
    		$strTitle=trim($strTitle);
    		$strTitle=str_replace(' ','-',$strTitle);
    		$strTitle=preg_replace("/(ò|ó|ọ|ỏ|õ|ơ|ờ|ớ|ợ|ở|ỡ|ô|ồ|ố|ộ|ổ|ỗ)/",'o',$strTitle);
    		$strTitle=preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|Ô|Ố|Ổ|Ộ|Ồ|Ỗ)/",'o',$strTitle);
    		$strTitle=preg_replace("/(à|á|ạ|ả|ã|ă|ằ|ắ|ặ|ẳ|ẵ|â|ầ|ấ|ậ|ẩ|ẫ)/",'a',$strTitle);
    		$strTitle=preg_replace("/(À|Á|Ạ|Ả|Ã|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|Â|Ấ|Ầ|Ậ|Ẩ|Ẫ)/",'a',$strTitle);
    		$strTitle=preg_replace("/(ề|ế|ệ|ể|ê|ễ|é|è|ẻ|ẽ|ẹ)/",'e',$strTitle);
    		$strTitle=preg_replace("/(Ể|Ế|Ệ|Ể|Ê|Ễ|É|È|Ẻ|Ẽ|Ẹ)/",'e',$strTitle);
    		$strTitle=preg_replace("/(ừ|ứ|ự|ử|ư|ữ|ù|ú|ụ|ủ|ũ)/",'u',$strTitle);
    		$strTitle=preg_replace("/(Ừ|Ứ|Ự|Ử|Ư|Ữ|Ù|Ú|Ụ|Ủ|Ũ)/",'u',$strTitle);
    		$strTitle=preg_replace("/(ì|í|ị|ỉ|ĩ)/",'i',$strTitle);
    		$strTitle=preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/",'i',$strTitle);
    		$strTitle=preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/",'y',$strTitle);
    		$strTitle=preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/",'y',$strTitle);
    		$strTitle=preg_replace('/(đ|Đ)/','d',$strTitle);
    		$strTitle=preg_replace("/[^-a-zA-Z0-9]/",'',$strTitle);
    		return $strTitle;
    	}
    }
}
