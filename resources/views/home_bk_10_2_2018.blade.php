@extends('main')

@section('content')
        <div class="container">
            <div class="row">
     <!--  slider section-->
        <section class="slider" id="slider">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox" style='height:550px;'>
                    <div class="item active">
                            <img async src="/public/images/slider/slide1.jpg" alt="#" />
                        </div>
                        <div class="item">
                            <img async src="/public/images/slider/slide2.jpg" alt="#" />
                        </div>
                        <div class="item">
                            <img async src="/public/images/slider/slide3.jpg" alt="#" />
                        </div>
                        <div class="item">
                            <img async src="/public/images/slider/slide4.jpg" alt="#" />
                        </div>
                        <div class="item">
                            <img async src="/public/images/slider/slide5.jpg" alt="#" />
                        </div>
                </div>
            <div id="searchhome">
				<div class="position">
					<h1>
						Tìm kiếm, tra cứu thông tin thuốc, chăm sóc và khám chữa bệnh dễ dàng, chính xác với hơn 1000 bác sĩ và cơ sở y tế toàn quốc
					</h1>

					<form class="search" method="get" action="/tim-kiem/" name="global-search">
						<div class="inner">
							<span class="location">
								<select name="province" id="location-switch-home">
									<option value="Hồ Chí Minh">Cả nước</option>
									<option value="Hà Nội">Hà Nội</option>
									<option value="Hồ Chí Minh">Hồ Chí Minh</option>
									<option value="An Giang">An Giang</option><option value="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu</option><option value="Bắc Cạn">Bắc Cạn</option><option value="Bắc Giang">Bắc Giang</option><option value="Bạc Liêu">Bạc Liêu</option><option value="Bắc Ninh">Bắc Ninh</option><option value="Bến Tre">Bến Tre</option><option value="Bình Dương">Bình Dương</option><option value="Bình Định">Bình Định</option><option value="Bình Phước">Bình Phước</option><option value="Bình Thuận">Bình Thuận</option><option value="Cao Bằng">Cao Bằng</option><option value="Cà Mau">Cà Mau</option><option value="Cần Thơ">Cần Thơ</option><option value="Đà Nẵng">Đà Nẵng</option><option value="Đắk Nông">Đắk Nông</option><option value="Đắk Lắk">Đắk Lắk</option><option value="Đồng Nai">Đồng Nai</option><option value="Điện Biên">Điện Biên</option><option value="Đồng Tháp">Đồng Tháp</option><option value="Gia Lai">Gia Lai</option><option value="Hà Giang">Hà Giang</option><option value="Hà Nam">Hà Nam</option><option value="Hà Tĩnh">Hà Tĩnh</option><option value="Hải Dương">Hải Dương</option><option value="Hải Phòng">Hải Phòng</option><option value="Hậu Giang">Hậu Giang</option><option value="Hòa Bình">Hòa Bình</option><option value="Hưng Yên">Hưng Yên</option><option value="Khánh Hòa">Khánh Hòa</option><option value="Kiên Giang">Kiên Giang</option><option value="Kon Tum">Kon Tum</option><option value="Lai Châu">Lai Châu</option><option value="Lạng Sơn">Lạng Sơn</option><option value="Lào Cai">Lào Cai</option><option value="Lâm Đồng">Lâm Đồng</option><option value="Long An">Long An</option><option value="Nam Định">Nam Định</option><option value="Nghệ An">Nghệ An</option><option value="Ninh Bình">Ninh Bình</option><option value="Ninh Thuận">Ninh Thuận</option><option value="Phú Thọ">Phú Thọ</option><option value="Phú Yên">Phú Yên</option><option value="Quảng Bình">Quảng Bình</option><option value="Quảng Nam">Quảng Nam</option><option value="Quảng Ngãi">Quảng Ngãi</option><option value="Quảng Ninh">Quảng Ninh</option><option value="Quảng Trị">Quảng Trị</option><option value="Sơn La">Sơn La</option><option value="Sóc Trăng">Sóc Trăng</option><option value="Tây Ninh">Tây Ninh</option><option value="Thái Bình">Thái Bình</option><option value="Thái Nguyên">Thái Nguyên</option><option value="Thanh Hóa">Thanh Hóa</option><option value="Thừa Thiên - Huế">Thừa Thiên - Huế</option><option value="Tiền Giang">Tiền Giang</option><option value="Trà Vinh">Trà Vinh</option><option value="Tuyên Quang">Tuyên Quang</option><option value="Vĩnh Phúc">Vĩnh Phúc</option><option value="Vĩnh Long">Vĩnh Long</option><option value="Yên Bái">Yên Bái</option>
								</select>
							</span>
							<div class="has-suggestion"><input name="q" value="" placeholder="Triệu chứng, bác sĩ, phòng khám, bệnh viện..." autocomplete="off" id="search-input-home" type="text"><div class="suggestion" style="display: none;"></div></div>
							<button type="submit"><i class="fa fa-search icon-search-not-loading"></i><i class="icon-search-loading"></i></button>
						</div>
					</form>
				</div>
			</div>
                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <i class="fa fa-angle-left" area-hidden="true"></i>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <i class="fa fa-angle-right" area-hidden="true"></i>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </section>
        <!-- slider ends -->
            </div>
        </div>
		<div style="clear: both;"></div>
		<!-- section specilities -->
		<section class="specialities" style="margin-top:200px;">		
		
			<div class="position">	
				<div class="tab-content-container">
					<div id="places-by-speciality" class="tab-content">
						<ul>
							@if(isset($specialities))
							   @foreach($specialities as $i=>$sp)
							      @if($i<=10)
    								<li>
    									<a href="/chuyen-khoa/{{$sp->specialty_url}}-{{$sp->speciality_id}}/">
    										<img src="{{url('public/images/front/folder_icon.png')}}" alt="Icon folder doctor">
    										<span>{{$sp->speciality_name}}</span>
    									</a>
    								</li>
								@endif
							  @endforeach
							@endif
							<li>
								<a href="/chuyen-khoa/" class="readmoreHome" title="Danh sách chuyên khoa">	
									<span>Xem thêm <i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
								</a>
							</li>
						</ul>
					</div>					
				</div>
			</div>
		</section>
		<!-- /section specilities -->
		  <!-- team section -->
        <section class="latest-post" id="team">
            <div class="container">
                <div class="row">
                     <div class="latest-news-heading col-md-12">
                        <h2>Câu hỏi nổi bật</h2>
                        
                        <a href="/hoi-bac-si/tuyen-chon" class="btn btn-info text-right">Xem tất cả <i class="fa fa-angle-right"></i></a>
                    </div>
                   @if(isset($questions)) 
                    <div id="question-content" class="owl-carousel">
                     @foreach($questions as $ques)
                    	<div class="item">
                    		 <a href="/hoi-bac-si/tuyen-chon/{{\App\Deals::strtoUrl($ques->subject)}}-{{$ques->id}}/kham-benh">
                            <img async src="{{$ques->image}}" alt="#" title="medihere Blog Post"/>
                            <h3>{{$ques->subject}}</h3>
                            <div class="desc">
								
							</div>
                           
                            </a>
                    	</div>
                    @endforeach
                 @endif
                      
                    </div>
                </div>
            </div>
        </section>
        
  <!-- team section -->
        <section class="latest-post" id="team">
            <div class="container">
                <div class="row">
                     <div class="latest-news-heading col-md-12">
                        <h2>Cơ Sở Y Tế Nổi Bật</h2>
                        
                        <a href="/danh-sach" class="btn btn-info text-right">Xem tất cả <i class="fa fa-angle-right"></i></a>
                    </div>
                   @if(isset($clinic)) 
                    <div id="clinic-content" class="owl-carousel">
                     @foreach($clinic as $cl)
                    	<div class="item">
                    		 <a href="/co-so-y-te/{{$cl->clinic_url}}-{{$cl->clinic_id}}/kham-benh">
                            <img async src="{{$cl->profile_image}}" alt="#" title="medihere Blog Post"/>
                            <h3>{{$cl->clinic_name}}</h3>
                            <div class="desc">
								{{$cl->clinic_address}}
							</div>
                           
                            </a>
                    	</div>
                    @endforeach
                 @endif
                      
                    </div>
                </div>
            </div>
        </section>
        <!-- team section ends -->
       
         <!-- team section -->
        <section class="latest-post" id="khuyenmai">
            <div class="container">
                <div class="row">
                     <div class="latest-news-heading col-md-12">
                        <h2>Khuyến mãi Nổi Bật</h2>
                        
                        <a href="/khuyen-mai" class="btn btn-info text-right">Xem tất cả <i class="fa fa-angle-right"></i></a>
                    </div>
                    
                   @if(isset($deals)) 
                    <div id="deal-content" class="owl-carousel">
                     @foreach($deals as $deal)
                     
                    	<div class="item">
                    	  <div class="images">
                    		 <a href="/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}">
                            <img async src="/public/images/{{$deal->image}}" alt="#" title="{{$deal->deal_title}}"/>
                           </div>
                            <h3>{!!$deal['deal_title']!!}</h3>                           
                             <span class="home_price_new">
                                {!!number_format($deal['price'],0)!!} ₫
                             </span>
                            <span class="home_price_old">  
                                {!!number_format($deal['old_price'],0)!!} ₫
                            </span>                    
                            </a>
                    	</div>
                    @endforeach
                 @endif
                      
                    </div>
                </div>
            </div>
        </section>
          
        <!-- team section ends -->
        <!-- team section -->
        <section class="team" id="team">
            <div class="container">
                <div class="row">
                    <div class="team-heading text-center">
                        <h2>Bác sĩ nổi bật</h2>
                        <p>Danh sách bác sĩ tương tác nhiều trên hệ thống</p>
                    </div>
                    <div id="team-slide" class="owl-carousel">
                    @if(isset($doctors))
                     @foreach($doctors as $dt)
                        <!-- member 1 -->
                        <div class="item">
                            <div class="member-image">
                                <img async src="{{url('public/images/doctor/'.$dt->profile_image)}}" alt="{{$dt->doctor_name}}" title="{{$dt->doctor_name}}">
                                <div class="item-cap">
                                    <div class="item-socials">
                                        <a class="fb" href="#"><i class="fa fa-facebook"></i></a>
                                        <a class="tt" href="#"><i class="fa fa-twitter"></i></a>
                                        <a class="gp" href="#"><i class="fa fa-google-plus"></i></a>
                                    </div>
                                    <a class="btn btn-info" href="/danh-sach/bac-si/{{$dt->doctor_id}}/">Xem</a>
                                </div>
                            </div>
                            <h3>{{$dt['doctor_name']}}</h3>
                            @if(isset($dt->doctorspeciality))
                            <h4>{{$dt->doctorspeciality->speciality->speciality_name}}</h4>
                            @endif
                        </div>
                        @endforeach
                      @endif
                   
                    </div>
                </div>
            </div>
        </section>
        <!-- team section ends -->
       
        <!-- newsletter -->
       <!-- <div class="newsletter">
            <div class="container">
                <div class="row">
                    <div class="newsletter-contents">
                        <div class="col-md-6 clearfix">
                            <form action="?">
                                <input class="col-md-9 col-sm-9 col-xs-9" type="email" placeholder="Put Your Email">
                                <input class="col-md-3 col-sm-3 col-xs-3" type="submit" value="Submit">
                            </form>
                        </div>
                        <div class="col-md-6 clearfix">
                            <h3>Subscribe our Newsletter, Stay Updated!</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <!-- newsletter ends -->

@endsection
