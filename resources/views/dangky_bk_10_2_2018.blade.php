@extends('main',['title'=> 'Đăng ký tài khoản'])


@section('content')
<div id="main">
			
			
			

<div id="signup">
	<div class="position">
		<div class="content">
			<div class="has-switch-content has-account-type-selector  account-type-user   source-others ">

	<h1><i class="fa fa-sign-in" aria-hidden="true"></i> Mở tài khoản tại BacsiViet</h1>

	<div class="signup-intro">
		<p>
			Chào mừng bạn đến với BacsiViet!
		</p>
		<div class="for-source-register_place">
			<p>
				Sau khi mở tài khoản, bạn có thể dễ dàng cập nhật, chỉnh sửa trang thông tin phòng khám mà bạn quản lý trên BacsiViet. Bạn cũng có thể gửi phản hồi nhận xét của khách hàng, và tham gia giải đáp các thắc mắc về y tế, sức khỏe của cộng đồng.
			</p>
			<p>
				Bạn cần chọn loại tài khoản là "Quản lý cơ sở y tế".
			</p>
		</div>
		<div class="for-source-register_prof">
			<p>
				Sau khi mở tài khoản, bạn có thể dễ dàng cập nhật, chỉnh sửa trang thông tin của mình trên BacsiViet. Bạn cũng có thể gửi phản hồi nhận xét của bệnh nhân, và tham gia giải đáp các thắc mắc về y tế, sức khỏe của cộng đồng.
			</p>
			<p>
				Bạn cần chọn loại tài khoản là "Bác sĩ".
			</p>
		</div>
		<div class="for-source-favourite">
			<p>
				Sau khi mở tài khoản, bạn có thể lưu lại cơ sở y tế và bác sĩ đáng quan tâm, cũng như sử dụng đầy đủ các chức năng, dịch vụ của BacsiViet
			</p>
		</div>
		<div class="for-source-promotion">
			<p>
				Bạn hãy mở tài khoản hoặc đăng nhập để nhận các ưu đãi về khám chữa bệnh, chăm sóc sức khỏe hấp dẫn từ BacsiViet!
			</p>
		</div>
		<div class="for-source-others">
			<p>
				Mở tài khoản dễ dàng, nhanh chóng với một form duy nhất để có thể sử dụng đầy đủ các chức năng và dịch vụ của BacsiViet.
			</p>
		</div>
		<p>
			<a href="{{url('dang-nhap')}}">Đăng nhập tại đây</a> nếu bạn đã có tài khoản tại BacsiViet.
		</p>
	</div>

	<div class="signup-form">
		

		<form method="post" action="/dang-ky?next=/dang-nhap/" name="signup">

			@if($errors->has('errorReg'))
				<div class="form-row">
		            <div class="alert alert-danger">
		                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                {{$errors->first('errorReg')}}
		            </div>
		        </div>
	        @endif

			<div class="form-row">
				<div class="form-field">
					<label>
						Loại tài khoản:
					</label>
					<div class="form-field-input">
						<select class="account-type-selector" name="type" required="">
							@if($type=="user")
								<option value="user" selected="selected">Thành viên</option>
								<option value="professional" >Bác sĩ</option>
								<option value="place">Quản lý cơ sở y tế</option>
							@elseif($type=="professional")
								<option value="user" >Thành viên</option>
								<option value="professional" selected="selected">Bác sĩ</option>
								<option value="place">Quản lý cơ sở y tế</option>
							@else
								<option value="user" >Thành viên</option>
								<option value="professional">Bác sĩ</option>
								<option value="place" selected="selected">Quản lý cơ sở y tế</option>

							@endif
						</select>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-field">
					<label>
						Họ và tên: <span class="color_red">*</span>
					</label>
					<div class="form-field-input">
						<input name="name" required="" type="text">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-field">
					<label>
						Điện thoại:
					</label>
					<div class="form-field-input">
						<input name="mobile_phone" type="text">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-field">
					<label>
						Username: <span class="color_red">*</span>
					</label>
					<div class="form-field-input">
						<input name="email" required="" type="text">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-field">
					<label>
						Mật khẩu: <span class="color_red">*</span>
					</label>
					<div class="form-field-input">
						<input name="password" pattern=".{5,}" title="Mật khẩu cần có ít nhất 5 kí tự" placeholder="Mật khẩu cần có ít nhất 5 ký tự" required="" type="password">
					</div>
				</div>
			</div>

			<div class="for-account-type-place">
				<hr class="form-hr">
				<div class="form-row">
					<div class="form-field">
						<label>
							Tên cơ sở y tế:
						</label>
						<div class="form-field-input">
							<input name="place_name" value="" type="text">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-field">
						<label>
							Địa chỉ:
						</label>
						<div class="form-field-input">
							<input name="place_add" value="" type="text">
						</div>
					</div>
				</div>
				<p>Vui lòng cung cấp đầy đủ thông tin để chúng tôi có thể liên hệ và hỗ trợ bạn tốt nhất.</p>
			</div>

			<div class="for-account-type-professional">
				<hr class="form-hr">
				<div class="form-row">
					<div class="form-field">
						<label>
							Chuyên khoa:
						</label>
						<div class="form-field-input">
							<input name="prof_spec" value="" type="text">
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="form-field">
						<label>
							Nơi công tác:
						</label>
						<div class="form-field-input">
							<input name="prof_place" value="" type="text">
						</div>
					</div>
				</div>
				<p>Vui lòng cung cấp đầy đủ thông tin để chúng tôi có thể liên hệ và hỗ trợ bạn tốt nhất.</p>
			</div>

			<div class="button-row">
				<button type="submit">Đăng ký</button>
			</div>	
			<div class="for-account-type-user" style="margin-top: 5%;margin-left: 20%;">
				<h4>Hướng dẫn sử dụng tại <a href="/huong-dan-user">đây</a></h4>
			</div>
			<div class="for-account-type-place" style="margin-top: 5%;margin-left: 20%;">
				<h4>Hướng dẫn sử dụng tại <a href="/huong-dan-phong-kham">đây</a></h4>
			</div>		
			<div class="for-account-type-professional" style="margin-top: 5%;margin-left: 20%;" >
				<h4>Hướng dẫn sử dụng tại <a href="/huong-dan-bac-si">đây</a></h4>
			</div>	
			

		</form>

		<script type="text/html" id="signup-confirmation-template">
			<div class="form-success">
				<h4><i class="fa fa-check-square-o"></i> Đăng ký mở tài khoản thành công!</h4>
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
	</div>
</div>


		</div>
	</div>
</div>


			
				<script id="login-overlay-template" type="text/html">

	<div class="has-account-type-selector">
		<ul class="tab-content-triggers">
			<li><a href="#signup-tab"><i class="fa fa-user-plus" aria-hidden="true"></i> Đăng ký</a></li>
			<li><a href="#login-tab" class="active"><i class="fa fa-sign-in" aria-hidden="true"></i> Đăng nhập</a></li>
		</ul>

		<div class="tab-content-container">

			<div id="login-tab" class="tab-content">
				<div class="for-email-existed">
					<p>Bạn đã có tài khoản đăng ký tại BacsiViet với email này. Vui lòng đăng nhập để sử dụng đầy đủ chức năng của BacsiViet. Sau khi đăng nhập, bạn sẽ được đưa trở lại trang trước. Nội dung bạn vừa viết đã được lưu lại vào trình duyệt và sẽ không bị mất đi.</p>
				</div>

				<form method="post" action="#" name="login">
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
									<a class="reset-password-link" href="/quen-mat-khau/">Quên mật khẩu?</a>
								</p>
							</div>
						</div>
					</div>
					<div class="button-row">
						<button type="submit">Đăng nhập</button>
					</div>
					<hr class="form-hr" />
					<div class="button-row">
						<button type="button" name="facebook" data-link="/tai-khoan/ket-noi/login/facebook/?next=/dang-nhap/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng nhập qua Facebook</button>
					</div>
				</form>
			</div>

			<div id="signup-tab" class="tab-content">

				<div class="instruction">
					<p>
						Chào mừng bạn đến với BacsiViet!
					</p>

					<div class="for-source-register_place">
						<p>
							Sau khi mở tài khoản, bạn có thể dễ dàng cập nhật, chỉnh sửa trang thông tin phòng khám mà bạn quản lý trên BacsiViet. Bạn cũng có thể gửi phản hồi nhận xét của khách hàng, và tham gia giải đáp các thắc mắc về y tế, sức khỏe của cộng đồng.
						</p>
						<p>
							Bạn cần chọn loại tài khoản là "Quản lý cơ sở y tế".
						</p>
					</div>
					<div class="for-source-register_prof">
						<p>
							Sau khi mở tài khoản, bạn có thể dễ dàng cập nhật, chỉnh sửa trang thông tin của mình trên BacsiViet. Bạn cũng có thể gửi phản hồi nhận xét của bệnh nhân, và tham gia giải đáp các thắc mắc về y tế, sức khỏe của cộng đồng.
						</p>
						<p>
							Bạn cần chọn loại tài khoản là "Bác sĩ".
						</p>
					</div>
					<div class="for-source-favourite">
						<p>
							Sau khi mở tài khoản, bạn có thể lưu lại cơ sở y tế và bác sĩ đáng quan tâm, cũng như sử dụng đầy đủ các chức năng, dịch vụ của BacsiViet
						</p>
					</div>
					<div class="for-source-promotion">
						<p>
							Bạn hãy mở tài khoản hoặc đăng nhập để nhận các ưu đãi về khám chữa bệnh, chăm sóc sức khỏe hấp dẫn từ BacsiViet!
						</p>
					</div>
					<div class="for-source-others">
						<p>
							Mở tài khoản dễ dàng, nhanh chóng với một form duy nhất để có thể sử dụng đầy đủ các chức năng và dịch vụ của BacsiViet.
						</p>
					</div>

				</div>

				<form method="post" action="<%= url %>" name="signup">
					<div class="form-row">
						<div class="form-field">
							<label>
								Loại tài khoản:
							</label>
							<div class="form-field-input">
								<select class="account-type-selector" name="type">
									<option value="user">Thành viên</option>
									<option value="professional">Bác sĩ</option>
									<option value="place">Quản lý cơ sở y tế</option>
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
								<input type="text" name="name" required />
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-field">
							<label>
								Điện thoại:
							</label>
							<div class="form-field-input">
								<input type="text" name="mobile_phone" />
							</div>
						</div>
					</div>
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
								<input type="password" name="password" pattern=".{5,}" title="Mật khẩu cần có ít nhất 5 kí tự" placeholder="Mật khẩu cần có ít nhất 5 kí tự" required></input>
							</div>
						</div>
					</div>

					<div class="for-account-type-place">
						<hr class="form-hr" />
						<div class="form-row">
							<div class="form-field">
								<label>
									Tên cơ sở y tế:
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
						<button type="button" name="facebook" data-link="/tai-khoan/ket-noi/login/facebook/?next=/dang-nhap/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng ký qua Facebook</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</script>

<script type="text/html" id="signup-confirmation-template">
	<div class="form-success">
		<h4><i class="fa fa-check-square-o"></i> Đăng ký mở tài khoản thành công!</h4>
		<p>Chào mừng bạn đến với BacsiViet!</p>
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



			
			<input name="csrfmiddlewaretoken" value="KiyMcBGJeHSm6FHeJpg0YZkLLL2TqUGd" type="hidden">
		</div>
@endsection
