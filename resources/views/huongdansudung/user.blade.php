@extends('main',['title'=> 'Hướng dẫn sử dụng user'])
@section('content')
<div id="main">
    <div class="position" id="list-cms">
        <div class="content">
            <ul class="cms-breadcrumb homepage-breadcrumb">
                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="/" itemprop="url"><span itemprop="title">Trang chủ</span></a> \
                </li>
                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="#" itemprop="url"><span itemprop="title">Hướng dẫn sử dụng user</span></a>
                </li>
            </ul>

            <div class="top-new" style="margin-left: 15%;">
                    <h2 style="text-align: center;">Hướng dẫn sử dụng cho người dùng</h2>
                    <h3>1. Đăng ký tài khoản</h3>
                    <h4>Vào <a href="https://medixlink.com/">www.medixlink.com</a> rồi chọn đăng ký như hình</h4>
                    <div>
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/user/1.jpg')!!}">
                    </div>
                    <h3>2. Gởi câu hỏi cho bác sĩ trả lời</h3>
                    <h4>Tiến hành đăng nhập rồi Kéo xuống rồi chọn mục gởi câu hỏi</h4>
                    <div>
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/user/2.jpg')!!}">
                    </div>
                    <h4>Rồi viết câu hỏi, chọn chuyên khoa</h4>
                    <div>
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/user/3.jpg')!!}">
                    </div>
                    <h4>Rồi vào mục câu hỏi của rồi để xem lịch sử câu hởi của mình</h4>
                    <div>
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/user/4.jpg')!!}">
                    </div>
                    <h3>3.  Chức năng chat trực tiếp với bác sĩ</h3>
                    <h4>Login vào tài khoản của mình rồi vào menu Chat bác si</h4>
                    <div>
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/user/5.jpg')!!}">
                    </div>
                    <h3>4.  Chat voice trực  tiếp với bác sĩ</h3>
                    <h4>a.  Vào play store tìm từ khóa app: <a href="C:\Users\Admin\Downloads\psdtowebbangdichvuRecoveredRecovered"> bacsiviet</a></h4>
                    <div>
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/user/6.jpg')!!}">
                    </div>
                    <h4>b. Cài vào điện thoại rồi chọn bác sĩ cùng chuyền khoa muốn chat text hay voice/audio hay video webcam trực tiếp</h4>
                    <div style="width: 50%">
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/user/7.jpg')!!}">
                    </div>
                      <h3>5. Vào coi lịch sử chat với các bác sĩ ở đây</h3>
                    <div style="width: 50%">  
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/user/8.png')!!}">
                    </div>
            </div>
        </div>
    </div>
            
</div>
@endsection