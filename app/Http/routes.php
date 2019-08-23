<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
//facebook
Route::get('/facebook', 'Auth\AuthController@redirectToProvider');
Route::get('/facebook/callback', 'Auth\AuthController@handleProviderCallback');
//api
Route::get('/api/v0.1/article','ApiController@article');
Route::get('/api/v0.1/article/{id}','ApiController@articleWhereId');

Route::get('/api/v0.1/deals','ApiController@deals');
Route::get('/api/v0.1/deals/{id}','ApiController@dealsWhereId');

Route::get('/api/v0.1/doctor','ApiController@doctor');
Route::get('/api/v0.1/doctor/{id}','ApiController@doctorWhereId');

Route::get('/api/v0.1/clinic','ApiController@clinic');
Route::get('/api/v0.1/clinic/{id}','ApiController@clinicWhereId');

Route::get('/api/v0.1/service/{id}','ApiController@serviceWhereId');

Route::get('/api/v0.1/specialities/{id}','ApiController@specialitiesWhereId');

Route::get('/api/v0.1/question','ApiController@question');
Route::get('/api/v0.1/question/{id}','ApiController@questionWhereId');

Route::get('/api/v0.1/answers/{id}','ApiController@answersWhereId');
Route::get('/api/v0.1/answersWhere/{id}','ApiController@answersMainWhereId');

//thuốc
Route::get('/api/v0.1/medicine','ApiController@medicine');
Route::get('/api/v0.1/medicine/{id}','ApiController@medicineWhereId');

//bệnh
Route::get('/api/v0.1/disease','ApiController@disease');
Route::get('/api/v0.1/disease/{id}','ApiController@diseaseWhereId');

Route::get('/api/v0.1/user/{id}','ApiController@userWhereId');

Route::group(['prefix' => 'api/v0.1'], function () {
    // Route::post('/short', 'UrlMapperController@store');
    Route::post('/login', 'ApiController@login_api');
    Route::group(['middleware' => ['jwt.auth']], function (){
        Route::post('/dat-cau-hoi', 'ApiController@hoibacsiPost');
        Route::get('/get-cau-hoi', 'ApiController@getQuestion');
    });
});




//hunglam quen-mat-khau
Route::get('/ve-chung-toi', 'HomeController@aboutUs');
Route::get('/tuyen-dung', 'HomeController@recruitment');
Route::get('/lien-he', 'HomeController@contactUs');
Route::get('/quy-trinh-giai-quyet-tranh-chap', 'HomeController@disputeResolution');
Route::get('/chinh-sach-bao-mat-thong-tin-khach-hang', 'HomeController@informationSecurityCustomer');
Route::get('/quen-mat-khau', 'HomeController@resetPassword');
Route::get('/dang-xay-dung', 'HomeController@construction');
Route::get('/huong-dan-user', 'HomeController@userGuide');
Route::get('/huong-dan-bac-si', 'HomeController@professionalGuide');
Route::get('/huong-dan-phong-kham', 'HomeController@placeGuide');
Route::get('/vou-cher', 'HomeController@voucher');


//Route::get('/', 'HomeController@index');
Route::get('/co-so-y-te/{id}/{speciality}','ViewController@chitiet_csyt')->name('id');
Route::get('/co-so-y-te/{id}/','ViewController@chitiet_csyt')->name('id');
Route::get('/nha-thuoc/{id}/','HomeController@chitiet_nhathuoc')->name('id');

Route::get('/api/v1/search','ApiController@search');
Route::post('/api/district','ApiController@district');

Route::get('/messages', 'MessagesController@index');


Route::get('/dang-xuat','HomeController@dangxuat');
Route::get('/hoi-bac-si', 'HomeController@hoibacsi');

Route::post('/hoi-bac-si/dat-cau-hoi', 'HomeController@hoibacsiPost');
Route::get('/hoi-bac-si/{id}','HomeController@hoibacsiview')->name('id');
Route::post('/hoi-bac-si/{id}','HomeController@bacsitraloi')->name('tra-loi');
//Route::post('/hoi-bac-si/{id}','HomeController@test');

Route::get('/hoi-bac-si/tuyen-chon/{id}','HomeController@hoibacsi_tuyenchon')->name('id');
Route::get('/hoi-bac-si/tuyen-chon/{id}/{khoa}','HomeController@hoibacsi_tuyenchon')->name('id');
Route::get('/danh-sach/hoi-bac-si', 'HomeController@hoibacsi_danhsach');
//Route::get('/danh-sach/hoi-bac-si{speciality}', 'HomeController@hoibacsi_danhsach');
Route::post('/comment','ApiController@comment');
Route::post('/deal_comment','HomeController@dealcomment');
//Route::get('/bai-viet', 'HomeController@listbaiviet');
//Route::get('/bai-viet/{id}','HomeController@baivietdetail')->name('id');
//Route::get('bai-viet/chuyen-muc/{id}/{aslias}', 'HomeController@danhmuc');
//Route::get('/bai-viet', 'HomeController@get');

//Route::get('/bai-viet/{qid}','HomeController@chitietbaiviet')->name('qid');
//Route::get('/chuyen-muc/{qid}','HomeController@chuyenmuc')->name('qid');

Route::get('/benh/tim-kiem','HomeController@timkiem');

Route::get('/tim-kiem','HomeController@timkiem');

Route::get('/danh-sach','HomeController@danhsach_csyt');
Route::get('/danh-sach-nha-thuoc','HomeController@danhsach_nhathuoc');
Route::get('/danh-sach/bac-si','ViewController@viewDoctors');
Route::get('/danh-sach/bac-si/{id}/','ViewController@bacsi_detail')->name('id');
Route::get('/danh-sach/bac-si/{id}/{speciality}/','ViewController@bacsi_detail')->name('id');


Route::get('/chuyen-khoa','HomeController@chuyenkhoa');
Route::get('/chuyen-khoa/{id}/','HomeController@chuyenkhoadetail');
Route::post('/api/v1/{method}','ApiController@v1');
Route::post('/api/v1/professional/comment/create','ApiController@professionalcommentcreate');

Route::get('/dang-ky','HomeController@getdangky');
Route::post('/dang-ky','HomeController@postDangky');
Route::post('/dangkyapp','HomeController@postDangkyApp');
Route::post('/check/existphone','HomeController@checkPhoneExist');

// Thang add 20181110 start
Route::post('/cap-nhat-user','HomeController@postCapNhatApp');
// Thang add 20181110 end

Route::post('/infodoctor','HomeController@postInfoDoctor');

Route::get('/dang-nhap','HomeController@dangnhap');
Route::post('/dang-nhap-mobile','HomeController@postDangNhapMobile');

Route::post('/apiapp','HomeController@testMobile');

Route::post('/test-mobile','HomeController@testMobile');


//Route::post('/apiapp-mobile','HomeController@apiappMobile');

Route::post('/dang-nhap','HomeController@postDangnhap');
Route::post('/times-call','HomeController@timesCall');
Route::post('/times-call-v2','HomeController@timesCallV2');

//social login
Route::get('/redirect/{social}', 'Auth\LoginController@redirect');
Route::get('/callback/{social}', 'Auth\LoginController@callback');


//Route::get('/dang-xuat','HomeController@logout');

Route::get('/tai-khoan','HomeController@taikhoan');
Route::get('/tai-khoan/{method}','HomeController@taikhoan_method')->name('method');

Route::post('/tai-khoan/viet-bai','HomeController@vietbai');
Route::post('/tai-khoan/them-bac-si','HomeController@thembacsi');
Route::post('/tai-khoan/doi-mat-khau','HomeController@doimatkhau');
Route::post('/tai-khoan/them-csyt','HomeController@themcsyt');
Route::post('/tai-khoan/them-nha-thuoc','HomeController@themnhathuoc');

Route::get('/benh','HomeController@benh');
Route::get('/benh/{qid}','HomeController@chitietbenh')->name('qid');
Route::get('/thuoc','HomeController@thuoc');
Route::get('/thuoc/danh-sach','HomeController@thuoc');
Route::get('/thuoc/{qid}','HomeController@chitietthuoc')->name('qid');

Route::get('/khuyen-mai','HomeController@khuyenmai');
Route::get('/khuyen-mai/{url}','HomeController@khuyenmaidetail')->name('url');
Route::post('/apilistkhuyenmai', 'HomeController@listkhuyenmai');

//
Route::get('bai-viet/chuyen-muc/{id}/{aslias}', 'HomeController@danhmuc');
Route::get('/bai-viet','HomeController@get');

Route::get('/bai-viet/{qid}','HomeController@chitietbaiviet')->name('qid');
Route::get('/chuyen-muc/{qid}','HomeController@chuyenmuc')->name('qid');

//-- #vngocvan
//-- Submit comment in article
//Route::post('/comment_article/{url}','ApiController@comment_article')->name('url');
Route::post('/comment_article/{url}','HomeController@comment')->name('url');
Route::post('/comment_doctor/{url}','HomeController@commentdoctor')->name('url');
Route::post('/comment_clinic/{url}','HomeController@commentclinic')->name('url');
Route::auth();

//Route::get('/home', 'HomeController@index');

Route::get('/event', 'MessagesController@indexEvent');

Route::get('/test',function()
{
    event(new App\Events\MessagesEvent());
    return "event fired";
});
//Route::post('/apiappfacebook','HomeController@LoginFaceb/danh-sachookMobile');
Route::post('/apiappfacebook','HomeController@loginface');
Route::post('/check-account-exist','HomeController@checkAccountExist');

Route::get('/sale','HomeController@sale_ads');


//Route::get('/nap-tien',				'NganLuongController@payment')->name('naptien');
//Route::get('/nap-tien/{orderid}',	'NganLuongController@cancel')->name('huy_naptien');
//Route::get('/ket-qua',				'NganLuongController@success')->name('ketqua_naptien');

//Route::post('/nap-tien',			'NganLuongController@payment')->name('naptien');
//Route::post('/nap-tien/{orderid}',	'NganLuongController@cancel')->name('huy_naptien');
//Route::post('/ket-qua',				'NganLuongController@success')->name('ketqua_naptien');

// Thắng add 20181107
Route::post("/kiem-tra-vi-tien",     'NganLuongController@kiemtravitien');
Route::post("/nap-tien-vao-vi",      'NganLuongController@naptienvaovi');
Route::post("/lich-su-nap-tien",     'NganLuongController@lichsunaptien');
Route::get("/test-api",              'HomeController@testapi');
Route::post("/test-post-api",        'HomeController@testpostapi');
Route::get('/dangnhapcongtac',       'HomeController@collaborators_login');
Route::post('/dangnhapcongtac',      'HomeController@collaborators_post_login');
    Route::get('/congtacvien/danhsach',  'HomeController@collaborators_danhsach');
Route::get('/congtacvien/thoigiandung',  'HomeController@collaborators_danhsach_thoigiandung');
Route::get('/congtacvien/dangky',    'HomeController@collaborators_dangky');

Route::post('/vi-tri/get',            'HomeController@getLocation');
Route::post('/vi-tri/set',            'HomeController@setLocation');
Route::post('/vi-tri/timkiem',        'HomeController@searchDistance');


Route::post('/api/chuyen-khoa',             'HomeController@apiChuyenKhoa');
Route::post('/api/danh-sach/bac-si',        'HomeController@apiDanhSachBacSi');
Route::post('/api/danh-sach/phong-kham',    'HomeController@apiDanhSachPhongKham');
Route::post('/api/doi-mat-khau',            'HomeController@apiDoiMatKhau');
Route::post('/api/danh-sach/tinh-thanh',    'HomeController@apiDanhSachTinhThanh');

Route::get('/api/update/version',    'HomeController@apiVersion');
Route::post('/api/thanh-toan-tin-nhan',    'HomeController@thanhToanTinNhan');

////////////////////////////////////////////// v2 ///////////////////////////////////////////////////////
Route::post('/v2/dang-nhap', 'ViewController@postDangnhap');
Route::post('/v2/dang-ky', 'ViewController@postDangky');
Route::get('/dangxuat','ViewController@dangxuat');

Route::get('/', 'ViewController@index');
Route::get('/home', 'ViewController@index');

Route::get('/danh-sach-bac-si', 'ViewController@viewDoctors');
Route::get('/danh-sach-bac-si-chi-tiet/{url}', 'ViewController@bacsi_detail');
Route::get('/danh-sach-bac-si-chi-tiet/{url}/{speciality}/','ViewController@bacsi_detail');

Route::get('/thuoc-danhsach','ViewController@danhsach_thuoc');
Route::get('/thuoc-chitiet/{id}','ViewController@chitietthuoc');

Route::get('/danhsach-phongkham','ViewController@danhsach_csyt');
Route::get('/phongkham-chitiet/{id}/','ViewController@chitiet_csyt');
Route::get('/phongkham-chitiet/{id}/{speciality}','ViewController@chitiet_csyt');

Route::get('/tim-kiem','ViewController@timkiem');

Route::get('/benh','ViewController@benh');
Route::get('/benh/tim-kiem','ViewController@timkiem');
Route::get('/benh/{qid}','ViewController@chitietbenh');

Route::get('/baiviet','ViewController@baiviet');
Route::get('/baiviet/{qid}','ViewController@chitietbaiviet');
Route::get('/chuyenmuc/{qid}','ViewController@chuyenmuc');

Route::post('/hoibacsi/datcauhoi', 'ViewController@hoibacsiPost');
Route::get('/hoibacsi', 'ViewController@hoibacsi');
Route::get('/hoibacsi/tuyenchon/{id}','ViewController@hoibacsi_tuyenchon');
Route::get('/hoibacsi/{id}','ViewController@hoibacsiview');
Route::post('/hoibacsi/{id}','ViewController@bacsitraloi');
Route::get('/chuyenkhoa','ViewController@chuyenkhoa');
Route::get('/chuyenkhoa/{id}/','ViewController@chuyenkhoadetail');

Route::get('/danh-sach-nha-thuoc','ViewController@danhsach_nhathuoc');
Route::get('/nha-thuoc/{id}/','ViewController@chitiet_nhathuoc');

Route::get('/vechungtoi', 'ViewController@aboutUs');

Route::get('/khuyenmai','ViewController@khuyenmai');
Route::get('/khuyenmai/{url}','ViewController@khuyenmaidetail');

Route::get('/taikhoan','ViewController@taikhoan');
Route::get('/taikhoan/{method}','ViewController@taikhoan_method');
Route::post('/taikhoan/doimatkhau','ViewController@doimatkhau');
Route::post('/taikhoan/thembacsi','ViewController@thembacsi');
Route::post('/taikhoan/themcsyt','ViewController@themcsyt');
Route::post('/taikhoan/themnhathuoc','ViewController@themnhathuoc');
Route::post('/taikhoan/vietbai','ViewController@vietbai');
Route::post('/taikhoan/admin-recharge-update','ViewController@update_balance');

Route::get('/naptien','ViewController@payment')->name('naptien');
Route::get('/nap-tien/{orderid}',	'ViewController@cancel')->name('huy_nap-tien');
Route::get('/ket-qua',				'ViewController@success')->name('ket-qua_nap-tien');

Route::post('/naptien','ViewController@payment')->name('naptien');
Route::post('/nap-tien/{orderid}',	'ViewController@cancel')->name('huy_naptien');
Route::post('/ket-qua',				'ViewController@success')->name('ketqua_naptien');

Route::get('/lienhe', 'ViewController@contactUs');
Route::get('/quytrinh-giaiquyet-tranhchap', 'ViewController@disputeResolution');
Route::get('/chinhsach-baomat-thongtin-khachhang', 'ViewController@informationSecurityCustomer');

Route::get('/chat','ViewController@chatDoc');
Route::get('/recharge','ViewController@recharge');
//////////////////////////////////////// Route En /////////////////////////////////////////////

Route::get('/en', 'en_ViewController@index');

Route::post('/en/dang-nhap', 'en_ViewController@postDangnhap');
Route::post('/en/dang-ky', 'en_ViewController@postDangky');
Route::get('/en/dangxuat','en_ViewController@dangxuat');

Route::get('/en/danh-sach-bac-si', 'en_ViewController@viewDoctors');
Route::get('/en/danh-sach-bac-si-chi-tiet/{url}', 'en_ViewController@bacsi_detail');
Route::get('/en/danh-sach-bac-si-chi-tiet/{url}/{speciality}/','en_ViewController@bacsi_detail');

Route::get('/en/danhsach-phongkham','en_ViewController@danhsach_csyt');
Route::get('/en/phongkham-chitiet/{id}/','en_ViewController@chitiet_csyt');
Route::get('/en/phongkham-chitiet/{id}/{speciality}','en_ViewController@chitiet_csyt');

Route::get('/en/benh','en_ViewController@benh');
Route::get('/en/benh/tim-kiem','en_ViewController@timkiem');
Route::get('/en/benh/{qid}','en_ViewController@chitietbenh');

Route::get('/en/thuoc-danhsach','en_ViewController@danhsach_thuoc');
Route::get('/en/thuoc-chitiet/{id}','en_ViewController@chitietthuoc');

Route::get('/en/danh-sach-nha-thuoc','en_ViewController@danhsach_nhathuoc');
Route::get('/en/nha-thuoc/{id}/','en_ViewController@chitiet_nhathuoc');

Route::post('/en/hoibacsi/datcauhoi', 'en_ViewController@hoibacsiPost');
Route::get('/en/hoibacsi', 'en_ViewController@hoibacsi');
Route::get('/en/hoibacsi/tuyenchon/{id}','en_ViewController@hoibacsi_tuyenchon');
Route::get('/en/hoibacsi/{id}','en_ViewController@hoibacsiview');
Route::post('/en/hoibacsi/{id}','en_ViewController@bacsitraloi');
Route::get('/en/chuyenkhoa','en_ViewController@chuyenkhoa');
Route::get('/en/chuyenkhoa/{id}/','en_ViewController@chuyenkhoadetail');

Route::get('/en/baiviet','en_ViewController@baiviet');
Route::get('/en/baiviet/{qid}','en_ViewController@chitietbaiviet');
Route::get('/en/chuyenmuc/{qid}','en_ViewController@chuyenmuc');

Route::get('/en/vechungtoi', 'en_ViewController@aboutUs');

Route::get('/en/khuyenmai','en_ViewController@khuyenmai');
Route::get('/en/khuyenmai/{url}','en_ViewController@khuyenmaidetail');

Route::get('/en/taikhoan','en_ViewController@taikhoan');
Route::get('/en/taikhoan/{method}','en_ViewController@taikhoan_method');
Route::post('/en/taikhoan/doimatkhau','en_ViewController@doimatkhau');
Route::post('/en/taikhoan/thembacsi','en_ViewController@thembacsi');
Route::post('/en/taikhoan/themcsyt','en_ViewController@themcsyt');
Route::post('/en/taikhoan/themnhathuoc','en_ViewController@themnhathuoc');
Route::post('/en/taikhoan/vietbai','en_ViewController@vietbai');

Route::get('/en/naptien','en_ViewController@payment')->name('en-naptien');
Route::get('/en/naptien/{orderid}',	'en_ViewController@cancel')->name('en-huy_nap-tien');
Route::get('/en/ket-qua',				'en_ViewController@success')->name('en-ket-qua_nap-tien');

Route::post('/en/naptien','en_ViewController@payment')->name('en-naptien');
Route::post('/en/naptien/{orderid}',	'en_ViewController@cancel')->name('en-huy_nap-tien');
Route::post('/en/ket-qua',				'en_ViewController@success')->name('en-ket-qua_nap-tien');

Route::post('/naptien','ViewController@payment')->name('nap-tien');
Route::post('/nap-tien/{orderid}',	'ViewController@cancel')->name('huy_naptien');
Route::post('/ket-qua',				'ViewController@success')->name('ketqua_naptien');

Route::get('/en/tim-kiem','en_ViewController@timkiem');

Route::get('/en/lienhe', 'en_ViewController@contactUs');
Route::get('/en/quytrinh-giaiquyet-tranhchap', 'en_ViewController@disputeResolution');
Route::get('/en/chinhsach-baomat-thongtin-khachhang', 'en_ViewController@informationSecurityCustomer');

Route::get('/en/chat','en_ViewController@chatDoc');
Route::get('/en/recharge','en_ViewController@recharge');
