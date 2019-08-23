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


//api
Route::get('/api/v0.1/article','ApiController@article');
Route::get('/api/v0.1/deals','ApiController@deals');
Route::get('/api/v0.1/doctor','ApiController@doctor');
Route::get('/api/v0.1/clinic','ApiController@clinic');
Route::get('/api/v0.1/clinic/{id}','ApiController@clinicWhereId');
Route::get('/api/v0.1/service/{id}','ApiController@serviceWhereId');
Route::get('/api/v0.1/specialities/{id}','ApiController@specialitiesWhereId');


Route::get('/api/v0.1/question','ApiController@question');
Route::get('/api/v0.1/question/{id}','ApiController@questionWhereId');
Route::get('/api/v0.1/answers/{id}','ApiController@answersWhereId');
Route::get('/api/v0.1/answersWhere/{id}','ApiController@answersMainWhereId');


Route::get('/', 'HomeController@index');
Route::get('/co-so-y-te/{id}/{speciality}','HomeController@chitiet_csyt')->name('id');
Route::get('/co-so-y-te/{id}/','HomeController@chitiet_csyt')->name('id');

Route::get('/api/v1/search','ApiController@search');
Route::post('/api/district','ApiController@district');


Route::get('/dang-xuat','HomeController@dangxuat');
Route::get('/hoi-bac-si', 'HomeController@hoibacsi');
Route::post('/hoi-bac-si/dat-cau-hoi', 'HomeController@hoibacsiPost');
Route::get('/hoi-bac-si/{id}','HomeController@hoibacsiview')->name('id');
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
Route::get('/danh-sach/bac-si','HomeController@bacsi_danhsach');
Route::get('/danh-sach/bac-si/{id}/','HomeController@bacsi_detail')->name('id');
Route::get('/danh-sach/bac-si/{id}/{speciality}/','HomeController@bacsi_detail')->name('id');

Route::get('/chuyen-khoa','HomeController@chuyenkhoa');
Route::get('/chuyen-khoa/{id}/','HomeController@chuyenkhoadetail');
Route::post('/api/v1/{method}','ApiController@v1');
Route::post('/api/v1/professional/comment/create','ApiController@professionalcommentcreate');
Route::get('/dang-ky','HomeController@dangky');
Route::post('/dang-ky','HomeController@postDangky');

Route::get('/dang-nhap','HomeController@dangnhap');
Route::post('/dang-nhap','HomeController@postDangnhap');

//social login
Route::get('/redirect/{social}', 'Auth\LoginController@redirect');
Route::get('/callback/{social}', 'Auth\LoginController@callback');


Route::get('/dang-xuat','HomeController@logout');

Route::get('/tai-khoan','HomeController@taikhoan');
Route::get('/tai-khoan/{method}','HomeController@taikhoan_method')->name('method');

Route::post('/tai-khoan/viet-bai','HomeController@vietbai');
Route::post('/tai-khoan/them-bac-si','HomeController@thembacsi');
Route::post('/tai-khoan/doi-mat-khau','HomeController@doimatkhau');
Route::post('/tai-khoan/them-csyt','HomeController@themcsyt');

Route::get('/benh','HomeController@benh');
Route::get('/benh/{qid}','HomeController@chitietbenh')->name('qid');
Route::get('/thuoc','HomeController@thuoc');
Route::get('/thuoc/danh-sach','HomeController@thuoc');
Route::get('/thuoc/{qid}','HomeController@chitietthuoc')->name('qid');

Route::get('/khuyen-mai','HomeController@khuyenmai');
Route::get('/khuyen-mai/{url}','HomeController@khuyenmaidetail')->name('url');

//
Route::get('bai-viet/chuyen-muc/{id}/{aslias}', 'HomeController@danhmuc');
Route::get('/bai-viet','HomeController@get');

Route::get('/bai-viet/{qid}','HomeController@chitietbaiviet')->name('qid');
Route::get('/chuyen-muc/{qid}','HomeController@chuyenmuc')->name('qid');

//-- #vngocvan
//-- Submit comment in article
Route::post('/comment_article/{url}','ApiController@comment_article')->name('url');
Route::auth();

Route::get('/home', 'HomeController@index');
