@extends('v2/view/en/en_main',['title'=> 'About Us'])
@section('en_content')
<div class="main-A">
	<div class="abu-cnt">
		<div id="top">
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/en">Home/a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="#">About us</a></li>
                    </ul> 
                    
                </div>
            </div> 
	    </div><!-- #top -->
	   
	    <div class="top-new">
                
                    <p style = "font-size: 16px;"> We are experienced doctors, we serve patients anytime, anywhere. <a style = "font-size: 16px; color: # 2b96cc;" href = "https://medixlink.com/"> medixlink.com </a> is a technology company with the desire to build a comprehensive health care system through mobile and web applications . Medixlink application on Android / tablet version of Android and IOS provides the first active health care service in Vietnam. Based on information technology foundation, Medixlink application makes it easy to connect users and doctors anytime, anywhere. Users can use the app to get health advice, look up medicines & clinics, and other health services. </p>



                    <br/>

                    <h2>FOUNDATION AND LEADERS</h2>
                 
               
                    <br />
                    <br />

                    <div class="media" id ="leader">
                     
                       <h2> 1. NGUYEN VY PHUONG </h2>
                      <img src = "../public/images/aboutUs/nguyenvyphuong.jpg" alt="Sunil Shroff">
                         <p>
                        <b class = "cl-b">Title: </b><b>CHAIRMAN OF THE BOARD OF DIRECTORS</b>
                             <br> <br>
                        <b class="cl-b">Specialties: </b><b>PHARMACY</b>
                             <br> <br>
                       <b class = "cl-b">Training school: </b><b>IDAHO STATE UNIVERSITY USA</b>
                          </p>
                     </div>
                   
                    <br/>
                    <br/>

                    <div class="media" id="leader" >
                        <h2>2. DO KHAC THANH</h2>
                        <img src="../public/images/aboutUs/HinhAnhThanhDo.JPG" alt="Sunil Shroff">
                         <p>
                             <b class = "cl-b"> Title: </b><b>DIRECTOR</b>
                             <br> <br>
                             <b class="cl-b">Expertise: </b><b>INFORMATION TECHNOLOGY MASTER </b>
                             <br> <br>
                             <b class = "cl-b"> Training school: </b><b>HCM CITY UNIVERSITY </b>
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
                        
                        <h2> 3. LUU THU QUANG </h2>
                         <img src="../public/images/aboutUs/luuthuquang.jpg" alt="Sunil Shroff">
                         <p>
                             <b class = "cl-b"> Title: </b> <b> FINANCIAL DIRECTOR </b>
                             <br> <br>
                             <b class ="cl-b"> Expertise: </b><b>FINANCIAL PROGRESS, UNIVERSITY STUDENT OF HCM CITY
                             </b>
                             <br> <br>
                             <b class="cl-b"> Training school: </b> <b>Feng Chia University </b>
                          </p>
                    </div>
                    <div style="clear: both;"></div>
                    <br />
                    <br />
                    <br />

                    
                    <h4 class = "h4-abu"> 1. Goal </h4>
                     <p class="p-abu">Our desire is to bring technology to serve patients.
						. Current hospital overload is hard for Vietnamese people. We want to improve this </p>
                    <div class="div-abu">
                        <img style="width: 60%;" src="{!!url('public/images/bacsiviet/aboutus/1.jpg')!!}">
                    </div>
                    <p> Now patients can interact with doctors directly anytime anywhere </p>
                    <br>
                    <h4 class = "h4-abu"> 2. Culture at <a class="link-p" href="https://medixlink.com/"> www.medixlink.com </a> </h4>
                    <p class = "p-abu"> We are a fair model with a flat organization system, we respect the expertise of good, experienced and dedicated doctors. We always respect the patient user. For us the patient is the object to be served, the center of the system </p>
                    <div class="div-abu">
                        <img style="width: 60%;" src="{!!url('public/images/bacsiviet/aboutus/2.jpg')!!}">
                    </div>
                
            </div>
	</div>
</div>
<br><br>
@endsection