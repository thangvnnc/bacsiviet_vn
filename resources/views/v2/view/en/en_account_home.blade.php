@extends('v2/view/en/en_account',['title'=> 'Tài khoản'])
@section('en_account_content')

<div class="content-tk-home">
			
	<section class="sec-acc-home">
		<div class="section-header">
			<h2><i class="fa fa-fw fa-user" aria-hidden="true"></i> Account</h2>
		</div>

		<div class="section-body">

			<div class="form-row">
				<div class="form-field">
					<label>
						Fullname:
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
						Phone:
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