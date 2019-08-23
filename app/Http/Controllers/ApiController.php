<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
use App\DoctorExperience;

use App\ClinicService;
use App\Catalog;
use App\DoctorService;
use App\Service;
use App\Province;
use App\Speciality;
use App\District;

class ApiController extends Controller
{
	
    public function article(){
        $article = Article::with('catalog')->orderBy('article_id','DESC')->paginate(10);        
        
        return response()->json([
            'article' => $article            
        ]);
    }

    public function articleWhereId($id){
        $article = Article::with('catalog')->where('article_id',$id)->first();    
        
        return response()->json([
            'article' => $article            
        ]);
    }



    public function deals(){
        $deals= Deals::with('catalog')->with('clinic')->orderBy('deal_id','DESC')->paginate(10);
        return response()->json([            
            'deals' => $deals
        ]);
    }

    public function dealsWhereId($id){
        $deals= Deals::with('catalog')->with('clinic')->where('deal_id',$id)->first();
        return response()->json([            
            'deals' => $deals
        ]);
    }


    //doctor
    public function doctor(){
        $doctor = Doctor::with('user')->with('clinics')->with('services')->with('specialities')->orderBy('doctor_id','DESC')->paginate(10);        
        
        return response()->json([
            'doctor' => $doctor            
        ]);
    }   
    public function doctorWhereId($id){
        $doctor = Doctor::with('user')->with('clinics')->with('services')->with('specialities')->where('doctor_id',$id)->first();        
        
        return response()->json([
            'doctor' => $doctor            
        ]);
    }


    //clinic
    public function clinic(){
        $clinic= Clinic::with('user')->with('services')->with('specialities')->orderBy('clinic_id','DESC')->paginate(10);
        return response()->json([            
            'clinic' => $clinic
        ]);
    }

    //clinic where id
    public function clinicWhereId($id){
        $clinic = Clinic::where('clinic_id', $id)->first(); 
        return response()->json([
            'clinic' => $clinic            
        ]);
    } 

    //doctor service where id
    public function serviceWhereId($id){
        $service = Service::where('service_id', $id)->first(); 
        return response()->json([
            'service' => $service            
        ]);
    }   

    // specialities Where Id
    public function specialitiesWhereId($id){
        $specialities = Speciality::where('speciality_id', $id)->first(); 
        return response()->json([
            'specialities' => $specialities            
        ]);
    }

    //question
    public function question(){
        $question = Question::with('answers')->with('cat')->with('speciality')->orderBy('question_id', 'DESC')->paginate(10);
        return response()->json([
            'question' => $question            
        ]);
    }

    public function questionWhereId($id){
        $question = Question::with('answers')->with('cat')->with('speciality')->where('question_id', $id)->orderBy('question_id', 'DESC')->first();
        return response()->json([
            'question' => $question            
        ]);
    }

    public function answersMainWhereId($id){
        $answers = Answer::with('user')->where('answer_id', $id)->orderBy('question_id', 'DESC')->first();
        return response()->json([
            'answers' => $answers            
        ]);
    }


    public function answersWhereId($id){
        $answer = Answer::where('question_id', $id)->orderBy('answer_id', 'DESC')->get(); 
        return response()->json([
            'answer' => $answer            
        ]);
    }

    public function userWhereId($id){
        $user = Users::where('user_id', $id)->first();
        $doctor = Doctor::where('user_id', $id)->first();
        $clinic = Clinic::where('user_id', $id)->first();
        return response()->json([
            'user' => $user,
            'doctor' => $doctor,
            'clinic' => $clinic
        ]);
    }

    //medicine
    public function medicine(){
        $medicine= Medicine::orderBy('medicine_id','ASC')->paginate(10);
        return response()->json([            
            'medicine' => $medicine
        ]);
    }
    public function medicineWhereId($id){
        $medicine= Medicine::where('medicine_id',$id)->first();
        return response()->json([            
            'medicine' => $medicine
        ]);
    }


    //disease
    public function disease(){
        $disease= Disease::with('speciality')->orderBy('disease_id','ASC')->paginate(10);
        return response()->json([            
            'disease' => $disease
        ]);
    }
    public function diseaseWhereId($id){
        $disease= Disease::where('disease_id', $id)->first();
        return response()->json([            
            'disease' => $disease
        ]);
    }

}

    