<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;
use App\Question;
use App\Users;
use App\UserType;
use App\Article;
use App\Deals;
use App\Doctor;
use App\Disease;
use App\SelectQuestion;
use App\SelectQuestionSubject;
use App\Review;
use App\Clinic;
use App\Comment;
use App\Medicine;
use App\Answer;
use App\DoctorSpeciality;
use App\ClinicSpeciality;
use App\ClinicService;
use App\Catalog;
use App\DoctorService;
use App\Province;
use App\Speciality;
use App\District;


class HomeController extends Controller
{
	public function __construct()
	{
		$article = Article::orderBy('article_id','DESC')->limit(5)->get();
		view()->share('article',$article);
	
		$deals= Deals::orderBy('ranked','DESC')->get();
		view()->share('deals',$deals);
		
	}
	public static function getProvinceID($province){
		$prov= \App\Province::where('province_name','like','%'.$province.'%')->firstOrFail();
		if($prov)
			return $prov->province_id;
		return false;
	}
    public function index(){
        
        $clinic = Clinic::where('featured','1')->get();
    	$doctor = Doctor::where('featured','1')->get();
    	$questions = SelectQuestionSubject::where('featured','1')->get();
    	$reviews = Review::all()->take(5);
    	$specialities = \App\Speciality::all();
        view()->share('clinic',$clinic);
    	view()->share('doctors',$doctor);
    	view()->share('specialities',$specialities);
    	view()->share('questions',$questions);
    	view()->share('reviews',$reviews);
    	return view('home');
    }
    public function timkiem(Request $rq){
    	if($rq->input('province')){
    		$provin = $rq->input('province');
    		$rq->session()->put('province',$provin);
    		$province = \App\Province::where('province_name','like','%'.$provin.'%')->first();
    		if($province!=null){
    			$rq->session()->put('province_id',$province->province_id);
    			return redirect('/danh-sach');
    		}
    		
    	}
    	if($rq->input('q')!=null){
    			$q = urldecode($rq->input('q'));
    			$benh = Disease::where('disease_name','like','%'.$q.'%');
    			$benh_count = $benh->count();
    			$benh = $benh->paginate(30);
	   			$thuoc = Medicine::where('description','like','%'.$q.'%')->count();
	   			$bs = Doctor::where('doctor_name','like','%'.$q.'%')->count();
	   			$csyt = Clinic::where('clinic_name','like','%'.$q.'%')->count();
	   			$qs = Question::where('question_title','like','%'.$q.'%')->count();
	   			$service = \App\Service::where('service_name','like','%'.$q.'%')->count();
    			return view('tim_kiem',['count'=>$benh_count,'benh'=>$benh,'thuoc'=>$thuoc,'doctor'=>$bs,'clinic'=>$csyt,'question'=>$qs,'service'=>$service]);
    		}
    		//
    }
    public function hoibacsi_tuyenchon($id){
    	$ids= explode('-',$id);
    	$qid = $ids[count($ids)-1];
    	$tuyenchon = \App\SelectQuestionSubject::where('id',$qid)->first();
    	$qids=  \App\SelectQuestion::where('subject_id',$qid)->pluck('question_id')->all();
    	$questions = Question::whereIn('question_id',$qids)->get();
    	//var_dump($questions);
    	$subjects= SelectQuestionSubject::whereNotIn('subject',$ids)->take(6)->get();
    	return view('tuyenchon-detail',['questions'=>$questions,'subject'=>$tuyenchon,'subjects'=>$subjects]);
    }
    public function hoibacsi(){
    	$question = Question::orderBy('question_id','DESC')->paginate(10);
    	//var_dump($question);
    	$selectQuestion = SelectQuestionSubject::orderBy('created_at','DESC')->take(6)->get();
    	//var_dump($question->answers);
        $speciality = \App\Speciality::get();
        //var_dump($speciality);
 
        //var_dump($questions[0]->question_id);
        view()->share('speciality',$speciality);
    	return view('hoibacsi',['question' => $question,'selectquestion'=>$selectQuestion])->withPost($question);
    }
    public function hoibacsiview(Request $rq, $id){
    	
    	switch($id){
    		case "tuyen-chon":
    			$subjects = SelectQuestionSubject::orderBy('created_at')->paginate(30);
    			return view('hoibacsi-tuyenchon',['subjects'=>$subjects])->withPost($subjects);
    			break;
    		case "dat-cau-hoi":
    			$specialities = \App\Speciality::all();
    			view()->share('specialities',$specialities);
    			return view('datcauhoi');
    			break;
    		case "danh-sach":
    			$unanswered = $rq->input('unanswered');
    			//var_dump($unanswered);
    			$all = \App\Answer::pluck('question_id')->all();
    			if($unanswered==="true"){
    				
    				$questions = \App\Question::whereNotIn('question_id',$all)->select('*')->paginate(20);
    				//var_dump($questions);
    			}
    			else{
    				$questions = \App\Question::whereIn('question_id',$all)->select('*')->paginate(20);
    			}
    			//$questions = \App\Answer::all();
    			///view()->share('questions',$questions);
    			//$question = Question::orderBy('question_id','DESC')->paginate(10);
    			if($rq->input('q')!=null){
    				$q = urldecode($rq->input('q'));
    				$benh = Disease::where('disease_name','like','%'.$q.'%');
    				$benh_count = $benh->count();
    				$benh = $benh->paginate(30);
    				$thuoc = Medicine::where('description','like','%'.$q.'%')->count();
    				$bs = Doctor::where('doctor_name','like','%'.$q.'%')->count();
    				$csyt = Clinic::where('clinic_name','like','%'.$q.'%')->count();
    				$qs = Question::where('question_title','like','%'.$q.'%')->count();
    				$questions = Question::where('question_title','like','%'.$q.'%')->paginate(30);
    				$service = \App\Service::where('service_name','like','%'.$q.'%')->count();
    				return view('hoibacsi_danhsach',['count'=>$benh_count,'questions'=>$questions,'thuoc'=>$thuoc,'doctor'=>$bs,'clinic'=>$csyt,'question'=>$qs,'service'=>$service])->withPost($questions);
    			}
    			return view('hoibacsi_danhsach',['questions'=>$questions])->withPost($questions);
    			break;
    		default:
    			return $this->hoibacsi_showdetail($id);
    			break;
    	}
    
    }
    public function thuoc_danhsach(){
    	return view('thuoc_danhsach');
    }
    public function hoibacsi_danhsach()
    {
        return view('hoibacsi_danhsach');
    }

    public function hoibacsi_showdetail($id){
    	$url = explode('-',$id);
    	$qid = $url[count($url)-1];
    	$question = Question::find($qid);
    	//$data[] = $question;
    	//var_dump($question);
    	//echo $qid;
    	return view('hoibacsiview')->with('question',$question);
    }
    public function listbaiviet(){
    	$Catalog = Catalog::all();
        $baiviet_new=Article::orderBy('article_id','DESC')->limit(1)->first();
        $baiviets  =Article::orderBy('article_id','DESC')->limit(5)->get();
        return view('baiviet-list',['baiviets' => $baiviets,'Catalog' => $Catalog,'baiviet_new'=>$baiviet_new])->withPost($baiviets);
    }
    public function baivietdetail($id){
    	echo $id;
    }
    
    public function bacsi_danhsach(Request $rq){
    	$doctors = Doctor::orderBy('doctor_id','DESC');
    	//view()->share('doctors',$doctors);
    	//var_dump($doctors);
    	if($rq->input('q')){
    		$q = urldecode($rq->input('q'));
    		$doctors = Doctor::where('doctor_name','like','%'.$q.'%')->paginate(30);
	    	
	    	$benh = Disease::where('disease_name','like','%'.$q.'%');
	    	$benh_count = $benh->count();
	    	//$benh = $benh->paginate(30);
	    	$thuoc = Medicine::where('description','like','%'.$q.'%')->count();
	    	$bs = Doctor::where('doctor_name','like','%'.$q.'%')->count();
	    	$csyt = Clinic::where('clinic_name','like','%'.$q.'%')->count();
	    	$qs = Question::where('question_title','like','%'.$q.'%')->count();
	    	$service = \App\Service::where('service_name','like','%'.$q.'%')->count();
	    	return view('danhsach_bacsi',['doctors'=>$doctors,'count'=>$benh_count,'thuoc'=>$thuoc,'doctor'=>$bs,'clinic'=>$csyt,'question'=>$qs,'service'=>$service])->withPost($doctors);
    	}
    	if($rq->input('province')!=null || $rq->input('speciality')!=null){
    		$prv= Province::where('province_url',$rq->input('province'))->first();
    		$sp= Speciality::where('specialty_url',$rq->input('speciality'))->first();
    		if($prv!=null){
    			$doctors= $doctors->where('province_id',$prv->province_id);
    		}
    		if($sp!=null){
    			$specialities = \App\DoctorSpeciality::where('speciality_id',$sp->speciality_id)->pluck('doctor_id')->all();
    			$doctors=  $doctors->whereIn('doctor_id',$specialities);
    			//echo count($doctors); return;
    		}
    		
    		//
    	
    	}
    	$doctors=$doctors->paginate(30);
    	return view('danhsach_bacsi',['doctors'=>$doctors])->withPost($doctors);
    }
    
    public function danhsach_csyt(Request $rq){
    	
    	$clinics = Clinic::orderBy('clinic_id','DESC'); 
    	if(isset($_COOKIE['province']) && $_COOKIE['province']!=""){
    		$clinics = Clinic::where('province_id',$this->getProvinceID($_COOKIE['province']))->orderBy('clinic_id','DESC');
    	}
    	if($rq->input('provinces')!=null){
    		
    	}
    	if($rq->input('specialities')!=null){
    		$speciality = \App\Speciality::where('specialty_url',$rq->input('specialities'))->first();

    		if($speciality!=null){
    			//echo 'test';return;
    			$clinic_ids = \App\ClinicSpeciality::where('speciality_id',$speciality->speciality_id)->pluck('clinic_id')->all();    			

    			$clinics = Clinic::whereIn('clinic_id',$clinic_ids)->orderBy('clinic_id','DESC'); 			

    		}
    		//var_dump($clinicss);
    	}
    	if($rq->input('place_types')!=null){
    		$speciality = \App\Speciality::where('specialty_url',$rq->input('place_types'))->firstOrFail();
    		if($speciality!=null){
    			$clinic_ids = \App\ClinicSpeciality::where('speciality_id',$speciality->speciality_id)->pluck('clinic_id')->all();
    			$clinics = Clinic::whereIn('clinic_id',$clinic_ids)->orderBy('clinic_id','DESC')->paginate(20);
    		}
    	}
    	if($rq->input('q')){
    		//echo $rq->input('q');return;
    		$clinics = Clinic::where('clinic_name','like','%'.$rq->input('q').'%')->orderBy('clinic_id','DESC')->paginate(30);
    		$q = urldecode($rq->input('q'));
    			$benh = Disease::where('disease_name','like','%'.$q.'%');
    			$benh_count = $benh->count();
    			//$benh = $benh->paginate(30);
	   			$thuoc = Medicine::where('description','like','%'.$q.'%')->count();
	   			$bs = Doctor::where('doctor_name','like','%'.$q.'%')->count();
	   			$csyt = Clinic::where('clinic_name','like','%'.$q.'%')->count();
	   			$qs = Question::where('question_title','like','%'.$q.'%')->count();
	   			$service = \App\Service::where('service_name','like','%'.$q.'%')->count();
    		//s echo count($clinics);return;
	   			return view('danhsach_csyt',['clinics'=>$clinics,'count'=>$benh_count,'thuoc'=>$thuoc,'doctor'=>$bs,'clinic'=>$csyt,'question'=>$qs,'service'=>$service])->withPost($clinics);
	   			 
    	}
    	if($rq->input('province')!=null || $rq->input('district')!=null || $rq->input('speciality')!=null){
    		$prv= Province::where('province_url',$rq->input('province'))->first();
    		$dis= District::where('url',$rq->input('district'))->first();
    		$sp= Speciality::where('specialty_url',$rq->input('speciality'))->first();
    		if($prv!=null){
    			$clinics = $clinics->where('province_id',$prv->province_id);
    		}
    		if($dis!=null){
    			$clinics = $clinics->where('district_id',$dis->id);
    		}
    		if($sp!=null){
    			$clinic_ids = \App\ClinicSpeciality::where('speciality_id',$sp->speciality_id)->pluck('clinic_id')->all();
    			$clinics = $clinics->whereIn('clinic_id',$clinic_ids)->orderBy('clinic_id','DESC');
    		}
    	}
    	$clinics= $clinics->paginate(30);
    	//var_dump($clinics[0]->specialities[0]->clinic);
    	//view()->share('clinics',$clinics);
    	return view('danhsach_csyt',['clinics'=>$clinics])->withPost($clinics);
    }
    public function chitiet_csyt($id){
    	if($id=='danh-sach'){
    		$clinics = Clinic::all();
    		//var_dump($clinics[0]->specialities[0]->clinic);
    		view()->share('clinics',$clinics);
    		return view('danhsach_csyt');
    		
    	}
    	
    	$url = explode('-',$id);
    	$uid =$url[count($url)-1];
    	
    	$comment = Comment::where('clinic_id',$uid)->orderBy('created_at', 'DESC')->get();
    	$danhgia = Comment::where('feedback_', '>', 0)->count('feedback_');
    	$sum = Comment::sum('feedback_');
    	$csyt = \App\Clinic::find($uid);
    	$chuyenkhoa = \App\ClinicSpeciality::where('clinic_id',$id)->get();
    	$bacsi = \App\DoctorClinic::where('clinic_id',$uid)->get();
    	
    	return view('chitiet_csyt',['cs'=>$csyt,'bacsi'=>$bacsi,'comment'=>$comment,'danhgia'=>$danhgia,'sum'=>$sum]);
    }
    public function chuyenkhoa(Request $rq){
    	$specialities = \App\Speciality::paginate(30);
    	view()->share('specialities',$specialities);
    	return view('chuyenkhoa')->withPost($specialities);
    }
    public function chuyenkhoadetail($id){
    	$url = explode('-',$id);
    	 
    	$qid = $url[count($url)-1];
    	$speciality = \App\Speciality::find($qid);
    	//var_dump($speciality);
    	$questions = Question::where('speciality_id',$qid)->orderby('created_at','DESC')->get();
    	$docid= \App\DoctorSpeciality::where('speciality_id',$speciality->speciality_id)->pluck('doctor_id')->all();
    	//var_dump($questions[0]->question_id);
    	$clinicid= ClinicSpeciality::where('speciality_id',$speciality->speciality_id)->pluck('clinic_id')->all();
    	
    	$clinics = Clinic::whereIn('clinic_id',$clinicid)->take(10)->get();
    	//var_dump($clinics);return;
    	$doctors= Doctor::whereIn('doctor_id',$docid)->take(10)->get();
        view()->share('speciality',$speciality);
    	view()->share('questions',$questions);
    	return view('chuyenkhoadetail',['doctors'=>$doctors,'clinics'=>$clinics]);
    }
    public function khuyenmaidetail(Request $rq, $url){
    	$ids = explode('-',$url);
    	$id = $ids[count($ids)-1];
    	$khuyenmai = \App\Deals::where('deal_id',$id)->first();
    	$khuyenmai->ranked = $khuyenmai->ranked +1;
    	$khuyenmai->save();
    	$comment  = comment::where('deal_id',$id)->orderBy('created_at','DESC')->get();
    	return view('khuyenmai_detail',['deal'=>$khuyenmai,'comment'=>$comment]);
    }
    public function dealcomment(Request $rq){
    	$body = $rq->input('body');
    	$deal_id = $rq->input('deal_id');
    	$deal = Deals::find($deal_id);
    	$comment = new Comment;
    	$comment->user_id = $rq->session()->get('user')->user_id;
    	$comment->deal_id = $deal_id;
    	$comment->content = $body;
    	$comment->save();
    	return redirect('/khuyen-mai/'.Deals::strtoUrl($deal->deal_title).'-'.$deal_id);
    }
    public function bacsi_detail($id){
    	$url = explode('-',$id);
    	
    	$qid = $url[count($url)-1];
    	$doctor = Doctor::find($qid);
    	view()->share('doctor',$doctor);
    	$comment = Comment::where('doctor_id',$doctor->doctor_id)->orderBy('created_at', 'DESC')->get();
    	$like = Comment::where('doctor_id',$doctor->doctor_id)->where('liking','1')->get();
    	//var_dump($doctor->activity[0]->question);
    	$doctor_user = Users::find($doctor->user_id);
    	if($doctor_user!=null){
    	$answers = Answer::where('answer_user_id',$doctor_user->user_id)->count();
    	}
    	else{
    		$answers = 0;
    	}
    	return view('bacsi-detail',['comment'=>$comment,'like'=>$like,'answer'=>$answers]);
    }

    public function logout(){
        session()->forget('user');
    }


    public function dangky(){
    	return view('dangky');
    }
    public function postDangky(Request $rq){
    	$email =$rq->input('email');
    	$phone = $rq->input('mobile_phone');
    	$name = $rq->input('name');
    	$next =$rq->input('next');
    	$password = $rq->input('password');
    	$place_add = $rq->input('place_add');
    	$place_name = $rq->input('place_name');
    	$prof_place = $rq->input('prof_place');
    	$prof_spec = $rq->input('prof_spec');
    	$type = $rq->input('type');
        // 

        //
    	if($email!=null && $name!=null){
    		$user = Users::where('email',$email)->first();
    		if($user==null){
    			$user = new Users;  		
	    		$user->email = $email;
	    		$user->fullname= $name;
	    		$user->phone = $phone;
	    		$user->password= Hash::make($password);
	    		$user_type = UserType::where('user_type_title',$type)->first();
	    		$user->user_type_id= $user_type!=null?$user_type->user_type_id:'1';
	    		$user->save();
    		}
    		else{
    			echo json_encode(array('next'=>$next));
    		}
    		
    	}
    	echo json_encode(array('next'=>$next));
    }
    public function dangnhap(Request $rq){
    	if($rq->input('next')!=null){
    		$rq->session()->put('next',$rq->input('next'));
    	}
    	if($rq->session()->has('user')){
    		if($rq->input('next')!=null)
    			return redirect($rq->input('next'));
    		return redirect('/tai-khoan');
    	}else{
    		return view('dangnhap');
    	}
    }
    public function postDangnhap(Request $rq){
    	//echo 'test';return;
    	$email = $rq->input('email');
    	$pass= $rq->input('password');
    	$next = $rq->input('next');
    	if(!$rq->session()->has('user')){
	    	$user = Users::where('email',$email)->first();
	    	if($user!=null){
	    		if(Hash::check($pass,$user->password)){
	    			$rq->session()->put('user',$user);
	    			//return response()->json(array('next'=>$next,'name'=>$user->fullname,'email'=>$user->email));
	    			return redirect('/');
	    		} 
	    	}
	    	return response()->json(array('detail'=>'Wrong email or password'),400);
    	}
    }
    public function taikhoan(Request $rq){
    	if($rq->session()->has('user')){
    		return view('taikhoan_home');
    	}
    	else{
    		return redirect('/dang-nhap?next=/tai-khoan');
    	}
    }
    public function taikhoan_method(Request $rq, $method){
    	if($rq->session()->has('user')){
	    	switch($method){
	    		case "ghi-nho":
	    			 return $this->taikhoan_ghinho($rq);
	    			break;
	    		case "nhan-xet":
	    			return $this->taikhoan_nhanxet($rq);
	    			break;
	    		case "hoi-dap":

	    			return $this->taikhoan_hoidap($rq);
	    			break;
	    		case "doi-mat-khau":
	    			return $this->taikhoan_doimatkhau($rq);
	    			break;
	    		case "cau-hoi-moi-nhat":
	    			$all = \App\Answer::pluck('question_id')->all();
	    			if($rq->session()->get('user')->user_type_id ==2){
	    				 $doctorid = $rq->session()->get('user')->doctor->doctor_id;
	    				 $spec = \App\DoctorSpeciality::where('doctor_id',$doctorid)->pluck('speciality_id')->all();
	    				// var_dump($spec);
	    				 $questions = \App\Question::whereNotIn('question_id',$all)->whereIn('speciality_id',$spec)->select('*')->get();
	    				//var_dump($questions);
	    				 view()->share('questions',$questions);
	    				 return view('taikhoan_cauhoimoinhat');
	    			    }
                   
	    			break;
	    		case "them-bac-si":
	    			$speciality = \App\Speciality::all();
	    			$services = \App\Service::all();
	    			return view('taikhoan_thembacsi',['specialities'=>$speciality,'services'=>$services]);
	    			break;
	    		case "them-csyt":
	    			$speciality = \App\Speciality::all();
	    			$services = \App\Service::all();
	    			return view('taikhoan_themcsyt',['specialities'=>$speciality,'services'=>$services]);
	    			break;
	    		case "viet-bai":
	    			$catalogs = Catalog::all();
	    			return view('taikhoan_vietbai',['catalogs'=>$catalogs]);
	    			break;
	    	}
    	}
    	else{
    		return redirect('/dang-nhap?next=/tai-khoan');
    	}
    }
    
    public static function taikhoan_ghinho(Request $rq){
    	return view('taikhoan_ghinho');
    }
    public static function taikhoan_nhanxet(Request $rq){
    	return 'somming soon';
    }
    public static function taikhoan_hoidap(Request $rq){
    	$all = \App\Answer::pluck('question_id')->all();
        $user_id = $rq->session()->get('user')->user_id;
      
         $count_answers = 0;
         //var_dump($user_id);
      //  $questions = Question::where('user_id',$user_id)->get();
      if( $rq->session()->get('user')->user_type_id==2 && $rq->session()->get('user')->doctor!=null){
      
        $spec = \App\DoctorSpeciality::where('doctor_id',$rq->session()->get('user')->doctor->doctor_id)->pluck('speciality_id')->all();
        //var_dump($spec);return;
        $questions = \App\Question::whereNotIn('question_id',$all)->whereIn('speciality_id',$spec)->select('*')->orderBy('created_at','DESC')->paginate(20);
        $answers = \App\Question::whereIn('question_id',$all)->whereIn('speciality_id',$spec)->select('*')->orderBy('created_at','DESC')->paginate(20);
      }
      elseif($rq->session()->get('user')->user_type_id==3 &&  $rq->session()->get('user')->clinic!=null){
      	$spec = \App\ClinicSpeciality::where('clinic_id',$rq->session()->get('user')->clinic->clinic_id)->pluck('speciality_id')->all();
      	//  var_dump($spec);
      	$questions = \App\Question::whereNotIn('question_id',$all)->whereIn('speciality_id',$spec)->select('*')->orderBy('created_at','DESC')->paginate(20);
      	$answers = \App\Question::whereIn('question_id',$all)->whereIn('speciality_id',$spec)->select('*')->orderBy('created_at','DESC')->paginate(20);
      	 
      }
      else{
      
      	$questions = \App\Question::where('user_id',$user_id)->orderBy('created_at','DESC')->paginate(20);
      	
      	$answers = \App\Question::where('user_id',$user_id)->whereIn('question_id',$all)->orderBy('created_at','DESC')->paginate(20);
      	//echo count($answers);return;
      }
      
        //$answers = \App\Question::whereIn('question_id',$all)->whereIn('speciality_id',$spec)->select('*')->get();
       // var_dump($spec);return;
        foreach ($questions as $question) {
             $dem  = Answer::where('question_id',$question['question_id'])->count();
             $count_answers=  $dem +1;
              
            } $count_answers =$count_answers + $count_answers;
       $count_questions =Question::where('user_id',$user_id)->count();
    	return view('taikhoan_hoidap',['questions' => $questions,'count_answers' => $count_answers,'count_questions' => $count_questions,'answers'=>$answers]);

    }
    public static function taikhoan_doimatkhau(Request $rq){
    	return view('taikhoan_doimatkhau');
    }
    public function doimatkhau(Request $rq){
    	$pass = $rq->input('password');
    	$newpass = $rq->input('new_password');
    	$newpass_confirm = $rq->input('new_password_confirm');
    	$email = $rq->session()->get('user')->email;
    	$user = Users::where('email',$email)->first();
    	if($user!=null){
    		if(Hash::check($pass,$user->password)){
    			if($newpass==$newpass_confirm){
    				$user->password= Hash::make($newpass);
    				$user->save();
    			}
    			else{
    				return response()->json(array('detail'=>'New password invalid'),400);
    			}
    		}
    		else{
    			return response()->json(array('detail'=>'Password invalid'),400);
    		}
    	}
    }
    
    public function dangxuat(Request $rq){
    	$rq->session()->forget('user');
    	
    }
    public function khuyenmai(Request $rq){
    	//echo 'khuyen mai';
    	$deal_category = \App\DealCategory::all();
    	$category = $rq->input('categories');
    	$cate = \App\DealCategory::where('category_url',$category)->first();
    	if($cate!=null){
    		$deals = \App\Deals::where('deal_category',$cate->id)->paginate(30);
    	}
    	else{
    		$deals = \App\Deals::orderBy('ranked','DESC')->paginate(30);
    	}
    	return view('khuyenmai',['deal_category'=>$deal_category,'deals'=>$deals])->withPost($deals);
    }
    public function benh(Request $rq){
    	  $benh_view = Disease::groupBy('view')->orderBy('view','DESC')->get();
          return view('benh',['benh_view'=> $benh_view]);
    }
    public function chitietbenh($qid)
    {
    	$url = explode('-',$qid);
    	$id = $url[count($url)-1];
    	//$bacsi =
        
    	$benh = Disease::find($id);
    	$cauhoi = Question::where('speciality_id',$benh['speciality_id'])->get();
        $id_bacsi = DoctorSpeciality::where('speciality_id',$benh['speciality_id'])->pluck('doctor_id')->all();
		//var_dump($id_bacsi);return;
		$idClinic = ClinicSpeciality::where('speciality_id',$benh['speciality_id'])->pluck('clinic_id')->all();
		$doctor = Doctor::whereIn('doctor_id',$id_bacsi)->take(10)->get();
		$clinics = Clinic::whereIn('clinic_id',$idClinic)->take(10)->get();
    	return view('benh-detail',['benh'=>$benh,'cauhoi'=>$cauhoi,'doctors'=>$doctor,'clinics'=>$clinics]);
    }
    
    
    public function thuoc(Request $rq){
    	$medicines = Medicine::orderBy('medicine_id','DESC')->paginate(60);
    	if($rq->input('q')){
    		$q = urldecode($rq->input('q'));
    		$benh = Disease::where('disease_name','like','%'.$q.'%');
    		$benh_count = $benh->count();
    		$benh = $benh->paginate(30);
    		$thuoc = Medicine::where('description','like','%'.$q.'%')->count();
    		$medicines = Medicine::where('description','like','%'.$q.'%')->paginate(60);
    		$bs = Doctor::where('doctor_name','like','%'.$q.'%')->count();
    		$csyt = Clinic::where('clinic_name','like','%'.$q.'%')->count();
    		$qs = Question::where('question_title','like','%'.$q.'%')->count();
    		$service = \App\Service::where('service_name','like','%'.$q.'%')->count();
    		return view('thuoc',['medicines'=>$medicines,'count'=>$benh_count,'benh'=>$benh,'thuoc'=>$thuoc,'doctor'=>$bs,'clinic'=>$csyt,'question'=>$qs,'service'=>$service])->withPost($medicines);
    	}
    	
    	return view('thuoc',['medicines'=>$medicines])->withPost($medicines);
    }
    public function chitietthuoc($qid){
    	$url = explode('-',$qid);
    	$id = $url[count($url)-1];
    	//echo $id;return;
    	$thuoc = Medicine::find($id);
    	//var_dump($thuoc);return;
    	//var_dump($thuoc->type_medicine);
        if($thuoc->speciality_id!=null){
    		$lienquan =Medicine::where('speciality_id',$thuoc->speciality_id)->get();
    		view()->share('lienquan',$lienquan);
        }
    	//$lienquan = Medicine::all()->get(5);
    	//var_dump($lienquan);return;
    	return view('thuoc-detail',['thuoc'=>$thuoc]);
    }
    function to_slug($str) {
    	$str = trim(mb_strtolower($str));
    	$str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    	$str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    	$str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    	$str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    	$str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    	$str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    	$str = preg_replace('/(đ)/', 'd', $str);
    	$str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    	$str = preg_replace('/([\s]+)/', '-', $str);
    	return $str;
    }
    public function comment($qid,Request $rq){
    	   $url = explode('-',$qid);
    	$id = $url[count($url)-1];
    	$baiviet =Article::find($id);
    	$comment = new comment;
    	$comment->article_id = $id;
    	$comment->user_id=$rq->session()->get('user')->user_id;
    	$comment->content= $rq->input('body');
    	$comment->save();
    	$tieude = to_slug($baiviet['article_title']);
    	return redirect('bai-viet/'.$tieude.'-'.$id)->with('thongbao','Viết Bình Luận Thành Công');
    }
    public function commentcsyt($qid,Request $rq){
    	var_dump($qid); return;
    	if($rq->input('next')!=""){
    		$rq->session()->put('next',$rq->input('next'));
    	}
    	if(!$rq->session()->has('user'))
    	{
    		return redirect('/dang-nhap?next='.$rq->session->get('next'));
    	}
    	else{
    		$url = explode('-',$qid);
    		$id = $url[count($url)-1];
    		$cs =Clinic::find($id);
    		$comment = new comment;
    		$comment->clinic_id = $id;
    		$comment->user_id=$rq->session()->get('user')->user_id;
    		$comment->feedback_=$rq->input('rating');
    		$comment->content= $rq->input('body');
    		// $comment->name= $rq->input('name');
    		//$comment->email= $rq->input('email');
    		$comment->save();
    		//$tieude = to_slug($baiviet['article_title']);
    		return redirect('/co-so-y-te/'.'-'.$id.'/kham-benh#nhan-xet')->with('thongbao','Bạn Bình Luận Thành Công');
    	}
    }
    public function detail($id){

           $comment  = comment::where('article_id',$id)->orderBy('created_at','DESC')->get();


          $Catalog = Catalog::all();
          $baiviet_new=Article::orderBy('article_id','DESC')->limit(1)->first();
          $baiviets    =Article::orderBy('article_id','DESC')->limit(5)->get();
          $baiviet = Article::find($id);
            $lienquan =Article::where('catalog_id',$baiviet['catalog_id'])->orderBy('article_id','DESC')->limit(5)->get();
          $noibat   =Article::orderBy('created_at','DESC')->limit(5)->get();// ,'noibat' =>$noibat

          return view('detail',['baiviet' => $baiviet,'lienquan' => $lienquan,'noibat' => $noibat,'comment' => $comment]);
    }

 
    public function chitietbaiviet($qid){
         $url = explode('-',$qid);   
         $id = $url[count($url)-1];
         $Catalogs = Catalog::all();
          $comment  = comment::where('article_id',$id)->orderBy('created_at','DESC')->get();
          $Catalog = Catalog::all();
          $baiviet_new=Article::orderBy('article_id','DESC')->limit(1)->first();
          $baiviets    =Article::orderBy('article_id','DESC')->limit(5)->get();
          $baiviet = Article::find($id);
          $lienquan =Article::where('catalog_id',$baiviet['catalog_id'])->orderBy('article_id','DESC')->limit(5)->get();
          $noibat   =Article::orderBy('created_at','DESC')->limit(5)->get();// ,'noibat' =>$noibat
          return view('detail',['Catalogs'=>$Catalogs,'baiviet' => $baiviet,'lienquan' => $lienquan,'noibat' => $noibat,'comment' => $comment]);

    }
    public function chuyenmuc($qid) {
        $url = explode('-',$qid);   
        $id = $url[count($url)-1];
        $Catalogs = Catalog::all();
        $Catalog = Catalog::where('id',$id)->first();
        if($Catalog->parent_id == 0)
        {
          $baiviet_new=Article::where('catalog_id',$id)->orderBy('article_id','ASC')->limit(1)->first();
          $baiviet = Article::where('catalog_id',$id)->orderBy('article_id','ASC')->paginate(10);
          return view('danhmuc',['Catalogs' => $Catalogs,'baiviet' => $baiviet,'baiviet_new'=>$baiviet_new]);
         }
        else

        $baiviet_new=Article::where('catalog_id',$id)->orderBy('article_id','DESC')->limit(1)->first();
        $baiviet = Article::where('catalog_id',$id)->orderBy('article_id','ASC')->paginate(10);
        return view('danhmuc',['Catalogs' => $Catalogs,'baiviet' => $baiviet,'baiviet_new'=>$baiviet_new])->withPost($baiviet);
        
    }
       public function get() {
        $Catalog = Catalog::all();
        $baiviet_new=Article::orderBy('article_id','DESC')->limit(1)->first();
        $baiviets  =Article::orderBy('article_id','DESC')->limit(50)->get();
        return view('baiviet-list',['baiviets' => $baiviets,'Catalog' => $Catalog,'baiviet_new'=>$baiviet_new])->withPost($baiviets);

    }
    public function danhmuc($id)
    {   
           $Catalog = Catalog::find($id);
       
           $baiviet_new = Article::where('catalog_id',$id)->orderBy('article_id','ASC')->first();
           if(!$baiviet_new)
           {
            $baiviet_new = null;
           }
           $baiviet =Article::where('catalog_id',$id)->orderBy('article_id','ASC')->limit(8)->get();
          

        return view('danhmuc',['baiviet' => $baiviet,'Catalog'=>$Catalog,'baiviet_new' => $baiviet_new])->withPost($baiviet);;
    }
    public function vietbai(Request $rq){
    	$title = $rq->input('tieude');
    	//echo $title;
    	$tomtat =$rq->input('tomtat');
    	$noidung = $rq->input('noidung');
    	$chuyenmuc=  $rq->input('chuyenmuc');
    	$author = $rq->input('nguoiviet');
    	$source = $rq->input('nguon');
    	$article = new Article;
    	$article->catalog_id = $chuyenmuc;
    	$article->article_title = $title;
    	$article->article_content = $noidung;
    	$article->article_summary = $tomtat;
    	$article->writer=$author;
    	$article->article_url = "";
    	echo $rq->input('hinhanh');
    	$target_dir = "/home/botvn/www/medicvn.com/public/images/";
    	$target_file = $target_dir . basename($_FILES["hinhanh"]["name"]);
    	$uploadOk = 1;
    	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    	// Check if image file is a actual image or fake image
    	if(isset($_POST["submit"])) {
    		$check = getimagesize($_FILES["hinhanh"]["tmp_name"]);
    		if($check !== false) {
    			echo "File is an image - " . $check["mime"] . ".";
    			$uploadOk = 1;
    		} else {
    			echo "File is not an image.";
    			$uploadOk = 0;
    		}
    	}
    	// Check if file already exists
    	if (file_exists($target_file)) {
    		echo "Sorry, file already exists.";
    		$uploadOk = 0;
    	}
    	// Check file size
    	if ($_FILES["hinhanh"]["size"] > 500000) {
    		echo "Sorry, your file is too large.";
    		$uploadOk = 0;
    	}
    	// Allow certain file formats
    	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    			&& $imageFileType != "gif" ) {
    				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    				$uploadOk = 0;
    			}
    			// Check if $uploadOk is set to 0 by an error
    			if ($uploadOk == 0) {
    				echo "Sorry, your file was not uploaded.";
    				// if everything is ok, try to upload file
    			} else {
    				if (move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $target_file)) {
    					echo "The file ". basename( $_FILES["hinhanh"]["name"]). " has been uploaded.";
    					$article->image = $_FILES["hinhanh"]["name"];
    				} else {
    					echo "Sorry, there was an error uploading your file.";
    				}
    			}
    	$article->save();
    	return redirect('/bai-viet');
    }


    public function thembacsi(Request $rq){
    	$name = $rq->input('doctorname');
    	$desc = $rq->input('description');
    	$specialities = $rq->input('chuyenkhoa');
    	//var_dump( $specialities);
    	$services = $rq->input('dichvu');
    	$clinic = $rq->input('noicongtac');
    	$exprience = $rq->input('kinhnghiem');
    	$exprience = explode("#",$exprience);
    	$daotao = $rq->input('daotao');
    	$daotao = explode('#',$daotao);
    	$doctor = new Doctor;
    	$doctor->doctor_name = $name;

    	$exp = "<ul>";
    	foreach($exprience as $ex){
    		$exp.="<li>".$ex."</li>";
    	}
    	$exp.="</ul>";
    	$doctor->experience = $exp;
    	$dt = "<ul>";
    	foreach($daotao as $d){
    		$dt.="<li>".$d."</li>";
    	}
    	$dt.="</ul>";
    	$doctor->training = $dt;
    	$doctor->doctor_url = $this->to_slug($name);    	

        //upload file
        if ($rq->hasFile('hinhanh')) {
            $file = $rq->file('hinhanh');
            $random_digit = rand(000000000, 999999999);
            $name = $random_digit.$file->getClientOriginalName('hinhanh');
            $duoi = strtolower($file->getClientOriginalExtension('hinhanh'));

            if ($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg') {
                return back()->with(['flash_level' => 'danger', 'flash_message' => 'Định dạng ảnh chưa chính xác']);
            }
            $file->move('public/images/doctor', $name);
            $doctor->profile_image = $name;           
        }    	
    	$doctor->save();

    	if($doctor->doctor_id!="" || $doctor->doctor_id!=null){
    		foreach($specialities as $sp){
    			$docsp = new DoctorSpeciality;
    			$docsp->doctor_id = $doctor->doctor_id;
    			$docsp->speciality_id = $sp;
    			$docsp->save();
    		}
    		foreach($services as $ser){
    			$docser = new DoctorService;
    			$docser->doctor_id = $doctor->doctor_id;
    			$docser->service_id = $ser;
    			$docser->save();
    		}
    	return redirect('/danh-sach/bac-si/'.$doctor->doctor_url.'-'.$doctor->doctor_id);
    	}
    }

    public function themcsyt(Request $rq){
    	//var_dump($rq);
    	$name = $rq->input('clinicname');
    	$specialities = $rq->input('chuyenkhoa');
    	//var_dump( $specialities);
    	$services = $rq->input('dichvu');
    	$clinic = new Clinic;
    	$clinic->clinic_name = $name;
    	$clinic->clinic_url  = $this->to_slug(trim($name));
    	$clinic->clinic_address = $rq->input('diachi');
    	$clinic->clinic_phone = $rq->input('dienthoai');
    	$clinic->clinic_desc = $rq->input('description');

        //upload images
        if ($rq->hasFile('hinhanh')) {
            $file = $rq->file('hinhanh');
            $random_digit = rand(000000000, 999999999);
            $name = $random_digit.$file->getClientOriginalName('hinhanh');
            $duoi = strtolower($file->getClientOriginalExtension('hinhanh'));

            if ($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg') {
                return back()->with(['flash_level' => 'danger', 'flash_message' => 'Định dạng ảnh chưa chính xác']);
            }
            $file->move('public/images/health_facilities', $name);
            $clinic->profile_image = $name;        
        }   
    	
    	$clinic->save();
    	if($clinic->clinic_id!="" || $clinic->clinic_id!=null){
    		if($specialities!=null)
	    		foreach($specialities as $sp){
	    			$docsp = new ClinicSpeciality;
	    			$docsp->clinic_id = $clinic->clinic_id;
	    			$docsp->speciality_id = $sp;
	    			$docsp->save();
	    		}
    	
    		if($services!=null){
	    		foreach($services as $ser){
	    			$docser = new ClinicService;
	    			$docser->clinic_id = $clinic->clinic_id;
	    			$docser->service_id = $ser;
	    			$docser->save();
	    		}
    		}
    	return redirect('/co-so-y-te/'.$clinic->clinic_url.'-'.$clinic->clinic_id);
    	}
    	//echo $name;
    }
    function test(){
    	return view('welcome');
    }
}
