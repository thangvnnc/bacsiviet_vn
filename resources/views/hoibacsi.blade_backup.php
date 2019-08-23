@extends('main',['title'=> 'Hỏi bác sĩ'])


@section('content')
  <div id="main">
			
			
			

<div id="page-title" class="has-create">
	<div class="background"></div>
	<div class="mask">
		<div class="position">
			<ul class="breadcrumbs">
				<li><a href="/">Trang chủ</a></li>
				
					<li class="active">Hỏi bác sĩ</li>
				
			</ul>

			<h1>Chuyên mục Hỏi bác sĩ</h1>

			<a class="button create-thread" href="/hoi-bac-si/dat-cau-hoi/" title="Đặt câu hỏi cho bác sĩ, hoàn toàn miễn phí">
				<i class="fa fa-commenting" aria-hidden="true"></i> Đặt câu hỏi miễn phí
			</a>
		</div>
	</div>
</div>

<div id="forum-landing" class="has-aside">
	<div class="position">
		<div class="content">
			<div id="forum-landing-top">
				<div class="header">
					<h3>Tuyển chọn</h3>
					<a href="/hoi-bac-si/tuyen-chon/">Xem tuyển chọn câu hỏi <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
				</div>

				<div class="row">
				@if(isset($selectquestion))
				 @foreach($selectquestion as $index=>$ques)
				   @if($index==0)
					<div id="col-left">
						
							<article>
								<div class="caption">
								
									<a class="image" href="/hoi-bac-si/tuyen-chon/{{\App\Deals::strtoUrl($ques->subject)}}-{{$ques->id}}/" style="background-image: url({{$ques->image}});"></a>

									<h3><a href="/hoi-bac-si/tuyen-chon/{{\App\Deals::strtoUrl($ques->subject)}}-{{$ques->id}}/">{{$ques->subject}}</a></h3>
								</div>

								<div class="body">
									<p>
										{!!$ques->description!!}
										<a href="/hoi-bac-si/tuyen-chon/{{\App\Deals::strtoUrl($ques->subject)}}-{{$ques->id}}/" class="readmore">Xem tiếp <i class="fa fa-angle-double-right"></i></a>
									</p>
								</div>
							</article>
						
					</div>
				
				@endif
				@endforeach
					<div id="col-right">
						<ul>
							
								
							
								@foreach($selectquestion as $index=>$ques)
								@if($index!=0)
								<li>
									<a class="image" href="/hoi-bac-si/tuyen-chon/{{\App\Deals::strtoUrl($ques->subject)}}-{{$ques->id}}/" style="background-image: url({{$ques->image}});"></a>
									<h3><a href="/hoi-bac-si/tuyen-chon/{{\App\Deals::strtoUrl($ques->subject)}}-{{$ques->id}}/">{{$ques->subject}}</a></h3>
								</li>
								@endif
							   @endforeach
								
								
							
						</ul>
					</div>
					@endif
				</div>
			</div>

			<div id="forum-landing-bottom">
				<div class="header">
					<h3>Các câu trả lời mới nhất</h3>
				<!-- 	<a href="/hoi-bac-si/danh-sach/">Xem danh sách câu hỏi <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
				--></div>

				@foreach($question as $qs)
				@if($qs->answer!=null)
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
											@else
												{{$traloi->user->doctor->doctor_description}}
											@endif
										</li>
								@else
									<li>
											<span class="image " @if(!empty($traloi->user->clinic->profile_image)) style="background-image: url(@if(strpos($traloi->user->clinic->profile_image,'http')===false)/@endif{{$traloi->user->clinic->profile_image}});" @endif></span>
											<h4><a href="/co-so-y-te/{{$traloi->user->clinic->clinic_url}}-{{$traloi->user->clinic->clinic_id}}">
												{{$traloi->user->clinic->clinic_name}}
												</a>
											</h4>

											
												<span>{{$traloi->user->clinic->clinic_address}}</span>
											
										</li>
								@endif
							</ul>
						</div>
					
						
						
						@endif
				</article>
				@endif
				
				@endforeach
				

				

				<div class="view-more">
                    @if(count($question) > 0)
				   {!!$question->links()!!}
					<!-- <a href="/hoi-bac-si/danh-sach/" class="button secondary weak">Xem danh sách câu hỏi</a> -->
                    @endif
				</div>
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

    
    <section class="collapsible-container collapsible-list collapsed">
        <h3 style="color:#2B96CC;">Câu hỏi theo chuyên khoa</h3>

        <dl class="">
            @foreach($speciality as $spec)
            <dt>
                <a href="chuyen-khoa/{{$spec->specialty_url}}-{{$spec->speciality_id}}" class="" title="{{$spec->specialty_url}}">
                    <h5>{{$spec->speciality_name}}</h5>
                    <span class="thread-count "></span>
                </a>
            </dt>
            <!--
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=da-lieu" class="" title="Da liễu">
                    <h5>Da liễu</h5>
                    <span class="thread-count ">7705 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=nhi" class="" title="Nhi">
                    <h5>Nhi</h5>
                    <span class="thread-count ">6424 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=truyen-nhiem" class="" title="Truyền nhiễm">
                    <h5>Truyền nhiễm</h5>
                    <span class="thread-count ">4813 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=tieu-hoa-gan-mat" class="" title="Tiêu hóa - Gan mật">
                    <h5>Tiêu hóa - Gan mật</h5>
                    <span class="thread-count ">4150 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=tai-mui-hong" class="" title="Tai - Mũi - Họng">
                    <h5>Tai - Mũi - Họng</h5>
                    <span class="thread-count ">3988 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=than-kinh" class="" title="Thần kinh">
                    <h5>Thần kinh</h5>
                    <span class="thread-count ">3723 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=co-xuong-khop" class="" title="Cơ Xương Khớp">
                    <h5>Cơ Xương Khớp</h5>
                    <span class="thread-count ">3248 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=nam" class="" title="Nam khoa">
                    <h5>Nam khoa</h5>
                    <span class="thread-count ">3023 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=nhan-khoa" class="" title="Nhãn khoa">
                    <h5>Nhãn khoa</h5>
                    <span class="thread-count ">2669 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=rang-ham-mat" class="" title="Răng - Hàm - Mặt">
                    <h5>Răng - Hàm - Mặt</h5>
                    <span class="thread-count ">2175 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=duoc" class="" title="Dược">
                    <h5>Dược</h5>
                    <span class="thread-count ">2130 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=dinh-duong" class="" title="Dinh dưỡng">
                    <h5>Dinh dưỡng</h5>
                    <span class="thread-count ">2041 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=ung-buou" class="" title="Ung bướu">
                    <h5>Ung bướu</h5>
                    <span class="thread-count ">1913 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=kham-benh" class="" title="Khám bệnh">
                    <h5>Khám bệnh</h5>
                    <span class="thread-count ">1839 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=than-tiet-nieu" class="" title="Thận - Tiết niệu">
                    <h5>Thận - Tiết niệu</h5>
                    <span class="thread-count ">1726 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=tim-mach" class="" title="Tim mạch">
                    <h5>Tim mạch</h5>
                    <span class="thread-count ">1484 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=ho-hap" class="" title="Hô hấp">
                    <h5>Hô hấp</h5>
                    <span class="thread-count ">1336 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=noi-tiet" class="" title="Nội tiết">
                    <h5>Nội tiết</h5>
                    <span class="thread-count ">1125 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=tam-than" class="" title="Tâm thần">
                    <h5>Tâm thần</h5>
                    <span class="thread-count ">1115 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=xet-nghiem" class="" title="Xét nghiệm">
                    <h5>Xét nghiệm</h5>
                    <span class="thread-count ">904 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=chan-thuong-chinh-hinh-cot-song" class="" title="Chấn thương chỉnh hình - Cột sống">
                    <h5>Chấn thương chỉnh hình - Cột sống</h5>
                    <span class="thread-count ">793 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=hiem-muon-vo-sinh" class="" title="Hiếm muộn - Vô sinh">
                    <h5>Hiếm muộn - Vô sinh</h5>
                    <span class="thread-count ">724 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=tham-my" class="" title="Thẩm mỹ">
                    <h5>Thẩm mỹ</h5>
                    <span class="thread-count ">716 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=di-ung-mien-dich" class="" title="Dị ứng - Miễn dịch">
                    <h5>Dị ứng - Miễn dịch</h5>
                    <span class="thread-count ">685 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=huyet-hoc-truyen-mau" class="" title="Huyết học - Truyền máu">
                    <h5>Huyết học - Truyền máu</h5>
                    <span class="thread-count ">567 câu hỏi</span>
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
                    <span class="thread-count ">273 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=da-khoa" class="" title="Đa khoa">
                    <h5>Đa khoa</h5>
                    <span class="thread-count ">181 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=y-hoc-co-truyen" class="" title="Y học cổ truyền">
                    <h5>Y học cổ truyền</h5>
                    <span class="thread-count ">167 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=lao-khoa" class="" title="Lão khoa">
                    <h5>Lão khoa</h5>
                    <span class="thread-count ">156 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=kiem-soat-nhiem-khuan" class="" title="Kiểm soát nhiễm khuẩn">
                    <h5>Kiểm soát nhiễm khuẩn</h5>
                    <span class="thread-count ">147 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=di-truyen-sinh-hoc-phan-tu" class="" title="Di truyền &amp; Sinh học phân tử">
                    <h5>Di truyền &amp; Sinh học phân tử</h5>
                    <span class="thread-count ">139 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=chan-doan-hinh-anh" class="" title="Chẩn đoán hình ảnh">
                    <h5>Chẩn đoán hình ảnh</h5>
                    <span class="thread-count ">94 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=noi-soi" class="" title="Nội soi">
                    <h5>Nội soi</h5>
                    <span class="thread-count ">90 câu hỏi</span>
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
                    <span class="thread-count ">44 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=hoi-suc-cap-cuu" class="" title="Hồi sức - Cấp cứu">
                    <h5>Hồi sức - Cấp cứu</h5>
                    <span class="thread-count ">29 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=noi-noi-tiet-dai-thao-duong" class="" title="Nội - Nội tiết -  Đái tháo đường">
                    <h5>Nội - Nội tiết -  Đái tháo đường</h5>
                    <span class="thread-count ">26 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=phu" class="" title="Phụ khoa">
                    <h5>Phụ khoa</h5>
                    <span class="thread-count ">26 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=thu-y" class="" title="Thú y">
                    <h5>Thú y</h5>
                    <span class="thread-count ">25 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=ngoai-than-kinh" class="" title="Ngoại Thần kinh">
                    <h5>Ngoại Thần kinh</h5>
                    <span class="thread-count ">12 câu hỏi</span>
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
                <a href="/hoi-bac-si/danh-sach/?speciality=noi-than-tiet-nieu" class="" title="Nội Thận - Tiết niệu">
                    <h5>Nội Thận - Tiết niệu</h5>
                    <span class="thread-count ">5 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=noi-tieu-hoa-gan-mat" class="" title="Nội Tiêu hoá - Gan mật">
                    <h5>Nội Tiêu hoá - Gan mật</h5>
                    <span class="thread-count ">5 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=tham-do-chuc-nang" class="" title="Thăm dò chức năng">
                    <h5>Thăm dò chức năng</h5>
                    <span class="thread-count ">4 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=nha-khoa-tong-quat" class="" title="Nha khoa Tổng quát">
                    <h5>Nha khoa Tổng quát</h5>
                    <span class="thread-count ">2 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?speciality=soi-dai-trang" class="" title="Soi đại tràng">
                    <h5>Soi đại tràng</h5>
                    <span class="thread-count ">2 câu hỏi</span>
                </a>
            </dt>
            -->
            @endforeach
        </dl>

     
    </section>
    

    <!--
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
                    <span class="thread-count ">6916 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=tre-em" class="" title="Trẻ em">
                    <h5>Trẻ em</h5>
                    <span class="thread-count ">4906 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=thuoc-thuc-pham-chuc-nang" class="" title="Thuốc / Thực phẩm chức năng ">
                    <h5>Thuốc / Thực phẩm chức năng </h5>
                    <span class="thread-count ">4589 câu hỏi</span>
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
                    <span class="thread-count ">2789 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=dia-chi-kham-benh" class="" title="Địa chỉ khám bệnh ">
                    <h5>Địa chỉ khám bệnh </h5>
                    <span class="thread-count ">2363 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=dinh-duong" class="" title="Dinh dưỡng">
                    <h5>Dinh dưỡng</h5>
                    <span class="thread-count ">2197 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=benh-xa-hoi" class="" title="Bệnh xã hội">
                    <h5>Bệnh xã hội</h5>
                    <span class="thread-count ">2055 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=tiem-chung" class="" title="Tiêm chủng">
                    <h5>Tiêm chủng</h5>
                    <span class="thread-count ">1674 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=mat" class="" title="Mắt">
                    <h5>Mắt</h5>
                    <span class="thread-count ">1591 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=tinh-duc-gioi-tinh" class="" title="Tình dục / Giới tính">
                    <h5>Tình dục / Giới tính</h5>
                    <span class="thread-count ">1584 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=xet-nghiem" class="" title="Xét nghiệm">
                    <h5>Xét nghiệm</h5>
                    <span class="thread-count ">1431 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=chi-phi-kham-benh" class="" title="Chi phí khám bệnh">
                    <h5>Chi phí khám bệnh</h5>
                    <span class="thread-count ">1284 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=ung-thu" class="" title="Ung thư ">
                    <h5>Ung thư </h5>
                    <span class="thread-count ">1230 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=tam-ly" class="" title="Tâm lý">
                    <h5>Tâm lý</h5>
                    <span class="thread-count ">1125 câu hỏi</span>
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
                    <span class="thread-count ">982 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=nguoi-cao-tuoi" class="" title="Người cao tuổi">
                    <h5>Người cao tuổi</h5>
                    <span class="thread-count ">656 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=tuoi-day-thi" class="" title="Tuổi dậy thì">
                    <h5>Tuổi dậy thì</h5>
                    <span class="thread-count ">529 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=vo-sinh" class="" title="Vô sinh">
                    <h5>Vô sinh</h5>
                    <span class="thread-count ">369 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=thu-tuc-kham-benh" class="" title="Thủ tục khám bệnh">
                    <h5>Thủ tục khám bệnh</h5>
                    <span class="thread-count ">330 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=" class="" title="Dịch bệnh">
                    <h5>Dịch bệnh</h5>
                    <span class="thread-count ">243 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=y-hoc-co-truyen" class="" title="Y học cổ truyền ">
                    <h5>Y học cổ truyền </h5>
                    <span class="thread-count ">204 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=the-hinh" class="" title="Thể hình">
                    <h5>Thể hình</h5>
                    <span class="thread-count ">204 câu hỏi</span>
                </a>
            </dt>
            
            <dt>
                <a href="/hoi-bac-si/danh-sach/?topic=bao-hiem" class="" title="Bảo hiểm">
                    <h5>Bảo hiểm</h5>
                    <span class="thread-count ">126 câu hỏi</span>
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
                    <span class="thread-count ">63 câu hỏi</span>
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
        <h3>Bác sĩ được cảm ơn nhiều nhất</h3>

        <ul>
            
            <li>
                <a href="/danh-sach/bac-si/duong-quang-huy-10059/nam-khoa" title="Dương Quang Huy" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/06_07_2016_08_13_59_950040.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/duong-quang-huy-10059/nam-khoa" title="Dương Quang Huy">
                            Bác sĩ
                            Dương Quang Huy
                        </a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/danh-sach/bac-si/do-huu-thanh-17514/noi-co-xuong-khop" title="Đỗ Hữu Thảnh" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/18_05_2016_07_42_38_508966.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/do-huu-thanh-17514/noi-co-xuong-khop" title="Đỗ Hữu Thảnh">
                            Bác sĩ
                            Đỗ Hữu Thảnh
                        </a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/danh-sach/bac-si/ha-van-chan-20950/da-lieu" title="Hà Văn Chấn" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/14_10_2016_08_21_54_553911.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/ha-van-chan-20950/da-lieu" title="Hà Văn Chấn">
                            Bác sĩ
                            Hà Văn Chấn
                        </a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/danh-sach/bac-si/julia-sac-34325/rang-ham-mat" title="Julia Sac" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/02_01_2017_16_16_36_699169.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/julia-sac-34325/rang-ham-mat" title="Julia Sac">
                            Bác sĩ
                            Julia Sac
                        </a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/danh-sach/bac-si/le-thi-thanh-xuan-18845/da-lieu" title="Lê Thị Thanh Xuân" class="image"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/le-thi-thanh-xuan-18845/da-lieu" title="Lê Thị Thanh Xuân">
                            Bác sĩ
                            Lê Thị Thanh Xuân
                        </a>
                    </h4>
                </div>
            </li>
            
        </ul>

        <a href="/danh-sach/bac-si/" class="view-more">Danh sách bác sĩ</a>
    </section>
    -->
</aside>

	</div>
</div>

			
			<input name="csrfmiddlewaretoken" value="OSU4rxNLLX1ROIMoIKau1fgs2qUAr7Vj" type="hidden">
		</div>
@endsection
