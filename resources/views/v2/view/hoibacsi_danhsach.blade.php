@extends('v2/structor/main',['title'=> 'Danh sách câu hỏi'])
@section('content')
<script type="text/javascript">
	$(document).ready(function(){
		let sec = $(".sec-js");
		for(let i = 0; i< sec.length; i++){
			$(sec[i]).find('dl').find('dt').slice(0,11).show();
		}
		$(".ck-ud").on('click',function(){
			let a = $(".sec-js dt").length;
			let data_id = $(this).attr("data-id");
			if(data_id == 0){
				$(this).find("#ck-up").show();
				$(this).find("#ck-down").hide();
				$(this).parents(".sec-js").find('dl').find('dt').show();
				$(this).attr("data-id","1");
			}
			else{
				$(this).find("#ck-up").hide();
				$(this).find("#ck-down").show();
				$(this).parents(".sec-js").find('dl').find('dt').slice(11,a).hide();
				$(this).attr("data-id","0");
			}
		});
	});
</script>
<div class="main-A">
	<div id="top">
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="#">Danh sách câu hỏi</a></li>
                    </ul> 
                    
                </div>
                <h1 style="font-size: 18px;">
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
                <a class="buthbs but-ds-hbs" href="/hoibacsi/datcauhoi/" title="Đặt câu hỏi cho bác sĩ, hoàn toàn miễn phí">
		<i class="fa fa-commenting" aria-hidden="true"></i> Đặt câu hỏi miễn phí
		</a>
            </div> 
             <div class="global-thread-create-cta">
			<a href="/hoibacsi/datcauhoi/" class="button">
				<i class="fa fa-question-circle" aria-hidden="true"></i>
				<strong>Hỏi bác sĩ</strong>
				<span>miễn phí</span>
			</a>
		</div>
	 </div><!-- #top -->

	 <div class="ds-hbs-cnt">
		@if(request()->input('unanswered'))
			<a href="/hoibacsi/danhsach" class="unanswered" title="Xem những câu hỏi được trả lời">
			Xem những câu hỏi được trả lời
				<i class="fa fa-angle-double-right"></i>
			</a>
		@else
			<a href="/hoibacsi/danhsach/?unanswered=true" class="unanswered" title="Xem những câu hỏi chưa được trả lời">
			Xem những câu hỏi chưa được trả lời
				<i class="fa fa-angle-double-right"></i>
			</a>
		@endif		
		@if(request()->input('q')!==null)
		 <div id="search">
        
            <ul>
                <li>
                    <span>Tìm kiếm theo:</span>
                </li>
                
                <li>
                    <a href="/danhsach-phongkham/?q={{request()->input('q')}}">
                        Phòng khám ({{$clinic or '0' }})
                    </a>
                </li>

                 <li>
	                    <a href="/danh-sach-nha-thuoc/?q={{request()->input('q')}}" >
	                        Nhà thuốc ({{$drugstore or '0' }})
	                    </a>
	            </li>
	            
                <li>
                    <a href="/danh-sach-bac-si/?q={{request()->input('q')}}">
                        Bác sĩ ({{$doctor or '0'}})
                    </a>
                </li>
                  <li>
                    <a href="/hoibacsi/danhsach/?q={{request()->input('q')}}" class="active">
                        Hỏi bác sĩ ({{$question or '0'}})
                    </a>
                </li>
                <li>
                    <a href="/benh/tim-kiem/?q={{request()->input('q')}}" >
                        Bệnh ({{$count or '0'}})
                    </a>
                </li>
                
                <li>
                    <a href="/thuoc-danhsach/?q={{request()->input('q')}}">
                        Thuốc ({{$thuoc or '0'}})
                    </a>
                </li>
                
               
                
            </ul>
        
    		</div><!-- #Nav search -->
		@endif

		<div class="as-left-hbs-ds">
			@foreach($questions as $qs)

			<article class="as-left-hbs-ds2">

				<div class="question">


					<h3><a href="/hoibacsi/{{$qs->question_url}}-{{$qs->question_id}}">{{$qs->question_title}}</a>
					</h3>

					<div class="post-meta-data">
						<span class="user">
							<?php $user = App\Users::find($qs->user_id) ?>
							@if(isset($user) && $user)
								{{$user->fullname}}
							@else
								Giấu tên
							@endif
						</span>

						<span class="time">
							{{$qs->created_at}}
						</span>

						<?php $chuyenkhoa = App\Speciality::find($qs->speciality_id) ?>
						@if(isset($chuyenkhoa) && $chuyenkhoa)
							<span>
							Chuyên khoa:
								<a href="/hoibacsi/danhsach/?speciality=san-phu" title="">
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
								<h4><a href="/danh-sach-bac-si-chi-tiet/{{$traloi->user->doctor->doctor_url}}-{{$traloi->user->doctor->doctor_id}}">
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

							</li>
							@endif
						</ul>
						</div>
					@endif
				@endif
			</article>

		@endforeach
		</div>
		{{--  <div class="pagination">
            <span class="current">
               {!!$questions->appends(request()->input())->links()!!}
            </span>
     
    	</div> --}}
    	<aside class="as-right-hbs-ds">
		    <section class="sec-hbs-ds">
		        
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
		                <a class="image circle" href="/danh-sach-bac-si-chi-tiet/do-huu-thanh-17514/noi-co-xuong-khop" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/18_05_2016_07_42_38_508966.jpeg);" title="Bác sĩ Đỗ Hữu Thảnh"></a>

		                <div class="body">
		                    <h4>
		                        <a href="/danh-sach-bac-si-chi-tiet/do-huu-thanh-17514/noi-co-xuong-khop" title="Bác sĩ Đỗ Hữu Thảnh">
		                            Bác sĩ
		                            Đỗ Hữu Thảnh
		                        </a>
		                    </h4>
		                    
		                        <p><i class="fa fa-reply" aria-hidden="true"></i> 281</p>
		                    
		                </div>
		            </li>
		            
		            <li>
		                <a class="image circle" href="/danh-sach-bac-si-chi-tiet/le-thi-thanh-xuan-18845/da-lieu" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/08_02_2017_02_32_04_494405.jpeg);" title="Bác sĩ Lê Thị Thanh Xuân"></a>

		                <div class="body">
		                    <h4>
		                        <a href="/danh-sach-bac-si-chi-tiet/le-thi-thanh-xuan-18845/da-lieu" title="Bác sĩ Lê Thị Thanh Xuân">
		                            Bác sĩ
		                            Lê Thị Thanh Xuân
		                        </a>
		                    </h4>
		                    
		                        <p><i class="fa fa-reply" aria-hidden="true"></i> 256</p>
		                    
		                </div>
		            </li>
		            
		            <li>
		                <a class="image circle" href="/danh-sach-bac-si-chi-tiet/ha-van-chan-20950/da-lieu" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/14_10_2016_08_21_54_553911.jpeg);" title="Bác sĩ Hà Văn Chấn"></a>

		                <div class="body">
		                    <h4>
		                        <a href="/danh-sach-bac-si-chi-tiet/ha-van-chan-20950/da-lieu" title="Bác sĩ Hà Văn Chấn">
		                            Bác sĩ
		                            Hà Văn Chấn
		                        </a>
		                    </h4>
		                    
		                        <p><i class="fa fa-reply" aria-hidden="true"></i> 179</p>
		                    
		                </div>
		            </li>
		            
		            <li>
		                <a class="image circle" href="/danh-sach-bac-si-chi-tiet/duong-quang-huy-10059/nam-khoa" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/06_07_2016_08_13_59_950040.jpeg);" title="Bác sĩ Dương Quang Huy"></a>

		                <div class="body">
		                    <h4>
		                        <a href="/danh-sach-bac-si-chi-tiet/duong-quang-huy-10059/nam-khoa" title="Bác sĩ Dương Quang Huy">
		                            Bác sĩ
		                            Dương Quang Huy
		                        </a>
		                    </h4>
		                    
		                        <p><i class="fa fa-reply" aria-hidden="true"></i> 112</p>
		                    
		                </div>
		            </li>
		            
		            <li>
		                <a class="image circle" href="/danh-sach-bac-si-chi-tiet/vu-viet-hung-18815/san-phu-khoa" title="Bác sĩ Vũ Việt Hùng"></a>

		                <div class="body">
		                    <h4>
		                        <a href="/danh-sach-bac-si-chi-tiet/vu-viet-hung-18815/san-phu-khoa" title="Bác sĩ Vũ Việt Hùng">
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
		    

		    
		    <section class="sec-q-ck sec-js">
		        <h3>Câu hỏi theo chuyên khoa</h3>

		        <dl class="collapsible-target">
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=san-phu" class="" title="Sản phụ khoa">
		                    <h5>Sản phụ khoa</h5>
		                    <span class="thread-count ">10831 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=da-lieu" class="" title="Da liễu">
		                    <h5>Da liễu</h5>
		                    <span class="thread-count ">8236 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=nhi" class="" title="Nhi">
		                    <h5>Nhi</h5>
		                    <span class="thread-count ">6555 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=truyen-nhiem" class="" title="Truyền nhiễm">
		                    <h5>Truyền nhiễm</h5>
		                    <span class="thread-count ">4940 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=tieu-hoa-gan-mat" class="" title="Tiêu hóa - Gan mật">
		                    <h5>Tiêu hóa - Gan mật</h5>
		                    <span class="thread-count ">4451 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=tai-mui-hong" class="" title="Tai - Mũi - Họng">
		                    <h5>Tai - Mũi - Họng</h5>
		                    <span class="thread-count ">4258 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=than-kinh" class="" title="Thần kinh">
		                    <h5>Thần kinh</h5>
		                    <span class="thread-count ">4053 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=co-xuong-khop" class="" title="Cơ Xương Khớp">
		                    <h5>Cơ Xương Khớp</h5>
		                    <span class="thread-count ">3520 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=nam" class="" title="Nam khoa">
		                    <h5>Nam khoa</h5>
		                    <span class="thread-count ">3332 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=nhan-khoa" class="" title="Nhãn khoa">
		                    <h5>Nhãn khoa</h5>
		                    <span class="thread-count ">2872 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=rang-ham-mat" class="" title="Răng - Hàm - Mặt">
		                    <h5>Răng - Hàm - Mặt</h5>
		                    <span class="thread-count ">2315 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=dinh-duong" class="" title="Dinh dưỡng">
		                    <h5>Dinh dưỡng</h5>
		                    <span class="thread-count ">2147 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=duoc" class="" title="Dược">
		                    <h5>Dược</h5>
		                    <span class="thread-count ">2142 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=ung-buou" class="" title="Ung bướu">
		                    <h5>Ung bướu</h5>
		                    <span class="thread-count ">1992 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=kham-benh" class="" title="Khám bệnh">
		                    <h5>Khám bệnh</h5>
		                    <span class="thread-count ">1929 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=than-tiet-nieu" class="" title="Thận - Tiết niệu">
		                    <h5>Thận - Tiết niệu</h5>
		                    <span class="thread-count ">1818 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=tim-mach" class="" title="Tim mạch">
		                    <h5>Tim mạch</h5>
		                    <span class="thread-count ">1583 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=ho-hap" class="" title="Hô hấp">
		                    <h5>Hô hấp</h5>
		                    <span class="thread-count ">1453 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=noi-tiet" class="" title="Nội tiết">
		                    <h5>Nội tiết</h5>
		                    <span class="thread-count ">1239 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=tam-than" class="" title="Tâm thần">
		                    <h5>Tâm thần</h5>
		                    <span class="thread-count ">1208 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=xet-nghiem" class="" title="Xét nghiệm">
		                    <h5>Xét nghiệm</h5>
		                    <span class="thread-count ">944 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=chan-thuong-chinh-hinh-cot-song" class="" title="Chấn thương chỉnh hình - Cột sống">
		                    <h5>Chấn thương chỉnh hình - Cột sống</h5>
		                    <span class="thread-count ">877 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=hiem-muon-vo-sinh" class="" title="Hiếm muộn - Vô sinh">
		                    <h5>Hiếm muộn - Vô sinh</h5>
		                    <span class="thread-count ">819 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=tham-my" class="" title="Thẩm mỹ">
		                    <h5>Thẩm mỹ</h5>
		                    <span class="thread-count ">784 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=di-ung-mien-dich" class="" title="Dị ứng - Miễn dịch">
		                    <h5>Dị ứng - Miễn dịch</h5>
		                    <span class="thread-count ">711 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=huyet-hoc-truyen-mau" class="" title="Huyết học - Truyền máu">
		                    <h5>Huyết học - Truyền máu</h5>
		                    <span class="thread-count ">592 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=chua-ro" class="" title="Chưa rõ">
		                    <h5>Chưa rõ</h5>
		                    <span class="thread-count ">361 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=vat-ly-tri-lieu-phuc-hoi-chuc-nang" class="" title="Vật lý trị liệu - Phục hồi chức năng">
		                    <h5>Vật lý trị liệu - Phục hồi chức năng</h5>
		                    <span class="thread-count ">287 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=da-khoa" class="" title="Đa khoa">
		                    <h5>Đa khoa</h5>
		                    <span class="thread-count ">191 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=y-hoc-co-truyen" class="" title="Y học cổ truyền">
		                    <h5>Y học cổ truyền</h5>
		                    <span class="thread-count ">177 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=lao-khoa" class="" title="Lão khoa">
		                    <h5>Lão khoa</h5>
		                    <span class="thread-count ">157 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=kiem-soat-nhiem-khuan" class="" title="Kiểm soát nhiễm khuẩn">
		                    <h5>Kiểm soát nhiễm khuẩn</h5>
		                    <span class="thread-count ">154 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=di-truyen-sinh-hoc-phan-tu" class="" title="Di truyền &amp; Sinh học phân tử">
		                    <h5>Di truyền &amp; Sinh học phân tử</h5>
		                    <span class="thread-count ">141 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=chan-doan-hinh-anh" class="" title="Chẩn đoán hình ảnh">
		                    <h5>Chẩn đoán hình ảnh</h5>
		                    <span class="thread-count ">111 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=noi-soi" class="" title="Nội soi">
		                    <h5>Nội soi</h5>
		                    <span class="thread-count ">101 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=noi-tong-hop" class="" title="Nội Tổng hợp">
		                    <h5>Nội Tổng hợp</h5>
		                    <span class="thread-count ">81 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=giai-phau-benh" class="" title="Giải phẫu bệnh">
		                    <h5>Giải phẫu bệnh</h5>
		                    <span class="thread-count ">64 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=hoi-suc-cap-cuu" class="" title="Hồi sức - Cấp cứu">
		                    <h5>Hồi sức - Cấp cứu</h5>
		                    <span class="thread-count ">32 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=thu-y" class="" title="Thú y">
		                    <h5>Thú y</h5>
		                    <span class="thread-count ">32 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=noi-noi-tiet-dai-thao-duong" class="" title="Nội - Nội tiết -  Đái tháo đường">
		                    <h5>Nội - Nội tiết -  Đái tháo đường</h5>
		                    <span class="thread-count ">26 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=hen-phe-quan" class="" title="Hen phế quản">
		                    <h5>Hen phế quản</h5>
		                    <span class="thread-count ">9 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=gay-me-hoi-suc" class="" title="Gây mê hồi sức">
		                    <h5>Gây mê hồi sức</h5>
		                    <span class="thread-count ">7 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=nhi-tim-mach" class="" title="Nhi Tim mạch">
		                    <h5>Nhi Tim mạch</h5>
		                    <span class="thread-count ">7 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=noi-tieu-hoa-gan-mat" class="" title="Nội Tiêu hoá - Gan mật">
		                    <h5>Nội Tiêu hoá - Gan mật</h5>
		                    <span class="thread-count ">6 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=tham-do-chuc-nang" class="" title="Thăm dò chức năng">
		                    <h5>Thăm dò chức năng</h5>
		                    <span class="thread-count ">5 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=chan-thuong-chinh-hinh-ham-mat" class="" title="Chấn thương chỉnh hình hàm mặt">
		                    <h5>Chấn thương chỉnh hình hàm mặt</h5>
		                    <span class="thread-count ">4 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?speciality=soi-dai-trang" class="" title="Soi đại tràng">
		                    <h5>Soi đại tràng</h5>
		                    <span class="thread-count ">2 câu hỏi</span>
		                </a>
		            </dt>
		            
		        </dl>

		        <div class="ck-ud" data-id="0">
		            <span class="trigger-expand"><i class="fa fa-chevron-down" id="ck-down"></i></span>
		            <span class="trigger-collapse"><i class="fa fa-chevron-up" id="ck-up"></i></span>
		        </div>
		    </section>
		    

		    
		    <section class="sec-q-cd sec-js">
		        <h3>Câu hỏi theo chủ đề</h3>

		        <dl class="collapsible-target">
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=phu-nu" class="" title="Phụ nữ">
		                    <h5>Phụ nữ</h5>
		                    <span class="thread-count ">6921 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=da-lieu" class="" title="Da liễu ">
		                    <h5>Da liễu </h5>
		                    <span class="thread-count ">6917 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=tre-em" class="" title="Trẻ em">
		                    <h5>Trẻ em</h5>
		                    <span class="thread-count ">4917 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=thuoc-thuc-pham-chuc-nang" class="" title="Thuốc / Thực phẩm chức năng ">
		                    <h5>Thuốc / Thực phẩm chức năng </h5>
		                    <span class="thread-count ">4597 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=me-va-be" class="" title="Mẹ và bé">
		                    <h5>Mẹ và bé</h5>
		                    <span class="thread-count ">4042 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=nam-khoa" class="" title="Nam khoa ">
		                    <h5>Nam khoa </h5>
		                    <span class="thread-count ">2793 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=dia-chi-kham-benh" class="" title="Địa chỉ khám bệnh ">
		                    <h5>Địa chỉ khám bệnh </h5>
		                    <span class="thread-count ">2435 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=dinh-duong" class="" title="Dinh dưỡng">
		                    <h5>Dinh dưỡng</h5>
		                    <span class="thread-count ">2198 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=benh-xa-hoi" class="" title="Bệnh xã hội">
		                    <h5>Bệnh xã hội</h5>
		                    <span class="thread-count ">2075 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=tiem-chung" class="" title="Tiêm chủng">
		                    <h5>Tiêm chủng</h5>
		                    <span class="thread-count ">1709 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=mat" class="" title="Mắt">
		                    <h5>Mắt</h5>
		                    <span class="thread-count ">1606 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=tinh-duc-gioi-tinh" class="" title="Tình dục / Giới tính">
		                    <h5>Tình dục / Giới tính</h5>
		                    <span class="thread-count ">1604 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=xet-nghiem" class="" title="Xét nghiệm">
		                    <h5>Xét nghiệm</h5>
		                    <span class="thread-count ">1439 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=chi-phi-kham-benh" class="" title="Chi phí khám bệnh">
		                    <h5>Chi phí khám bệnh</h5>
		                    <span class="thread-count ">1363 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=ung-thu" class="" title="Ung thư ">
		                    <h5>Ung thư </h5>
		                    <span class="thread-count ">1245 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=tam-ly" class="" title="Tâm lý">
		                    <h5>Tâm lý</h5>
		                    <span class="thread-count ">1190 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=benh-thuong-thuc" class="" title="Bệnh thường thức">
		                    <h5>Bệnh thường thức</h5>
		                    <span class="thread-count ">1062 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=lam-dep" class="" title="Làm đẹp ">
		                    <h5>Làm đẹp </h5>
		                    <span class="thread-count ">984 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=nguoi-cao-tuoi" class="" title="Người cao tuổi">
		                    <h5>Người cao tuổi</h5>
		                    <span class="thread-count ">665 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=tuoi-day-thi" class="" title="Tuổi dậy thì">
		                    <h5>Tuổi dậy thì</h5>
		                    <span class="thread-count ">535 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=thu-tuc-kham-benh" class="" title="Thủ tục khám bệnh">
		                    <h5>Thủ tục khám bệnh</h5>
		                    <span class="thread-count ">438 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=vo-sinh" class="" title="Vô sinh">
		                    <h5>Vô sinh</h5>
		                    <span class="thread-count ">370 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=" class="" title="Dịch bệnh">
		                    <h5>Dịch bệnh</h5>
		                    <span class="thread-count ">252 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=y-hoc-co-truyen" class="" title="Y học cổ truyền ">
		                    <h5>Y học cổ truyền </h5>
		                    <span class="thread-count ">206 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=the-hinh" class="" title="Thể hình">
		                    <h5>Thể hình</h5>
		                    <span class="thread-count ">206 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=bao-hiem" class="" title="Bảo hiểm">
		                    <h5>Bảo hiểm</h5>
		                    <span class="thread-count ">153 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=benh-nghe-nghiep" class="" title="Bệnh nghề nghiệp">
		                    <h5>Bệnh nghề nghiệp</h5>
		                    <span class="thread-count ">115 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=benh-mua-lanh" class="" title="Bệnh mùa lạnh ">
		                    <h5>Bệnh mùa lạnh </h5>
		                    <span class="thread-count ">112 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=benh-giao-mua" class="" title="Bệnh giao mùa">
		                    <h5>Bệnh giao mùa</h5>
		                    <span class="thread-count ">67 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=tuoi-tien-man-kinh" class="" title="Tuổi tiền mãn kinh ">
		                    <h5>Tuổi tiền mãn kinh </h5>
		                    <span class="thread-count ">65 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=benh-mua-nong" class="" title="Bệnh mùa nóng">
		                    <h5>Bệnh mùa nóng</h5>
		                    <span class="thread-count ">58 câu hỏi</span>
		                </a>
		            </dt>
		            
		            <dt>
		                <a href="/hoibacsi/danhsach/?topic=an-toan-thuc-pham" class="" title="An toàn thực phẩm ">
		                    <h5>An toàn thực phẩm </h5>
		                    <span class="thread-count ">55 câu hỏi</span>
		                </a>
		            </dt>
		            
		        </dl>

		        <div class="ck-ud" data-id="0">
		            <span class="trigger-expand"><i class="fa fa-chevron-down" id="ck-down"></i></span>
		            <span class="trigger-collapse"><i class="fa fa-chevron-up" id="ck-up"></i></span>
		        </div>
		    </section>
		    

		    
		    <section class="top-list">
		        <h3>Đáng quan tâm</h3>

		        <ul>
		            
		            <li>
		                <a href="/hoibacsi/tuyenchon/dung-thuoc-bo-khi-mang-thai-nhung-dieu-ban-nen-biet-3606/" title="Dùng thuốc bổ khi mang thai: Những điều bạn nên biết" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/03_11_2016_08_11_56_271991.jpeg);"></a>

		                <div class="body">
		                    <h4>
		                        <a href="/hoibacsi/tuyenchon/dung-thuoc-bo-khi-mang-thai-nhung-dieu-ban-nen-biet-3606/" title="Dùng thuốc bổ khi mang thai: Những điều bạn nên biết">Dùng thuốc bổ khi mang thai: Những điều bạn nên biết</a>
		                    </h4>
		                </div>
		            </li>
		            
		            <li>
		                <a href="/hoibacsi/tuyenchon/4-dieu-can-biet-ve-chung-roi-loan-lo-au-mang-thai-va-sau-sinh-6515/" title="4 điều cần biết về chứng rối loạn lo âu mang thai và sau sinh" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/12_12_2016_07_59_47_303830.jpeg);"></a>

		                <div class="body">
		                    <h4>
		                        <a href="/hoibacsi/tuyenchon/4-dieu-can-biet-ve-chung-roi-loan-lo-au-mang-thai-va-sau-sinh-6515/" title="4 điều cần biết về chứng rối loạn lo âu mang thai và sau sinh">4 điều cần biết về chứng rối loạn lo âu mang thai và sau sinh</a>
		                    </h4>
		                </div>
		            </li>
		            
		            <li>
		                <a href="/hoibacsi/tuyenchon/nhung-dau-hieu-bat-thuong-o-moi-lon-cua-am-dao-can-canh-giac-1598/" title="Những dấu hiệu bất thường ở môi lớn của âm đạo cần cảnh giác" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/07_10_2016_09_00_07_394514.jpeg);"></a>

		                <div class="body">
		                    <h4>
		                        <a href="/hoibacsi/tuyenchon/nhung-dau-hieu-bat-thuong-o-moi-lon-cua-am-dao-can-canh-giac-1598/" title="Những dấu hiệu bất thường ở môi lớn của âm đạo cần cảnh giác">Những dấu hiệu bất thường ở môi lớn của âm đạo cần cảnh giác</a>
		                    </h4>
		                </div>
		            </li>
		            
		            <li>
		                <a href="/hoibacsi/tuyenchon/hay-can-than-khi-di-sieu-am-1302/" title="Hãy cẩn thận khi đi siêu âm!" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/04_10_2016_08_38_06_307621.jpeg);"></a>

		                <div class="body">
		                    <h4>
		                        <a href="/hoibacsi/tuyenchon/hay-can-than-khi-di-sieu-am-1302/" title="Hãy cẩn thận khi đi siêu âm!">Hãy cẩn thận khi đi siêu âm!</a>
		                    </h4>
		                </div>
		            </li>
		            
		            <li>
		                <a href="/hoibacsi/tuyenchon/nhung-dau-hieu-nhan-biet-thai-nhi-bi-di-tat-1193/" title="Những dấu hiệu nhận biết thai nhi bị dị tật" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/02_12_2016_10_43_25_883038.jpeg);"></a>

		                <div class="body">
		                    <h4>
		                        <a href="/hoibacsi/tuyenchon/nhung-dau-hieu-nhan-biet-thai-nhi-bi-di-tat-1193/" title="Những dấu hiệu nhận biết thai nhi bị dị tật">Những dấu hiệu nhận biết thai nhi bị dị tật</a>
		                    </h4>
		                </div>
		            </li>
		            
		            <li>
		                <a href="/hoibacsi/tuyenchon/canh-giac-voi-chung-dau-bung-khi-mang-thai-6420/" title="Cảnh giác với chứng đau bụng khi mang thai" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/07_12_2016_10_58_40_446638.jpeg);"></a>

		                <div class="body">
		                    <h4>
		                        <a href="/hoibacsi/tuyenchon/canh-giac-voi-chung-dau-bung-khi-mang-thai-6420/" title="Cảnh giác với chứng đau bụng khi mang thai">Cảnh giác với chứng đau bụng khi mang thai</a>
		                    </h4>
		                </div>
		            </li>
		            
		            <li>
		                <a href="/hoibacsi/tuyenchon/mo-ap-xe-vu-bao-lau-thi-lanh-va-nhung-cau-hoi-thuong-gap-1957/" title="Mổ áp xe vú bao lâu thì lành và những câu hỏi thường gặp?" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/13_10_2016_08_46_27_644597.jpeg);"></a>

		                <div class="body">
		                    <h4>
		                        <a href="/hoibacsi/tuyenchon/mo-ap-xe-vu-bao-lau-thi-lanh-va-nhung-cau-hoi-thuong-gap-1957/" title="Mổ áp xe vú bao lâu thì lành và những câu hỏi thường gặp?">Mổ áp xe vú bao lâu thì lành và những câu hỏi thường gặp?</a>
		                    </h4>
		                </div>
		            </li>
		            
		            <li>
		                <a href="/hoibacsi/tuyenchon/phau-thuat-noi-gan-bao-lau-thi-phuc-hoi-4136/" title="Phẫu thuật nối gân phục hồi trong bao lâu?" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/10_11_2016_09_52_53_066064.jpeg);"></a>

		                <div class="body">
		                    <h4>
		                        <a href="/hoibacsi/tuyenchon/phau-thuat-noi-gan-bao-lau-thi-phuc-hoi-4136/" title="Phẫu thuật nối gân phục hồi trong bao lâu?">Phẫu thuật nối gân phục hồi trong bao lâu?</a>
		                    </h4>
		                </div>
		            </li>
		            
		            <li>
		                <a href="/hoibacsi/tuyenchon/thoi-gian-hoi-phuc-dut-gan-ngon-tay-3228/" title="Lưu ý về thời gian hồi phục đứt gân ngón tay" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/31_10_2016_04_17_20_915796.jpeg);"></a>

		                <div class="body">
		                    <h4>
		                        <a href="/hoibacsi/tuyenchon/thoi-gian-hoi-phuc-dut-gan-ngon-tay-3228/" title="Lưu ý về thời gian hồi phục đứt gân ngón tay">Lưu ý về thời gian hồi phục đứt gân ngón tay</a>
		                    </h4>
		                </div>
		            </li>
		            
		            <li>
		                <a href="/hoibacsi/tuyenchon/neu-nuoc-bot-tiet-ra-kem-mau-cho-chu-quan-3294/" title="Nếu nước bọt tiết ra kèm máu, chớ chủ quan!" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/31_10_2016_09_20_03_519856.jpeg);"></a>

		                <div class="body">
		                    <h4>
		                        <a href="/hoibacsi/tuyenchon/neu-nuoc-bot-tiet-ra-kem-mau-cho-chu-quan-3294/" title="Nếu nước bọt tiết ra kèm máu, chớ chủ quan!">Nếu nước bọt tiết ra kèm máu, chớ chủ quan!</a>
		                    </h4>
		                </div>
		            </li>
		            
		        </ul>

		        <a href="/hoibacsi/tuyenchon/" class="view-more">Xem tất cả các câu hỏi tuyển chọn</a>
		    </section>
		    

		    
		</aside>
		 <div class="pagination">

            <span class="current">
               {!!$questions->appends(request()->input())->links()!!}
            </span>
    	</div>
	 </div>
</div>
@endsection