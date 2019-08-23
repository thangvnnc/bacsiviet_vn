@extends('main',['title'=> 'Chuyên khoa '.$speciality->speciality_name])


@section('content')
<div id="main">
			
			
			

<div id="page-title">
	<div class="background"></div>
	<div class="mask">
		<div class="position">
			<ul class="breadcrumbs">
				<li><a href="/">Trang chủ</a></li>
				<li><a href="/chuyen-khoa/">Chuyên khoa</a></li>
				
			</ul>

			<h1>
				Chuyên khoa {{$speciality->speciality_name}}

				
			</h1>
		</div>
	</div>
</div>

<div id="landing-service" class="has-aside">
	<div class="position">
		<div class="content">
			
			 <section class="carousel-section professionals">
				<h3>
					Bác sĩ nổi bật có chuyên khoa này 
					<a href="/danh-sach/bac-si/?specialities=san-phu" title="Xem danh sách bác sĩ">Xem tất cả <i class="fa fa-angle-double-right"></i></a>
				</h3>
				 @if(isset($doctors)) 
                    <div id="doctor-content" class="owl-carousel">
                     @foreach($doctors as $doc)
                    	<div class="item">
                    		 <a href="/danh-sach/bac-si/{{$doc->doctor_url}}-{{$doc->doctor_id}}/kham-benh">
                            <img src="@if($doc->profile_image!=null) @if(strpos($doc->profile_image, 'http')===false)https://medixlink.com/public/images/doctor/@endif{{$doc->profile_image}}@endif" alt="#" title="medihere Blog Post"/>
                            <h3>{{$doc->doctor_name}}</h3>
                           
                           
                            </a>
                    	</div>
                    @endforeach
                    </div>
                     @endif
</section>
			

			
			<section class="carousel-section" id="spec-clinic">
				<h3>
					Cơ sở y tế nổi bật có chuyên khoa này 
					<a href="/danh-sach/?specialities=san-phu" title="Xem danh sách cơ sở y tế">Xem tất cả <i class="fa fa-angle-double-right"></i></a>
				</h3>
				 @if(isset($clinics)) 
                    <div id="clinic-content" class="owl-carousel">
                     @foreach($clinics as $cs)
                    	<div class="item">
                    		 <a href="/co-so-y-te/{{$cs->clinic_url}}-{{$cs->clinic_id}}">
                            <img src="@if($cs->profile_image!=null) @if(strpos($cs->profile_image, 'http')===false)https://medixlink.com/public/images/health_facilities/@endif{{$cs->profile_image}}@endif" alt="" title="medihere Blog Post"/>
                            <h3>{{$cs->clinic_name}}</h3>
                           
                           
                            </a>
                    	</div>
                    @endforeach
                    </div>
                     @endif
</section>
			
			
			<section id="question-section">
				<div class="header">
					<h3>Các câu hỏi mới nhất</h3>
					<a href="/hoi-bac-si/danh-sach/">Xem danh sách câu hỏi <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
				</div>

				@if(isset($questions))
				  @foreach($questions as $qs)
				<article>
					
						<div class="question">
							<h3><a href="/hoi-bac-si/{{$qs->question_url}}-{{$qs->question_id}}/">{{$qs->question_title}}</a></h3>

							<div class="post-meta-data">
								<span class="user">
									
										{{$qs->fullname}}
									
								</span>

								<span class="time">
									Hỏi lúc 00h38 11-02-2017
								</span>

								
								<span>
									Chuyên khoa:
									
										<a href="/hoi-bac-si/danh-sach/?speciality={{$speciality->specialty_url}}" title="">{{$speciality->speciality_name}}</a>
									
								</span>
								
							</div>

							<div class="body">
								

								<p>{{$qs->question_content}}</p>

								<div class="thank-count">
									<i class="fa fa-heart-o" aria-hidden="true"></i>
									<span>0</span>
									người cám ơn bài viết
								</div>
							</div>
						</div>
			<?php $traloi = App\Answer::where('question_id',$qs->question_id)->first(); ?>
					@if(isset($traloi) && $traloi )
						@if($traloi->user!=null)
					
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
								@elseif($traloi->user->clinic!==null)
									<li>
											<span class="image " @if(!empty($traloi->user->clinic->profile_image)) style="background-image: url(@if(strpos($traloi->user->clinic->profile_image,'http')===false)/@endif{{$traloi->user->clinic->profile_image}});" @endif></span>
											<h4>
												{{$traloi->user->doctor}}
											</h4>

											
												<span></span>
											
										</li>
								@else
									{{$traloi->user->fullname}}
								@endif
							</ul>
						</div>
					
						@endif
						
						@endif
				</article>
				@endforeach
			 @endif
				
				
			</section>
			
		</div>
		

<aside class="pulled-up">
    
    <section class="collapsible-container collapsible-text collapsed">
        <h3>{{$speciality->speciality_name}}</h3>

        <div class="collapsible-target" style="max-height: none;">
            {!!$speciality->speciality_desc!!}

        </div>

        <div class="collapse-trigger" style="display: none;">
            <span class="trigger-expand"><i class="fa fa-chevron-down"></i></span>
            <span class="trigger-collapse"><i class="fa fa-chevron-up"></i></span>
        </div>
    </section>
    

    
    <section class="top-list">
        <h3>Các câu hỏi cùng chuyên khoa</h3>

        <ul>
            @if(!empty($speciality->questions))
              @foreach($speciality->questions as $ques)
            <li>
                <a class="image" href="/hoi-bac-si/{{$ques->question_url}}-{{$ques->question_id}}/" style="background-image: url();" title="Dùng thuốc bổ khi mang thai: Những điều bạn nên biết"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/{{$ques->question_url}}-{{$ques->question_id}}/" title="{{$ques->question_title}}">
                            {{$ques->question_title}}
                        </a>
                    </h4>
                </div>
            </li>
            @endforeach
            @endif
           
        </ul>

        <a href="/hoi-bac-si/tuyen-chon/" class="view-more">Xem tất cả các tuyển chọn câu hỏi</a>
    </section>
    

    
    <section class="top-list">
        <h3>Các tuyển chọn bác sĩ</h3>

        <ul>
            @if(!empty($specs = $speciality->doctors($speciality->speciality_id)))
              @foreach($specs as $doc)
            <li>
                <a class="image circle" href="/danh-sach/bac-si/{{App\Deals::strtoUrl($doc->doctor_name)}}-{{$doc->doctor_id}}" @if(!empty($doc->profile_image)) style="background-image: url(@if(strpos($doc->profile_image,'http')===false)/@endif{{$doc->profile_image}});" @endif title="5 Bác sĩ đầu ngành về chuyên khoa tim mạch được nhiều người biết đến tại TP. Hồ Chí Minh"></a>

                <div class="body">
                    <h4>
                        <a href="/danh-sach/bac-si/{{App\Deals::strtoUrl($doc->doctor_name)}}-{{$doc->doctor_id}}" title="{{$doc->doctor_name}}">
                            {{$doc->doctor_name}}
                        </a>
                    </h4>
                </div>
            </li>
             @endforeach
            @endif
            
            
        </ul>

      <!--   <a href="/tuyen-chon-bac-si/" class="view-more">Xem tất cả các tuyển chọn bác sĩ</a>-->
    </section>
    

    
    <section class="top-list">
        <h3>Các tuyển chọn cơ sở y tế</h3>

        <ul>
            @if(!empty($specs = $speciality->clinics($speciality->speciality_id)))
              @foreach($specs as $cs)
            <li>
                <a class="image" href="/co-so-y-te/{{App\Deals::strtoUrl($cs->clinic_name)}}-{{$cs->clinic_id}}/" @if(!empty($cs->profile_image))style="background-image: url(@if(strpos($cs->profile_image,'http')===false)/@endif{{$cs->profile_image}})" @endif title="{{$cs->clinic_name}}"></a>

                <div class="body">
                    <h4>
                        <a href="/co-so-y-te/{{App\Deals::strtoUrl($cs->clinic_name)}}-{{$cs->clinic_id}}/" title="{{$cs->clinic_name}}">
                            {{$cs->clinic_name}}
                        </a>
                    </h4>
                </div>
            </li>
            @endforeach
           @endif
            
           
        </ul>

      <!--   <a href="/tuyen-chon/" class="view-more">Xem tất cả các tuyển chọn cơ sở y tế</a> -->
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

				<form method="post" action="https://vicare.vn/dang-nhap/?next=/chuyen-khoa/san-phu-267/" name="login">
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
						<button type="button" name="facebook" data-link="https://vicare.vn/tai-khoan/ket-noi/login/facebook/?next=/chuyen-khoa/san-phu-267/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng nhập qua Facebook</button>
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

				<form method="post" action="https://vicare.vn/dang-ky/?next=/chuyen-khoa/san-phu-267/" name="signup">
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
						<button type="button" name="facebook" data-link="https://vicare.vn/tai-khoan/ket-noi/login/facebook/?next=/chuyen-khoa/san-phu-267/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng ký qua Facebook</button>
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
