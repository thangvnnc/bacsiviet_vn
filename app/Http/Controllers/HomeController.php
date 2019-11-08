<?php

namespace App\Http\Controllers;

use App\Drugstore;
use App\Locations;
use App\Patient;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
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
use App\Calltime;
use App\Social;
use App\Ads;
use App\CollaboratorsUser;
use Auth;
use PhpParser\Comment\Doc;
use Socialite;
use Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

class HomeController extends Controller
{
    public function __construct()
    {
        if (isset(Session::get('user')->user_id)) {
            if (!isset($_SESSION)) {
                session_start();
            }

            //session_start();
            $_SESSION['userid_chat'] = Session::get('user')->user_id;

        }
        $article = Article::orderBy('article_id', 'DESC')->limit(5)->get();
        view()->share('article', $article);

        $deals = Deals::orderBy('ranked', 'DESC')->get();
        view()->share('deals', $deals);

        //news new 5
        $news_new = Article::orderBy('article_id', 'DESC')->limit(5)->get();
        view()->share('news_new', $news_new);
        //news popular
        $news_popular = Article::where('popular', 1)->orderBy('article_id', 'DESC')->limit(5)->get();
        view()->share('news_popular', $news_popular);
    }

    public static function getProvinceID($province)
    {
        $prov = \App\Province::where('name', 'like', '%' . $province . '%')->firstOrFail();
        if ($prov)
            return $prov->province_id;
        return false;
    }

    public function index()
    {

        $clinic = Clinic::where('featured', '1')->limit(12)->get();
        $doctor = Doctor::where('featured', '1')->orderBy('order_doctor', 'DESC')->limit(9)->get();
        $questions = SelectQuestionSubject::where('featured', '1')->limit(12)->get();
        $reviews = Review::all()->take(5);
        $specialities = \App\Speciality::all();
        view()->share('clinic', $clinic);
        view()->share('doctors', $doctor);
        view()->share('specialities', $specialities);
        view()->share('questions', $questions);
        view()->share('reviews', $reviews);
        return view('home');
    }

    public function aboutUs()
    {
        return view('bacsiviet/aboutUs');
    }

    public function recruitment()
    {
        return view('bacsiviet/recruitment');
    }

    public function contactUs()
    {
        return view('bacsiviet/contactUs');
    }

    public function disputeResolution()
    {
        return view('bacsiviet/disputeResolution');
    }

    public function informationSecurityCustomer()
    {
        return view('bacsiviet/informationSecurityCustomer');
    }

    public function resetPassword()
    {
        return view('taikhoan/resetPassword');
    }

    public function construction()
    {
        return view('dangxaydung/dangxaydung');
    }

    public function userGuide()
    {
        return view('huongdansudung/user');
    }

    public function professionalGuide()
    {
        return view('huongdansudung/placeAndProfessional');
    }

    public function placeGuide()
    {
        return view('huongdansudung/placeAndProfessional');
    }

    public function voucher()
    {
        return view('voucher/index');
    }


    public function timkiem(Request $rq)
    {
        if ($rq->input('province')) {
            $provin = $rq->input('province');
            $rq->session()->put('province', $provin);
            $province = \App\Province::where('name', 'like', '%' . $provin . '%')->first();
            // if($province!=null){
            // 	$rq->session()->put('province_id',$province->province_id);
            // 	return redirect('/danh-sach');
            // }

        }
        if ($rq->input('q') != null) {
            $q = urldecode($rq->input('q'));
            $benh = Disease::where('disease_name', 'like', '%' . $q . '%');
            $benh_count = $benh->count();
            $benh = $benh->paginate(30);
            $thuoc = Medicine::where('description', 'like', '%' . $q . '%')->count();
            $bs = Doctor::where('doctor_name', 'like', '%' . $q . '%')->count();
            $csyt = Clinic::where('clinic_name', 'like', '%' . $q . '%')->count();
            $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
            $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();
            return view('tim_kiem', ['count' => $benh_count, 'benh' => $benh, 'thuoc' => $thuoc, 'doctor' => $bs, 'clinic' => $csyt, 'question' => $qs, 'service' => $service]);
        } else {
            echo '<script>alert("Vui lòng nhập từ khóa tìm kiếm.");window.history.back();</script>';
        }
    }

    public function hoibacsi_tuyenchon($id)
    {
        $ids = explode('-', $id);
        $qid = $ids[count($ids) - 1];
        $tuyenchon = \App\SelectQuestionSubject::where('id', $qid)->first();
        $qids = \App\SelectQuestion::where('subject_id', $qid)->pluck('question_id')->all();
        $questions = Question::whereIn('question_id', $qids)->get();
        //var_dump($questions);
        $subjects = SelectQuestionSubject::whereNotIn('subject', $ids)->take(6)->get();
        return view('tuyenchon-detail', ['questions' => $questions, 'subject' => $tuyenchon, 'subjects' => $subjects]);
    }

    public function hoibacsi()
    {
        $question = Question::orderBy('question_id', 'DESC')->paginate(10);
        //var_dump($question);
        $selectQuestion = SelectQuestionSubject::orderBy('created_at', 'DESC')->take(6)->get();
        //var_dump($question->answers);
        $speciality = \App\Speciality::get();
        //var_dump($speciality);

        //var_dump($questions[0]->question_id);
        view()->share('speciality', $speciality);
        return view('hoibacsi', ['question' => $question, 'selectquestion' => $selectQuestion])->withPost($question);
    }

    public function hoibacsiPost(Request $rq)
    {
        $title = $rq->title;
        $body = $rq->body;
        $specialities = $rq->specialities;
        if ($rq->name != NULL) {
            $name = $rq->name;
        } else {
            $name = "Giấu tên";
        }

        $email = $rq->email;
        $user_id = $rq->user_id;

        if ($title === null || $body === null || $email === null) {
            $errors = new MessageBag(['errorMs' => 'Vui lòng điền vào các trường có dấu *']);
            return redirect()->back()->withInput()->withErrors($errors);
        } else {
            $question = new Question;
            $question->topic_id = $specialities;
            $question->user_id = $user_id;
            $question->fullname = $name;
            $question->question_title = $title;
            $question->question_content = $body;
            $question->question_url = $this->to_slug($title);
            $question->speciality_id = $specialities;
            $question->save();
            return redirect('/hoi-bac-si');
        }
    }

    public function apihoibacsiPost(Request $rq)
    {
        $title = $rq->title;
        $body = $rq->body;
        $specialities = $rq->specialities;
        if ($rq->name != NULL) {
            $name = $rq->name;
        } else {
            $name = "Giấu tên";
        }

        $email = $rq->email;
        $user_id = $rq->user_id;

        if ($title === null || $body === null || $email === null) {
            $errors = new MessageBag(['errorMs' => 'Vui lòng điền vào các trường có dấu *']);
            return redirect()->back()->withInput()->withErrors($errors);
        } else {
            $question = new Question;
            $question->topic_id = $specialities;
            $question->user_id = $user_id;
            $question->fullname = $name;
            $question->question_title = $title;
            $question->question_content = $body;
            $question->question_url = $this->to_slug($title);
            $question->speciality_id = $specialities;
            $question->save();
            return redirect('/hoi-bac-si');
        }
    }

    public function hoibacsiview(Request $rq, $id)
    {

        // var_dump($id);die;
        switch ($id) {
            case "tuyen-chon":
                $subjects = SelectQuestionSubject::orderBy('created_at')->paginate(30);
                return view('hoibacsi-tuyenchon', ['subjects' => $subjects])->withPost($subjects);
                break;
            case "dat-cau-hoi":
                $specialities = \App\Speciality::all();
                view()->share('specialities', $specialities);
                return view('datcauhoi');
                break;
            case "danh-sach":
                $unanswered = $rq->input('unanswered');
                //var_dump($unanswered);
                $all = \App\Answer::pluck('question_id')->all();
                if ($unanswered === "true") {

                    $questions = \App\Question::whereNotIn('question_id', $all)->select('*')->paginate(20);
                    //var_dump($questions);
                } else {
                    $questions = \App\Question::whereIn('question_id', $all)->select('*')->paginate(20);
                }
                //$questions = \App\Answer::all();
                ///view()->share('questions',$questions);
                //$question = Question::orderBy('question_id','DESC')->paginate(10);
                if ($rq->input('q') != null) {
                    $q = urldecode($rq->input('q'));
                    $benh = Disease::where('disease_name', 'like', '%' . $q . '%');
                    $benh_count = $benh->count();
                    $benh = $benh->paginate(30);
                    $thuoc = Medicine::where('description', 'like', '%' . $q . '%')->count();
                    $bs = Doctor::where('doctor_name', 'like', '%' . $q . '%')->count();
                    $csyt = Clinic::where('clinic_name', 'like', '%' . $q . '%')->count();
                    $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
                    $questions = Question::where('question_title', 'like', '%' . $q . '%')->paginate(30);
                    $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();
                    return view('hoibacsi_danhsach', ['count' => $benh_count, 'questions' => $questions, 'thuoc' => $thuoc, 'doctor' => $bs, 'clinic' => $csyt, 'question' => $qs, 'service' => $service])->withPost($questions);
                }
                return view('hoibacsi_danhsach', ['questions' => $questions])->withPost($questions);
                break;
            default:
                return $this->hoibacsi_showdetail($id);
                break;
        }

    }

    public function test()
    {
        return "fsda";
    }

    public function bacsitraloi(Request $rq, $id)
    {
        // var_dump("fds");die;
        $info = $rq->get('reply_as_information');
        $infoParse = json_decode($info);
        $thred_id = $rq->get('thread_id');
        $body = $rq->get('body');

        // $question = Question::orderBy('question_id','DESC')->paginate(10);
        // var_dump(json_decode($info));die;
        if (!empty($infoParse) && !empty($thred_id) && !empty($body)) {
            $answers = new Answer;
            $answers->question_id = $rq->get('thread_id');
            $answers->answer_type = $infoParse->reply_as_type;
            $answers->answer_user_id = $infoParse->reply_as_id;
            $answers->answer_content = $rq->get('body');
            $answers->save();
        }

        return $this->hoibacsi_showdetail($id);
    }

    public function thuoc_danhsach()
    {
        return view('thuoc_danhsach');
    }

    public function hoibacsi_danhsach()
    {
        return view('hoibacsi_danhsach');
    }

    public function hoibacsi_showdetail($id)
    {
        $ads = Ads::where('place', '1')->get();
        $url = explode('-', $id);
        $qid = $url[count($url) - 1];
        $question = Question::find($qid);
        //$data[] = $question;
        //var_dump($question);
        //echo $qid;
        return view('hoibacsiview', compact('ads'))->with('question', $question);
    }

    public function listbaiviet()
    {
        $Catalog = Catalog::all();
        $baiviet_new = Article::orderBy('article_id', 'DESC')->limit(1)->first();
        $baiviets = Article::orderBy('article_id', 'DESC')->limit(5)->get();
        return view('baiviet-list', ['baiviets' => $baiviets, 'Catalog' => $Catalog, 'baiviet_new' => $baiviet_new])->withPost($baiviets);
    }

    public function baivietdetail($id)
    {
        echo $id;
    }

    public function bacsi_danhsach(Request $rq)
    {
        $ads = Ads::where('place', '5')->get();

        $doctors = Doctor::where('status', '1')->orderBy('doctor_id', 'DESC');
        //view()->share('doctors',$doctors);
        //var_dump($doctors);
        if ($rq->input('q')) {
            if ($rq->input('key') == 'specialities') {
                $speciality = Speciality::where('specialty_url', $rq->input('q'))->first();
                $doctors = Doctor::Join('doctor_speciality', 'doctor.doctor_id', '=', 'doctor_speciality.doctor_id')->where('doctor_speciality.speciality_id', $speciality->speciality_id)->paginate(30);
                $bs = Doctor::Join('doctor_speciality', 'doctor.doctor_id', '=', 'doctor_speciality.doctor_id')->where('speciality_id', $speciality->speciality_id)->count();
                $q = urldecode($rq->input('q'));
                $user = Users::where('addpress', $rq->input('q'))->get();
                $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
                $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();

                return view('danhsach_bacsi', ['doctors' => $doctors, 'doctor' => $bs, 'question' => $qs, 'service' => $service, 'ads' => $ads, 'user' => $user, 'speciality' => $speciality])->withPost($doctors);

            } else if ($rq->input('key') == 'city') {
                // $doctors = Doctor::Join('user', 'doctor.user_id', '=', 'user.user_id')
                // ->where('user.addpress',$rq->input('q'))->paginate(30);

                $doctors = Doctor::where('doctor_address', 'like', $rq->input('q'))->paginate(30);

                $q = urldecode($rq->input('q'));
                $user = Users::where('addpress', $rq->input('q'))->get();
                //$doctors = Doctor::where('user_id','like','%trung%')->paginate(30);

                //     $bs = Doctor::Join('user', 'doctor.user_id', '=', 'user.user_id')
                // ->where('user.addpress',$rq->input('q'))->count();

                $bs = Doctor::where('doctor_address', 'like', $rq->input('q'))->count();

                $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
                $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();
                return view('danhsach_bacsi', ['doctors' => $doctors, 'doctor' => $bs, 'question' => $qs, 'service' => $service, 'ads' => $ads, 'user' => $user])->withPost($doctors);
            } else if ($rq->input('key') == 'clinic') {
                echo "clinic";
                die();
            }
            $q = urldecode($rq->input('q'));
            $doctors = Doctor::where('doctor_name', 'like', '%' . $q . '%')->paginate(30);

            $benh = Disease::where('disease_name', 'like', '%' . $q . '%');
            $benh_count = $benh->count();
            //$benh = $benh->paginate(30);
            $thuoc = Medicine::where('description', 'like', '%' . $q . '%')->count();
            $bs = Doctor::where('doctor_name', 'like', '%' . $q . '%')->count();
            $csyt = Clinic::where('clinic_name', 'like', '%' . $q . '%')->count();
            $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
            $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();
            return view('danhsach_bacsi', ['doctors' => $doctors, 'count' => $benh_count, 'thuoc' => $thuoc, 'doctor' => $bs, 'clinic' => $csyt, 'question' => $qs, 'service' => $service, 'ads' => $ads])->withPost($doctors);
        }

        if ($rq->input('province') != null) {
            $doctors = $doctors->where('province_id', $rq->input('province'));
        }
        if ($rq->input('speciality') != null) {
            $sp = Speciality::where('specialty_url', $rq->input('speciality'))->first();

            if ($sp != null) {
                $specialities = \App\DoctorSpeciality::where('speciality_id', $sp->speciality_id)->pluck('doctor_id')->all();
                $doctors = $doctors->whereIn('doctor_id', $specialities);
            }
        }
        $doctors = $doctors->paginate(30);
        return view('danhsach_bacsi', ['doctors' => $doctors, 'ads' => $ads])->withPost($doctors);
    }

    public function danhsach_csyt(Request $rq)
    {
        $ads = Ads::where('place', '6')->get();
        $baiviets = Article::where('catalog_id', '14')->orderBy('article_id', 'DESC')->limit(10)->get();
        $clinics = Clinic::orderBy('clinic_id', 'DESC');
        if (isset($_COOKIE['province']) && $_COOKIE['province'] != "") {
            $clinics = Clinic::where('province_id', $this->getProvinceID($_COOKIE['province']))->orderBy('clinic_id', 'DESC');
        }
        if ($rq->input('provinces') != null) {

        }
        if ($rq->input('specialities') != null) {
            $speciality = \App\Speciality::where('specialty_url', $rq->input('specialities'))->first();

            if ($speciality != null) {
                //echo 'test';return;
                $clinic_ids = \App\ClinicSpeciality::where('speciality_id', $speciality->speciality_id)->pluck('clinic_id')->all();

                $clinics = Clinic::whereIn('clinic_id', $clinic_ids)->orderBy('clinic_id', 'DESC');

            }
            //var_dump($clinicss);
        }
        if ($rq->input('place_types') != null) {
            $speciality = \App\Speciality::where('specialty_url', $rq->input('place_types'))->firstOrFail();
            if ($speciality != null) {
                $clinic_ids = \App\ClinicSpeciality::where('speciality_id', $speciality->speciality_id)->pluck('clinic_id')->all();
                $clinics = Clinic::whereIn('clinic_id', $clinic_ids)->orderBy('clinic_id', 'DESC')->paginate(20);
            }
        }
        if ($rq->input('q')) {
            //echo $rq->input('q');return;
            $clinics = Clinic::where('clinic_name', 'like', '%' . $rq->input('q') . '%')->orderBy('clinic_id', 'DESC')->paginate(30);
            $q = urldecode($rq->input('q'));
            $benh = Disease::where('disease_name', 'like', '%' . $q . '%');
            $benh_count = $benh->count();
            //$benh = $benh->paginate(30);
            $thuoc = Medicine::where('description', 'like', '%' . $q . '%')->count();
            $bs = Doctor::where('doctor_name', 'like', '%' . $q . '%')->count();
            $csyt = Clinic::where('clinic_name', 'like', '%' . $q . '%')->count();
            $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
            $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();
            //s echo count($clinics);return;
            return view('danhsach_csyt', ['clinics' => $clinics, 'count' => $benh_count, 'thuoc' => $thuoc, 'doctor' => $bs, 'clinic' => $csyt, 'question' => $qs, 'service' => $service, 'baiviets' => $baiviets, 'ads' => $ads])->withPost($clinics);

        }

        if ($rq->input('province') != null) {
            $prv = Province::where('id', $rq->input('province'))->first();
            if ($prv != null) {
                $clinics = $clinics->where('province', $prv->id);
            }
        }

        if ($rq->input('speciality') != null) {
            $sp = Speciality::where('specialty_url', $rq->input('speciality'))->first();
            if ($sp != null) {
                $clinic_ids = \App\ClinicSpeciality::where('speciality_id', $sp->speciality_id)->pluck('clinic_id')->all();
                $clinics = $clinics->whereIn('clinic_id', $clinic_ids)->orderBy('clinic_id', 'DESC');
            }
        }

//        if ($rq->input('province') != null || $rq->input('district') != null || $rq->input('speciality') != null) {
//            $prv = Province::where('province_url', $rq->input('province'))->first();
//            $dis = District::where('url', $rq->input('district'))->first();
//            $sp = Speciality::where('specialty_url', $rq->input('speciality'))->first();
//            if ($prv != null) {
//                $clinics = $clinics->where('province_id', $prv->province_id);
//            }
//            if ($dis != null) {
//                $clinics = $clinics->where('district_id', $dis->id);
//            }
//            if ($sp != null) {
//                $clinic_ids = \App\ClinicSpeciality::where('speciality_id', $sp->speciality_id)->pluck('clinic_id')->all();
//                $clinics = $clinics->whereIn('clinic_id', $clinic_ids)->orderBy('clinic_id', 'DESC');
//            }
//        }
        $clinics = $clinics->paginate(30);
        //var_dump($clinics[0]->specialities[0]->clinic);
        //view()->share('clinics',$clinics);
        return view('danhsach_csyt', ['baiviets' => $baiviets, 'ads' => $ads], ['clinics' => $clinics])->withPost($clinics);
    }

    public function danhsach_nhathuoc(Request $rq)
    {
        $drugstores = Drugstore::orderBy('drugstore_id', 'DESC');
        if (isset($_COOKIE['province']) && $_COOKIE['province'] != "") {
            $drugstores = Drugstore::where('province_id', $this->getProvinceID($_COOKIE['province']))->orderBy('drugstore_id', 'DESC');
        }

        if ($rq->input('province') != null) {
            $prv = Province::where('id', $rq->input('province'))->first();
            if ($prv != null) {
                $drugstores = $drugstores->where('province', $prv->id);
            }
        }
        $drugstores = $drugstores->paginate(30);
        return view('danhsach_nhathuoc2', ['drugstores' => $drugstores])->withPost($drugstores);
    }

    public function chitiet_csyt($id)
    {
        sleep(2);
        if ($id == 'danh-sach') {
            $clinics = Clinic::all();
            //var_dump($clinics[0]->specialities[0]->clinic);
            view()->share('clinics', $clinics);
            return view('danhsach_csyt');

        }

        $url = explode('-', $id);
        $uid = $url[count($url) - 1];

        $comment = Comment::where('clinic_id', $uid)->orderBy('created_at', 'DESC')->get();
        $danhgia = Comment::where('feedback_', '>', 0)->count('feedback_');
        $sum = Comment::sum('feedback_');
        $csyt = \App\Clinic::find($uid);
        $chuyenkhoa = \App\ClinicSpeciality::where('clinic_id', $id)->get();
        $bacsi = \App\DoctorClinic::where('clinic_id', $uid)->get();

        return view('chitiet_csyt', ['cs' => $csyt, 'bacsi' => $bacsi, 'comment' => $comment, 'danhgia' => $danhgia, 'sum' => $sum]);
    }

    public function chitiet_nhathuoc($id)
    {
        sleep(2);
        if ($id == 'danh-sach') {
            return redirect('/danh-sach-nha-thuoc');
        }

        $url = explode('/', $id);
        $uid = $url[count($url) - 1];

        $nhathuoc = \App\Drugstore::where('drugstore_url', $uid)->first();
        $vitri = \App\Locations::where('user_id', $nhathuoc->user_id)->first();
        if ($vitri == null) {
            $vitri = new Locations();
            $vitri->lat = 10.758363;
            $vitri->lng = 106.662145;
        }

        return view('chitiet_nhathuoc', ['cs' => $nhathuoc, 'vitri' => $vitri]);
    }

    public function chuyenkhoa(Request $rq)
    {

        $doctors = Doctor::where('status', '1')->orderBy('doctor_id', 'DESC')->limit(5)->get();
        $clinics = Clinic::orderBy('clinic_id', 'DESC')->limit(5)->get();

        $specialities = \App\Speciality::paginate(30);
        view()->share('specialities', $specialities);
        return view('chuyenkhoa', compact('doctors', 'clinics'))->withPost($specialities);
    }

    public function chuyenkhoadetail($id)
    {
        $url = explode('-', $id);

        $qid = $url[count($url) - 1];
        $speciality = \App\Speciality::find($qid);
        //var_dump($speciality);
        $questions = Question::where('speciality_id', $qid)->orderby('created_at', 'DESC')->get();
        $docid = \App\DoctorSpeciality::where('speciality_id', $speciality->speciality_id)->pluck('doctor_id')->all();
        //var_dump($questions[0]->question_id);
        $clinicid = ClinicSpeciality::where('speciality_id', $speciality->speciality_id)->pluck('clinic_id')->all();

        $clinics = Clinic::whereIn('clinic_id', $clinicid)->take(10)->get();
        //var_dump($clinics);return;
        $doctors = Doctor::whereIn('doctor_id', $docid)->where('status', 1)->take(10)->get();
        view()->share('speciality', $speciality);
        view()->share('questions', $questions);
        return view('chuyenkhoadetail', ['doctors' => $doctors, 'clinics' => $clinics]);
    }

    public function khuyenmaidetail(Request $rq, $url)
    {
        $ids = explode('-', $url);
        $id = $ids[count($ids) - 1];
        $khuyenmai = \App\Deals::where('deal_id', $id)->first();
        $khuyenmai->ranked = $khuyenmai->ranked + 1;
        $khuyenmai->save();
        $comment = comment::where('deal_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('khuyenmai_detail', ['deal' => $khuyenmai, 'comment' => $comment]);
    }

    public function dealcomment(Request $rq)
    {
        $body = $rq->input('body');
        $deal_id = $rq->input('deal_id');
        $deal = Deals::find($deal_id);
        $comment = new Comment;
        $comment->user_id = $rq->session()->get('user')->user_id;
        $comment->deal_id = $deal_id;
        $comment->content = $body;
        $comment->save();
        return redirect('/khuyen-mai/' . Deals::strtoUrl($deal->deal_title) . '-' . $deal_id);
    }

    public function bacsi_detail($id)
    {
        $url = explode('-', $id);

        $qid = $url[count($url) - 1];
        $doctor = Doctor::find($qid);
        view()->share('doctor', $doctor);
        $comment = Comment::where('doctor_id', $doctor->doctor_id)->orderBy('created_at', 'DESC')->get();
        $like = Comment::where('doctor_id', $doctor->doctor_id)->where('liking', '1')->get();
        //var_dump($doctor->activity[0]->question);
        $doctor_user = Users::find($doctor->user_id);
        if ($doctor_user != null) {
            $answers = Answer::where('answer_user_id', $doctor_user->user_id)->count();
        } else {
            $answers = 0;
        }
        return view('bacsi-detail', ['comment' => $comment, 'like' => $like, 'answer' => $answers]);
    }

    function postInfoDoctor(Request $rq)
    {
        $doctor_id = $rq->id;
        $doctor = Doctor::find($doctor_id);

        if ($doctor != null) {
            $spec = \App\DoctorSpeciality::where('doctor_id', $doctor_id)->pluck('speciality_id')->first();
            $spec_url = \App\Speciality::where('speciality_id', $spec)->first();
            $link = "https://medixlink.com/danh-sach/bac-si/" . $doctor->doctor_url . '-' . $doctor_id . '/' . $spec_url->specialty_url;

            header('Content-Type: application/json; charset=utf-8');
            return json_encode(array('isLogin' => true, 'msg' => 'Thông Tin Bác Sĩ', 'link' => $link), JSON_UNESCAPED_UNICODE);
        } else {
            header('Content-Type: application/json; charset=utf-8');
            return json_encode(array('isLogin' => false, 'msg' => 'Không Tồn Tại Bác Sĩ Này!'), JSON_UNESCAPED_UNICODE);
        }
    }

    function listkhuyenmai(Request $rq)
    {
        $deals = Deals::where('special_sale', 1)->orderBy('ranked', 'DESC')->get();
        $listid = array();

        if ($deals) {
            foreach ($deals as $dl) {
                array_push($listid, array('deal_id' => $dl->deal_id, 'deal_title' => $dl->deal_title, 'image' => 'https://medixlink.com/public/images/' . $dl->image, 'deal_description' => str_replace("\t", " ", str_replace("\r", " ", str_replace("\n", " ", str_replace("&nbsp;", " ", strip_tags($dl->description))))), 'deal_content' => str_replace("\t", " ", str_replace("\r", " ", str_replace("\n", " ", str_replace("&nbsp;", " ", strip_tags($dl->deal_content))))), 'link_detail' => 'https://medixlink.com/khuyen-mai/' . $this->to_slug($dl->deal_title) . '-' . $dl->deal_id));
            }

            return $listid;
            // die();

        } else {
            header('Content-Type: application/json: charset=utf-8');
            return json_encode(array('isLogin' => false, 'msg' => 'Không có khuyến mãi nào!'), JSON_UNESCAPED_UNICODE);
        }
    }

    public function logout()
    {
        session()->forget('user');
        session_destroy();
    }

    public function getdangky()
    {

        return view('dangky');
    }

    public function postDangky(Request $rq)
    {

        // echo $rq->type."<br/>";
        // echo $rq->name."<br/>";
        // echo $rq->mobile_phone."<br/>";
        // echo $rq->email."<br/>";
        // echo $rq->ngt."<br/>";
        // $pass = Hash::make($rq->password);
        // echo $pass."<br/>";

        $email = $rq->email;
        $phone = $rq->mobile_phone;
        $name = $rq->name;
        $password = $rq->password;
        $type = $rq->type;
        $present = $rq->ngt;
        $gender = $rq->gender;
        $type = 0;

        if ($email != null && $name != null && $password != null) {
            $user = Users::where('email', $email)->first();
            if ($user == null) {
                $user = new Users;
                $user->email = $email;
                $user->fullname = $name;
                $user->phone = $phone;
                $user->gender = $gender;
                $user->addpress = 'Việt Nam';
                $user->password = Hash::make($password);
                if ($rq->type == "user") {
                    $type = 1;
                } else if ($rq->type == "professional") {
                    $type = 2;
                } else if ($rq->type == "place") {
                    $type = 3;
                } else if ($rq->type == "drugstore") {
                    $type = 4;
                }
                $user->user_type_id = $type;
                $user->paid = 1;
                if ($user->save()) {
                    $user = Users::where('email', $email)->first();
                    $user_id = $user->user_id + ($user->user_type_id * 10000000);

                    DB::table('user')->where('user_id', $user->user_id)->update(array(
                        'user_id'=>$user_id
                    ));
                    $user = Users::where('email', $email)->first();
                    if ($user->user_type_id == 1) {
                        $user->user_id = $user->user_id + 10000000;
                        $user->save();
                        $patientNew = $user->createPatient();
                        $patientNew->save();
                        if($present != null && $present != "") {
                            $user->present = $present;
                            $user->save();
                            $collaboratorsUser = CollaboratorsUser::where('code', $present)->first();
                            if($collaboratorsUser != null) {
                                $patientNew->balance += $collaboratorsUser->promotion;
                                $patientNew->save();
                            }
                        }
                    } else if ($user->user_type_id == 2) {
                        $user->user_id = $user->user_id + 20000000;
                        $user->save();
                        $doctor = new Doctor;
                        $doctor->doctor_name = 'BS ' . $user->fullname;
                        $doctor->doctor_url = $this->to_slug('BS ' . $user->fullname);
                        $doctor->user_id = $user->user_id;
                        $doctor->experience = '<ul><li>20 năm  bệnh viện Chợ rẫy</li></ul>';
                        $doctor->training = '<ul><li>Đại học y dược HCM</li></ul>';
                        $doctor->doctor_address = 'Hồ Chí Minh';
                        $doctor->profile_image = '246170446bacsi.jpg';
                        $doctor->doctor_timework = '7h đến 19h';
                        $doctor->doctor_clinic = 'bv Đại Học Y Dược';
                        if ($doctor->save()) {
                            $docsp = new DoctorSpeciality;
                            $docsp->doctor_id = $doctor->doctor_id;
                            $docsp->speciality_id = 1;
                            $docsp->save();


                            $docser = new DoctorService;
                            $docser->doctor_id = $doctor->doctor_id;
                            $docser->service_id = 1;
                            $docser->save();
                        }
                    } else if ($user->user_type_id == 3) {
                        $user->user_id = $user->user_id + 30000000;
                        $user->save();
                        $image = $user->avatar;
                        // Thắng mod 20181107 start
                        $address = $user->address;

                        $clinic = new Clinic();
                        $clinic->user_id = $user->user_id;
                        $clinic->clinic_name = $user->fullname;
                        if ($image == null) {
                            $image = "";
                        }
                        $clinic->profile_image = $image;
                        if ($address == null) {
                            $address = "Việt Nam";
                        }
                        $clinic->clinic_address = $address;
                        $clinic->save();
                        // Thắng mod 20181107 end
                    } else if ($user->user_type_id == 4) {
                        $user->user_id = $user->user_id + 40000000;
                        $user->save();
                        $patientNew = $user->createPatient();
                        $patientNew->save();
                        if($present != null && $present != "") {
                            $user->present = $present;
                            $user->save();
                            $collaboratorsUser = CollaboratorsUser::where('code', $present)->first();
                            if($collaboratorsUser != null) {
                                $patientNew->balance += $collaboratorsUser->promotion;
                                $patientNew->save();
                            }
                        }
                    }

                };
                return view('register_success', compact("name", 'email', 'phone'));
            } else {
                $errors = new MessageBag(['errorReg' => 'Username này đã có người sử dụng, vui lòng nhập username khác']);
                return redirect()->back()->withInput()->withErrors($errors);
            }

        } else {
            $errors = new MessageBag(['errorReg' => 'Hộ Tên, Username và mật khẩu không được để trống.']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    public function postDangkyApp(Request $rq)
    {
        $username = $rq->username;
        $password = $rq->password;
        $fullname = $rq->fullname;
        $gender = $rq->gender;
        $present = $rq->presenter;
        $phone = $rq->phone;
        $type = 1;
        $image = "";

        if ($username != null && $fullname != null && $password != null) {

            $user = Users::where('email', $username)->first();
//            $checkPhone = Users::where('phone', $phone)->first();
//            if ($checkPhone != null) {
//                header('Content-Type: application/json; charset=utf-8');
//                return json_encode(array('isLogin' => false, 'msg' => 'Số điện thoại đã tồn tại!'), JSON_UNESCAPED_UNICODE);
//            }
//            else
            if ($user != null) {
                header('Content-Type: application/json; charset=utf-8');
                return json_encode(array('isLogin' => false, 'msg' => 'Tên Tài Khoản Đã Tồn Tại!'), JSON_UNESCAPED_UNICODE);
            } else {
                $user = new Users;
                $user->email = $username;
                $user->fullname = $fullname;
                $user->gender = $gender;
                $user->phone = $phone;
                $user->addpress = 'Việt Nam';
                $user->password = Hash::make($password);
                if ($rq->type == "user") {
                    $type = 1;
                } else if ($rq->type == "professional") {
                    $type = 2;
                } else if ($rq->type == "place") {
                    $type = 3;
                }
                $user->user_type_id = $type;
                $user->paid = 1;
                if ($user->save()) {
                    $user = Users::where('email', $username)->first();
                    $user_id = $user->user_id + ($user->user_type_id * 10000000);

                    DB::table('user')->where('user_id', $user->user_id)->update(array(
                        'user_id'=>$user_id
                    ));

                    $user = Users::where('email', $username)->first();
                    if ($user->user_type_id == 1) {
                        $user_type = "user";
                        $patientNew = $user->createPatient();
                        $patientNew->save();

                        if($present != null && $present != "") {
                            $user->present = $present;
                            $user->save();
                            $collaboratorsUser = CollaboratorsUser::where('code', $present)->first();
                            if($collaboratorsUser != null) {
                                $patientNew->balance += $collaboratorsUser->promotion;
                                $patientNew->save();
                            }
                        }

                    } else if ($user->user_type_id == 2) {
                        $user_type = "doctor";
                        $image = $user->avatar;

                        $doctor = new Doctor;
                        $doctor->doctor_name = 'BS ' . $user->fullname;
                        $doctor->doctor_url = $this->to_slug('BS ' . $user->fullname);
                        $doctor->user_id = $user->user_id;
                        $doctor->experience = '<ul><li>20 năm  bệnh viện Chợ rẫy</li></ul>';
                        $doctor->training = '<ul><li>Đại học y dược HCM</li></ul>';
                        $doctor->doctor_address = 'Hồ Chí Minh';
                        $doctor->profile_image = '246170446bacsi.jpg';
                        $doctor->doctor_timework = '7h đến 19h';
                        $doctor->doctor_clinic = 'bv Đại Học Y Dược';
                        if ($doctor->save()) {
                            $docsp = new DoctorSpeciality;
                            $docsp->doctor_id = $doctor->doctor_id;
                            $docsp->speciality_id = 1;
                            $docsp->save();


                            $docser = new DoctorService;
                            $docser->doctor_id = $doctor->doctor_id;
                            $docser->service_id = 1;
                            $docser->save();
                        }
                        if($present != null && $present != "") {
                            $user->present = $present;
                            $user->save();
                        }
                    } else if ($user->user_type_id == 3) {
                        $user_type = "clinic";
                        $image = $user->avatar;
                        // Thắng mod 20181107 start
                        $address = $user->address;

                        $clinic = new Clinic();
                        $clinic->user_id = $user->user_id;
                        $clinic->clinic_name = $user->fullname;
                        if ($image == null) {
                            $image = "";
                        }
                        $clinic->profile_image = $image;
                        if ($address == null) {
                            $address = "Việt Nam";
                        }
                        $clinic->clinic_address = $address;
                        $clinic->save();
                        // Thắng mod 20181107 end
                        if($present != null && $present != "") {
                            $user->present = $present;
                            $user->save();
                        }
                        if($present != null && $present != "") {
                            $user->present = $present;
                            $user->save();
                        }
                    }

                    if ($image == null) {
                        $image = '';
                    }
                    // header('Content-Type: application/json; charset=utf-8');
                    //     return json_encode(array('isLogin' => true,'msg'=>'Đăng Kí Thành Công','type'=>$user_type,'fullname'=>$user->fullname,'presenter'=>$user->present, 'phone'=>$user->phone,'username'=>$user->email,'password'=>$user->password),JSON_UNESCAPED_UNICODE);
                    header('Content-Type: application/json; charset=utf-8');
                    return json_encode(array('isLogin' => true, 'msg' => 'Đăng Kí Thành Công', 'user_type' => $user_type, 'image' => $image, 'paid' => $user->paid, 'fullname' => $user->fullname), JSON_UNESCAPED_UNICODE);
                }
            }
        } else {
            header('Content-Type: application/json; charset=utf-8');
            return json_encode(array('isLogin' => false, 'msg' => 'Chưa Nhập Đầy Đủ Thông Tin!'), JSON_UNESCAPED_UNICODE);
        }
    }

    public function dangnhap(Request $rq)
    {
        if ($rq->input('next') != null) {
            $rq->session()->put('next', $rq->input('next'));
        }
        if ($rq->session()->has('user')) {
            if ($rq->input('next') != null)
                return redirect($rq->input('next'));
            return redirect('/tai-khoan');
        } else {
            return view('dangnhap');
        }
    }

    public function testMobile(Request $rq)
    {
        $dt = new \DateTime();
        $Y = (int)date_format($dt, 'Y');
        $m = (int)date_format($dt, 'm');
        $d = (int)date_format($dt, 'd');
        $date_ser = date_format($dt, 'Y-m-d');
        $email = $rq->get('email');
        $pass = $rq->get('pwd');
        $pass = "$pass";

        if (!empty($email) && !empty($pass)) {
            $user = Users::where('email', $email)->first();
            if ($user != null) {
                $check_time_use_of_user = Users::select('use_date')->where('user_id', $user->user_id)->first()->use_date;

                //if($date_ser <= $check_time_use_of_user){
                if (Hash::check($pass, $user->password)) {
                    $user_type = '';
                    $fullname = '';
                    $image = '';
                    if ($user->user_type_id == 1) {
                        $user_type = 'user';
                        //$fullname .= $email ."-";
                        $fullname .= $user->fullname . "-";
                        $fullname .= $user->sex == 1 ? 'Nam' : 'Nữ';
                        $image = $user->avatar;
                        $fullname .= "," . $user->addpress;
                    } else if ($user->user_type_id == 2) {

                        $user_type = 'doctor';
                        //$urls = "http://bacsiviet/public/images/doctor/";
                        $urls = $_SERVER['HTTP_HOST'] . "/public/images/doctor/";
                        $doctorid = $user->doctor->doctor_id;
                        $image = $urls . $user->doctor->profile_image;
                        $spec = \App\DoctorSpeciality::where('doctor_id', $doctorid)->pluck('speciality_id')->all();
                        $speciality = Speciality::select('speciality_name')->whereIn('speciality_id', $spec)->get();
                        $fullname .= $user->doctor->doctor_name . "-";
                        $speciality_str = '';
                        foreach ($speciality as $key => $value) {

                            $speciality_str .= $value['speciality_name'] . ",";
                        }
                        $fullname .= $speciality_str;

                        $fullname = rtrim($fullname, ",");

                    } else if ($user->user_type_id == 3) {
                        $user_type = 'clinic';
                        $clinicid = $user->clinic->clinic_id;
                        $cli = \App\ClinicSpeciality::where('clinic_id', $clinicid)->pluck('speciality_id')->all();
                        $speciality = Speciality::select('speciality_name')->whereIn('speciality_id', $cli)->get();

                        $fullname .= $user->clinic->clinic_name . "-";
                        $speciality_str = '';
                        foreach ($speciality as $key => $value) {

                            $speciality_str .= $value['speciality_name'] . ",";

                        }
                        $fullname .= $speciality_str;
                        $fullname = rtrim($fullname, ",");
                    } else {
                        $user_type = 'undefined';
                    }
                    header('Content-Type: application/json; charset=utf-8');
                    return json_encode(array('isLogin' => true, 'msg' => 'Login Success', 'user_type' => $user_type, 'image' => $image, 'paid' => $user->paid, 'fullname' => $fullname), JSON_UNESCAPED_UNICODE);
                } else {
                    return json_encode(array('isLogin' => false, 'msg' => 'Incorrect password'));
                }
                //}

                //return json_encode(array('isLogin' => false,'msg'=>'Account has expired'));
            } else {
                return json_encode(array('isLogin' => false, 'msg' => 'Account does not exist'));
            }
        }
    }

    public function checkAccountExist(Request $rq)
    {
        $id = $rq->get('idfacebook');
        $username = $rq->get('username');
        $isExist = false;

        if($id != null) {
            $userFace = Users::where('id_facebook', $id)->first();
            if($userFace != null) {
                $isExist = true;
            }
        }

        if($username != null) {
            $user = Users::where('email', $username)->first();
            if($user != null) {
                $isExist = true;
            }
        }

        header('Content-Type: application/json; charset=utf-8');
        return json_encode(array('exist' => $isExist, 'msg' => 'Status account'));
    }

    public function loginface(Request $rq)
    {
        $username = $rq->get('username');
        $id = $rq->get('qwd');
        $present = $rq->get('presenter');
        $fullname = null;
        if ($rq->has('fullname')) {
            $fullname = $rq->get('fullname');
        }

        $user_type = "";
        $u = Users::where('id_facebook', $id)->first();

        if ($u) {
            $rq->session()->put('user', $u);
            if ($u->user_type_id == 1) {
                $user_type = "user";
                if ($u->patient == null) {
                    $patientNew = $u->createPatient();
                    $patientNew->save();
                }
                $balance = $u->patient->balance;
                if (($u->fullname == "") && ($fullname != null)) {
                    $u->fullname = $fullname;
                    $u->save();
                }
                return json_encode(array('isLogin' => true, 'user' => $u, 'balance' => $balance, 'msg' => 'Login Success', 'user_type' => $user_type, 'image' => $u->avatar, 'paid' => $u->paid, 'id' => $id));
            } else if ($u->user_type_id == 2) {
                $user_type = "doctor";
            } else if ($u->user_type_id == 3) {
                $user_type = "clinic";
            }
            header('Content-Type: application/json; charset=utf-8');
            return json_encode(array('isLogin' => true, 'msg' => 'Login Success', 'user_type' => $user_type, 'image' => $u->avatar, 'paid' => $u->paid), JSON_UNESCAPED_UNICODE);

        } else {

            $u = new Users;
            if ($fullname != null) {
                $u->fullname = $fullname;
            }
            $u->email = $username;
            $u->id_facebook = $id;
            $u->user_type_id = 1;
            $u->avatar = "";
            $u->paid = 1;

            if ($u->save()) {
                $u = Users::where('email', $username)->first();
                $user_id = $u->user_id + ($u->user_type_id * 10000000);

                DB::table('user')->where('user_id', $u->user_id)->update(array(
                    'user_id'=>$user_id
                ));
                $u = Users::where('email', $username)->first();

                if ($u->user_type_id == 1) {
                    $user_type = "user";
                    if ($u->patient == null) {
                        $patientNew = $u->createPatient();
                        $patientNew->save();
                    }
                    if($present != null && $present != "") {
                        $collaboratorsUser = CollaboratorsUser::where('code', $present)->first();
                        if($collaboratorsUser != null) {
                            $patientNew->balance += $collaboratorsUser->promotion;
                            $patientNew->save();
                        }
                        $u->present = $present;
                        $u->save();
                    }
                    $u = Users::where('id_facebook', $id)->first();
                    $balance = $u->patient->balance;
                    return json_encode(array('isLogin' => true, 'user' => $u, 'balance' => $balance, 'msg' => 'Login Success', 'user_type' => $user_type, 'image' => $u->avatar, 'paid' => $u->paid, 'id' => $id));
                } else if ($u->user_type_id == 2) {
                    $user_type = "doctor";
                    if($present != null && $present != "") {
                        $collaboratorsUser = CollaboratorsUser::where('code', $present)->first();
                        $u->present = $present;
                        $u->save();
                    }
                } else if ($u->user_type_id == 3) {
                    $user_type = "clinic";
                    if($present != null && $present != "") {
                        $collaboratorsUser = CollaboratorsUser::where('code', $present)->first();
                        $u->present = $present;
                        $u->save();
                    }
                }
                header('Content-Type: application/json; charset=utf-8');
                return json_encode(array('isLogin' => true, 'msg' => 'Login Success', 'user_type' => $user_type, 'image' => $u->avatar, 'paid' => $u->paid), JSON_UNESCAPED_UNICODE);
            }
        }

    }

    public function LoginFacebookMobile(Request $rq)
    {
        $dt = new \DateTime();
        $Y = (int)date_format($dt, 'Y');
        $m = (int)date_format($dt, 'm');
        $d = (int)date_format($dt, 'd');
        $date_ser = date_format($dt, 'Y-m-d');
        $email = $rq->get('username');
        $pass = $rq->get('pwd');
        $pass = "$pass";

        if (!empty($email) && !empty($pass)) {
            $user = Users::where('email', $email)->first();
            if ($user != null) {
                $check_time_use_of_user = Users::select('use_date')->where('user_id', $user->user_id)->first()->use_date;

                if ($date_ser <= $check_time_use_of_user) {
                    if (Hash::check($pass, $user->password)) {
                        $user_type = '';
                        $fullname = '';
                        $image = '';
                        if ($user->user_type_id == 1) {
                            $user_type = 'user';
                            $fullname .= $email . "-";
                            //$fullname .= $user->fullname ."-";
                            $fullname .= $user->sex == 1 ? 'Nam' : 'Nữ';
                            $image = $user->avatar;
                            $fullname .= "," . $user->addpress;
                        } else if ($user->user_type_id == 2) {

                            $user_type = 'doctor';
                            //$urls = "http://bacsiviet/public/images/doctor/";
                            //$urls = $_SERVER['HTTP_HOST']."/public/images/doctor/";
                            $urls = $_SERVER['HTTP_HOST'] . "/";
                            $doctorid = $user->doctor->doctor_id;
                            //$image = $urls.$user->doctor->profile_image;
                            $image = $urls . $user->doctor->profile_image;
                            $spec = \App\DoctorSpeciality::where('doctor_id', $doctorid)->pluck('speciality_id')->all();
                            $speciality = Speciality::select('speciality_name')->whereIn('speciality_id', $spec)->get();
                            $fullname .= $user->doctor->doctor_name . "-";
                            $speciality_str = '';
                            foreach ($speciality as $key => $value) {

                                $speciality_str .= $value['speciality_name'] . ",";
                            }
                            $fullname .= $speciality_str;

                            $fullname = rtrim($fullname, ",");

                        } else if ($user->user_type_id == 3) {
                            $user_type = 'clinic';
                            $clinicid = $user->clinic->clinic_id;
                            $cli = \App\ClinicSpeciality::where('clinic_id', $clinicid)->pluck('speciality_id')->all();
                            $speciality = Speciality::select('speciality_name')->whereIn('speciality_id', $cli)->get();

                            $fullname .= $user->clinic->clinic_name . "-";
                            $speciality_str = '';
                            foreach ($speciality as $key => $value) {

                                $speciality_str .= $value['speciality_name'] . ",";

                            }
                            $fullname .= $speciality_str;
                            $fullname = rtrim($fullname, ",");
                        } else {
                            $user_type = 'undefined';
                        }
                        header('Content-Type: application/json; charset=utf-8');
                        return json_encode(array('isLogin' => true, 'msg' => 'Login Success', 'user_type' => $user_type, 'image' => $image, 'paid' => $user->paid, 'fullname' => $fullname), JSON_UNESCAPED_UNICODE);
                    } else {
                        return json_encode(array('isLogin' => false, 'msg' => 'Incorrect password'));
                    }
                }

                return json_encode(array('isLogin' => false, 'msg' => 'Account has expired'));
            } else {
                return json_encode(array('isLogin' => false, 'msg' => 'Account does not exist'));
            }
        }
    }

    public function postDangNhapMobile(Request $rq)
    {
        // Thang mod 20181112 start
        $email = $rq->get('email');
        $pass = $rq->get('pwd');
        $present = $rq->get("presenter");
        $pass = "$pass";

        if (!empty($email) && !empty($pass)) {
            $user = Users::where('email', $email)->first();
            if ($user != null) {
                if (Hash::check($pass, $user->password)) {
                    $id = 0;

                    if ($user->patient == null) {
                        $patientNew = $user->createPatient();
                        $patientNew->save();

                        if($present != null && $present != "") {
                            $collaboratorsUser = CollaboratorsUser::where('code', $present)->get();
                            if($collaboratorsUser != null) {
                                $patientNew->balance += $collaboratorsUser->promotion;
                                $patientNew->save();
                            }
                        }
                    }
                    $balance = $user->patient->balance;

                    if ($user->user_type_id == 1) {
                        $user_type = 'user';
                        $fullname = $user->fullname;
                        $image = $user->avatar;

						$unit = \App\Config::where('id', 2)->first();
						$unit = (!empty($unit)) ? intval($unit->content) : 1000;
                        return json_encode(array('isLogin' => true, 'unit' =>$unit, 'user' => $user, 'balance' => $balance, 'msg' => 'Login Success', 'user_type' => $user_type, 'image' => $image, 'paid' => $user->paid, 'fullname' => $fullname, 'id' => $id), JSON_UNESCAPED_UNICODE);
                    } else if ($user->user_type_id == 2) {
                        $user_type = 'doctor';
                        //$image = $user->avatar;

                        if (strlen(strstr($user->doctor->profile_image, "https://dwbxi9io9o7ce.cloudfront.net")) > 0) {
                            $image = "medixlink.com/public/images/doctor/246170446bacsi.jpg";
                        } else {
                            $image = "medixlink.com/public/images/doctor/" . $user->doctor->profile_image;
                        }
                        //$image = "https://medixlink.com/public/images/doctor/".$user->doctor->profile_image;
                        // $doctorid = $user->doctor->doctor_id;
                        // $spec = \App\DoctorSpeciality::where('doctor_id',$doctorid)->pluck('speciality_id')->all();
                        // $speciality = Speciality::select('speciality_name')->whereIn('speciality_id',$spec)->get();
                        // $fullname .= $user->doctor->doctor_name ."-";
                        // $speciality_str = '';
                        // foreach ($speciality as $key => $value) {

                        //     $speciality_str .= $value['speciality_name'] . ",";

                        // }
                        // $fullname .= $speciality_str;

                        // $fullname = rtrim($fullname, ",");
                        $doctorid = $user->doctor->doctor_id;
                        if ($doctorid) {
                            $doctor = \App\Doctor::where('doctor_id', $doctorid)->first();
                            $spec = \App\DoctorSpeciality::where('doctor_id', $doctorid)->pluck('speciality_id')->first();
                            $spec_url = \App\Speciality::where('speciality_id', $spec)->first();
                            $fullname = $doctor->doctor_name . "-" . $spec_url->speciality_name;
                            $link = "https://medixlink.com/danh-sach/bac-si/".$doctor->doctor_id;
                            $id = $doctorid;
                            return json_encode(array('isLogin' => true, 'link' => $link, 'user' => $user, 'balance' => $balance, 'msg' => 'Login Success', 'user_type' => $user_type, 'image' => $image, 'paid' => $user->paid, 'fullname' => $fullname, 'id' => $id), JSON_UNESCAPED_UNICODE);
                        } else {
                            return json_encode(array('isLogin' => false, 'msg' => 'Tài khoản bác sĩ không tìm thấy'));
                        }
                    } else if ($user->user_type_id == 3) {
                        $user_type = 'clinic';

                        if (strlen(strstr($user->clinic->profile_image, "https://dwbxi9io9o7ce.cloudfront.net")) > 0) {
                            $image = "medixlink.com/public/images/doctor/246170446bacsi.jpg";
                        } else {
                            $image = "medixlink.com/public/images/health_facilities/" . $user->clinic->profile_image;
                        }
                        $clinic_id = $user->clinic->clinic_id;
                        if ($clinic_id) {
                            $clinic = \App\Clinic::where('clinic_id', $clinic_id)->first();
                            $spec = \App\ClinicSpeciality::where('clinic_id', $clinic_id)->pluck('speciality_id')->first();
                            $spec_url = \App\Speciality::where('speciality_id', $spec)->first();
                            if ($spec_url) {
                                $fullname = $clinic->clinic_name . "-" . $spec_url->speciality_name;
                            } else {
                                $fullname = $clinic->clinic_name . "-" . "Không có";
                            }
                            $link = "https://medixlink.com/co-so-y-te/".$clinic->clinic_id;
                            $id = $clinic_id;
                            return json_encode(array('isLogin' => true, 'link' => $link, 'user' => $user, 'balance' => $balance, 'msg' => 'Login Success', 'user_type' => $user_type, 'image' => $image, 'paid' => $user->paid, 'fullname' => $fullname, 'id' => $id), JSON_UNESCAPED_UNICODE);
                        } else {
                            return json_encode(array('isLogin' => false, 'msg' => 'Phòng khám không tìm thấy'));
                        }

                    } else  if ($user->user_type_id == 4) {
                        $user_type = 'drugstore';
                        $fullname = $user->fullname;
                        $image = $user->avatar;
                        if ($user->patient == null) {
                            $patientNew = $user->createPatient();
                            $patientNew->save();

                            if($present != null && $present != "") {
                                $collaboratorsUser = CollaboratorsUser::where('code', $present)->get();
                                if($collaboratorsUser != null) {
                                    $patientNew->balance += $collaboratorsUser->promotion;
                                    $patientNew->save();
                                }
                            }
                        }
                        $balance = $user->patient->balance;
                        $unit = \App\Config::where('id', 2)->first();
                        $unit = (!empty($unit)) ? intval($unit->content) : 1000;
                        return json_encode(array('isLogin' => true, 'unit' =>$unit, 'user' => $user, 'balance' => $balance, 'msg' => 'Login Success', 'user_type' => $user_type, 'image' => $image, 'paid' => $user->paid, 'fullname' => $fullname, 'id' => $id), JSON_UNESCAPED_UNICODE);
                    }
                    else {
                        return json_encode(array('isLogin' => false, 'msg' => 'Loại user không tồn tại'));
                    }
                } else {
                    return json_encode(array('isLogin' => false, 'msg' => 'Incorrect password'));
                }

            } else {
                return json_encode(array('isLogin' => false, 'msg' => 'Account does not exist'));
            }
        }
        // Thang mod 20181110 end
    }

    public function timesCall(Request $rq)
    {

        $user_email = $rq->get('user_email');
        $doctor_email = $rq->get('doctor_email');
        $times = $rq->get('times');

        if (empty($user_email)) return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'user_email is not required'));
        if (empty($doctor_email)) return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'doctor_email is not required'));
        if (empty($times)) return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'Times is not required'));

        $qty = 0;

        $calltime = new Calltime();
        $calltime->user_email = $user_email;
        $calltime->doctor_email = $doctor_email;

        try {
            $qty = doubleval($times);
            if ($qty <= 0) {
                return json_encode(array('isSucess' => false, 'balance' => 0, 'msg' => 'Sai định dạng dữ liệu!'), JSON_UNESCAPED_UNICODE);
            }
        } catch (Exception $exception) {
            return json_encode(array('isSucess' => false, 'balance' => 0, 'msg' => 'Sai định dạng dữ liệu!'), JSON_UNESCAPED_UNICODE);
        }
        $calltime->times = $qty;
        $unit = \App\Config::where('id', 2)->first();
        $unit = (!empty($unit)) ? intval($unit->content) : 1000;

        $calltime->unit = $unit;
        if ($calltime->save()) {
            // Thắng add 20181107 start
            $patient = \App\Patient::where('email', $user_email)->first();
            if ($patient == null) {
                return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'Không tìm thấy thông tin tài khoản!'), JSON_UNESCAPED_UNICODE);
            }

            $patient->minusTime($qty);
            $patient->save();
            if($patient->balance < $unit) {
                $patient->can_chat = 0;
                $patient->can_call_audio = 0;
                $patient->can_call_video = 0;
                $patient->save();
                $user = \App\Users::where('email', $user_email)->first();
                $user->paid = 0;
                $user->save();
            }
            // Thắng add 20181107 end

            return json_encode(array('isSave' => true, 'balance' => $patient->balance, 'msg' => 'Lưu thành công'));
        } else {
            return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'Lưu thất bại'));
        }

    }

    public function timesCallV2(Request $rq)
    {
        $user_email = $rq->get('user_email');
        $user_type_id = $rq->get('user_type_id');
        $doctor_email = $rq->get('doctor_email');
        $times = $rq->get('times');

        if (empty($user_email)) return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'user_email is not required'));
        if (empty($doctor_email)) return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'doctor_email is not required'));
        if (empty($times)) return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'Times is not required'));
        if (empty($user_type_id)) return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'user_type_id is not required'));

        $qty = 0;

        $calltime = new Calltime();
        $calltime->user_email = $user_email;
        $calltime->doctor_email = $doctor_email;
        $calltime->type = 0;

        try {
            $qty = doubleval($times);
            if ($qty <= 0) {
                return json_encode(array('isSucess' => false, 'balance' => 0, 'msg' => 'Sai định dạng dữ liệu!'), JSON_UNESCAPED_UNICODE);
            }
        } catch (Exception $exception) {
            return json_encode(array('isSucess' => false, 'balance' => 0, 'msg' => 'Sai định dạng dữ liệu!'), JSON_UNESCAPED_UNICODE);
        }
        $calltime->times = $qty;
        $unit = \App\Config::where('id', 2)->first();
        $unit = (!empty($unit)) ? intval($unit->content) : 1000;

        // Kiểm tra d
        if($user_type_id != null)
        {
            $userRecv = Users::where('email', $doctor_email)->first();
            if($user_type_id == 2)
            {
                $doctorItem = Doctor::where('user_id', $userRecv->user_id)->first();

                if ($doctorItem->price != null)
                {
                    $unit = $doctorItem->price;
                }
            }
            else if ($user_type_id == 3)
            {
                $clinicItem = Clinic::where('user_id', $userRecv->user_id)->first();
                if ($clinicItem->price != null)
                {
                    $unit = $clinicItem->price;
                }
            }
        }

        $calltime->unit = $unit;
        if ($calltime->save()) {
            // Thắng add 20181107 start
            $patient = \App\Patient::where('email', $user_email)->first();
            if ($patient == null) {
                return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'Không tìm thấy thông tin tài khoản!'), JSON_UNESCAPED_UNICODE);
            }

            $patient->minusTimeV2($unit, $qty);
            $patient->save();
            if($patient->balance < $unit) {
                $patient->can_chat = 0;
                $patient->can_call_audio = 0;
                $patient->can_call_video = 0;
                $patient->save();
                $user = \App\Users::where('email', $user_email)->first();
                $user->paid = 0;
                $user->save();
            }
            // Thắng add 20181107 end

            return json_encode(array('unit'=>$unit, 'isSave' => true, 'balance' => $patient->balance, 'msg' => 'Lưu thành công'));
        } else {
            return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'Lưu thất bại'));
        }

    }

    public function postDangnhap(Request $rq)
    {
        $email = $rq->input('email');
        $pass = $rq->input('password');

        $next = $rq->input('next');
        if (!$rq->session()->has('user')) {
            $user = Users::where('email', $email)->first();
            if ($user != null) {
                if (Hash::check($pass, $user->password)) {
                    $rq->session()->put('user', $user);
                    return redirect('/');
                } else {
                    $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
                    return redirect()->back()->withInput()->withErrors($errors);
                }
            } else {
                $errors = new MessageBag(['errorlogin' => 'Email hoặc mật khẩu không đúng']);
                return redirect()->back()->withInput()->withErrors($errors);
            }
        }
    }

    public function taikhoan(Request $rq)
    {
        if ($rq->session()->has('user')) {
            return view('taikhoan_home');
        } else {
            return redirect('/dang-nhap?next=/tai-khoan');
        }
    }

    public function taikhoan_method(Request $rq, $method)
    {
        if ($rq->session()->has('user')) {
            switch ($method) {
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
                    if ($rq->session()->get('user')->user_type_id == 2) {
                        $doctorid = $rq->session()->get('user')->doctor->doctor_id;
                        $spec = \App\DoctorSpeciality::where('doctor_id', $doctorid)->pluck('speciality_id')->all();
                        // var_dump($spec);
                        $questions = \App\Question::whereNotIn('question_id', $all)->whereIn('speciality_id', $spec)->select('*')->get();
                        //var_dump($questions);
                        view()->share('questions', $questions);
                        return view('taikhoan_cauhoimoinhat');
                    }

                    break;
                case "them-bac-si":
                    $speciality = \App\Speciality::all();
                    $services = \App\Service::all();
                    return view('taikhoan_thembacsi', ['specialities' => $speciality, 'services' => $services]);
                    break;
                case "them-csyt":
                    $speciality = \App\Speciality::all();
                    $services = \App\Service::all();
                    return view('taikhoan_themcsyt', ['specialities' => $speciality, 'services' => $services]);
                    break;
                case "them-nha-thuoc":
                    return view('taikhoan_themnhathuoc');
                    break;
                case "viet-bai":
                    $catalogs = Catalog::all();
                    return view('taikhoan_vietbai', ['catalogs' => $catalogs]);
                    break;
            }
        } else {
            return redirect('/dang-nhap?next=/tai-khoan');
        }
    }

    public static function taikhoan_ghinho(Request $rq)
    {
        return view('taikhoan_ghinho');
    }

    public static function taikhoan_nhanxet(Request $rq)
    {
        return 'somming soon';
    }

    public static function taikhoan_hoidap(Request $rq)
    {
        $all = \App\Answer::pluck('question_id')->all();
        $user_id = $rq->session()->get('user')->user_id;

        $count_answers = 0;
        //var_dump($user_id);
        //  $questions = Question::where('user_id',$user_id)->get();
        if ($rq->session()->get('user')->user_type_id == 2 && $rq->session()->get('user')->doctor != null) {

            $spec = \App\DoctorSpeciality::where('doctor_id', $rq->session()->get('user')->doctor->doctor_id)->pluck('speciality_id')->all();
            //var_dump($spec);return;
            $questions = \App\Question::whereNotIn('question_id', $all)->whereIn('speciality_id', $spec)->select('*')->orderBy('created_at', 'DESC')->paginate(20);
            $answers = \App\Question::whereIn('question_id', $all)->whereIn('speciality_id', $spec)->select('*')->orderBy('created_at', 'DESC')->paginate(20);
        } elseif ($rq->session()->get('user')->user_type_id == 3 && $rq->session()->get('user')->clinic != null) {
            $spec = \App\ClinicSpeciality::where('clinic_id', $rq->session()->get('user')->clinic->clinic_id)->pluck('speciality_id')->all();
            //  var_dump($spec);
            $questions = \App\Question::whereNotIn('question_id', $all)->whereIn('speciality_id', $spec)->select('*')->orderBy('created_at', 'DESC')->paginate(20);
            $answers = \App\Question::whereIn('question_id', $all)->whereIn('speciality_id', $spec)->select('*')->orderBy('created_at', 'DESC')->paginate(20);

        } else {

            $questions = \App\Question::where('user_id', $user_id)->orderBy('created_at', 'DESC')->paginate(20);

            $answers = \App\Question::where('user_id', $user_id)->whereIn('question_id', $all)->orderBy('created_at', 'DESC')->paginate(20);
            //echo count($answers);return;
        }

        //$answers = \App\Question::whereIn('question_id',$all)->whereIn('speciality_id',$spec)->select('*')->get();
        // var_dump($spec);return;
        foreach ($questions as $question) {
            $dem = Answer::where('question_id', $question['question_id'])->count();
            $count_answers = $dem + 1;

        }
        $count_answers = $count_answers + $count_answers;
        $count_questions = Question::where('user_id', $user_id)->count();
        return view('taikhoan_hoidap', ['questions' => $questions, 'count_answers' => $count_answers, 'count_questions' => $count_questions, 'answers' => $answers]);

    }

    public static function taikhoan_doimatkhau(Request $rq)
    {
        return view('taikhoan_doimatkhau');
    }

    public function doimatkhau(Request $rq)
    {
        $pass = $rq->input('password');
        $newpass = $rq->input('new_password');
        $newpass_confirm = $rq->input('new_password_confirm');
        $email = $rq->session()->get('user')->email;
        $user = Users::where('email', $email)->first();
        if ($user != null) {
            if (Hash::check($pass, $user->password)) {
                if ($newpass == $newpass_confirm) {
                    $user->password = Hash::make($newpass);
                    $user->save();
                } else {
                    return response()->json(array('detail' => 'New password invalid'), 400);
                }
            } else {
                return response()->json(array('detail' => 'Password invalid'), 400);
            }
        }
    }

    public function dangxuat(Request $rq)
    {
        Session::flush();
        $rq->session()->forget('user');
        return redirect('/home');

    }

    public function khuyenmai(Request $rq)
    {
        //echo 'khuyen mai';
        $deal_category = \App\DealCategory::all();
        $category = $rq->input('categories');
        $cate = \App\DealCategory::where('category_url', $category)->first();
        if ($cate != null) {
            $deals = \App\Deals::where('deal_category', $cate->id)->paginate(30);
        } else {
            $deals = \App\Deals::orderBy('ranked', 'DESC')->paginate(30);
        }
        return view('khuyenmai', ['deal_category' => $deal_category, 'deals' => $deals])->withPost($deals);
    }

    public function benh(Request $rq)
    {
        $benh_view = Disease::groupBy('view')->orderBy('view', 'DESC')->get();
        return view('benh', ['benh_view' => $benh_view]);
    }

    public function chitietbenh($qid)
    {
        $ads = Ads::where('place', '3')->get();
        $url = explode('-', $qid);
        $id = $url[count($url) - 1];
        //$bacsi =

        $benh = Disease::find($id);
        $cauhoi = Question::where('speciality_id', $benh['speciality_id'])->get();
        $id_bacsi = DoctorSpeciality::where('speciality_id', $benh['speciality_id'])->pluck('doctor_id')->all();
        //var_dump($id_bacsi);return;
        $idClinic = ClinicSpeciality::where('speciality_id', $benh['speciality_id'])->pluck('clinic_id')->all();
        $doctor = Doctor::whereIn('doctor_id', $id_bacsi)->take(10)->get();
        $clinics = Clinic::whereIn('clinic_id', $idClinic)->take(10)->get();
        return view('benh-detail', ['benh' => $benh, 'cauhoi' => $cauhoi, 'doctors' => $doctor, 'clinics' => $clinics, 'ads' => $ads]);
    }


    public function thuoc(Request $rq)
    {
        $medicines = Medicine::orderBy('medicine_id', 'DESC')->paginate(60);
        if ($rq->input('q')) {
            $q = urldecode($rq->input('q'));
            $benh = Disease::where('disease_name', 'like', '%' . $q . '%');
            $benh_count = $benh->count();
            $benh = $benh->paginate(30);
            $thuoc = Medicine::where('description', 'like', '%' . $q . '%')->count();
            $medicines = Medicine::where('description', 'like', '%' . $q . '%')->paginate(60);
            $bs = Doctor::where('doctor_name', 'like', '%' . $q . '%')->count();
            $csyt = Clinic::where('clinic_name', 'like', '%' . $q . '%')->count();
            $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
            $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();
            return view('thuoc', ['medicines' => $medicines, 'count' => $benh_count, 'benh' => $benh, 'thuoc' => $thuoc, 'doctor' => $bs, 'clinic' => $csyt, 'question' => $qs, 'service' => $service])->withPost($medicines);
        }

        return view('thuoc', ['medicines' => $medicines])->withPost($medicines);
    }

    public function chitietthuoc($qid)
    {
        $ads = Ads::where('place', '4')->get();

        $url = explode('-', $qid);
        $id = $url[count($url) - 1];
        //echo $id;return;
        $thuoc = Medicine::find($id);
        //var_dump($thuoc);return;
        //var_dump($thuoc->type_medicine);
        if ($thuoc->speciality_id != null) {
            $lienquan = Medicine::where('speciality_id', $thuoc->speciality_id)->get();
            view()->share('lienquan', $lienquan);
        }
        //$lienquan = Medicine::all()->get(5);
        //var_dump($lienquan);return;
        return view('thuoc-detail', ['thuoc' => $thuoc, 'ads' => $ads]);
    }

    function to_slug($str)
    {
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

    public function comment($qid, Request $rq)
    {
        $url = explode('-', $qid);
        $id = $url[count($url) - 1];
        $baiviet = Article::find($id);
        $comment = new comment;
        $comment->article_id = $id;
        $comment->user_id = $rq->session()->get('user')->user_id;
        $comment->content = $rq->input('body');
        $comment->save();
        //$tieude = to_slug($baiviet['article_title']);
//return redirect('bai-viet/'.$tieude.'-'.$id)->with('thongbao','Viết Bình Luận Thành Công');
        return redirect()->back()->with('thongbao', 'Viết Bình Luận Thành Công');
    }

    public function commentdoctor($qid, Request $rq)
    {
        $comment = new comment;
        $comment->doctor_id = $qid;
        $comment->user_id = $rq->session()->get('user')->user_id;
        $comment->content = $rq->input('comment');
        $comment->save();
        return redirect()->back()->with('thongbao', 'Viết Bình Luận Thành Công');
    }

    public function commentclinic($qid, Request $rq)
    {

        $comment = new comment;
        $comment->clinic_id = $qid;
        $comment->user_id = $rq->session()->get('user')->user_id;
        $comment->feedback_ = $rq->input('rating');
        $comment->content = $rq->input('body');
        // $comment->name= $rq->input('name');
        //$comment->email= $rq->input('email');
        $comment->save();
        //$tieude = to_slug($baiviet['article_title']);
        return redirect()->back()->with('thongbao', 'Bạn Bình Luận Thành Công');

    }

    public function commentcsyt($qid, Request $rq)
    {
        var_dump($qid);
        return;
        if ($rq->input('next') != "") {
            $rq->session()->put('next', $rq->input('next'));
        }
        if (!$rq->session()->has('user')) {
            return redirect('/dang-nhap?next=' . $rq->session->get('next'));
        } else {
            $url = explode('-', $qid);
            $id = $url[count($url) - 1];
            $cs = Clinic::find($id);
            $comment = new comment;
            $comment->clinic_id = $id;
            $comment->user_id = $rq->session()->get('user')->user_id;
            $comment->feedback_ = $rq->input('rating');
            $comment->content = $rq->input('body');
            // $comment->name= $rq->input('name');
            //$comment->email= $rq->input('email');
            $comment->save();
            //$tieude = to_slug($baiviet['article_title']);
            return redirect('/co-so-y-te/' . '-' . $id . '/kham-benh#nhan-xet')->with('thongbao', 'Bạn Bình Luận Thành Công');
        }
    }

    public function detail($id)
    {


        $comment = comment::where('article_id', $id)->orderBy('created_at', 'DESC')->get();


        $Catalog = Catalog::all();
        $baiviet_new = Article::orderBy('article_id', 'DESC')->limit(1)->first();
        $baiviets = Article::orderBy('article_id', 'DESC')->limit(5)->get();
        $baiviet = Article::find($id);
        $lienquan = Article::where('catalog_id', $baiviet['catalog_id'])->orderBy('article_id', 'DESC')->limit(5)->get();
        $noibat = Article::orderBy('created_at', 'DESC')->limit(5)->get();// ,'noibat' =>$noibat

        return view('detail', ['baiviet' => $baiviet, 'lienquan' => $lienquan, 'noibat' => $noibat, 'comment' => $comment]);
    }


    public function chitietbaiviet($qid)
    {
        $ads = Ads::where('place', '2')->get();

        $url = explode('-', $qid);
        $id = $url[count($url) - 1];
        $Catalogs = Catalog::all();
        $comment = comment::where('article_id', $id)->orderBy('created_at', 'DESC')->get();
        $Catalog = Catalog::all();
        $baiviet_new = Article::orderBy('article_id', 'DESC')->limit(1)->first();
        $baiviets = Article::orderBy('article_id', 'DESC')->limit(5)->get();
        $baiviet = Article::find($id);
        $lienquan = Article::where('catalog_id', $baiviet['catalog_id'])->orderBy('article_id', 'DESC')->limit(5)->get();
        $noibat = Article::orderBy('created_at', 'DESC')->limit(5)->get();// ,'noibat' =>$noibat
        return view('detail', ['Catalogs' => $Catalogs, 'baiviet' => $baiviet, 'lienquan' => $lienquan, 'noibat' => $noibat, 'comment' => $comment, 'ads' => $ads]);

    }

    public function chuyenmuc($qid)
    {
        $url = explode('-', $qid);
        $id = $url[count($url) - 1];
        $Catalogs = Catalog::all();
        $Catalog = Catalog::where('id', $id)->first();
        if ($Catalog->parent_id == 0) {
            $baiviet_new = Article::where('catalog_id', $id)->orderBy('article_id', 'ASC')->limit(1)->first();
            $baiviet = Article::where('catalog_id', $id)->orderBy('article_id', 'ASC')->paginate(10);
            return view('danhmuc', ['Catalogs' => $Catalogs, 'baiviet' => $baiviet, 'baiviet_new' => $baiviet_new]);
        } else

            $baiviet_new = Article::where('catalog_id', $id)->orderBy('article_id', 'DESC')->limit(1)->first();
        $baiviet = Article::where('catalog_id', $id)->orderBy('article_id', 'ASC')->paginate(10);
        return view('danhmuc', ['Catalogs' => $Catalogs, 'baiviet' => $baiviet, 'baiviet_new' => $baiviet_new])->withPost($baiviet);

    }

    public function get()
    {
        $Catalog = Catalog::all();
        $baiviet_new = Article::orderBy('article_id', 'DESC')->limit(1)->first();
        $baiviets = Article::orderBy('article_id', 'DESC')->limit(50)->get();
        return view('baiviet-list', ['baiviets' => $baiviets, 'Catalog' => $Catalog, 'baiviet_new' => $baiviet_new])->withPost($baiviets);

    }

    public function danhmuc($id)
    {
        $Catalog = Catalog::find($id);

        $baiviet_new = Article::where('catalog_id', $id)->orderBy('article_id', 'ASC')->first();
        if (!$baiviet_new) {
            $baiviet_new = null;
        }
        $baiviet = Article::where('catalog_id', $id)->orderBy('article_id', 'ASC')->limit(8)->get();


        return view('danhmuc', ['baiviet' => $baiviet, 'Catalog' => $Catalog, 'baiviet_new' => $baiviet_new])->withPost($baiviet);;
    }

    public function vietbai(Request $rq)
    {
        $title = $rq->input('tieude');
        //echo $title;
        $tomtat = $rq->input('tomtat');
        $noidung = $rq->input('noidung');
        $chuyenmuc = $rq->input('chuyenmuc');
        $author = $rq->input('nguoiviet');
        $source = $rq->input('nguon');
        $article = new Article;
        $article->catalog_id = $chuyenmuc;
        $article->article_title = $title;
        $article->article_content = $noidung;
        $article->article_summary = $tomtat;
        $article->writer = $author;
        $article->article_url = "";
        //upload file
        if ($rq->hasFile('hinhanh')) {
            $file = $rq->file('hinhanh');
            $random_digit = rand(000000000, 999999999);
            $name = $random_digit . $file->getClientOriginalName('hinhanh');
            $duoi = strtolower($file->getClientOriginalExtension('hinhanh'));

            if ($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg') {
                return back()->with(['flash_level' => 'danger', 'flash_message' => 'Định dạng ảnh chưa chính xác']);
            }
            $file->move('public/images/', $name);
            $article->image = $name;
        }
        $article->save();
        return redirect('/bai-viet');
    }


    public function thembacsi(Request $rq)
    {
        $name = $rq->input('doctorname');
        $desc = $rq->input('description');
        $specialities = $rq->input('chuyenkhoa');
        //var_dump( $specialities);
        $services = $rq->input('dichvu');

        $doctorclinic = $rq->input('noicongtac');
        $exprience = $rq->input('kinhnghiem');
        $exprience = explode("#", $exprience);
        $daotao = $rq->input('daotao');
        $daotao = explode('#', $daotao);
        $diachi = $rq->input('diachi');
        $doctortimework = $rq->input('doctortimework');
        $doctor = new Doctor;
        $doctor->doctor_name = $name;
        $province = Province::where('id', $diachi)->first();
        $doctor->doctor_address = $province->name;
        $doctor->province_id = $diachi;
        $doctor->doctor_timework = $doctortimework;
        $doctor->doctor_description = $desc;
        $doctor->doctor_clinic = $doctorclinic;
        $doctor->status = 1;

        $exp = "<ul>";
        foreach ($exprience as $ex) {
            $exp .= "<li>" . $ex . "</li>";
        }
        $exp .= "</ul>";
        $doctor->experience = $exp;
        $dt = "<ul>";
        foreach ($daotao as $d) {
            $dt .= "<li>" . $d . "</li>";
        }
        $dt .= "</ul>";
        $doctor->training = $dt;
        $doctor->doctor_url = $this->to_slug($name);

        //upload file
        if ($rq->hasFile('hinhanh')) {
            $file = $rq->file('hinhanh');
            $random_digit = rand(000000000, 999999999);
            $name = $random_digit . $file->getClientOriginalName('hinhanh');
            $duoi = strtolower($file->getClientOriginalExtension('hinhanh'));

            if ($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg') {
                return back()->with(['flash_level' => 'danger', 'flash_message' => 'Định dạng ảnh chưa chính xác']);
            }
            $file->move('public/images/doctor', $name);
            $doctor->profile_image = $name;
        }
        $doctor->save();

        if ($doctor->doctor_id != "" || $doctor->doctor_id != null) {
            foreach ($specialities as $sp) {
                $docsp = new DoctorSpeciality;
                $docsp->doctor_id = $doctor->doctor_id;
                $docsp->speciality_id = $sp;
                $docsp->save();
            }
            foreach ($services as $ser) {
                $docser = new DoctorService;
                $docser->doctor_id = $doctor->doctor_id;
                $docser->service_id = $ser;
                $docser->save();
            }
            return redirect('/danh-sach/bac-si/' . $doctor->doctor_url . '-' . $doctor->doctor_id);
        }
    }

    public function themcsyt(Request $rq)
    {
        //var_dump($rq);
        $name = $rq->input('clinicname');
        $specialities = $rq->input('chuyenkhoa');
        //var_dump( $specialities);
        $services = $rq->input('dichvu');
        $clinic = new Clinic;
        $clinic->clinic_name = $name;
        $clinic->clinic_url = $this->to_slug(trim($name));
        $clinic->clinic_address = $rq->input('diachi');
        $clinic->clinic_phone = $rq->input('dienthoai');
        $clinic->clinic_desc = $rq->input('description');
        $clinic->clinic_timeopen = $rq->input('clinictimeopen');

        //upload images
        if ($rq->hasFile('hinhanh')) {
            $file = $rq->file('hinhanh');
            $random_digit = rand(000000000, 999999999);
            $name = $random_digit . $file->getClientOriginalName('hinhanh');
            $duoi = strtolower($file->getClientOriginalExtension('hinhanh'));

            if ($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg') {
                return back()->with(['flash_level' => 'danger', 'flash_message' => 'Định dạng ảnh chưa chính xác']);
            }
            $file->move('public/images/health_facilities', $name);
            $clinic->profile_image = $name;
        }

        $clinic->save();
        if ($clinic->clinic_id != "" || $clinic->clinic_id != null) {
            if ($specialities != null)
                foreach ($specialities as $sp) {
                    $docsp = new ClinicSpeciality;
                    $docsp->clinic_id = $clinic->clinic_id;
                    $docsp->speciality_id = $sp;
                    $docsp->save();
                }

            if ($services != null) {
                foreach ($services as $ser) {
                    $docser = new ClinicService;
                    $docser->clinic_id = $clinic->clinic_id;
                    $docser->service_id = $ser;
                    $docser->save();
                }
            }
            return redirect('/co-so-y-te/' . $clinic->clinic_url . '-' . $clinic->clinic_id);
        }
        //echo $name;
    }

    public function themnhathuoc(Request $rq)
    {
        $name = $rq->input('drugstorename');
        $drugstore = new Drugstore;
        $drugstore->drugstore_name = $name;
        $drugstore->drugstore_url = $this->to_slug(trim($name));
        $drugstore->drugstore_address = $rq->input('diachi');
        $drugstore->drugstore_phone = $rq->input('dienthoai');
        $drugstore->drugstore_desc = $rq->input('description');
        $drugstore->province = $rq->input('province');

        //upload images
        if ($rq->hasFile('hinhanh')) {
            $file = $rq->file('hinhanh');
            $random_digit = rand(000000000, 999999999);
            $name = $random_digit . $file->getClientOriginalName('hinhanh');
            $duoi = strtolower($file->getClientOriginalExtension('hinhanh'));

            if ($duoi != 'png' && $duoi != 'jpg' && $duoi != 'jpeg' && $duoi != 'svg') {
                return back()->with(['flash_level' => 'danger', 'flash_message' => 'Định dạng ảnh chưa chính xác']);
            }
            $file->move('public/images/health_facilities', $name);
            $drugstore->profile_image = $name;
        }

        $drugstore->save();
        return redirect('/nha-thuoc/' . $drugstore->drugstore_url);
    }


    public function chat()
    {
        return view('chat');
    }

    public function sale_ads()
    {
        return view('sale/index');
    }

    public function testapi(Request $request)
    {
        return json_encode(array('isSuccess' => false, 'msg' => 'Không tìm thấy thông tin tài khoản!'), JSON_UNESCAPED_UNICODE);
    }

    public function postCapNhatApp(Request $rq)
    {
        $username = $rq->username;
        $password = $rq->password;
        $fullname = $rq->fullname;
        $presenter = $rq->presenter;
        $gender = $rq->gender;
        $phone = $rq->phone;
        $addpress = $rq->addpress;
        $type = 1;
        $image = "";

        if ($username != null && $rq->type != null) {
            $user = Users::where('email', $username)->first();
            if ($user != null) {
                $user->email = $username != null ? $username : null;
                $user->fullname = $fullname != null ? $fullname : null;
                $user->phone = $phone != null ? $phone : null;
                $user->present = $presenter != null ? $presenter : null;
                $user->gender = $gender != null ? $gender : null;
                $user->addpress = $addpress != null ? $addpress : null;
                $user->password = $password != null ? Hash::make($password) : null;
                if ($rq->type == "user") {
                    $type = 1;
                    $user_type = 'user';
                    $avatar = $this->saveImage($rq, $user, $type);
                    if ($avatar != null) {
                        $user->avatar = $avatar;
                    }
                } else if ($rq->type == "professional") {
                    $type = 2;
                    $user_type = 'doctor';
                } else if ($rq->type == "place") {
                    $type = 3;
                    $user_type = "clinic";
                } else if ($rq->type == "drugstore") {
                    $type = 4;
                    $user_type = "drugstore";
                }
                $user->user_type_id = $type;
                $user->paid = 1;
                if ($user->save()) {
                    if ($user->user_type_id == 1) {
                        $user->savePatient();
                    } else if ($user->user_type_id == 2) {

                    } else if ($user->user_type_id == 3) {

                    }
                    if ($image == null) {
                        $image = '';
                    }
                    header('Content-Type: application/json; charset=utf-8');
                    return json_encode(array('isSuccess' => true, 'msg' => 'Cập Nhật Thành Công', 'user_type' => $user_type, 'image' => $image, 'paid' => $user->paid, 'fullname' => $user->fullname), JSON_UNESCAPED_UNICODE);
                }
            } else {
                header('Content-Type: application/json; charset=utf-8');
                return json_encode(array('isSuccess' => false, 'msg' => 'Tên Tài Khoản Không Tồn Tại!'), JSON_UNESCAPED_UNICODE);
            }
        } else {
            header('Content-Type: application/json; charset=utf-8');
            return json_encode(array('isSuccess' => false, 'msg' => 'Chưa Nhập Đầy Đủ Thông Tin!'), JSON_UNESCAPED_UNICODE);
        }
    }

    public function saveImage(Request $request, $user, $type)
    {
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time() . '.' . $image->getClientOriginalExtension();
            if ($type == 1) {
                $path = public_path('/images/user');
                $image->move($path, $name);
                return "https://medixlink.com/public/images/user/" . $name;
            }
            if ($type == 2) {
//                $path = public_path('/images/doctor');
//                $image->move($path, $name);
//                if (strlen(strstr($user->doctor->profile_image, "https://dwbxi9io9o7ce.cloudfront.net")) > 0) {
//                    $imageURL = "medixlink.com/public/images/doctor/246170446bacsi.jpg";
//                }
//                else{
//                    $imageURL =  "medixlink.com/public/images/doctor/".$name;
//                }
//                return $imageURL;
            }
            if ($type == 3) {
//                $path = public_path('/images/health_facilities');
//                $image->move($path, $name);
//                if (strlen(strstr($user->clinic->profile_image, "https://dwbxi9io9o7ce.cloudfront.net")) > 0) {
//                    $imageURL = "medixlink.com/public/images/doctor/246170446bacsi.jpg";
//                }
//                else{
//                    $imageURL =  "medixlink.com/public/images/health_facilities/".$name;
//                }
//                return $imageURL;
            }
        }

        return "";
    }

    public function testpostapi(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/test');
            $image->move($destinationPath, $name);
            return back()->with('success', 'Image Upload successfully');
        } else {
            return json_encode(array('isSuccess' => false, 'msg' => 'OOOOOOO'), JSON_UNESCAPED_UNICODE);
        }
    }

    public function collaborators_login(Request $rq)
    {
        if($rq->session()->has('collaboratorsUser')){
            return redirect('/congtacvien/danhsach');
        }else{
            return view('dangnhapcongtac');
        }
    }

    public function collaborators_post_login(Request $rq)
    {
        $username = $rq->input('username');
        $password = $rq->input('password');

        $collaboratorsUser = CollaboratorsUser::where('username', $username)->first();
        if($collaboratorsUser == null)
        {
            return redirect('/dangnhapcongtac');
        }

        if(! Hash::check($password, $collaboratorsUser->password))
        {
            return redirect('/dangnhapcongtac');
        }
        $rq->session()->put('collaboratorsUser', $collaboratorsUser);
        return redirect('/congtacvien/danhsach');
    }

    public function collaborators_danhsach(Request $rq)
    {
        if(! $rq->session()->has('collaboratorsUser')){
            return redirect('/dangnhapcongtac');
        }
        $collaboratorsUsers = $rq->session()->get('collaboratorsUser');
        $userData = Users::where('present', $collaboratorsUsers->code)->orderBy('created_at', 'desc')->paginate(20);
        return view('danhsach_user_congtacvien', ['userData' => $userData]);
    }

    public function collaborators_danhsach_thoigiandung(Request $rq)
    {
        if(! $rq->session()->has('collaboratorsUser')){
            return redirect('/dangnhapcongtac');
        }

        $unit           = \App\Config::where('id', 2)->first();
        $unit           = (!empty($unit))? intval($unit->content) : 1000;
        $collaboratorsUsers = $rq->session()->get('collaboratorsUser');

        $userthoigiandung = DB::select("SELECT u.`user_id`, u.`email`, u.`fullname`, dt.`doctor_name`, u.`phone`, SUM(ct.times)time_call 
                                          FROM `user` u JOIN `call_time` ct ON u.`email`=ct.`user_email` JOIN 
                                          (SELECT d2.doctor_name, u2.email FROM `doctor` d2 JOIN `user` u2 ON d2.`user_id` = u2.`user_id`) as dt
                                           ON dt.email = ct.doctor_email 
                                           WHERE u.`present`='$collaboratorsUsers->code' GROUP BY u.`user_id`, u.`email`, u.`fullname`, dt.`doctor_name`, u.`phone`
                                        ")->paginate(20);
//        return view('danhsach_user_thoigiandung', ['userData' => $userthoigiandung, 'unit' => $unit]);
        return view('danhsach_user_thoigiandung', ['userData' => $userthoigiandung, 'unit' => $unit]);
    }

    public function collaborators_dangky(Request $rq)
    {
        $username = $rq->get("username");
        $password = $rq->get("password");
        $fullname = $rq->get("fullname");
        $code     = $rq->get("code");
        $note     = $rq->get("note");

        if($username == null || $password == null || $code == null)
        {
            return json_encode(["message"=>"Thong tin dang ky gom ten dang nhap, mat khau, ma code"]);
        }

        $collaboratorsUserCheck = CollaboratorsUser::where('username', $username)->first();
        if($collaboratorsUserCheck != null)
        {
            return json_encode(["message"=>"Tai khoan da ton tai"]);
        }
        $collaboratorsUserCheck2 = CollaboratorsUser::where('code', $code)->first();
        if($collaboratorsUserCheck2 != null)
        {
            return json_encode(["message"=>"Ma gioi thieu da ton tai"]);
        }

        $comporatorUser = new CollaboratorsUser();
        $comporatorUser->username = $username;
        $comporatorUser->password = Hash::make($password);
        $comporatorUser->fullname = $fullname;
        $comporatorUser->code = $code;
        $comporatorUser->note = $note;
        $comporatorUser->save();

        return json_encode(["success"=>true]);
    }

    public function getLocation(Request $request){
        if ($request->has('user_id')) {
            $query = Locations::query();
            $query = $query->where('user_id', $request->get('user_id'));
            $query = $query->where('status', 1);
            $localtion = $query->first();
            if ($localtion != null) {
                return json_encode(['success' => true, 'location' => $localtion]);
            }
        }
        return ['success' => false, 'message' => 'Không tìm thấy vị trí'];
    }

    public function setLocation(Request $request){
        if ($request->has('lat') && $request->has('lng') && $request->has('user_id')) {
            $user_id = $request->get('user_id');
            $lat = $request->get('lat');
            $lng = $request->get('lng');

            $query = Locations::query();
            $query = $query->where('user_id', $user_id);
            $localtionGet = $query->first();
            if ($localtionGet == null) {
                $localtion = new Locations();
                $localtion->user_id = $user_id;
                $localtion->lat = $lat;
                $localtion->lng = $lng;
                $localtion->save();
            }
            else {
                $localtionGet->lat = $lat;
                $localtionGet->lng = $lng;
                $localtionGet->save();
            }
            return ['success' => true, 'message' => 'Lưu vị trí thành công'];
        }
        else {
            return ['success' => false, 'message' => 'Vui lòng đủ prameters'];
        }
    }

    public function searchDistance(Request $request) {
        if ($request->has('lat') && $request->has('lng')
            && $request->has('distance')) {
            $lat = $request->get('lat');
            $lng = $request->get('lng');
            $distance = $request->get('distance');
            $locations = DB::select("
              SELECT u.*, l.lat, l.lng, ( 6371 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance 
              FROM location l JOIN user u ON l.user_id = u.user_id
              WHERE (u.user_type_id = 2 OR u.user_type_id = 3) AND l.status = 1
              HAVING distance < $distance ORDER BY distance LIMIT 0 , 20;"
            );

            $locations_doctors = DB::select("
              SELECT u.*, l.lat, l.lng, ( 6371 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance 
              FROM location l JOIN user u ON l.user_id = u.user_id
              WHERE u.user_type_id = 2 AND l.status = 1
              HAVING distance < $distance ORDER BY distance LIMIT 0 , 20;"
            );

            $locations_clinics = DB::select("
              SELECT u.*, l.lat, l.lng, ( 6371 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance 
              FROM location l JOIN user u ON l.user_id = u.user_id
              WHERE u.user_type_id = 3 AND l.status = 1
              HAVING distance < $distance ORDER BY distance LIMIT 0 , 20;"
            );

            $locations_drugstores = DB::select("
              SELECT u.*, l.lat, l.lng, ( 6371 * acos( cos( radians($lat) ) * cos( radians( lat ) ) * cos( radians( lng ) - radians($lng) ) + sin( radians($lat) ) * sin( radians( lat ) ) ) ) AS distance 
              FROM location l JOIN user u ON l.user_id = u.user_id
              WHERE u.user_type_id = 4 AND l.status = 1
              HAVING distance < $distance ORDER BY distance LIMIT 0 , 20;"
            );

            foreach ($locations_doctors as $location) {
                $doctor = Doctor::where('user_id', $location->user_id)->first();
                $doctor_specialitys = DoctorSpeciality::where('doctor_id', $doctor['doctor_id'])->get();  
                foreach ($doctor_specialitys as $doctor_speciality) {
                    $specialitys = Speciality::where('speciality_id', $doctor_speciality->speciality_id)->get();
                    $doctor_speciality->speciality_detail = $specialitys;
                }
                $doctor['specialitys'] = $doctor_specialitys;
                $location->doctor = $doctor;
            }

            foreach ($locations_clinics as $location) {
                $clinic = Clinic::where('user_id', $location->user_id)->first();
                $clinic_specialitys = ClinicSpeciality::where('clinic_id', $clinic['clinic_id'])->get();
                foreach ($clinic_specialitys as $clinic_speciality) {
                    $specialitys = Speciality::where('speciality_id', $clinic_speciality->speciality_id)->get();
                    $clinic_speciality->speciality_detail = $specialitys;
                }
                $location->clinic = $clinic_specialitys;
            }

            foreach ($locations_drugstores as $location) {
                $drugstore = Drugstore::where('user_id', $location->user_id)->first();
                $location->drugstore = $drugstore;
            }

            return json_encode(['success' => true, 'user' => $locations, 'doctors' => $locations_doctors, 'clinics' => $locations_clinics, 'drugstores' => $locations_drugstores]);
        }
        else {
            return ['success' => false, 'message' => 'Vui lòng đủ prameters'];
        }
    }

    public function checkPhoneExist(Request $rq){
        $phone = $rq->get('phone');
        $checkPhone = Users::where('phone', $phone)->first();
        if ($checkPhone == null) {
            header('Content-Type: application/json; charset=utf-8');
            return json_encode(array('isExist' => false, 'msg' => 'Số điện thoại không có trên hệ thống!'));
        }
        else {
            header('Content-Type: application/json; charset=utf-8');
            return json_encode(array('isExist' => true, 'msg' => 'Số điện thoại đã tồn tại!'));
        }
    }

    public function apiChuyenKhoa(Request $rq) {
        return Speciality::all();
    }

    public function apiDanhSachBacSi(Request $rq) {

        if ($rq->has('speciality_id')) {
            $speciality_id = $rq->get('speciality_id');

            $dataQuery = DB::table('doctor')
                ->join('doctor_speciality', 'doctor.doctor_id', '=', 'doctor_speciality.doctor_id')
                ->join('speciality', 'speciality.speciality_id', '=', 'doctor_speciality.speciality_id')
                ->where('doctor_speciality.speciality_id', $speciality_id)
                ->where('doctor.featured', '!=',0)
                ->orderBy('doctor.top', 'desc')
                ->orderBy('doctor.featured', 'desc')
                ->orderBy('doctor.vote', 'desc')
                ->groupBy('doctor.doctor_id')
                ->select('doctor.*', DB::raw('GROUP_CONCAT(speciality.speciality_name SEPARATOR \', \') as \'specialitys\''))
                ->paginate(20);
            $dataQuery->getCollection()->transform(function ($value) {
                $value->profile_image = 'https://medixlink.com/public/images/doctor/'.$value->profile_image;
                return $value;
            });
            return $dataQuery;
        }

        $data = DB::table('doctor')
            ->join('doctor_speciality', 'doctor.doctor_id', '=', 'doctor_speciality.doctor_id')
            ->join('speciality', 'speciality.speciality_id', '=', 'doctor_speciality.speciality_id')
            ->orderBy('doctor.top', 'desc')
            ->orderBy('doctor.featured', 'desc')
            ->orderBy('doctor.vote', 'desc')
            ->groupBy('doctor.doctor_id')
            ->select('doctor.*', DB::raw('GROUP_CONCAT(speciality.speciality_name SEPARATOR \', \') as \'specialitys\''))
            ->paginate(20);

        $data->getCollection()->transform(function ($value) {
            $value->profile_image = 'https://medixlink.com/public/images/doctor/'.$value->profile_image;
            return $value;
        });
        return $data;
    }

    public function apiDanhSachPhongKham(Request $rq) {

        if ($rq->has('speciality_id')) {
            $speciality_id = $rq->get('speciality_id');

            $dataQuery = DB::table('clinic')
                ->join('clinic_speciality', 'clinic.clinic_id', '=', 'clinic_speciality.clinic_id')
                ->join('speciality', 'speciality.speciality_id', '=', 'clinic_speciality.speciality_id')
                ->where('clinic_speciality.speciality_id', $speciality_id)
                ->orderBy('clinic.top', 'desc')
                ->orderBy('clinic.featured', 'desc')
                ->orderBy('clinic.vote', 'desc')
                ->groupBy('clinic.clinic_id')
                ->select('clinic.*', DB::raw('GROUP_CONCAT(speciality.speciality_name SEPARATOR \', \') as \'specialitys\''))
                ->paginate(20);
            $dataQuery->getCollection()->transform(function ($value) {
                $value->profile_image = 'https://medixlink.com/public/images/health_facilities/'.$value->profile_image;
                return $value;
            });
            return $dataQuery;
        }

        $data = DB::table('clinic')
            ->join('clinic_speciality', 'clinic.clinic_id', '=', 'clinic_speciality.clinic_id')
            ->join('speciality', 'speciality.speciality_id', '=', 'clinic_speciality.speciality_id')
            ->orderBy('clinic.top', 'desc')
            ->orderBy('clinic.featured', 'desc')
            ->orderBy('clinic.vote', 'desc')
            ->groupBy('clinic.clinic_id')
            ->select('clinic.*', DB::raw('GROUP_CONCAT(speciality.speciality_name SEPARATOR \', \') as \'specialitys\''))
            ->paginate(20);
        $data->getCollection()->transform(function ($value) {
            $value->profile_image = 'https://medixlink.com/public/images/health_facilities/'.$value->profile_image;
            return $value;
        });
        return $data;
    }

    public function apiDoiMatKhau(Request $rq) {
        if (!$rq->has('username') ||!$rq->has('old_password') || !$rq->has('new_password')) {
            return ['success' => false, 'message' => 'Vui lòng đủ prameters'];
        }

        $username = $rq->get("username");
        $old_password = $rq->get("old_password");
        $new_password = $rq->get("new_password");

        $user = Users::where('email', '=', $username)->first();

        if (!Hash::check($old_password, $user->password)) {
            return ['success' => false, 'message' => 'Mật khẩu cũ không đúng'];
        }
        else {
            $user->password =Hash::make($new_password);
            $user->save();
            return ['success' => true, 'message' => 'Đổi mật khẩu thành công'];
        }
    }

    public function apiDanhSachTinhThanh(Request $rq) {
        $data = Province::all();
        return $data;
    }

    public function apiVersion(Request $rq) {
        // Những version ở android bắt buộc update
        $versions = [];
        return ['versionUpdate' => $versions];
    }

    public function thanhToanTinNhan(Request $rq)
    {
        $user_email = $rq->get('user_email');
        $doctor_email = $rq->get('doctor_email');
        $times = $rq->get('count');

        if (empty($user_email)) return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'user_email is not required'));
        if (empty($doctor_email)) return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'doctor_email is not required'));
        if (empty($times)) return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'Times is not required'));

        $qty = 0;

        $calltime = new Calltime();
        $calltime->type = 1;
        $calltime->user_email = $user_email;
        $calltime->doctor_email = $doctor_email;

        try {
            $qty = doubleval($times);
            if ($qty <= 0) {
                return json_encode(array('isSucess' => false, 'balance' => 0, 'msg' => 'Sai định dạng dữ liệu!'), JSON_UNESCAPED_UNICODE);
            }
        } catch (Exception $exception) {
            return json_encode(array('isSucess' => false, 'balance' => 0, 'msg' => 'Sai định dạng dữ liệu!'), JSON_UNESCAPED_UNICODE);
        }
        $calltime->times = $qty;
        $unit = \App\Config::where('id', 3)->first();
        $unit = (!empty($unit)) ? intval($unit->content) : 1000;

        $calltime->unit = $unit;
        if ($calltime->save()) {
            // Thắng add 20181107 start
            $patient = \App\Patient::where('email', $user_email)->first();
            if ($patient == null) {
                return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'Không tìm thấy thông tin tài khoản!'), JSON_UNESCAPED_UNICODE);
            }

            $patient->minusTimeMessage($qty);
            $patient->save();
            if($patient->balance < $unit) {
                $patient->can_chat = 0;
                $patient->can_call_audio = 0;
                $patient->can_call_video = 0;
                $patient->save();
                $user = \App\Users::where('email', $user_email)->first();
                $user->paid = 0;
                $user->save();
            }
            // Thắng add 20181107 end

            return json_encode(array('isSave' => true, 'balance' => $patient->balance, 'msg' => 'Lưu thành công'));
        } else {
            return json_encode(array('isSave' => false, 'balance' => 0, 'msg' => 'Lưu thất bại'));
        }
    }
} 
