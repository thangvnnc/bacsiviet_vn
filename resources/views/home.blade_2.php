@extends('main')

@section('content')
     <!--  slider section-->

        <!-- slider ends -->
		<div style="clear: both;"></div>

		<!-- section specilities -->
		<!-- /section specilities -->
		  <!-- team section -->
    <!--    <section class="latest-post" id="team">
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
        </section> -->
        
  <!-- team section -->
    <!--    <section class="latest-post" id="team">
            <div class="container">
                <div class="row">
                     <div class="latest-news-heading col-md-12">
                        <h2>Phòng Khám Nổi Bật</h2>
                        
                        <a href="/danh-sach" class="btn btn-info text-right">Xem tất cả <i class="fa fa-angle-right"></i></a>
                    </div>
                   @if(isset($clinic)) 
                    <div id="clinic-content" class="owl-carousel">
                     @foreach($clinic as $cl)
                    	<div class="item">
                    		 <a href="/co-so-y-te/{{$cl->clinic_url}}-{{$cl->clinic_id}}/kham-benh">
                            <img async src="public/images/health_facilities/{{$cl->profile_image}}" alt="#" title="medihere Blog Post"/>
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
        </section> -->
        <!-- team section ends -->
       
         <!-- team section -->
    <!--    <section class="latest-post" id="khuyenmai">
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
        </section>  -->
          
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
                                <img async src="
                                @if($dt->profile_image == '') https://n6-img-fp.akamaized.net/free-vector/doctor-character-background_1270-84.jpg?size=338&ext=jpg
                                @else 
                                {{url('public/images/doctor/'.$dt->profile_image)}}" alt="{{$dt->doctor_name}}
                                @endif
                                " title="{{$dt->doctor_name}}">
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
        <!--<div class="newsletter">
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
        <style type="text/css">
            @media only screen and (max-width: 768px){
                width: 99% !important;
            }
        </style>
@endsection
