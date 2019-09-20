<?php

namespace App\Http\Controllers;

use App\Drugstore;
use App\Locations;
use App\Patient;
use App\User;
use DateTime;
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
use App\Helpers\NL_CheckOutV3;


define('URL_API', 'https://www.nganluong.vn/checkout.api.nganluong.post.php');    // Đường dẫn gọi api
define('RECEIVER', 'bacsivietok@gmail.com');                                        // Email tài khoản ngân lượng
define('MERCHANT_ID', '55678');                                                        // Mã merchant kết nối
define('MERCHANT_PASS', 'd444b643bad3bdee56d0c155ed657aa1');                            // Mật khẩu kết nôi


class ViewController extends Controller
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

        //news new 5Tải ứng dụng để chat với bác sĩ
        $news_new = Article::orderBy('article_id', 'DESC')->limit(5)->get();
        view()->share('news_new', $news_new);
        //news popular
        $news_popular = Article::where('popular', 1)->orderBy('article_id', 'DESC')->limit(5)->get();
        view()->share('news_popular', $news_popular);
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

    public static function getProvinceID($province)
    {
        $prov = \App\Province::where('name', 'like', '%' . $province . '%')->firstOrFail();
        if ($prov)
            return $prov->province_id;
        return false;
    }

    public function index()
    {
//        $clinics = Clinic::where('featured', '1')->limit(12)->get();
        $doctors = Doctor::where('featured', '1')->orderBy('order_doctor', 'DESC')->limit(9)->get();
//        $questions = SelectQuestionSubject::where('featured', '1')->limit(12)->get();
//        $reviews = Review::all()->take(5);
//        $specialities = \App\Speciality::all();
        $provinces = Province::all();

//        view()->share('clinics', $clinics);
        view()->share('doctors', $doctors);
        view()->share('provinces', $provinces);
//        view()->share('specialities', $specialities);
//        view()->share('questions', $questions);
//        view()->share('reviews', $reviews);
        return view('v2/view/home');
    }

    public function postDangnhap(Request $rq)
    {
        $email = $rq->input('email');
        $pass = $rq->input('password');

        $next = $rq->input('next');
        $goto = $rq->input('goto');
        if (!$rq->session()->has('user')) {
            $user = Users::where('email', $email)->first();
            if ($user != null) {
                if (Hash::check($pass, $user->password)) {
                    $rq->session()->put('user', $user);
                    if($goto != null)
                    {
                        return redirect($goto);
                    }
                    return redirect('/home');
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
                    $user->user_id = $user->user_id + (10000000 * $user->user_type_id);
                    $user->save();

                    // Tạo dữ liệu partient tài khoản
                    $patientNew = $user->createPatient();
                    $patientNew->save();
                    if ($present != null && $present != "") {
                        $user->present = $present;
                        $user->save();
                        $collaboratorsUser = CollaboratorsUser::where('code', $present)->first();
                        if ($collaboratorsUser != null) {
                            $patientNew->balance += $collaboratorsUser->promotion;
                            $patientNew->save();
                        }
                    }

                    if ($user->user_type_id == 1) {
                        $patientNew = $user->createPatient();
                        $patientNew->save();
                        if ($present != null && $present != "") {
                            $user->present = $present;
                            $user->save();
                            $collaboratorsUser = CollaboratorsUser::where('code', $present)->first();
                            if ($collaboratorsUser != null) {
                                $patientNew->balance += $collaboratorsUser->promotion;
                                $patientNew->save();
                            }
                        }
                    } else if ($user->user_type_id == 2) {
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
                        $patientNew = $user->createPatient();
                        $patientNew->save();
                        if ($present != null && $present != "") {
                            $user->present = $present;
                            $user->save();
                            $collaboratorsUser = CollaboratorsUser::where('code', $present)->first();
                            if ($collaboratorsUser != null) {
                                $patientNew->balance += $collaboratorsUser->promotion;
                                $patientNew->save();
                            }
                        }
                    }

                };
                return redirect('/home')->with('successReg', 'Đăng ký thành công');
            } else {
                $errors = new MessageBag(['errorReg' => 'Username này đã có người sử dụng, vui lòng nhập username khác']);
                return redirect()->back()->withInput()->withErrors($errors);
            }

        } else {
            $errors = new MessageBag(['errorReg' => 'Hộ Tên, Username và mật khẩu không được để trống.']);
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    public function viewDoctors(Request $rq)
    {
        $ads = Ads::where('place', '5')->get();

        $doctors = Doctor::where('status', '1')->orderBy('doctor_id', 'DESC');


        //view()->share('doctors',$doctors);
        //var_dump($doctors);
        if ($rq->input('q')) {
            if ($rq->input('key') == 'specialities') {
                $speciality = Speciality::where('specialty_url', $rq->input('q'))->first();
                $doctors = Doctor::Join('doctor_speciality', 'doctor.doctor_id', '=', 'doctor_speciality.doctor_id')->where('doctor_speciality.speciality_id', $speciality->speciality_id)->paginate(15);
                $bs = Doctor::Join('doctor_speciality', 'doctor.doctor_id', '=', 'doctor_speciality.doctor_id')->where('speciality_id', $speciality->speciality_id)->count();
                $q = urldecode($rq->input('q'));
                $drugstore = Drugstore::where('drugstore_name', 'like', '%' . $q . '%')->count();
                $user = Users::where('addpress', $rq->input('q'))->get();
                $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
                $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();
                return view('v2/view/doctors', ['doctors' => $doctors, 'doctor' => $bs, 'question' => $qs, 'service' => $service, 'ads' => $ads, 'user' => $user, 'speciality' => $speciality, 'drugstore' => $drugstore])->withPost($doctors);

            } else if ($rq->input('key') == 'city') {
                // $doctors = Doctor::Join('user', 'doctor.user_id', '=', 'user.user_id')
                // ->where('user.addpress',$rq->input('q'))->paginate(30);

                $doctors = Doctor::where('doctor_address', 'like', $rq->input('q'))->paginate(15);

                $q = urldecode($rq->input('q'));
                $user = Users::where('addpress', $rq->input('q'))->get();
                //$doctors = Doctor::where('user_id','like','%trung%')->paginate(30);

                //     $bs = Doctor::Join('user', 'doctor.user_id', '=', 'user.user_id')
                // ->where('user.addpress',$rq->input('q'))->count();

                $bs = Doctor::where('doctor_address', 'like', $rq->input('q'))->count();
                $drugstore = Drugstore::where('drugstore_address', 'like', '%' . $q . '%')->count();
                $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
                $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();
                return view('v2/view/doctors', ['doctors' => $doctors, 'doctor' => $bs, 'question' => $qs, 'service' => $service, 'ads' => $ads, 'user' => $user, 'drugstore' => $drugstore])->withPost($doctors);
            } else if ($rq->input('key') == 'clinic') {
                echo "clinic";
                die();
            }
            $q = urldecode($rq->input('q'));
            $doctors = Doctor::where('doctor_name', 'like', '%' . $q . '%')->paginate(15);

            $benh = Disease::where('disease_name', 'like', '%' . $q . '%');
            $benh_count = $benh->count();
            //$benh = $benh->paginate(30);
            $thuoc = Medicine::where('description', 'like', '%' . $q . '%')->count();
            $bs = Doctor::where('doctor_name', 'like', '%' . $q . '%')->count();
            $drugstore = Drugstore::where('drugstore_name', 'like', '%' . $q . '%')->count();
            $csyt = Clinic::where('clinic_name', 'like', '%' . $q . '%')->count();
            $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
            $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();
            return view('v2/view/doctors', ['doctors' => $doctors, 'count' => $benh_count, 'thuoc' => $thuoc, 'doctor' => $bs, 'clinic' => $csyt, 'question' => $qs, 'service' => $service, 'ads' => $ads, 'drugstore' => $drugstore])->withPost($doctors);
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
        $doctors = $doctors->paginate(15);
        return view('v2/view/doctors', ['doctors' => $doctors, 'ads' => $ads])->withPost($doctors);
    }


    public function viewDoctors2(Request $rq)
    {
        return view('v2/view/doctors_result');
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

        return view('v2/view/bacsi_chitiet', ['comment' => $comment, 'like' => $like, 'answer' => $answers]);
    }

    public function danhsach_thuoc(Request $rq)
    {
        $medicines = Medicine::orderBy('medicine_id', 'DESC')->paginate(30);
        if ($rq->input('q')) {
            $q = urldecode($rq->input('q'));
            $benh = Disease::where('disease_name', 'like', '%' . $q . '%');
            $benh_count = $benh->count();
            $benh = $benh->paginate(30);
            $drugstore = Drugstore::where('drugstore_name', 'like', '%' . $q . '%')->count();
            $thuoc = Medicine::where('description', 'like', '%' . $q . '%')->count();
            $medicines = Medicine::where('description', 'like', '%' . $q . '%')->paginate(30);
            $bs = Doctor::where('doctor_name', 'like', '%' . $q . '%')->count();
            $csyt = Clinic::where('clinic_name', 'like', '%' . $q . '%')->count();
            $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
            $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();
            return view('v2/view/thuoc_danhsach', ['medicines' => $medicines, 'count' => $benh_count, 'benh' => $benh, 'thuoc' => $thuoc, 'doctor' => $bs, 'clinic' => $csyt, 'question' => $qs, 'service' => $service, 'drugstore' => $drugstore])->withPost($medicines);
        }

        return view('v2/view/thuoc_danhsach', ['medicines' => $medicines])->withPost($medicines);
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
            $clinics = $clinics->where('province_id', $rq->input('province'));
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
            $drugstore = Drugstore::where('drugstore_name', 'like', '%' . $q . '%')->count();
            $bs = Doctor::where('doctor_name', 'like', '%' . $q . '%')->count();
            $csyt = Clinic::where('clinic_name', 'like', '%' . $q . '%')->count();
            $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
            $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();
            //s echo count($clinics);return;
            return view('v2/view/phongkham', ['clinics' => $clinics, 'count' => $benh_count, 'thuoc' => $thuoc, 'doctor' => $bs, 'clinic' => $csyt, 'question' => $qs, 'service' => $service, 'baiviets' => $baiviets, 'ads' => $ads, 'drugstore' => $drugstore])->withPost($clinics);

        }

        if ($rq->input('province') != null) {
            $prv = Province::where('id', $rq->input('province'))->first();
            if ($prv != null) {
                $clinics = $clinics->where('province_id', $prv->id);
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
        return view('v2/view/phongkham', ['baiviets' => $baiviets, 'ads' => $ads], ['clinics' => $clinics])->withPost($clinics);
    }

    public function chitiet_csyt($id)
    {
        sleep(2);
        if ($id == 'danhsach-phongkham') {
            $clinics = Clinic::all();
            //var_dump($clinics[0]->specialities[0]->clinic);
            view()->share('clinics', $clinics);
            return view('v2/view/chitiet_phongkham');

        }

        $url = explode('-', $id);
        $uid = $url[count($url) - 1];

        $comment = Comment::where('clinic_id', $uid)->orderBy('created_at', 'DESC')->get();
        $danhgia = Comment::where('feedback_', '>', 0)->count('feedback_');
        $sum = Comment::sum('feedback_');
        $csyt = \App\Clinic::find($uid);
        $chuyenkhoa = \App\ClinicSpeciality::where('clinic_id', $id)->get();
        $bacsi = \App\DoctorClinic::where('clinic_id', $uid)->get();

        return view('v2/view/chitiet_phongkham', ['cs' => $csyt, 'bacsi' => $bacsi, 'comment' => $comment, 'danhgia' => $danhgia, 'sum' => $sum]);
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
        return view('v2/view/thuoc_chitiet', ['thuoc' => $thuoc, 'ads' => $ads]);
    }

    public function timkiem(Request $rq)
    {
        if ($rq->input('province')) {
            $provin = $rq->input('province');
            $rq->session()->put('province', $provin);
            $province = \App\Province::where('name', 'like', '%' . $provin . '%')->first();
            // if($province!=null){
            //  $rq->session()->put('province_id',$province->province_id);
            //  return redirect('/danh-sach');
            // }

        }
        if ($rq->input('q') != null) {
            $q = urldecode($rq->input('q'));
            $benh = Disease::where('disease_name', 'like', '%' . $q . '%');
            $benh_count = $benh->count();
            $benh = $benh->paginate(30);
            $drugstore = Drugstore::where('drugstore_name', 'like', '%' . $q . '%')->count();
            $thuoc = Medicine::where('description', 'like', '%' . $q . '%')->count();
            $bs = Doctor::where('doctor_name', 'like', '%' . $q . '%')->count();
            $csyt = Clinic::where('clinic_name', 'like', '%' . $q . '%')->count();
            $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
            $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();
            return view('v2/view/timkiem', ['count' => $benh_count, 'benh' => $benh, 'thuoc' => $thuoc, 'doctor' => $bs, 'clinic' => $csyt, 'question' => $qs, 'service' => $service, 'drugstore' => $drugstore]);
        } else {
            echo '<script>alert("Vui lòng nhập từ khóa tìm kiếm.");window.history.back();</script>';
        }
    }

    public function benh(Request $rq)
    {
        $benh_view = Disease::groupBy('view')->orderBy('view', 'DESC')->get();
        return view('v2/view/benh', ['benh_view' => $benh_view]);
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
        return view('v2/view/benh_chitiet', ['benh' => $benh, 'cauhoi' => $cauhoi, 'doctors' => $doctor, 'clinics' => $clinics, 'ads' => $ads]);
    }

    public function convert_vi_to_en($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        $str = str_replace(" ", "-", str_replace("&*#39;","",$str));
        $str = str_replace("?", "-", str_replace("&*#39;","",$str));
        $str = strtolower($str);
        return $str;
    }

    public function baiviet()
    {
        $Catalog = Catalog::all();
        $baiviet_new = Article::orderBy('article_id', 'DESC')->limit(1)->first();
        $baiviets = Article::orderBy('article_id', 'DESC')->limit(50)->get();

//        $bv = Article::get();
//        foreach ($bv as $item) {
//            $v = $this->convert_vi_to_en($item->article_title);
//            Article::where('article_id', $item->article_id)->update(array('article_url' => $v));
//        }

        return view('v2/view/tintuc_danhsach', ['baiviets' => $baiviets, 'Catalog' => $Catalog, 'baiviet_new' => $baiviet_new])->withPost($baiviets);

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
        return view('v2/view/tintuc_chitiet', ['Catalogs' => $Catalogs, 'baiviet' => $baiviet, 'lienquan' => $lienquan, 'noibat' => $noibat, 'comment' => $comment, 'ads' => $ads]);

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
            return view('v2/view/chuyen_muc', ['Catalogs' => $Catalogs, 'baiviet' => $baiviet, 'baiviet_new' => $baiviet_new]);
        } else

            $baiviet_new = Article::where('catalog_id', $id)->orderBy('article_id', 'DESC')->limit(1)->first();
        $baiviet = Article::where('catalog_id', $id)->orderBy('article_id', 'ASC')->paginate(10);
        return view('v2/view/chuyen_muc', ['Catalogs' => $Catalogs, 'baiviet' => $baiviet, 'baiviet_new' => $baiviet_new])->withPost($baiviet);

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
        return view('v2/view/hoibacsi', ['question' => $question, 'selectquestion' => $selectQuestion])->withPost($question);
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
        return view('v2/view/tuyenchon_detail', ['questions' => $questions, 'subject' => $tuyenchon, 'subjects' => $subjects]);
    }

    public function hoibacsiview(Request $rq, $id)
    {

        // var_dump($id);die;
        switch ($id) {
            case "tuyenchon":
                $subjects = SelectQuestionSubject::orderBy('created_at')->paginate(30);
                return view('v2/view/hoibacsi_tuyenchon', ['subjects' => $subjects])->withPost($subjects);
                break;
            case "datcauhoi":
                $specialities = \App\Speciality::all();
                view()->share('specialities', $specialities);
                return view('v2/view/datcauhoi');
                break;
            case "danhsach":
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
                    $drugstore = Drugstore::where('drugstore_name', 'like', '%' . $q . '%')->count();
                    $bs = Doctor::where('doctor_name', 'like', '%' . $q . '%')->count();
                    $csyt = Clinic::where('clinic_name', 'like', '%' . $q . '%')->count();
                    $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
                    $questions = Question::where('question_title', 'like', '%' . $q . '%')->paginate(30);
                    $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();
                    return view('v2/view/hoibacsi_danhsach', ['count' => $benh_count, 'questions' => $questions, 'thuoc' => $thuoc, 'doctor' => $bs, 'clinic' => $csyt, 'question' => $qs, 'service' => $service, 'drugstore' => $drugstore])->withPost($questions);
                }
                return view('v2/view/hoibacsi_danhsach', ['questions' => $questions])->withPost($questions);
                break;
            default:
                return $this->hoibacsi_showdetail($id);
                break;
        }
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
        return view('v2/view/hoibacsiview', compact('ads'))->with('question', $question);
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
            return redirect('/hoibacsi');
        }
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
        return view('v2/view/chuyenkhoa_detail', ['doctors' => $doctors, 'clinics' => $clinics]);
    }

    public function aboutUs()
    {
        return view('v2/view/aboutUs');
    }

    public function recharge()
    {
        return view('v2/view/recharge');
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
        return view('v2/view/khuyenmai', ['deal_category' => $deal_category, 'deals' => $deals])->withPost($deals);
    }

    public function khuyenmaidetail(Request $rq, $url)
    {
        $ids = explode('-', $url);
        $id = $ids[count($ids) - 1];
        $khuyenmai = \App\Deals::where('deal_id', $id)->first();
        $khuyenmai->ranked = $khuyenmai->ranked + 1;
        $khuyenmai->save();
        $comment = comment::where('deal_id', $id)->orderBy('created_at', 'DESC')->get();
        return view('v2/view/khuyenmai_detail', ['deal' => $khuyenmai, 'comment' => $comment]);
    }

    public function taikhoan(Request $rq)
    {
        if ($rq->session()->has('user')) {
            return view('v2/view/taikhoan_home');
        } else {
            return redirect('/home');
        }
    }

    public function taikhoan_method(Request $rq, $method)
    {
        if ($rq->session()->has('user')) {
            switch ($method) {
                case "ghinho":
                    return $this->taikhoan_ghinho($rq);
                    break;
                case "nhan-xet":
                    return $this->taikhoan_nhanxet($rq);
                    break;
                case "hoidap":

                    return $this->taikhoan_hoidap($rq);
                    break;
                case "doimatkhau":
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
                case "thembacsi":
                    $speciality = \App\Speciality::all();
                    $services = \App\Service::all();
                    return view('v2/view/taikhoan_thembacsi', ['specialities' => $speciality, 'services' => $services]);
                    break;
                case "themcsyt":
                    $speciality = \App\Speciality::all();
                    $services = \App\Service::all();
                    return view('v2/view/taikhoan_themcsyt', ['specialities' => $speciality, 'services' => $services]);
                    break;
                case "themnhathuoc":
                    return view('v2/view/taikhoan_themnhathuoc');
                    break;
                case "vietbai":
                    $catalogs = Catalog::all();
                    return view('v2/view/taikhoan_vietbai', ['catalogs' => $catalogs]);
                    break;
                case "doanhso":
                    $dateFrom = '1970-01-01';
                    if($rq->has('date_from')) {
                        $dateFrom = $rq->get('date_from');
                    }
                    $dateTo = date('Y-m-d');
                    if($rq->has('date_to')) {
                        $dateTo = $rq->get('date_to');
                    }
                    $userLogin = $rq->session()->get('user');
                    $callTimeWithDoctor = Calltime::where('doctor_email', $userLogin->email)->where('created_at', '>=', $dateFrom)->where('created_at', '<=', $dateTo)->orderBy('call_time_id', 'desc')->paginate(50);
                    $queryTotal = DB::select("SELECT SUM(times * unit) as `total` FROM `call_time` WHERE `created_at` >= '$dateFrom' AND `created_at` <= '$dateTo' AND `doctor_email`='$userLogin->email'");
                    $total = $queryTotal[0]->total;
                    if($total == null)
                    {
                        $total = 0;
                    }
                    return view('v2/view/taikhoan_doanhso', ['callTimeWithDoctor' => $callTimeWithDoctor, 'total' =>round($total)]);
                    break;
                case "doanh-thu-bac-si":
                    if($rq->has('doctor_email'))
                    {
                        $dateFrom = '1970-01-01';
                        if($rq->has('date_from')) {
                            $dateFrom = $rq->get('date_from');
                        }
                        $dateTo = date('Y-m-d');
                        if($rq->has('date_to')) {
                            $dateTo = $rq->get('date_to');
                        }

                        $doctorEmail = $rq->get('doctor_email');
                        $callTimeWithDoctor = Calltime::where('doctor_email', $doctorEmail)->where('created_at', '>=', $dateFrom)->where('created_at', '<=', $dateTo)->orderBy('call_time_id', 'desc')->paginate(50);
                        $queryTotal = DB::select("SELECT SUM(times * unit) as `total` FROM `call_time` WHERE `created_at` >= '$dateFrom' AND `created_at` <= '$dateTo' AND `doctor_email`='$doctorEmail'");
                        $total = $queryTotal[0]->total;
                        if($total == null)
                        {
                            $total = 0;
                        }
                        return view('v2/view/taikhoan_doanhthubacsi', ['callTimeWithDoctor' => $callTimeWithDoctor, 'total' =>round($total)]);
                    }

                    return view('v2/view/taikhoan_doanhthubacsi', ['callTimeWithDoctor' => null, 'total' => 0]);
                    break;
                case "admin-recharge":
                    $query = "";
                    if($rq->has('query'))
                    {
                        $query = $rq->get('query');
                    }
                    $userList = Users::where('fullname', 'like', '%' . $query . '%')
                        ->orWhere('email', 'like', '%' . $query . '%')
                        ->orWhere('phone', 'like', '%' . $query . '%')
                        ->orderBy('fullname', 'asc')->paginate(50);
                    return view('v2/view/admin_recharge', ['userList' => $userList]);
                    break;
            }
        } else {
            return redirect('/home');
        }
    }

    public static function update_balance(Request $rq)
    {
        if($rq->has('user-id') && $rq->has('balance') && $rq->has('link'))
        {
            try
            {
                $userId = $rq->get('user-id');
                $balance = $rq->get('balance');
                $link = $rq->get('link');

                $user = Users::where('user_id', $userId)->first();
                $user->paid = 1;
                $user->save();
                if ($user->patient == null) {
                    $patientNew = $user->createPatient();
                    $patientNew->save();
                }
                $patient = Patient::where('user_id', $userId)->first();
                $patient->balance = $balance;
                $patient->can_chat = 1;
                $patient->can_call_audio = 1;
                $patient->can_call_video = 1;
                $patient->save();

                return redirect($link);
            }
            catch (\Exception $e)
            {}
        }
        return redirect('/taikhoan/admin-recharge');
    }

    public static function taikhoan_ghinho(Request $rq)
    {
        return view('v2/view/taikhoan_ghinho');
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
        return redirect('/baiviet');
    }

    public static function taikhoan_hoidap(Request $rq)
    {
        $all = \App\Answer::pluck('question_id')->all();
        $user_id = $rq->session()->get('user')->user_id;

        $count_answers = 0;
        var_dump($user_id);
        $questions = Question::where('user_id',$user_id)->get();
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

            $questions = \App\Question::where('user_id', $user_id)->whereNotIn('question_id', $all)->orderBy('created_at', 'DESC')->paginate(20);

            $answers = \App\Question::where('user_id', $user_id)->whereIn('question_id', $all)->orderBy('created_at', 'DESC')->paginate(20);
//            echo count($answers);return;
        }

        //$answers = \App\Question::whereIn('question_id',$all)->whereIn('speciality_id',$spec)->select('*')->get();
        // var_dump($spec);return;
        foreach ($questions as $question) {
            $count = Answer::where('question_id', $question['question_id'])->count();
            if($count > 0) {
                $count_answers = $count_answers + 1;
            }
        }
//        $count_questions = Question::where('user_id', $user_id)->count();
        $count_questions = count($questions);
        $count_answers = count($answers);
        return view('v2/view/taikhoan_hoidap', ['questions' => $questions, 'count_answers' => $count_answers, 'count_questions' => $count_questions, 'answers' => $answers]);

    }

    public static function taikhoan_doimatkhau(Request $rq)
    {
        return view('v2/view/taikhoan_doimatkhau');
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
        //$errors = new MessageBag(['errorReg' => 'Mật khẩu hoặc mật khẩu nhập lại chưa chính xác']);
        return redirect('/taikhoan/doimatkhau')->with('success', 'Đổi mật khẩu thành công');
    }

    public function dangxuat(Request $rq)
    {
        Session::flush();
        $rq->session()->forget('user');
        return redirect('/home');
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
            return redirect('/danh-sach-bac-si-chi-tiet/' . $doctor->doctor_url . '-' . $doctor->doctor_id);
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
            return redirect('/phongkham-chitiet/' . $clinic->clinic_url . '-' . $clinic->clinic_id);
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

    public function danhsach_nhathuoc(Request $rq)
    {
        $ads = Ads::where('place', '6')->get();
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

        if ($rq->input('q')) {
            $q = urldecode($rq->input('q'));
            $doctors = Doctor::where('doctor_name', 'like', '%' . $q . '%')->paginate(15);
            $drugstores = $drugstores->paginate(30);
            $benh = Disease::where('disease_name', 'like', '%' . $q . '%');
            $benh_count = $benh->count();
            //$benh = $benh->paginate(30);
            $thuoc = Medicine::where('description', 'like', '%' . $q . '%')->count();
            $bs = Doctor::where('doctor_name', 'like', '%' . $q . '%')->count();
            $drugstore = Drugstore::where('drugstore_name', 'like', '%' . $q . '%')->count();
            $csyt = Clinic::where('clinic_name', 'like', '%' . $q . '%')->count();
            $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
            $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();
            return view('v2/view/danhsach_nhathuoc', ['doctors' => $doctors, 'count' => $benh_count, 'thuoc' => $thuoc, 'doctor' => $bs, 'clinic' => $csyt, 'question' => $qs, 'service' => $service, 'ads' => $ads, 'drugstore' => $drugstore, 'drugstores' => $drugstores])->withPost($drugstores);
        }
        if ($rq->input('q') == 'city') {
            // $doctors = Doctor::Join('user', 'doctor.user_id', '=', 'user.user_id')
            // ->where('user.addpress',$rq->input('q'))->paginate(30);

            $doctors = Doctor::where('doctor_address', 'like', $rq->input('q'))->paginate(15);

            $q = urldecode($rq->input('q'));
            $user = Users::where('addpress', $rq->input('q'))->get();
            //$doctors = Doctor::where('user_id','like','%trung%')->paginate(30);

            //     $bs = Doctor::Join('user', 'doctor.user_id', '=', 'user.user_id')
            // ->where('user.addpress',$rq->input('q'))->count();
            $drugstores = $drugstores->paginate(30);
            $bs = Doctor::where('doctor_address', 'like', $rq->input('q'))->count();
            $drugstore = Drugstore::where('drugstore_address', 'like', '%' . $q . '%')->count();
            $qs = Question::where('question_title', 'like', '%' . $q . '%')->count();
            $service = \App\Service::where('service_name', 'like', '%' . $q . '%')->count();
            return view('v2/view/danhsach_nhathuoc', ['doctors' => $doctors, 'doctor' => $bs, 'question' => $qs, 'service' => $service, 'ads' => $ads, 'user' => $user, 'drugstore' => $drugstore, 'drugstores' => $drugstores])->withPost($drugstores);
        }


        $drugstores = $drugstores->paginate(30);
        return view('v2/view/danhsach_nhathuoc', ['drugstores' => $drugstores])->withPost($drugstores);
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

        return view('v2/view/chitiet_nhathuoc', ['cs' => $nhathuoc, 'vitri' => $vitri]);
    }

    public function contactUs()
    {
        return view('v2/view/contactUs');
    }

    public function disputeResolution()
    {
        return view('v2/view/dispute_resolution');
    }

    public function informationSecurityCustomer()
    {
        return view('v2/view/information_security');
    }

    public function chatDoc()
    {
        return view('v2/view/chat_doctor');
    }

    public function payment(Request $request)
    {
        if (!$request->session()->has('user')) {
            return redirect('/home');
        }
        $nlcheckout = new NL_CheckOutV3(MERCHANT_ID, MERCHANT_PASS, RECEIVER, URL_API);
        $total_amount = ($request->total_amount) ? $request->total_amount : 50000;

        if (@$_POST['nlpayment']) {
            $this->validate($request, [
                'total_amount' => 'required|numeric|in:10000, 50000,100000,200000',
                'option_payment' => 'required',
                'buyer_fullname' => 'required|string|max:255',
                'buyer_email' => 'required|string|email|max:255',
                'buyer_mobile' => 'required|string|max:255',
            ], [
                'total_amount.in' => "Giá trị tiền nạp không đúng!",
                'option_payment.required' => "Bạn chưa chọn phương thức thanh toán!",
                'buyer_fullname.required' => "Họ tên không được trống!",
                'buyer_email.required' => "E-mail không được trống!",
                'buyer_email.email' => "Bạn phải nhập đúng e-mail!",
                'buyer_mobile.required' => "Số điện thoại không được trống!",
            ]);

            $total_amount = $_POST['total_amount'];
            $array_items[0] = array(
                'item_name1' => 'Product name',
                'item_quantity1' => 1,
                'item_amount1' => $total_amount,
                'item_url1' => 'http://nganluong.vn/'
            );

            $array_items = array();
            $payment_method = $_POST['option_payment'];
            $bank_code = @$_POST['bankcode'];
            $order_code = "bsv_" . time();

            $payment_type = '';
            $discount_amount = 0;
            $order_description = '';
            $tax_amount = 0;
            $fee_shipping = 0;
            $return_url = route('ket-qua_nap-tien');
            $cancel_url = route('huy_nap-tien', ['orderid' => urlencode($order_code)]);

            $buyer_fullname = $_POST['buyer_fullname'];
            $buyer_email = $_POST['buyer_email'];
            $buyer_mobile = $_POST['buyer_mobile'];
            $buyer_address = 'bacsiviet.vn';

            if ($payment_method != '' && $buyer_email != "" && $buyer_mobile != "" && $buyer_fullname != "" && filter_var($buyer_email, FILTER_VALIDATE_EMAIL)) {
                if ($payment_method == "VISA") {
                    $nl_result = $nlcheckout->VisaCheckout($order_code, $total_amount, $payment_type, $order_description, $tax_amount,
                        $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile,
                        $buyer_address, $array_items, $bank_code);
                } elseif ($payment_method == "NL") {
                    $nl_result = $nlcheckout->NLCheckout($order_code, $total_amount, $payment_type, $order_description, $tax_amount,
                        $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile,
                        $buyer_address, $array_items);
                } elseif ($payment_method == "ATM_ONLINE" && $bank_code != '') {
                    $nl_result = $nlcheckout->BankCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount,
                        $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile,
                        $buyer_address, $array_items);
                } elseif ($payment_method == "NH_OFFLINE") {
                    $nl_result = $nlcheckout->officeBankCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);
                } elseif ($payment_method == "ATM_OFFLINE") {
                    $nl_result = $nlcheckout->BankOfflineCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);

                } elseif ($payment_method == "IB_ONLINE") {
                    $nl_result = $nlcheckout->IBCheckout($order_code, $total_amount, $bank_code, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items);
                } elseif ($payment_method == "CREDIT_CARD_PREPAID") {

                    $nl_result = $nlcheckout->PrepaidVisaCheckout($order_code, $total_amount, $payment_type, $order_description, $tax_amount, $fee_shipping, $discount_amount, $return_url, $cancel_url, $buyer_fullname, $buyer_email, $buyer_mobile, $buyer_address, $array_items, $bank_code);
                }

                //var_dump($nl_result); die;
                if ($nl_result->error_code == '00') {
                    //Cập nhât order với token  $nl_result->token để sử dụng check hoàn thành sau này
                    return redirect($nl_result->checkout_url);
                } else {
                    // echo $nl_result->error_message;
                }
            } else {
                // echo "<h3> Bạn chưa nhập đủ thông tin khách hàng </h3>";
            }
        }
        return view('v2/view/nap_tien', [
            'nlcheckout' => $nlcheckout,
            'total_amount' => $total_amount,
        ]);
    }

    /**
     * @link /nap-tien/{orderid}
     * @param String orderid
     */
    public function cancel(Request $request, $orderid)
    {
        return view('v2.view.order-cancel', [
            'orderid' => $orderid,
        ]);
    }

    /**
     * @link /nap-tien/ket-qua
     * @param String orderid
     */
    public function success(Request $request)
    {
        $result = "Kết quả thanh toán";
        if (empty($request->token)) {
            return redirect()->route('naptien');
        }

        $nlcheckout = new NL_CheckOutV3(MERCHANT_ID, MERCHANT_PASS, RECEIVER, URL_API);
        $nl_result = $nlcheckout->GetTransactionDetail($request->token);
        if ($nl_result) {
            $nl_errorcode = (string)$nl_result->error_code;
            $nl_transaction_status = (string)$nl_result->transaction_status;
            if ($nl_errorcode == '00') {
                if ($nl_transaction_status == '00') {
                    // trạng thái thanh toán thành công
                    $user_id = $request->session()->get('user')->user_id;
                    $user = \App\Users::where('user_id', $user_id)->first();
                    $user->paid = 1;
                    $user->balance += intval($nl_result->total_amount);

                    $patient = \App\Patient::where('email', $user->email)->first();
                    if ($patient == null) {
                        $user->createPatient();
                        $patient = \App\Patient::where('email', $user->email)->first();
                    }
                    $patient->balance += intval($nl_result->total_amount);
                    $patient->updated_at = new \DateTime();
                    if ($patient->save()) {
                        $patient->createRecharge(intval($nl_result->total_amount));
                        $unit = \App\Config::where('id', 2)->first();
                        $unit = (!empty($unit)) ? intval($unit->content) : 1000;
                        if($patient->balance > $unit) {
                            $patient->can_chat = 1;
                            $patient->can_call_audio = 1;
                            $patient->can_call_video = 1;
                            $patient->save();
                            $user->paid = 1;
                            $user->save();
                        }
                    };

                    $status = \App\Model\UserOrder::firstOrCreate([
                        'user_id' => $user_id,
                        'code' => strval($nl_result->order_code),
                        'money' => intval($nl_result->total_amount),
                        'token' => strval($nl_result->token),
                    ]);
                    if ($user->save() && $status) {
                        $result = "Thanh toán thành công!";
                    }
                }
            } else {
                $result = $nlcheckout->GetErrorMessage($nl_errorcode);
                return redirect()->route('naptien')->withErrors($result);
            }
        }
        return view('v2.view.order-success', [
            'result' => $result,
        ]);
    }

}

