@extends('v2/structor/main',['title'=> 'Về chúng tôi'])
@section('content')
<div class="main-A">
	<div class="abu-cnt">
		<div id="top">
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="/">Về chúng tôi</a></li>
                    </ul> 
                    
                </div>
            </div> 
	    </div><!-- #top -->
	    <div class="global-thread-create-cta">
	        <a href="/hoibacsi/datcauhoi/" class="button">
	            <i class="fa fa-question-circle" aria-hidden="true"></i>
	            <strong>Hỏi bác sĩ</strong>
	            <span>miễn phí</span>
	        </a>
	    </div>
	    <div class="top-new">
                
                    <p style="font-size: 16px;">Chúng tôi là những bác sĩ nhiều kinh nghiệm, chúng tôi phục vụ người bệnh mọi lúc mọi nơi. <a style="font-size: 16px; color: #2b96cc;" href="https://medixlink.com/">medixlink.com</a>  là công ty công nghệ với mong muốn sẽ xây dựng được một hệ thống chăm sóc sức khỏe toàn diện thông qua ứng dụng trên điện thoại và web. Ứng dụng medix trên smartphone / tablet phiên bản Android và IOS cung cấp dịch vụ chăm sóc sức khỏe chủ động đầu tiên tại Việt Nam. Dựa trên nền tảng công nghệ thông tin, ứng dụng medix giúp kết nối người dùng và Bác Sĩ dễ dàng ở mọi lúc, mọi nơi. Người dùng có thể sử dụng ứng dụng để được tư vấn sức khỏe, tra cứu thuốc & phòng khám, cùng các dịch vụ sức khỏe khác.</p>



                    <br/>

                    <h2>ĐỘI NGŨ SÁNG LẬP VÀ NGƯỜI LÃNH ĐẠO</h2>
                 
               
                    <br />
                    <br />

                    <div class="media" id="leader" >
                        
                        <h2 >1.  NGUYỄN VỸ PHƯƠNG </h2>
                        <img  src="../public/images/aboutUs/nguyenvyphuong.jpg" alt="Sunil Shroff" > 
                        <p >
                            <b class="cl-b">Chức danh:</b> <b >CHỦ TỊCH HỘI ĐỒNG QUẢN TRỊ  </b> 
                            <br><br>
                            <b class="cl-b">Chuyên môn:</b> <b >DƯỢC SỸ </b>                     
                            <br><br>
                            <b class="cl-b">Trường đào tạo:</b> <b > ĐẠI HỌC IDAHO STATE  UNIVERSITY USA </b>
                         </p>
                    </div>
                   
                    <br />
                    <br />

                    <div class="media" id="leader" >
                        
                        <h2 >2.  ĐỖ KHẮC THẠNH </h2>
                        <img  src="../public/images/aboutUs/HinhAnhThanhDo.JPG" alt="Sunil Shroff" > 
                        <p >
                            <b class="cl-b">Chức danh:</b> <b >GIÁM ĐỐC  </b> 
                            <br><br>
                            <b class="cl-b">Chuyên môn:</b> <b >THẠC SĨ CÔNG NGHỆ THÔNG TIN </b>                     
                            <br><br>
                            <b class="cl-b">Trường đào tạo:</b> <b > ĐẠI HỌC BÁCH KHOA HCM</b>
                         </p>
                    </div>
                   
                    <br />
                    <br />

                    <!-- <div class="media" id="leader" style="position:relative;margin-left:30px;">
                        
                        <h2 style="color: #2fa4e7;">3.  NGUYỄN THỊ GIÁC TOÀN</h2>
                        <img  src="../public/images/aboutUs/giactoan.jpg" alt="Sunil Shroff" width="200" height="300"> 
                        <p >
                            <b >Chức danh:</b> <b >GIÁM ĐỐC MARKETING </b> 
                            <br><br>
                            <b >Chuyên môn:</b> <b >TỐT NGHIỆP KHOA QUẢN TRỊ KINH DOANH ĐẠI HỌC NGOẠI THƯƠNG </b>                     
                            <br><br>
                            <b >Trường đào tạo:</b> <b > ĐẠI HỌC NGOẠI THƯƠNG HCM</b>
                         </p>
                    </div> -->
                    <div class="media" id="leader">
                        
                        <h2 >3. LƯU THU QUANG</h2>
                        <img  src="../public/images/aboutUs/luuthuquang.jpg" alt="Sunil Shroff"> 
                        <p >
                            <b class="cl-b">Chức danh:</b> <b >GIÁM ĐỐC TÀI CHÍNH </b> 
                            <br><br>
                            <b class="cl-b">Chuyên môn:</b> <b >
                            	TIẾN SĨ TÀI CHÍNH, GIẢNG VIÊN ĐẠI HỌC NGÂN HÀNG HCM
                            </b>                     
                            <br><br>
                            <b class="cl-b">Trường đào tạo:</b> <b > Feng Chia University</b>
                         </p>
                    </div>
                    <div style="clear: both;"></div>
                    <br />
                    <br />
                    <br />

                    
                    <h4 class="h4-abu">1.  Mục tiêu</h4>
                    <p class="p-abu">Ước muốn của chúng tôi là đem công nghệ để phục vụ người bệnh. Tình trạng quá tải bệnh viện hiện nay thật vất vả cho người dân việt nam. Chúng tôi muốn cải thiện điều này</p>
                    <div class="div-abu">
                        <img style="width: 60%;" src="{!!url('public/images/bacsiviet/aboutus/1.jpg')!!}">
                    </div>
                    <p>Bây giờ người bệnh có thể tương tác với bác sĩ trực tiếp mọi lúc mọi nơi</p>
                    <br>
                    <h4 class="h4-abu">2.  Văn hóa tại <a class="link-p" href="https://medixlink.com/">www.medixlink.com</a></h4>
                    <p class="p-abu">Chúng tôi là mô hình công bằng với hệ thống tổ chức phẳng, chúng tôi tôn trọng chuyên môn của các bác sĩ giỏi, nhiều kinh nghiệm và tâm huyết với nghề. Chúng tôi luôn tôn trọng người dùng là bệnh nhân. Với chúng tôi bệnh nhân chính là đối tượng được phục vụ, là trung tâm của hệ thống</p>
                    <div class="div-abu">
                        <img style="width: 60%;" src="{!!url('public/images/bacsiviet/aboutus/2.jpg')!!}">
                    </div>
                
            </div>
	</div>
</div>
<br><br>
@endsection