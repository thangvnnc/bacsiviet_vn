@extends('main',['title'=> 'Về chúng tôi'])
@section('content')
<div id="main">
	<div class="position" id="list-cms">
        <div class="content">
            <ul class="cms-breadcrumb homepage-breadcrumb">
                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="/" itemprop="url"><span itemprop="title">Trang chủ</span></a> \
                </li>
                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="#" itemprop="url"><span itemprop="title">Về chúng tôi</span></a>
                </li>
            </ul>

            <div class="top-new">
                
                    <p>Chúng tôi là những bác sĩ nhiều kinh nghiệm, chúng tôi phục vụ người bệnh mọi lúc mọi nơi. <a href="https://medixlink.com/">medixlink.com</a>  là công ty công nghệ với mong muốn sẽ xây dựng được một hệ thống chăm sóc sức khỏe toàn diện thông qua ứng dụng trên điện thoại và web. Ứng dụng BacsiViet trên smartphone / tablet phiên bản Android và IOS cung cấp dịch vụ chăm sóc sức khỏe chủ động đầu tiên tại Việt Nam. Dựa trên nền tảng công nghệ thông tin, ứng dụng BacsiViet giúp kết nối người dùng và Bác Sĩ dễ dàng ở mọi lúc, mọi nơi. Người dùng có thể sử dụng ứng dụng để được tư vấn sức khỏe, tra cứu thuốc & phòng khám, cùng các dịch vụ sức khỏe khác.</p>



                    <br/>

                    <h2>ĐỘI NGŨ SÁNG LẬP VÀ NGƯỜI LÃNH ĐẠO</h2>
                 
                    <div style="clear: both;"></div>
                    <br />
                    <br />

                    <div class="media" id="leader" style="position:relative;margin-left:30px;">
                        
                        <h2 style="color: #2fa4e7;">1.  NGUYỄN VỸ PHƯƠNG </h2>
                        <img style="float:left;border-radius: 100px;margin-right:30px;" src="../public/images/aboutUs/nguyenvyphuong.jpg" alt="Sunil Shroff" width="200" height="300"> 
                        <p style='float:left;position: absolute;top:100px;left:250px;'>
                            <b style="font-size:18px;">Chức danh:</b> <b style="font-size:18px; color: #2fa4e7;">CHỦ TỊCH HỘI ĐỒNG QUẢN TRỊ  </b> 
                            <br><br>
                            <b style="font-size:18px;">Chuyên môn:</b> <b style="font-size:18px; color: #2fa4e7;">DƯỢC SỸ </b>                     
                            <br><br>
                            <b style="font-size:18px;">Trường đào tạo:</b> <b style="font-size:18px; color: #2fa4e7;"> ĐẠI HỌC IDAHO STATE  UNIVERSITY USA </b>
                         </p>
                    </div>
                    <div style="clear: both;"></div>
                    <br />
                    <br />

                    <div class="media" id="leader" style="position:relative;margin-left:30px;">
                        
                        <h2 style="color: #2fa4e7;">2.  ĐỖ KHẮC THẠNH </h2>
                        <img style="float:left;border-radius: 100px;margin-right:30px;" src="../public/images/aboutUs/HinhAnhThanhDo.JPG" alt="Sunil Shroff" width="200" height="300"> 
                        <p style='float:left;position: absolute;top:100px;left:250px;'>
                            <b style="font-size:18px;">Chức danh:</b> <b style="font-size:18px; color: #2fa4e7;">GIÁM ĐỐC  </b> 
                            <br><br>
                            <b style="font-size:18px;">Chuyên môn:</b> <b style="font-size:18px; color: #2fa4e7;">THẠC SĨ CÔNG NGHỆ THÔNG TIN </b>                     
                            <br><br>
                            <b style="font-size:18px;">Trường đào tạo:</b> <b style="font-size:18px; color: #2fa4e7;"> ĐẠI HỌC BÁCH KHOA HCM</b>
                         </p>
                    </div>
                    <div style="clear: both;"></div>
                    <br />
                    <br />

                    <!-- <div class="media" id="leader" style="position:relative;margin-left:30px;">
                        
                        <h2 style="color: #2fa4e7;">3.  NGUYỄN THỊ GIÁC TOÀN</h2>
                        <img style="float:left;border-radius: 100px;margin-right:30px;" src="../public/images/aboutUs/giactoan.jpg" alt="Sunil Shroff" width="200" height="300"> 
                        <p style='float:left;position: absolute;top:100px;left:250px;'>
                            <b style="font-size:18px;">Chức danh:</b> <b style="font-size:18px; color: #2fa4e7;">GIÁM ĐỐC MARKETING </b> 
                            <br><br>
                            <b style="font-size:18px;">Chuyên môn:</b> <b style="font-size:18px; color: #2fa4e7;">TỐT NGHIỆP KHOA QUẢN TRỊ KINH DOANH ĐẠI HỌC NGOẠI THƯƠNG </b>                     
                            <br><br>
                            <b style="font-size:18px;">Trường đào tạo:</b> <b style="font-size:18px; color: #2fa4e7;"> ĐẠI HỌC NGOẠI THƯƠNG HCM</b>
                         </p>
                    </div> -->
                    <div class="media" id="leader" style="position:relative;margin-left:30px;">
                        
                        <h2 style="color: #2fa4e7;">3. LƯU THU QUANG</h2>
                        <img style="float:left;border-radius: 100px;margin-right:30px;" src="../public/images/aboutUs/luuthuquang.jpg" alt="Sunil Shroff" width="200" height="300"> 
                        <p style='float:left;position: absolute;top:100px;left:250px;'>
                            <b style="font-size:18px;">Chức danh:</b> <b style="font-size:18px; color: #2fa4e7;">GIÁM ĐỐC TÀI CHÍNH </b> 
                            <br><br>
                            <b style="font-size:18px;">Chuyên môn:</b> <b style="font-size:18px; color: #2fa4e7;">
                            	TIẾN SĨ TÀI CHÍNH, GIẢNG VIÊN ĐẠI HỌC NGÂN HÀNG HCM
                            </b>                     
                            <br><br>
                            <b style="font-size:18px;">Trường đào tạo:</b> <b style="font-size:18px; color: #2fa4e7;"> Feng Chia University</b>
                         </p>
                    </div>
                    <div style="clear: both;"></div>
                    <br />
                    <br />
                    <br />

                    
                    <h4>1.  Mục tiêu</h4>
                    <p>Ước muốn của chúng tôi là đem công nghệ để phục vụ người bệnh. Tình trạng quá tải bệnh viện hiện nay thật vất vả cho người dân việt nam. Chúng tôi muốn cải thiện điều này</p>
                    <div>
                        <img style="width: 60%;" src="{!!url('public/images/bacsiviet/aboutus/1.jpg')!!}">
                    </div>
                    <p>Bây giờ người bệnh có thể tương tác với bác sĩ trực tiếp mọi lúc mọi nơi</p>
                    <h4>2.  Văn hóa tại <a href="https://medixlink.com/">www.medixlink.com</a></h4>
                    <p>Chúng tôi là mô hình công bằng với hệ thống tổ chức phẳng, chúng tôi tôn trọng chuyên môn của các bác sĩ giỏi, nhiều kinh nghiệm và tâm huyết với nghề. Chúng tôi luôn tôn trọng người dùng là bệnh nhân. Với chúng tôi bệnh nhân chính là đối tượng được phục vụ, là trung tâm của hệ thống</p>
                    <div>
                        <img style="width: 60%;" src="{!!url('public/images/bacsiviet/aboutus/2.jpg')!!}">
                    </div>
                
            </div>
        </div>
    </div>
			
</div>
<style type="text/css">
    @media only screen and (max-width: 768px){
        #leader p{
            position: relative !important;
            left: 0 !important;
             top: 50px !important;
            margin-bottom: 150px;
        } 
    } 
</style>
@endsection