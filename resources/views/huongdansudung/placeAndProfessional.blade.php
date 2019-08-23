@extends('main',['title'=> 'Hướng dẫn sử dụng'])
@section('content')
<div id="main">
    <div class="position" id="list-cms">
        <div class="content">
            <ul class="cms-breadcrumb homepage-breadcrumb">
                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="/" itemprop="url"><span itemprop="title">Trang chủ</span></a> \
                </li>
                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="#" itemprop="url"><span itemprop="title">Hướng dẫn sử dụng</span></a>
                </li>
            </ul>

            <div class="top-new" style="margin-left: 15%;">
                    <h2 style="text-align: center;">Hướng dẫn sử dụng cho bác sĩ</h2>
                    <h3>1. Đăng ký tài khoản</h3>
                    <h4>Vào <a href="https://medixlink.com/">www.medixlink.com</a> rồi chọn đăng ký như hình</h4>
                    <div>
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/bacsi_phongkham/1.jpg')!!}">
                    </div>
                    <h3>2. Trả lời câu hỏi cho bệnh nhân hỏi</h3>
                    <h4>Tiến hành đăng nhập rồi Kéo xuống rồi chọn mục gởi câu hỏi của tôi</h4>
                    <div>
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/bacsi_phongkham/2.jpg')!!}">
                    </div>
                    <h4>Rồi vào mục câu hỏi của tôi để xem lịch sử câu hỏi của mình</h4>
                    <div>
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/bacsi_phongkham/3.jpg')!!}">
                    </div>
                    <h4>Rồi viết câu trả lời</h4>
                    <div>
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/bacsi_phongkham/4.jpg')!!}">
                    </div>
                    <h3>3.  Chức năng chat trực tiếp với bệnh nhân</h3>
                    <h4>Login vào tài khoản của mình rồi vào menu Chat bác sĩ</h4>
                    <h4>Trong đó bệnh nhân sẽ thấy bác sĩ đang rảnh ở trạnh thái online sẽ chat</h4>
                    <div>
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/bacsi_phongkham/5.jpg')!!}">
                    </div>
                    <h3>4.  Chat voice trực  tiếp với bệnh nhân</h3>
                    <h4>a.  Vào play store tìm từ khóa app: <a href="https://play.google.com/store/apps/details?id=com.app.khambenh.bacsiviet">bacsiviet</a></h4>
                    <div>
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/bacsi_phongkham/6.jpg')!!}">
                    </div>
                    <h4>b. Cài vào điện thoại rồi rảnh thì login ,bệnh nhân sẽ thấy bác sĩ và chuyên khoa họ cần rồi hõe  chọn bác sĩ cùng chuyền khoa muốn chat text hay voice/audio hay video webcam trực tiếp</h4>
                    <div style="width: 50%">
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/bacsi_phongkham/7.jpg')!!}">
                    </div>
                    <h3>5. vào đây để xem bệnh nhân muốn chat trực tiếp với mình và coi lịch sử chat</h3>
                    <div style="width: 50%">
                        <img style="width: 60%;" src="{!!url('public/images/huongdansudung/bacsi_phongkham/8.png')!!}">
                    </div>
            </div>
        </div>
    </div>
            
</div>
@endsection