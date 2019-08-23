@extends('v2/view/en/en_account',['title'=> 'Change Password'])
@section('en_account_content')
<div class="content-tk-home">
	<section class="change-password">

	<div class="section-header">
		<h2><i class="fa fa-fw fa-key" aria-hidden="true"></i> Change Password </h2>
	</div>

	<div class="section-body">
		

		@if (session('success'))
            <div class="alert alert-success">
	            {{session('success')}}
	        </div>
	    @endif
		<form method="post" action="#" name="signup">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div class="form-row">
				<div class="form-field">
					<label>
						Current password:
					</label>
					<div class="form-field-input">
						<input name="password" required="" type="password">
					</div>
				</div>
			</div>
			
			<div class="form-row">
				<div class="form-field">
					<label>
						New password:
					</label>
					<div class="form-field-input">
						<input name="new_password" pattern=".{5,}" title="Mật khẩu phải có ít nhất 5 kí tự" placeholder="Password must be at least 5 characters" required="" type="password">
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-field">
					<label>
						Re-enter your password:
					</label>
					<div class="form-field-input">
						<input name="new_password_confirm" placeholder="Enter a new password" required="" type="password">
					</div>
				</div>
			</div>
			<div class="button-row">
				<button type="submit">Send</button>
			</div>
		</form>

		<div class="form-success">
			<script type="text/html" id="change-success-template">
				<h4><i class="fa fa-check-square-o"></i> Change password successfully!</h4>
				<p>Account information:</p>
				<p>
					<strong>Fullname:</strong> <%= name %>
				</p>
				<p>
					<strong>Email:</strong> <%= email %>
				</p>
				<p>
					<strong>Phone:</strong> <%= mobile_phone %>
				</p>
				<p>
					<a href="/en/taikhoan/doimatkhau/" class="button">OK <i class="fa fa-check" aria-hidden="true"></i></a>
				</p>
			</script>
		</div>
	</div>

	</section>
</div>
@endsection