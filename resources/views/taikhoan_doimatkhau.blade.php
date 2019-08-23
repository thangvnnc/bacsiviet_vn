@extends('taikhoan',['title'=> 'Medicalvn - Trang chủ'])

 	@section('taikhoan_content')
 	<div class="content">
			
<section class="change-password">

	<div class="section-header">
		<h2><i class="fa fa-fw fa-key" aria-hidden="true"></i> Đổi mật khẩu </h2>
	</div>

	<div class="section-body">
		<form method="post" action="#" name="signup">
			
			<div class="form-row">
				<div class="form-field">
					<label>
						Mật khẩu hiện tại:
					</label>
					<div class="form-field-input">
						<input name="password" required="" type="password">
					</div>
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-field">
					<label>
						Mật khẩu mới:
					</label>
					<div class="form-field-input">
						<input name="new_password" pattern=".{5,}" title="Mật khẩu phải có ít nhất 5 kí tự" placeholder="Mật khẩu phải có ít nhất 5 ký tự" required="" type="password">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-field">
					<label>
						Nhập lại:
					</label>
					<div class="form-field-input">
						<input name="new_password_confirm" placeholder="Nhập lại mật khẩu mới" required="" type="password">
					</div>
				</div>
			</div>
			<div class="button-row">
				<button type="submit">Gửi đi</button>
			</div>
		</form>

		<div class="form-success">
			<script type="text/html" id="change-success-template">
				<h4><i class="fa fa-check-square-o"></i> Đổi mật khẩu thành công!</h4>
				<p>Thông tin tài khoản:</p>
				<p>
					<strong>Họ và tên:</strong> <%= name %>
				</p>
				<p>
					<strong>Email:</strong> <%= email %>
				</p>
				<p>
					<strong>Điện thoại:</strong> <%= mobile_phone %>
				</p>
				<p>
					<a href="/tai-khoan/doi-mat-khau/" class="button">OK <i class="fa fa-check" aria-hidden="true"></i></a>
				</p>
			</script>
		</div>
	</div>

	</section>


		</div>

	@endsection
