@extends('main',['title'=> $question->question_title])


@section('content')
 <div id="main">
			
			
			
@if(isset($question))
<div id="page-title" class="has-create">
	<div class="background"></div>
	<div class="mask">
		<div class="position">
			<ul class="breadcrumbs">
				<li><a href="/">Trang chủ</a></li>
				<li><a href="/hoi-bac-si/">Hỏi bác sĩ</a></li>
				
					
				
			</ul>

			<h1>
				{{$question->question_title}}

				
			</h1>

			<a class="button create-thread" href="/hoi-bac-si/dat-cau-hoi/" title="Đặt câu hỏi cho bác sĩ, hoàn toàn miễn phí">
				<i class="fa fa-commenting" aria-hidden="true"></i> Đặt câu hỏi miễn phí
			</a>

			
		</div>
	</div>
</div>

<div id="thread-detail" class="has-aside">
	<div class="position">
		<div class="content">
			
				<article>
					
						<div class="question" data-id="243628">
							<div class="post-meta-data">
								<span class="user">
									
										@if($question->fullname!=null)
										{{$question->fullname}}
										@endif
									
								</span>

								<span class="time">
									hỏi lúc {{$question->created_at}}
								</span>

								@if(isset($question->speciality_id) && $question->speciality_id !=0)
								<span>
									Chuyên khoa:
									<?php $chuyenkhoa = App\Speciality::find($question->speciality_id);?>
										<a href="/chuyen-khoa/{{$chuyenkhoa->specialty_url}}-{{$chuyenkhoa->speciality_id}}" title="">{{$chuyenkhoa->speciality_name}}</a>
									
								</span>
								@else
								@endif

								<!--
								<span>
									Chủ đề:
									
										<a href="/hoi-bac-si/danh-sach/?topic=tre-em"></a>
									
								</span>
								-->
							</div>

							<div class="body">
								{{$question->question_content}}
								
							</div>

							<div class="thanks-button-count">
	<a href="#" title="" class="thank " data-id="243628">
		<span class="unactive-text">
			<i class="fa fa-heart-o" aria-hidden="true"></i> Cảm ơn
		</span>
		<span class="active-text">
			<i class="fa fa-heart-o" aria-hidden="true"></i> Đã cảm ơn
		</span>
	</a>

	<div class="thanks-count-inner ">
		<i class="fa fa-heart-o" aria-hidden="true"></i>
			<span class="thank-count-value">0</span>

			
			<span>người đã cảm ơn bài viết</span>

			
		
	</div>
</div>
						</div>
						
					
				</article>
@if(count($question->answers)>0)
@foreach($question->answers as $ans)
@if($ans->answer_type!="customer")
				<article>
					
						
							<div class="answer">
							<div class="answer-top">
									<a class="image " @if(!empty($ans->user->doctor->profile_image) || !empty($ans->user->clinic->profile_image)) style="background-image: url(@if($ans->user->doctor!=null)@if(strpos($ans->user->doctor->profile_image,'http')===false)/@endif{{$ans->user->doctor->profile_image}}@else @if(strpos($ans->user->clinic->profile_image,'http')===false)/@endif{{$ans->user->clinic->profile_image}} @endif);" @endif></a>

									<h3>
										
											<a href="@if($ans->user->doctor!=null || $ans->user->clinic!=null)@if($ans->user->doctor!=null)/danh-sach/bac-si/@else/co-so-y-te/@endif{{App\Deals::strtoUrl($ans->user->doctor!=null?$ans->user->doctor->doctor_name: $ans->user->clinic->clinic_name)}}-{{$ans->user->doctor!=null?$ans->user->doctor->doctor_id: $ans->user->clinic->clinic_id}}@endif">
												<i class="fa fa-fw fa-user-md" aria-hidden="true"></i>
												 @if($ans->user->doctor!=null || $ans->user->clinic!=null)
												 
												 {{$ans->user->doctor!=null?'Bác sĩ '.$ans->user->doctor->doctor_name:$ans->user->clinic->clinic_name}}
												 @else
												 {{$ans->user->fullname}}
												 @endif
											</a>
										

										<span class="verified-badge has-tooltip">
											<em>Chính thức</em>
											<span class="tooltip">Nội dung chính thức từ bác sĩ hợp tác với ViCare</span>
										</span>
									</h3>
										<p>
											<i class="fa fa-fw fa-stethoscope" aria-hidden="true"></i>									
												<a href="/hoi-bac-si/danh-sach/?speciality=kham-benh" title="Khám bệnh">Khám bệnh</a>

										</p>
									
								</div>

								<div class="body">
									<div class="post-meta-data">
										<span class="time">{{$ans->created_at}}</span>

										
									</div>

									<div class="inner-boby">
										<div class="post-body-content">
											{{$ans->answer_content}}
										</div>										
									</div>
									<a href="#" class="reply" data-id="248072">
										<i class="fa fa-reply" aria-hidden="true"></i>
										Trả lời
									</a>

									<div class="thanks-button-count">
			<a href="#" title="" class="thank " data-id="248072">
		<span class="unactive-text">
			<i class="fa fa-heart-o" aria-hidden="true"></i> Cảm ơn
		</span>
		<span class="active-text">
			<i class="fa fa-heart-o" aria-hidden="true"></i> Đã cảm ơn
		</span>
	</a>

	<div class="thanks-count-inner ">
		<i class="fa fa-heart-o" aria-hidden="true"></i>
			<span class="thank-count-value">0</span>

			
			<span>người đã cảm ơn bài viết</span>

			
		
	</div>
		</div>
								</div>
							</div>
						
					
				</article>
@else
<article>
							<div class="answer user-answer">
								<div class="answer-top">
									<div class="post-meta-data">
										<span class="user">
											@if($ans->user!=null)
												{{$ans->user->fullname}}
											@else
												Giấu tên
											@endif
										</span>

										<span class="time">
											Hỏi lúc: {{$ans->created_at}}
										</span>

										
									</div>
								</div>

								<div class="body">
									<div class="inner-boby">
										<div class="post-body-content">
											<p>{{$ans->answer_content}}</p>
										</div>

										
									</div>
									<div class="thanks-button-count">
	<a href="#" title="" class="thank " data-id="248410">
		<span class="unactive-text">
			<i class="fa fa-heart-o" aria-hidden="true"></i> Cảm ơn
		</span>
		<span class="active-text">
			<i class="fa fa-heart-o" aria-hidden="true"></i> Đã cảm ơn
		</span>
	</a>

	<div class="thanks-count-inner ">
		<i class="fa fa-heart-o" aria-hidden="true"></i>
			<span class="thank-count-value">0</span>

			
			<span>người đã cảm ơn bài viết</span>

			
		
	</div>
</div>
								</div>
							</div>
						
					
				</article>
@endif
@endforeach		
@endif
	@if(Session::has('user') != null)
			<div id="post-reply-form">
				<h3>Trả lời</h3>

				<form name="new-post" class="post-new" action="#" method="#">
					
						
							<div class="post-new-top">
								@if(Session::has('user') && Session::get('user')->user_type_id==2)
								<h4>{{Session::get('user')->fullname}}</h4>
								@endif
								<div class="avatar-form" style=""></div>
								@if(Session::has('user') && Session::get('user')->user_type_id==2)
									<input name="reply_as_information" value="{&quot;reply_as_type&quot;: &quot;professional&quot;, &quot;reply_as_id&quot;: &quot;{{Session::get('user')->user_id}}&quot;}" type="hidden">
								@elseif(Session::has('user') && Session::get('user')->user_type_id==3)
											<input name="reply_as_information" value="{&quot;reply_as_type&quot;: &quot;place&quot;, &quot;reply_as_id&quot;: &quot;{{Session::get('user')->user_id}}&quot;}" type="hidden">
								@else
									<input name="reply_as_information" value="{&quot;reply_as_type&quot;: &quot;customer&quot;, &quot;reply_as_id&quot;: &quot;0&quot;}" type="hidden">
								@endif
								
							</div>
						
					

					<textarea class="form-control resize-textarea" name="body" required="" style="height: 108px;"></textarea>
					<button type="submit">Gửi trả lời</button>
					<input name="thread_id" value="{{$question->question_id}}" type="hidden">
				</form>
			</div>
@else
<h3><a href="/dang-nhap"> Bạn Cần Đăng Nhập đễ Bình Luận  </a></h3>

			@endif

			
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
        <h3>Câu hỏi theo chuyên khoa</h3>
        <?php $speciality = App\Speciality::all();?>
        <dl class="">
            @foreach($speciality as $spec)
            <dt>
                <a href="/chuyen-khoa/{{$spec->specialty_url}}-{{$spec->speciality_id}}" class="" title="{{$spec->specialty_url}}">
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
                <a href="/hoi-bac-si/danh-sach/?topic=tre-em" class="forum-name-active" title="Trẻ em">
                    <h5>Trẻ em</h5>
                    <span class="thread-count thread-count-active">4906 câu hỏi</span>
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
        <h3>Bác sĩ có chuyên khoa này</h3>

        <ul>
            
            <li>
                <a class="image circle" href="/danh-sach/bac-si/nguyen-quoc-bao-27/ngoai-co-xuong-khop" title="Bác sĩ Nguyễn Quốc Bảo"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/nguyen-quoc-bao-27/ngoai-co-xuong-khop" title="Bác sĩ Nguyễn Quốc Bảo">
                            Bác sĩ
                            <br>
                            Nguyễn Quốc Bảo
                        </a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a class="image circle" href="/danh-sach/bac-si/ngo-quang-cu-32/nhi" title="Bác sĩ Ngô Quang Cử"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/ngo-quang-cu-32/nhi" title="Bác sĩ Ngô Quang Cử">
                            Bác sĩ
                            <br>
                            Ngô Quang Cử
                        </a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a class="image circle" href="/danh-sach/bac-si/nguyen-ngoc-loi-34/nhi-so-sinh" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/2015-11-19_170238.5572390000.jpeg);" title="Bác sĩ Nguyễn Ngọc Lợi"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/nguyen-ngoc-loi-34/nhi-so-sinh" title="Bác sĩ Nguyễn Ngọc Lợi">
                            Bác sĩ
                            <br>
                            Nguyễn Ngọc Lợi
                        </a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a class="image circle" href="/danh-sach/bac-si/cu-minh-hien-59/kham-benh" title="Bác sĩ Cù Minh Hiền"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/cu-minh-hien-59/kham-benh" title="Bác sĩ Cù Minh Hiền">
                            Bác sĩ
                            <br>
                            Cù Minh Hiền
                        </a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a class="image circle" href="/danh-sach/bac-si/nguyen-van-khue-64/kham-benh" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/01_08_2016_01_51_20_684293.jpeg);" title="Bác sĩ Nguyễn Văn Khuê"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/nguyen-van-khue-64/kham-benh" title="Bác sĩ Nguyễn Văn Khuê">
                            Bác sĩ
                            <br>
                            Nguyễn Văn Khuê
                        </a>
                    </h4>
                </div>
            </li>
            
        </ul>

        <a href="/danh-sach/bac-si/?specialities=nhi" class="view-more">Xem tất cả các bác sĩ có chuyên khoa này</a>
    </section>
    

    

    
    <section class="top-list">
        <h3>Đáng quan tâm</h3>

        <ul>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/ba-bau-nen-va-khong-nen-an-gi-5058/" title="Bà bầu nên và không nên ăn gì?" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/21_11_2016_07_05_12_447214.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/ba-bau-nen-va-khong-nen-an-gi-5058/" title="Bà bầu nên và không nên ăn gì?">Bà bầu nên và không nên ăn gì?</a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/luu-y-khi-kham-thai-truoc-sinh-ma-me-bau-can-biet-1455/" title="Lưu ý khi khám thai trước sinh mà mẹ bầu cần biết!" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/06_10_2016_07_53_40_459842.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/luu-y-khi-kham-thai-truoc-sinh-ma-me-bau-can-biet-1455/" title="Lưu ý khi khám thai trước sinh mà mẹ bầu cần biết!">Lưu ý khi khám thai trước sinh mà mẹ bầu cần biết!</a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/tuyen-chon-cau-hoi-hay-nhat-ve-thuoc-duong-thai-2353/" title="Tuyển chọn câu hỏi hay nhất về thuốc dưỡng thai" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/19_10_2016_09_12_28_716319.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/tuyen-chon-cau-hoi-hay-nhat-ve-thuoc-duong-thai-2353/" title="Tuyển chọn câu hỏi hay nhất về thuốc dưỡng thai">Tuyển chọn câu hỏi hay nhất về thuốc dưỡng thai</a>
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
                <a href="/hoi-bac-si/tuyen-chon/tuyen-chon-nhung-thac-mac-xoay-quanh-ngay-du-sinh-2446/" title="Tuyển chọn những thắc mắc xoay quanh ngày dự sinh" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/20_10_2016_08_17_53_670435.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/tuyen-chon-nhung-thac-mac-xoay-quanh-ngay-du-sinh-2446/" title="Tuyển chọn những thắc mắc xoay quanh ngày dự sinh">Tuyển chọn những thắc mắc xoay quanh ngày dự sinh</a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/nhung-cau-hoi-hay-ve-tim-thai-cua-me-bau-tren-25-tuoi-5193/" title="Những câu hỏi hay về tim thai của mẹ bầu trên 25 tuổi" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/22_11_2016_10_40_10_527261.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/nhung-cau-hoi-hay-ve-tim-thai-cua-me-bau-tren-25-tuoi-5193/" title="Những câu hỏi hay về tim thai của mẹ bầu trên 25 tuổi">Những câu hỏi hay về tim thai của mẹ bầu trên 25 tuổi</a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/dung-thuoc-bo-khi-mang-thai-nhung-dieu-ban-nen-biet-3606/" title="Dùng thuốc bổ khi mang thai: Những điều bạn nên biết" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/03_11_2016_08_11_56_271991.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/dung-thuoc-bo-khi-mang-thai-nhung-dieu-ban-nen-biet-3606/" title="Dùng thuốc bổ khi mang thai: Những điều bạn nên biết">Dùng thuốc bổ khi mang thai: Những điều bạn nên biết</a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/can-trong-khi-chup-x-quang-5641/" title="Cẩn trọng khi chụp X-quang" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/25_11_2016_11_07_49_367833.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/can-trong-khi-chup-x-quang-5641/" title="Cẩn trọng khi chụp X-quang">Cẩn trọng khi chụp X-quang</a>
                    </h4>
                </div>
            </li>
            
            <li>
                <a href="/hoi-bac-si/tuyen-chon/nhung-dieu-can-biet-sau-khi-sinh-mo-1617/" title="Những điều cần biết sau khi sinh mổ" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/07_10_2016_10_54_58_677392.jpeg);"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/nhung-dieu-can-biet-sau-khi-sinh-mo-1617/" title="Những điều cần biết sau khi sinh mổ">Những điều cần biết sau khi sinh mổ</a>
                    </h4>
                </div>
            </li>
            
        </ul>

        <a href="/hoi-bac-si/tuyen-chon/" class="view-more">Xem tất cả các câu hỏi tuyển chọn</a>
    </section>
    
-->
    
</aside>

	</div>
</div>


<script type="text/html" id="thread-reply-template-user">
    <article>
        <div class="answer user-answer">
            <div class="answer-top">
                <div class="post-meta-data">
                    <span class="user">
                        <% if (post.hiding_creator) { %>
                            Giấu tên
                        <% } else { %>
                            <%= post.created_by.name %>
                        <% } %>
                    </span>

                    <span class="time">
                        Hỏi lúc <%= post.created_at %>
                    </span>
                </div>
            </div>

            <div class="body">

                <div class="inner-boby">
                    <div class="post-body-content">
                        <%= post.body %>
                    </div>

                    <div class="media">
                        <% if (post.all_images != null && post.all_images.length >= 1) { %>
                            <ul>
                            <% for (var i = 0; i < post.all_images.length; i++) { %>
                                <li>
                                    <a href="#" data-id="<%= post.all_images[i].id %>" class="image <% if (post.all_images[i].nsfw) { %> censored <% } %>" style="background-image: url(<%= post.all_images[i].thumbnail_url %>);"></a>

                                    <span class="caption-image">
                                        <span class="caption-content"><%= post.all_images[i].name %></span>

                                        <input type="text" value="<%= post.all_images[i].name %>">

                                        <span class="complete-edit-caption">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </span>

                                        <span class="cancel-edit-caption">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </span>

                                        <span class="edit-caption">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </span>
                                    </span>

                                    <span class="remove-image">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </span>
                                </li>
                            <% } %>
                            </ul>
                        <% } %>
                    </div>
                </div>

                <a href="#" class="edit" data-id="<%= post.id %>">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                    Sửa
                </a>

                <a href="#" class="reply" data-id="<%= post.id %>">
                    <i class="fa fa-reply" aria-hidden="true"></i>
                    Trả lời
                </a>

                <div class="thanks-button-count" >
                    <a href="#" title="" class="thank" data-id="<%=post.id %>">
                        <span class="unactive-text"><i class="fa fa-heart-o" aria-hidden="true"></i> Cảm ơn</span>
                    </a>

                    <div class="thanks-count-inner" >
                        <i class="fa fa-heart-o" aria-hidden="true" >
                            <span class="thank-count-value">0</span>
                            <span>người đã cảm ơn bài viết</span>
                        </i>
                    </div>
                </div>
            </div>
        </div>
    </article>
</script>


<script type="text/html" id="thread-reply-template">
    <article>
        <div class="answer">
            <div class="answer-top">
                <a class="image" <% if (post.created_by.main_image != '') { %> style="background-image: url(<%= post.created_by.main_image %>);"<% } %>></a>

                <h3>
                    <% if (post.hiding_creator) { %>
                        Giấu tên
                    <% } else { %>
                        <a href="<% post.created_by.absolute_url %>">
                            <i class="fa fa-fw fa-user-md" aria-hidden="true"></i>
                            <%= post.created_by.occupation %> <%= post.created_by.name %>
                        </a>
                    <% } %>

                    <span class="verified-badge has-tooltip">
                        <em>Chính thức</em>
                        <span class="tooltip">Nội dung chính thức từ bác sĩ hợp tác với ViCare</span>
                    </span>
                </h3>

                <% if (post.created_by.experience_summary != '') { %>
                    <p>
                        <i class="fa fa-fw fa-medkit" aria-hidden="true"></i>
                        <%= post.created_by.experience_summary %>
                    </p>
                <% } %>

                <% if (post.created_by.specialities != '') { %>
                    <p>
                        <i class="fa fa-fw fa-stethoscope" aria-hidden="true"></i>
                        <a href="/hoi-bac-si/danh-sach/?specialities=<%= post.created_by.specialities[0].slug %>" title=""><%=post.created_by.specialities[0].name %></a>
                        <% if (post.created_by.specialities.length > 1) { %>
                            và <%= post.created_by.specialities.length - 1 %> chuyên khoa khác
                        <% } %>
                    </p>
                <% } %>
            </div>

            <div class="body">
                <div class="post-meta-data">
                    <span class="time"><%= post.created_at %></span>
                </div>

                <div class="inner-boby">
                    <div class="post-body-content">
                        <%= post.body %>
                    </div>

                    <div class="media">
                        <% if (post.all_images != null && post.all_images.length >= 1) { %>
                            <ul>
                            <% for (var i = 0; i < post.all_images.length; i++) { %>
                                <li>
                                    <a href="#" data-id="<%= post.all_images[i].id %>" class="image <% if (post.all_images[i].nsfw) { %> censored <% } %>" style="background-image: url(<%= post.all_images[i].thumbnail_url %>);"></a>

                                    <span class="caption-image">
                                        <span class="caption-content"><%= post.all_images[i].name %></span>

                                        <input type="text" value="<%= post.all_images[i].name %>">

                                        <span class="complete-edit-caption">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </span>

                                        <span class="cancel-edit-caption">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </span>

                                        <span class="edit-caption">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </span>
                                    </span>

                                    <span class="remove-image">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </span>
                                </li>
                            <% } %>
                            </ul>
                        <% } %>
                    </div>
                </div>

                <a href="#" class="edit" data-id="<%= post.id %>">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                    Sửa
                </a>

                <a href="#" class="reply" data-id="<%=post.id %>">
                    <i class="fa fa-reply" aria-hidden="true"></i>
                    Trả lời
                </a>

                <div class="thanks-button-count" >
                    <a href="#" title="" class="thank" data-id="<%=post.id %>">
                        <span class="unactive-text"><i class="fa fa-heart-o" aria-hidden="true"></i> Cảm ơn</span>
                    </a>

                    <div class="thanks-count-inner" >
                        <i class="fa fa-heart-o" aria-hidden="true" >
                            <span class="thank-count-value">0</span>
                            <span>người đã cảm ơn bài viết</span>
                        </i>
                    </div>
                </div>
            </div>
        </div>
    </article>
</script>


<script type="text/html" id="thread-edit-template">
	<form name="edit-post" class="edit-post" action="#" method="#" data-id="<%=id%>">
		<textarea class="edit-post-area resize-textarea" name="edit-post-area"><%=body_raw%></textarea>
		<% if (typeof created_by.official == 'undefined' || !created_by.official) { %>
			<label for="update_hiding_creator">
				<input type="checkbox" id="update_hiding_creator" name="update_hiding_creator" <% if (hiding_creator) { %> checked <% } %> >
				Tôi muốn ẩn thông tin cá nhân của mình
			</label>
		<% } %>

		<div class="add-images">
			<div class="form-upload hide">
				<input type="file" accept=".png, .jpg, .jpeg">
				<label>Tiêu đề ảnh<input type="text"></label>
			</div>
		</div>

		<% if (countImage < 4) { %>
			<div class="add-more-image"><i class="fa fa-plus-circle" aria-hidden="true"></i> Tải thêm ảnh.</div>
		<% } %>

		<div class="edit-post-submit">
			<button type="submit">Hoàn tất</button>
			<a href="#" class="cancel-edit"><i class="fa fa-times" aria-hidden="true"></i>Hủy sửa</a>
		</div>

		<input type="hidden" name="thread_id"/>
	</form>
</script>

<script type="text/html" id="post-edit-time-template">
	<span class="time"><%=modified_at%></span>

	<span class="has-tooltip">
		<i class="fa fa-pencil" aria-hidden="true"></i>
		đã sửa
		<span class="tooltip">Sửa lần cuối lúc <%=modified_at%></span>
	</span>
</script>
<script type="text/html" id="post-edit-image-template">
	<% if (all_images.length > 0) {%>
		<ul>
			<% for(var i = 0; i < all_images.length; i++) { %>
				<li>
					<a href="#" data-id="<%= all_images[i].id %>"  class="image <% if (all_images[i].nsfw) { %> censored <% } %>" style="background-image: url(<%= all_images[i].thumbnail_url %>);"></a>

					<% if (all_images[i].name) { %>
						<span class="caption-image">
							<%= all_images[i].name %>

							<span class="edit-caption">
								<i class="fa fa-pencil" aria-hidden="true"></i>
							</span>
						</span>
					<% } else { %>
						<span class="caption-image">
							Ảnh minh hoạ

							<span class="edit-caption">
								<i class="fa fa-pencil" aria-hidden="true"></i>
							</span>
						</span>
					<% } %>

					<span class="remove-image">
						<i class="fa fa-times-circle" aria-hidden="true"></i>
					</span>
				</li>
			<% } %>
		</ul>
	<% } %>
</script>


			
			<input name="csrfmiddlewaretoken" value="OSU4rxNLLX1ROIMoIKau1fgs2qUAr7Vj" type="hidden">
@endif
		</div>
@endsection
