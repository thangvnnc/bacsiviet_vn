@extends('main',['title'=> 'Đăng ký tài khoản'])


@section('content')
<div id="main">
	<div id="signups">
		<div class="positions">
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
					<div class="form-success">
						<h4><i class="fa fa-check-square-o"></i> Đăng ký mở tài khoản thành công!</h4>
						<div class="">
							<p>Cảm ơn bạn đã gửi thông tin. Chúng tôi sẽ liên hệ với bạn để xác nhận trong thời gian sớm nhất.</p>
						</div>
						<p>
							<strong>Họ và tên:{{$name}}</strong> 
							<br />
							<strong>Số điện thoại:@if($phone == "") chưa cung cấp @else {{$phone}} @endif
							</strong>
							
							
							<br />
							<strong>Username:{{$email}}</strong> 
						</p>
						<div class="button-row">
							<a href="../" class="button">OK <i class="fa fa-check" aria-hidden="true"></i></a>
						</div>
					</div>
				
			</div>
		</div>
	</div>
</div>
@endsection
