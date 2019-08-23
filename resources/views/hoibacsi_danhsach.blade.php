@extends('main',['title'=> 'Danh sách câu hỏi'])


@section('content')
   <div id="main">
			
			
			

<div id="page-title" class="has-create">
	<div class="background"></div>
	<div class="mask">
		<div class="position">
			<ul class="breadcrumbs">
				<li><a href="/">Trang chủ</a></li>
				
					<li><a href="/hoi-bac-si/">Hỏi bác sĩ</a></li>
					<li class="active"></li>
				
			</ul>

			<h1>
					@if(request()->input('q')!==null)
	Tìm kiếm câu hỏi theo từ khóa "{{urldecode(request()->input('q'))}}"			
	@else
		@if(request()->input('unanswered'))
		 Những câu hỏi chưa được trả lời
		 @else
		 Những câu hỏi đã được trả lời
		 @endif
	    @if(Session::has('province'))
	        </br>tại {{$_COOKIE['province']}}
	    @endif
    @endif
	
		
	
   





</h1>
   @if(request()->input('unanswered'))
   <a href="/hoi-bac-si/danh-sach" class="unanswered" title="Xem những câu hỏi được trả lời">
					Xem những câu hỏi được trả lời
					<i class="fa fa-angle-double-right"></i>
				</a>
			
   @else
   <a href="/hoi-bac-si/danh-sach/?unanswered=true" class="unanswered" title="Xem những câu hỏi chưa được trả lời">
					Xem những câu hỏi chưa được trả lời
					<i class="fa fa-angle-double-right"></i>
				</a>
			
   @endif		
				

			<a class="button create-thread" href="/hoi-bac-si/dat-cau-hoi/" title="Đặt câu hỏi cho bác sĩ, hoàn toàn miễn phí">
				<i class="fa fa-commenting" aria-hidden="true"></i> Đặt câu hỏi miễn phí
			</a>
		</div>
	</div>
</div>


@if(request()->input('q')!==null)
    <div id="nav-search">
        <div class="position">
            <ul>
                <li>
                    <span>Tìm kiếm theo:</span>
                </li>
                
                <li>
                    <a href="/danh-sach/?q={{request()->input('q')}}">
                        Cơ sở y tế ({{$clinic or '0' }})
                    </a>
                </li>
                
                
                <li>
                    <a href="/danh-sach/bac-si/?q={{request()->input('q')}}">
                        Bác sĩ ({{$doctor or '0'}})
                    </a>
                </li>
                
                
                
                <!-- 
                <li>
                    <a href="/dich-vu/?q={{request()->input('q')}}">
                        Dịch vụ ({{$service or '0'}} )
                    </a>
                </li>
                
                 -->
                
                
                <li>
                    <a href="/hoi-bac-si/danh-sach/?q={{request()->input('q')}}" class="active">
                        Hỏi bác sĩ ({{$question}})
                    </a>
                </li>
                
               
                
                
                <li>
                    <a href="/benh/tim-kiem/?q={{request()->input('q')}}" >
                        Bệnh ({{$count or '0'}})
                    </a>
                </li>
                
                
                <li>
                    <a href="/thuoc/danh-sach/?q={{request()->input('q')}}">
                        Thuốc ({{$thuoc or '0'}})
                    </a>
                </li>
                
               
                
            </ul>
        </div>
    </div>
  @endif


<div id="thread-list" class="has-aside">
	<div class="position">
		<div class="content">
			

	@foreach($questions as $qs)
				
				<article>
					
						<div class="question">
							

							<h3><a href="/hoi-bac-si/{{$qs->question_url}}-{{$qs->question_id}}">{{$qs->question_title}}</a></h3>

							<div class="post-meta-data">
								<span class="user">
								<?php $user = App\Users::find($qs->user_id) ?>
								@if(isset($user) && $user)
										{{$user->fullname}}
								@else
								Giau Ten
								@endif
								</span>

								<span class="time">
									{{$qs->created_at}}
								</span>

								<?php $chuyenkhoa = App\Speciality::find($qs->speciality_id) ?>
								@if(isset($chuyenkhoa) && $chuyenkhoa)
								<span>

									Chuyên khoa:
									
										<a href="/hoi-bac-si/danh-sach/?speciality=san-phu" title="">
										{{$chuyenkhoa->speciality_name}}
										</a>
									
								</span>
								@else
								@endif

								
							</div>

							<div class="body">
								<p>{{$qs->question_content}}</p>

								
								<div class="thank-count">
									<i class="fa fa-heart-o" aria-hidden="true"></i>
									<span>1</span>
									người cám ơn bài viết
								</div>
								
							</div>
						</div>
					
@if($qs->answer!=null && $qs->answer->user!=null)
					<?php $traloi = App\Answer::where('question_id',$qs['question_id'])->first(); ?>
					@if(isset($traloi) && $traloi )

					
						<div class="answer">
							<span>Được trả lời bởi</span>

							<ul>
								@if($traloi->user->doctor!==null)
									<li>
											<span class="image " @if(!empty($traloi->user->doctor->profile_image)) style="background-image: url(@if(strpos($traloi->user->doctor->profile_image,'http')===false)/@endif{{$traloi->user->doctor->profile_image}});" @endif></span>
											<h4><a href="/danh-sach/bac-si/{{$traloi->user->doctor->doctor_url}}-{{$traloi->user->doctor->doctor_id}}">
												Bác sĩ {{$traloi->user->doctor->doctor_name}}
												</a>
											</h4>

											@if(strlen($traloi->user->doctor->doctor_description)>200 && strpos($traloi->user->doctor->doctor_description, ' ', 200)!="")
									
												<span>{!!substr( $traloi->user->doctor->doctor_description, 0, strpos($traloi->user->doctor->doctor_description, ' ', 200) )!!}</span>
											@endif
										</li>
								@else
									<li>
											<span class="image " @if(!empty($traloi->user->clinic->profile_image)) style="background-image: url(@if(strpos($traloi->user->clinic->profile_image,'http')===false)/@endif{{$traloi->user->clinic->profile_image}});" @endif></span>
											<h4>
												
											</h4>

											
												<span></span>
											
										</li>
								@endif
							</ul>
						</div>
					
						
						
						@endif
						@endif
				</article>
				
				
				@endforeach
				

				
	
			


    <div class="pagination">
        <div class="vh">62525 kết quả.</div>
        <span class="step-links">
            

            <span class="current">
               {!!$questions->appends(request()->input())->links()!!}
            </span>

            
                
            
        </span>
    </div>


		</div>
		

<aside class="pulled-up">
    <section class="collapsible-container collapsible-text collapsed">
        
            <h3>Hỏi bác sĩ</h3>
        

        <div class="collapsible-target" style="max-height: none;">
            
                <p>Chuyên mục Hỏi Bác sĩ mang đến cho người đọc dữ liệu hàng nghìn câu hỏi-đáp về sức khỏe đã được trả lời bởi các bác sĩ và chuyên gia uy tín. Bạn cũng có thể gửi câu hỏi mới để nhận được tư vấn trực tiếp của bác sĩ ngay tại đây, hoàn toàn miễn phí.</p>
            
        </div>

        <div class="collapse-trigger" style="display: none;">
            <span class="trigger-expand"><i class="fa fa-chevron-down"></i></span>
            <span class="trigger-collapse"><i class="fa fa-chevron-up"></i></span>
        </div>
    </section>

    
    <section class="top-list no-view-more">
        <h3 class="has-tooltip">
            Bác sĩ nhiệt tình

            <span class="tooltip break-text">Dựa trên hoạt động của bác sĩ theo chuyên khoa tương ứng trong 60 ngày gần nhất</span>
        </h3>

        <ul>
            
            <li>
                <a class="image circle" href="/danh-sach/bac-si/do-huu-thanh-17514/noi-co-xuong-khop" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/18_05_2016_07_42_38_508966.jpeg);" title="Bác sĩ Đỗ Hữu Thảnh"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/do-huu-thanh-17514/noi-co-xuong-khop" title="Bác sĩ Đỗ Hữu Thảnh">
                            Bác sĩ
                            Đỗ Hữu Thảnh
                        </a>
                    </h4>
                    
                        <p><i class="fa fa-reply" aria-hidden="true"></i> 281</p>
                    
                </div>
            </li>
            
            <li>
                <a class="image circle" href="/danh-sach/bac-si/le-thi-thanh-xuan-18845/da-lieu" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/08_02_2017_02_32_04_494405.jpeg);" title="Bác sĩ Lê Thị Thanh Xuân"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/le-thi-thanh-xuan-18845/da-lieu" title="Bác sĩ Lê Thị Thanh Xuân">
                            Bác sĩ
                            Lê Thị Thanh Xuân
                        </a>
                    </h4>
                    
                        <p><i class="fa fa-reply" aria-hidden="true"></i> 256</p>
                    
                </div>
            </li>
            
            <li>
                <a class="image circle" href="/danh-sach/bac-si/ha-van-chan-20950/da-lieu" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/14_10_2016_08_21_54_553911.jpeg);" title="Bác sĩ Hà Văn Chấn"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/ha-van-chan-20950/da-lieu" title="Bác sĩ Hà Văn Chấn">
                            Bác sĩ
                            Hà Văn Chấn
                        </a>
                    </h4>
                    
                        <p><i class="fa fa-reply" aria-hidden="true"></i> 179</p>
                    
                </div>
            </li>
            
            <li>
                <a class="image circle" href="/danh-sach/bac-si/duong-quang-huy-10059/nam-khoa" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/06_07_2016_08_13_59_950040.jpeg);" title="Bác sĩ Dương Quang Huy"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/duong-quang-huy-10059/nam-khoa" title="Bác sĩ Dương Quang Huy">
                            Bác sĩ
                            Dương Quang Huy
                        </a>
                    </h4>
                    
                        <p><i class="fa fa-reply" aria-hidden="true"></i> 112</p>
                    
                </div>
            </li>
            
            <li>
                <a class="image circle" href="/danh-sach/bac-si/vu-viet-hung-18815/san-phu-khoa" title="Bác sĩ Vũ Việt Hùng"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/vu-viet-hung-18815/san-phu-khoa" title="Bác sĩ Vũ Việt Hùng">
                            Bác sĩ
                            Vũ Việt Hùng
                        </a>
                    </h4>
                    
                        <p><i class="fa fa-reply" aria-hidden="true"></i> 108</p>
                    
                </div>
            </li>
            
        </ul>
    </section>
    

    
    <section class="top-list no-view-more">
        <h3 class="has-tooltip">
            Cơ sở y tế nhiệt tình

            <span class="tooltip break-text">Dựa trên hoạt động của cơ sở y tế theo chuyên khoa tương ứng trong 60 ngày gần nhất</span>
        </h3>

        <ul>
            
            <li>
                <a href="/phong-kham-san-phu-khoa-bac-si-nguyen-thi-thu-hoai-11864/san-phu-khoa" title="Phòng khám Sản phụ khoa - Bác sĩ Nguyễn Thị Thu Hoài" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/2016-01-26_102217.9735830000.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/phong-kham-san-phu-khoa-bac-si-nguyen-thi-thu-hoai-11864/san-phu-khoa" title="Phòng khám Sản phụ khoa - Bác sĩ Nguyễn Thị Thu Hoài">Phòng khám Sản phụ khoa - Bác sĩ Nguyễn Thị Thu Hoài</a>
                    </h4>
                    
                        <p><i class="fa fa-reply" aria-hidden="true"></i> 111</p>
                    
                </div>
            </li>
            
            <li>
                <a href="/benh-vien-dai-hoc-y-ha-noi-xet-nghiem-tai-nha-xander-84936/xet-nghiem" title="Bệnh viện Đại học Y Hà Nội - Xét nghiệm tại nhà - Xander" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/11_01_2017_09_08_51_467239.png);"></a>

                <div class="body">
                    <h4>
                        <a href="/benh-vien-dai-hoc-y-ha-noi-xet-nghiem-tai-nha-xander-84936/xet-nghiem" title="Bệnh viện Đại học Y Hà Nội - Xét nghiệm tại nhà - Xander">Bệnh viện Đại học Y Hà Nội - Xét nghiệm tại nhà - Xander</a>
                    </h4>
                    
                        <p><i class="fa fa-reply" aria-hidden="true"></i> 42</p>
                    
                </div>
            </li>
            
            <li>
                <a href="/phong-kham-noi-tong-quat-bac-si-doan-ngoc-thuong-92975/noi-tong-hop" title="Phòng khám Nội Tổng quát - Bác sĩ Đoàn Ngọc Thương" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/30_12_2016_08_26_26_664323.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/phong-kham-noi-tong-quat-bac-si-doan-ngoc-thuong-92975/noi-tong-hop" title="Phòng khám Nội Tổng quát - Bác sĩ Đoàn Ngọc Thương">Phòng khám Nội Tổng quát - Bác sĩ Đoàn Ngọc Thương</a>
                    </h4>
                    
                        <p><i class="fa fa-reply" aria-hidden="true"></i> 41</p>
                    
                </div>
            </li>
            
            <li>
                <a href="/trung-tam-xet-nghiem-bionet-viet-nam-15845/xet-nghiem" title="Trung tâm Xét nghiệm Bionet Việt Nam" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/09_02_2017_08_37_21_335590.png);"></a>

                <div class="body">
                    <h4>
                        <a href="/trung-tam-xet-nghiem-bionet-viet-nam-15845/xet-nghiem" title="Trung tâm Xét nghiệm Bionet Việt Nam">Trung tâm Xét nghiệm Bionet Việt Nam</a>
                    </h4>
                    
                        <p><i class="fa fa-reply" aria-hidden="true"></i> 33</p>
                    
                </div>
            </li>
            
            <li>
                <a href="/phong-kham-nam-khoa-andos-70857/nam-khoa" title="Phòng khám Nam Khoa Andos" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/15_09_2016_02_38_54_547210.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/phong-kham-nam-khoa-andos-70857/nam-khoa" title="Phòng khám Nam Khoa Andos">Phòng khám Nam Khoa Andos</a>
                    </h4>
                    
                        <p><i class="fa fa-reply" aria-hidden="true"></i> 14</p>
                    
                </div>
            </li>
            
        </ul>
    </section>
    

    
    <section class="collapsible-container collapsible-list collapsed">
        <h3>Câu hỏi theo chuyên khoa</h3>

        <dl class="collapsible-target">
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=san-phu" class="" title="Sản phụ khoa">
                    <h5>Sản phụ khoa</h5>
                    <span class="thread-count ">10831 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=da-lieu" class="" title="Da liễu">
                    <h5>Da liễu</h5>
                    <span class="thread-count ">8236 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=nhi" class="" title="Nhi">
                    <h5>Nhi</h5>
                    <span class="thread-count ">6555 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=truyen-nhiem" class="" title="Truyền nhiễm">
                    <h5>Truyền nhiễm</h5>
                    <span class="thread-count ">4940 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=tieu-hoa-gan-mat" class="" title="Tiêu hóa - Gan mật">
                    <h5>Tiêu hóa - Gan mật</h5>
                    <span class="thread-count ">4451 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=tai-mui-hong" class="" title="Tai - Mũi - Họng">
                    <h5>Tai - Mũi - Họng</h5>
                    <span class="thread-count ">4258 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=than-kinh" class="" title="Thần kinh">
                    <h5>Thần kinh</h5>
                    <span class="thread-count ">4053 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=co-xuong-khop" class="" title="Cơ Xương Khớp">
                    <h5>Cơ Xương Khớp</h5>
                    <span class="thread-count ">3520 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=nam" class="" title="Nam khoa">
                    <h5>Nam khoa</h5>
                    <span class="thread-count ">3332 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=nhan-khoa" class="" title="Nhãn khoa">
                    <h5>Nhãn khoa</h5>
                    <span class="thread-count ">2872 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=rang-ham-mat" class="" title="Răng - Hàm - Mặt">
                    <h5>Răng - Hàm - Mặt</h5>
                    <span class="thread-count ">2315 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=dinh-duong" class="" title="Dinh dưỡng">
                    <h5>Dinh dưỡng</h5>
                    <span class="thread-count ">2147 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=duoc" class="" title="Dược">
                    <h5>Dược</h5>
                    <span class="thread-count ">2142 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=ung-buou" class="" title="Ung bướu">
                    <h5>Ung bướu</h5>
                    <span class="thread-count ">1992 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=kham-benh" class="" title="Khám bệnh">
                    <h5>Khám bệnh</h5>
                    <span class="thread-count ">1929 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=than-tiet-nieu" class="" title="Thận - Tiết niệu">
                    <h5>Thận - Tiết niệu</h5>
                    <span class="thread-count ">1818 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=tim-mach" class="" title="Tim mạch">
                    <h5>Tim mạch</h5>
                    <span class="thread-count ">1583 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=ho-hap" class="" title="Hô hấp">
                    <h5>Hô hấp</h5>
                    <span class="thread-count ">1453 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=noi-tiet" class="" title="Nội tiết">
                    <h5>Nội tiết</h5>
                    <span class="thread-count ">1239 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=tam-than" class="" title="Tâm thần">
                    <h5>Tâm thần</h5>
                    <span class="thread-count ">1208 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=xet-nghiem" class="" title="Xét nghiệm">
                    <h5>Xét nghiệm</h5>
                    <span class="thread-count ">944 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=chan-thuong-chinh-hinh-cot-song" class="" title="Chấn thương chỉnh hình - Cột sống">
                    <h5>Chấn thương chỉnh hình - Cột sống</h5>
                    <span class="thread-count ">877 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=hiem-muon-vo-sinh" class="" title="Hiếm muộn - Vô sinh">
                    <h5>Hiếm muộn - Vô sinh</h5>
                    <span class="thread-count ">819 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=tham-my" class="" title="Thẩm mỹ">
                    <h5>Thẩm mỹ</h5>
                    <span class="thread-count ">784 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=di-ung-mien-dich" class="" title="Dị ứng - Miễn dịch">
                    <h5>Dị ứng - Miễn dịch</h5>
                    <span class="thread-count ">711 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=huyet-hoc-truyen-mau" class="" title="Huyết học - Truyền máu">
                    <h5>Huyết học - Truyền máu</h5>
                    <span class="thread-count ">592 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=chua-ro" class="" title="Chưa rõ">
                    <h5>Chưa rõ</h5>
                    <span class="thread-count ">361 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=vat-ly-tri-lieu-phuc-hoi-chuc-nang" class="" title="Vật lý trị liệu - Phục hồi chức năng">
                    <h5>Vật lý trị liệu - Phục hồi chức năng</h5>
                    <span class="thread-count ">287 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=da-khoa" class="" title="Đa khoa">
                    <h5>Đa khoa</h5>
                    <span class="thread-count ">191 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=y-hoc-co-truyen" class="" title="Y học cổ truyền">
                    <h5>Y học cổ truyền</h5>
                    <span class="thread-count ">177 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=lao-khoa" class="" title="Lão khoa">
                    <h5>Lão khoa</h5>
                    <span class="thread-count ">157 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=kiem-soat-nhiem-khuan" class="" title="Kiểm soát nhiễm khuẩn">
                    <h5>Kiểm soát nhiễm khuẩn</h5>
                    <span class="thread-count ">154 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=di-truyen-sinh-hoc-phan-tu" class="" title="Di truyền &amp; Sinh học phân tử">
                    <h5>Di truyền &amp; Sinh học phân tử</h5>
                    <span class="thread-count ">141 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=chan-doan-hinh-anh" class="" title="Chẩn đoán hình ảnh">
                    <h5>Chẩn đoán hình ảnh</h5>
                    <span class="thread-count ">111 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=noi-soi" class="" title="Nội soi">
                    <h5>Nội soi</h5>
                    <span class="thread-count ">101 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=noi-tong-hop" class="" title="Nội Tổng hợp">
                    <h5>Nội Tổng hợp</h5>
                    <span class="thread-count ">81 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=giai-phau-benh" class="" title="Giải phẫu bệnh">
                    <h5>Giải phẫu bệnh</h5>
                    <span class="thread-count ">64 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=hoi-suc-cap-cuu" class="" title="Hồi sức - Cấp cứu">
                    <h5>Hồi sức - Cấp cứu</h5>
                    <span class="thread-count ">32 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=thu-y" class="" title="Thú y">
                    <h5>Thú y</h5>
                    <span class="thread-count ">32 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=noi-noi-tiet-dai-thao-duong" class="" title="Nội - Nội tiết -  Đái tháo đường">
                    <h5>Nội - Nội tiết -  Đái tháo đường</h5>
                    <span class="thread-count ">26 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=hen-phe-quan" class="" title="Hen phế quản">
                    <h5>Hen phế quản</h5>
                    <span class="thread-count ">9 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=gay-me-hoi-suc" class="" title="Gây mê hồi sức">
                    <h5>Gây mê hồi sức</h5>
                    <span class="thread-count ">7 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=nhi-tim-mach" class="" title="Nhi Tim mạch">
                    <h5>Nhi Tim mạch</h5>
                    <span class="thread-count ">7 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=noi-tieu-hoa-gan-mat" class="" title="Nội Tiêu hoá - Gan mật">
                    <h5>Nội Tiêu hoá - Gan mật</h5>
                    <span class="thread-count ">6 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=tham-do-chuc-nang" class="" title="Thăm dò chức năng">
                    <h5>Thăm dò chức năng</h5>
                    <span class="thread-count ">5 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=chan-thuong-chinh-hinh-ham-mat" class="" title="Chấn thương chỉnh hình hàm mặt">
                    <h5>Chấn thương chỉnh hình hàm mặt</h5>
                    <span class="thread-count ">4 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=soi-dai-trang" class="" title="Soi đại tràng">
                    <h5>Soi đại tràng</h5>
                    <span class="thread-count ">2 câu hỏi</span>
                </a>
            </dt>
            
        </dl>

        <div class="collapse-trigger">
            <span class="trigger-expand"><i class="fa fa-chevron-down"></i></span>
            <span class="trigger-collapse"><i class="fa fa-chevron-up"></i></span>
        </div>
    </section>
    

    
    <section class="collapsible-container collapsible-list collapsed">
        <h3>Câu hỏi theo chủ đề</h3>

        <dl class="collapsible-target">
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=phu-nu" class="" title="Phụ nữ">
                    <h5>Phụ nữ</h5>
                    <span class="thread-count ">6921 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=da-lieu" class="" title="Da liễu ">
                    <h5>Da liễu </h5>
                    <span class="thread-count ">6917 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=tre-em" class="" title="Trẻ em">
                    <h5>Trẻ em</h5>
                    <span class="thread-count ">4917 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=thuoc-thuc-pham-chuc-nang" class="" title="Thuốc / Thực phẩm chức năng ">
                    <h5>Thuốc / Thực phẩm chức năng </h5>
                    <span class="thread-count ">4597 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=me-va-be" class="" title="Mẹ và bé">
                    <h5>Mẹ và bé</h5>
                    <span class="thread-count ">4042 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=nam-khoa" class="" title="Nam khoa ">
                    <h5>Nam khoa </h5>
                    <span class="thread-count ">2793 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=dia-chi-kham-benh" class="" title="Địa chỉ khám bệnh ">
                    <h5>Địa chỉ khám bệnh </h5>
                    <span class="thread-count ">2435 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=dinh-duong" class="" title="Dinh dưỡng">
                    <h5>Dinh dưỡng</h5>
                    <span class="thread-count ">2198 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=benh-xa-hoi" class="" title="Bệnh xã hội">
                    <h5>Bệnh xã hội</h5>
                    <span class="thread-count ">2075 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=tiem-chung" class="" title="Tiêm chủng">
                    <h5>Tiêm chủng</h5>
                    <span class="thread-count ">1709 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=mat" class="" title="Mắt">
                    <h5>Mắt</h5>
                    <span class="thread-count ">1606 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=tinh-duc-gioi-tinh" class="" title="Tình dục / Giới tính">
                    <h5>Tình dục / Giới tính</h5>
                    <span class="thread-count ">1604 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=xet-nghiem" class="" title="Xét nghiệm">
                    <h5>Xét nghiệm</h5>
                    <span class="thread-count ">1439 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=chi-phi-kham-benh" class="" title="Chi phí khám bệnh">
                    <h5>Chi phí khám bệnh</h5>
                    <span class="thread-count ">1363 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=ung-thu" class="" title="Ung thư ">
                    <h5>Ung thư </h5>
                    <span class="thread-count ">1245 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=tam-ly" class="" title="Tâm lý">
                    <h5>Tâm lý</h5>
                    <span class="thread-count ">1190 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=benh-thuong-thuc" class="" title="Bệnh thường thức">
                    <h5>Bệnh thường thức</h5>
                    <span class="thread-count ">1062 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=lam-dep" class="" title="Làm đẹp ">
                    <h5>Làm đẹp </h5>
                    <span class="thread-count ">984 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=nguoi-cao-tuoi" class="" title="Người cao tuổi">
                    <h5>Người cao tuổi</h5>
                    <span class="thread-count ">665 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=tuoi-day-thi" class="" title="Tuổi dậy thì">
                    <h5>Tuổi dậy thì</h5>
                    <span class="thread-count ">535 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=thu-tuc-kham-benh" class="" title="Thủ tục khám bệnh">
                    <h5>Thủ tục khám bệnh</h5>
                    <span class="thread-count ">438 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=vo-sinh" class="" title="Vô sinh">
                    <h5>Vô sinh</h5>
                    <span class="thread-count ">370 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=" class="" title="Dịch bệnh">
                    <h5>Dịch bệnh</h5>
                    <span class="thread-count ">252 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=y-hoc-co-truyen" class="" title="Y học cổ truyền ">
                    <h5>Y học cổ truyền </h5>
                    <span class="thread-count ">206 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=the-hinh" class="" title="Thể hình">
                    <h5>Thể hình</h5>
                    <span class="thread-count ">206 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=bao-hiem" class="" title="Bảo hiểm">
                    <h5>Bảo hiểm</h5>
                    <span class="thread-count ">153 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=benh-nghe-nghiep" class="" title="Bệnh nghề nghiệp">
                    <h5>Bệnh nghề nghiệp</h5>
                    <span class="thread-count ">115 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=benh-mua-lanh" class="" title="Bệnh mùa lạnh ">
                    <h5>Bệnh mùa lạnh </h5>
                    <span class="thread-count ">112 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=benh-giao-mua" class="" title="Bệnh giao mùa">
                    <h5>Bệnh giao mùa</h5>
                    <span class="thread-count ">67 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=tuoi-tien-man-kinh" class="" title="Tuổi tiền mãn kinh ">
                    <h5>Tuổi tiền mãn kinh </h5>
                    <span class="thread-count ">65 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=benh-mua-nong" class="" title="Bệnh mùa nóng">
                    <h5>Bệnh mùa nóng</h5>
                    <span class="thread-count ">58 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=an-toan-thuc-pham" class="" title="An toàn thực phẩm ">
                    <h5>An toàn thực phẩm </h5>
                    <span class="thread-count ">55 câu hỏi</span>
                </a>
            </dt>
            
        </dl>

        <div class="collapse-trigger">
            <span class="trigger-expand"><i class="fa fa-chevron-down"></i></span>
            <span class="trigger-collapse"><i class="fa fa-chevron-up"></i></span>
        </div>
    </section>
    

    
    <section class="top-list">
        <h3>Đáng quan tâm</h3>

        <ul>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/dung-thuoc-bo-khi-mang-thai-nhung-dieu-ban-nen-biet-3606/" title="Dùng thuốc bổ khi mang thai: Những điều bạn nên biết" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/03_11_2016_08_11_56_271991.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/dung-thuoc-bo-khi-mang-thai-nhung-dieu-ban-nen-biet-3606/" title="Dùng thuốc bổ khi mang thai: Những điều bạn nên biết">Dùng thuốc bổ khi mang thai: Những điều bạn nên biết</a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/4-dieu-can-biet-ve-chung-roi-loan-lo-au-mang-thai-va-sau-sinh-6515/" title="4 điều cần biết về chứng rối loạn lo âu mang thai và sau sinh" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/12_12_2016_07_59_47_303830.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/4-dieu-can-biet-ve-chung-roi-loan-lo-au-mang-thai-va-sau-sinh-6515/" title="4 điều cần biết về chứng rối loạn lo âu mang thai và sau sinh">4 điều cần biết về chứng rối loạn lo âu mang thai và sau sinh</a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/nhung-dau-hieu-bat-thuong-o-moi-lon-cua-am-dao-can-canh-giac-1598/" title="Những dấu hiệu bất thường ở môi lớn của âm đạo cần cảnh giác" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/07_10_2016_09_00_07_394514.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/nhung-dau-hieu-bat-thuong-o-moi-lon-cua-am-dao-can-canh-giac-1598/" title="Những dấu hiệu bất thường ở môi lớn của âm đạo cần cảnh giác">Những dấu hiệu bất thường ở môi lớn của âm đạo cần cảnh giác</a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/hay-can-than-khi-di-sieu-am-1302/" title="Hãy cẩn thận khi đi siêu âm!" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/04_10_2016_08_38_06_307621.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/hay-can-than-khi-di-sieu-am-1302/" title="Hãy cẩn thận khi đi siêu âm!">Hãy cẩn thận khi đi siêu âm!</a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/nhung-dau-hieu-nhan-biet-thai-nhi-bi-di-tat-1193/" title="Những dấu hiệu nhận biết thai nhi bị dị tật" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/02_12_2016_10_43_25_883038.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/nhung-dau-hieu-nhan-biet-thai-nhi-bi-di-tat-1193/" title="Những dấu hiệu nhận biết thai nhi bị dị tật">Những dấu hiệu nhận biết thai nhi bị dị tật</a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/canh-giac-voi-chung-dau-bung-khi-mang-thai-6420/" title="Cảnh giác với chứng đau bụng khi mang thai" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/07_12_2016_10_58_40_446638.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/canh-giac-voi-chung-dau-bung-khi-mang-thai-6420/" title="Cảnh giác với chứng đau bụng khi mang thai">Cảnh giác với chứng đau bụng khi mang thai</a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/mo-ap-xe-vu-bao-lau-thi-lanh-va-nhung-cau-hoi-thuong-gap-1957/" title="Mổ áp xe vú bao lâu thì lành và những câu hỏi thường gặp?" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/13_10_2016_08_46_27_644597.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/mo-ap-xe-vu-bao-lau-thi-lanh-va-nhung-cau-hoi-thuong-gap-1957/" title="Mổ áp xe vú bao lâu thì lành và những câu hỏi thường gặp?">Mổ áp xe vú bao lâu thì lành và những câu hỏi thường gặp?</a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/phau-thuat-noi-gan-bao-lau-thi-phuc-hoi-4136/" title="Phẫu thuật nối gân phục hồi trong bao lâu?" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/10_11_2016_09_52_53_066064.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/phau-thuat-noi-gan-bao-lau-thi-phuc-hoi-4136/" title="Phẫu thuật nối gân phục hồi trong bao lâu?">Phẫu thuật nối gân phục hồi trong bao lâu?</a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/thoi-gian-hoi-phuc-dut-gan-ngon-tay-3228/" title="Lưu ý về thời gian hồi phục đứt gân ngón tay" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/31_10_2016_04_17_20_915796.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/thoi-gian-hoi-phuc-dut-gan-ngon-tay-3228/" title="Lưu ý về thời gian hồi phục đứt gân ngón tay">Lưu ý về thời gian hồi phục đứt gân ngón tay</a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/neu-nuoc-bot-tiet-ra-kem-mau-cho-chu-quan-3294/" title="Nếu nước bọt tiết ra kèm máu, chớ chủ quan!" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/31_10_2016_09_20_03_519856.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/neu-nuoc-bot-tiet-ra-kem-mau-cho-chu-quan-3294/" title="Nếu nước bọt tiết ra kèm máu, chớ chủ quan!">Nếu nước bọt tiết ra kèm máu, chớ chủ quan!</a>
                    </h4>
                </div>
            </li>
            
        </ul>

        <a href="/hoi-bac-si/tuyen-chon/" class="view-more">Xem tất cả các câu hỏi tuyển chọn</a>
    </section>
    

    
</aside>

	</div>
</div>


			
				

<script id="login-overlay-template" type="text/html">

	<div class="has-account-type-selector">
		<ul class="tab-content-triggers">
			<li><a href="#signup-tab" class="active"><i class="fa fa-user-plus" aria-hidden="true"></i> Đăng ký</a></li>
			<li><a href="#login-tab"><i class="fa fa-sign-in" aria-hidden="true"></i> Đăng nhập</a></li>
		</ul>

		<div class="tab-content-container">

			<div id="login-tab" class="tab-content">
				<div class="for-email-existed">
					<p>Bạn đã có tài khoản đăng ký tại ViCare với email này. Vui lòng đăng nhập để sử dụng đầy đủ chức năng của ViCare. Sau khi đăng nhập, bạn sẽ được đưa trở lại trang trước. Nội dung bạn vừa viết đã được lưu lại vào trình duyệt và sẽ không bị mất đi.</p>
				</div>

				<form method="post" action="https://vicare.vn/dang-nhap/?next=/hoi-bac-si/danh-sach/" name="login">
					<div class="form-row">
						<div class="form-field">
							<label>
								Email:
							</label>
							<div class="form-field-input">
								<input type="text" name="email" required />
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-field">
							<label>
								Mật khẩu:
							</label>
							<div class="form-field-input">
								<input type="password" name="password" required></input>
								<p>
									<a class="reset-password-link" href="https://vicare.vn/quen-mat-khau/">Quên mật khẩu?</a>
								</p>
							</div>
						</div>
					</div>
					<div class="button-row">
						<button type="submit">Đăng nhập</button>
					</div>
					<hr class="form-hr" />
					<div class="button-row">
						<button type="button" name="facebook" data-link="https://vicare.vn/tai-khoan/ket-noi/login/facebook/?next=/hoi-bac-si/danh-sach/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng nhập qua Facebook</button>
					</div>
				</form>
			</div>

			<div id="signup-tab" class="tab-content active">

				<div class="instruction">
					<p>
						Chào mừng bạn đến với ViCare!
					</p>

					<div class="for-source-register_place">
						<p>
							Sau khi mở tài khoản, bạn có thể dễ dàng cập nhật, chỉnh sửa trang thông tin phòng khám, bệnh viện hoặc doanh nghiệp mà bạn quản lý trên ViCare. Bạn cũng có thể gửi phản hồi nhận xét của khách hàng, và tham gia giải đáp các thắc mắc về y tế, sức khỏe của cộng đồng.
						</p>
						<p>
							Bạn cần chọn loại tài khoản là "Quản lý cơ sở y tế".
						</p>
					</div>
					<div class="for-source-register_prof">
						<p>
							Sau khi mở tài khoản, bạn có thể dễ dàng cập nhật, chỉnh sửa trang thông tin của mình trên ViCare. Bạn cũng có thể gửi phản hồi nhận xét của bệnh nhân, và tham gia giải đáp các thắc mắc về y tế, sức khỏe của cộng đồng.
						</p>
						<p>
							Bạn cần chọn loại tài khoản là "Bác sĩ".
						</p>
					</div>
					<div class="for-source-favourite">
						<p>
							Sau khi mở tài khoản, bạn có thể lưu lại cơ sở y tế và bác sĩ đáng quan tâm, cũng như sử dụng đầy đủ các chức năng, dịch vụ của ViCare
						</p>
					</div>
					<div class="for-source-promotion">
						<p>
							Bạn hãy mở tài khoản hoặc đăng nhập để nhận các ưu đãi về khám chữa bệnh, chăm sóc sức khỏe hấp dẫn từ ViCare!
						</p>
					</div>
					<div class="for-source-others">
						<p>
							Mở tài khoản dễ dàng, nhanh chóng với một form duy nhất để có thể sử dụng đầy đủ các chức năng và dịch vụ của ViCare.
						</p>
					</div>

				</div>

				<form method="post" action="https://vicare.vn/dang-ky/?next=/hoi-bac-si/danh-sach/" name="signup">
					<div class="form-row">
						<div class="form-field">
							<label>
								Loại tài khoản:
							</label>
							<div class="form-field-input">
								<select class="account-type-selector" name="type">
									<option value="user">Thành viên</option>
									<option value="professional">Bác sĩ</option>
									<option value="place">Cơ sở y tế &amp; doanh nghiệp</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-field">
							<label>
								Họ và tên:
							</label>
							<div class="form-field-input">
								<input type="text" name="name" id="name" data-rules="required" class="validate" />
								<p class="validation-error help-block"></p>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-field">
							<label>
								Điện thoại:
							</label>
							<div class="form-field-input">
								<input type="text" name="mobile_phone" id="mobile_phone" data-rules="required" />
								<p class="validation-error help-block"></p>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-field">
							<label>
								Email:
							</label>
							<div class="form-field-input">
								<input name="email" type="text" id="email" data-rules="required|valid_email" class="validate" />
								<p class="validation-error help-block"></p>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-field">
							<label>
								Mật khẩu:
							</label>
							<div class="form-field-input">
								<input type="password" name="password" id="password" title="Mật khẩu cần có ít nhất 5 kí tự" placeholder="Mật khẩu cần có ít nhất 5 kí tự" data-display="Mật khẩu" data-rules="required|min_length[5]" class="validate"></input>
								<p class="validation-error help-block"></p>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-field">
							<label>
								Xác nhận lại mật khẩu:
							</label>
							<div class="form-field-input">
								<input type="password" name="confirm_password" id="confirm_password" title="Nhập lại mật khẩu" placeholder="Nhập lại mật khẩu" data-rules="required|matches[password]" class="validate"></input>
								<p class="validation-error help-block"></p>
							</div>
						</div>
					</div>

					<div class="for-account-type-place">
						<hr class="form-hr" />
						<div class="form-row">
							<div class="form-field">
								<label>
									Tên cơ sở y tế / doanh nghiệp:
								</label>
								<div class="form-field-input">
									<input type="text" name="place_name" value="<%= meta.placeName %>"/>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-field">
								<label>
									Địa chỉ:
								</label>
								<div class="form-field-input">
									<input type="text" name="place_add" value="<%= meta.placeAdd %>"/>
								</div>
							</div>
						</div>
						<p>Vui lòng cung cấp đầy đủ thông tin để chúng tôi có thể liên hệ và hỗ trợ bạn tốt nhất.</p>
					</div>

					<div class="for-account-type-professional">
						<hr class="form-hr" />
						<div class="form-row">
							<div class="form-field">
								<label>
									Chuyên khoa:
								</label>
								<div class="form-field-input">
									<input type="text" name="prof_spec" value="<%= meta.profSpec %>"/>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-field">
								<label>
									Nơi công tác:
								</label>
								<div class="form-field-input">
									<input type="text" name="prof_place" value="<%= meta.profPlace %>" />
								</div>
							</div>
						</div>
						<p>Vui lòng cung cấp đầy đủ thông tin để chúng tôi có thể liên hệ và hỗ trợ bạn tốt nhất.</p>
					</div>
					<div class="button-row">
						<button type="submit" name="register">Đăng ký</button>
					</div>
					<hr class="form-hr" />
					<div class="button-row">
						<button type="button" name="facebook" data-link="https://vicare.vn/tai-khoan/ket-noi/login/facebook/?next=/hoi-bac-si/danh-sach/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng ký qua Facebook</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</script>

<script type="text/html" id="signup-confirmation-template">
	<div class="form-success">
		<h4><i class="fa fa-check-square-o"></i> Đăng ký mở tài khoản thành công!</h4>
		<p>Chào mừng bạn đến với ViCare!</p>
		<div class="for-account-type-professional">
			<p>Cảm ơn bạn đã gửi thông tin. Chúng tôi sẽ liên hệ với bạn để xác nhận trong thời gian sớm nhất.</p>
		</div>
		<div class="for-account-type-place">
			<p>Cảm ơn bạn đã gửi thông tin. Chúng tôi sẽ liên hệ với bạn để xác nhận trong thời gian sớm nhất.</p>
		</div>
		<p>
			<strong>Họ và tên:</strong> <%= name %>
			<br />
			<strong>Số điện thoại:</strong>
			<%= phone ? phone : '<em>chưa cung cấp</em>' %>
			<br />
			<strong>Email:</strong> <%= email %>
		</p>
		<div class="button-row">
			<a href="<%= next %>" class="button">OK <i class="fa fa-check" aria-hidden="true"></i></a>
		</div>
	</div>
</script>



			
			<input name="csrfmiddlewaretoken" value="o76v1bf5eB34ClSCVPwbpGYopdhPhjC5" type="hidden">
		</div>
@endsection
