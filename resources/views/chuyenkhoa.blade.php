@extends('main',['title'=> 'Danh sách chuyên khoa'])


@section('content')
<div id="main">				
	<div id="page-title">
		<div class="background"></div>
		<div class="mask">
			<div class="position">
				<ul class="breadcrumbs">
					<li>
						<a href="/">Trang chủ</a>
					</li>
					<li>
						<a href="/chuyen-khoa/">Chuyên khoa</a>
					</li>
				</ul>
				<h1>Danh sách chuyên khoa</h1>
			</div>
		</div>
	</div>
	<div class="position">
		<div id="speciality-list" class="has-aside">
			<div class="content pulled-up">
				<section>
					@if(isset($specialities))
					  @foreach($specialities as $sp)
					
						<article>
							<div class="header">
								<a href="/chuyen-khoa/{{$sp->specialty_url}}-{{$sp->speciality_id}}/" class="image" 
									style="background-image: url({{url('public/images/front/folder_icon.png')}})"> 
								</a>

								<h3><a href="/chuyen-khoa/{{$sp->specialty_url}}-{{$sp->speciality_id}}/">{{$sp->speciality_name}}</a></h3>

								<ul>
									
									<li>
										<a href="/danh-sach/?specialities=san-phu">
											<i class="fa fa-hospital-o" aria-hidden="true"></i>
											1477 cơ sở y tế
										</a>
									</li>
									
									
									<li>
										<a href="/danh-sach/bac-si/?specialities=san-phu">
											<i class="fa fa-user-md" aria-hidden="true"></i>
											1760 bác sĩ
										</a>
									</li>
									
									
									<li>
										<a href="/hoi-bac-si/danh-sach/?speciality=san-phu">
											<i class="fa fa-comments" aria-hidden="true"></i>
											10725 câu hỏi
										</a>
									</li>
									
									
									<li>
										<a href="#">
											<i class="fa fa-h-square" aria-hidden="true"></i>
											84 dịch vụ
										</a>
									</li>
									
								</ul>
							</div>

							
							<div class="body">
								<p>{{$sp->speciality_desc}}
</p>
						</div>
						
					</article>
				    @endforeach
				 @endif
					
				
				


    <div class="pagination">
        <div class="vh">76 kết quả.</div>
        <span class="step-links">
            

            <span class="current">
               
            </span>

          {!!$specialities->links()!!}
            
        </span>
    </div>


			</section>
		</div>
		

<aside class="pulled-up">
    

    

    

    

    
    <section class="top-list">
        <h3>Bác sĩ liên quan</h3>

        <ul>
            @foreach($doctors as $dr)
	            <li>
	                <a class="image circle" href="/danh-sach/bac-si/{{$dr->doctor_url}}-{{$dr->doctor_id}}/kham-benh" style="background-image: url(https://medixlink.com/public/images/doctor/{{$dr->profile_image}});" title="{{$dr->doctor_name}}"></a>

	                <div class="body">
	                    <h4>
	                        <a href="/danh-sach/bac-si/{{$dr->doctor_url}}-{{$dr->doctor_id}}/kham-benh" title="{{$dr->doctor_name}}">
	                            Bác sĩ
	                            <br>
	                            {{$dr->doctor_name}}
	                        </a>
	                    </h4>
	                </div>
	            </li>
            @endforeach
        </ul>

        <a href="/danh-sach/bac-si/" class="view-more">Xem tất cả các bác sĩ liên quan</a>
    </section>
    

    
    <section class="top-list">
        <h3>Phòng khám liên quan</h3>

        <ul>
            
             @foreach($clinics as $cl)
            <li>
                <a href="/co-so-y-te/{{$cl->clinic_name}}-{{$cl->clinic_id}}/kham-benh" title="{{$cl->clinic_name}}" class="image" style="background-image: url(https://medixlink.com/public/images/health_facilities/{{$cl->profile_image}});"></a>

                <div class="body">
                    <h4>
                        <a href="/co-so-y-te/{{$cl->clinic_name}}-{{$cl->clinic_id}}/kham-benh" title="{{$cl->clinic_name}}">{{$cl->clinic_name}}</a>
                    </h4>
                </div>
            </li>
            @endforeach
            
        </ul>

        <a href="/danh-sach/" class="view-more">Xem tất cả các phòng khám liên quan</a>
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

				<form method="post" action="https://vicare.vn/dang-nhap/?next=/chuyen-khoa/" name="login">
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
						<button type="button" name="facebook" data-link="https://vicare.vn/tai-khoan/ket-noi/login/facebook/?next=/chuyen-khoa/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng nhập qua Facebook</button>
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

				<form method="post" action="https://vicare.vn/dang-ky/?next=/chuyen-khoa/" name="signup">
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
						<button type="button" name="facebook" data-link="https://vicare.vn/tai-khoan/ket-noi/login/facebook/?next=/chuyen-khoa/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng ký qua Facebook</button>
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
