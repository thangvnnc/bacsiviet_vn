@extends('taikhoan',['title'=> 'Tài khoản'])

 	@section('taikhoan_content')
 		
		<div class="content">
			
	<section>

		<div class="section-header">
			<h2><i class="fa fa-fw fa-user" aria-hidden="true"></i> Tài khoản</h2>
		</div>

		<div class="section-body">

			<div class="form-row">
				<div class="form-field">
					<label>
						Họ và tên:
					</label>
					<div class="form-field-text">
						{{Session::get('user')->fullname}}
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-field">
					<label>
						Email:
					</label>
					<div class="form-field-text">
						{{Session::get('user')->email}}
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-field">
					<label>
						Số điện thoại:
					</label>
					<div class="form-field-text">
						{{Session::get('user')->phone}}
					</div>
				</div>
			</div>
		</div>

	</section>

		</div>



	@endsection
