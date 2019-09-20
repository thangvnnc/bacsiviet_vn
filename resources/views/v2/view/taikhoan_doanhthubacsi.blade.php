@extends('v2/view/taikhoan',['title'=> 'Tài khoản'])
@section('taikhoan_content')

<div class="content-tk-home">
			
	<section class="sec-acc-home" style="margin-bottom: 20px;">
		<form action="/taikhoan/doanh-thu-bac-si" method="get">
			<input type="hidden" name="_token" value="{{csrf_token()}}">

		<div class="section-header">
			<h2 style="margin-top: 15px;"><i class="fa fa-fw fa-list" aria-hidden="true"></i>
				Doanh thu của bác sĩ
			</h2>
			<div style="float: left;"><input name="doctor_email" placeholder="Username bác sĩ" class="form-control" type="text"></div>
			<div style="float: right;"><input value="Tìm" class="form-control" type="submit"></div>
			<div style="float: right;"><input name="date_to" class="form-control" type="date"></div>
			<div style="float: right;"><input name="date_from" class="form-control" type="date"></div>
		</div>
		</form>
		<div class="section-body">
			<table class="table">
				<thead class="thead-light">
				<tr>
					<th scope="col"><strong>ID</strong></th>
					<th scope="col"><strong>Tên user</strong></th>
					<th scope="col"><strong>Đơn vị</strong></th>
					<th scope="col"><strong>Thành tiền</strong></th>
					<th scope="col"><strong>Vào lúc</strong></th>
				</tr>
				</thead>
				<tbody>

				@if(isset($callTimeWithDoctor))
					@foreach($callTimeWithDoctor as $calltime)
						<?php
							$userCall = \App\Users::where('email', $calltime->user_email)->first();
						?>
						<tr>
							<th scope="row">{{$calltime->call_time_id}}</th>
							<td><?php
								if (isset($userCall->fullname))
								{
								    echo $userCall->fullname;
								}
								else {
                                    echo "<strong>Not found</strong>";
								};?>
							</td>
							<td>
								@if($calltime->type == 0)
									{{$calltime->times}} Phút
								@else
									{{round($calltime->times)}} Tin nhắn
								@endif
							</td>
							<td>{{number_format($calltime->times * $calltime->unit, 0, '', ',')}} Vnđ</td>
							<th scope="row">{{$calltime->created_at}}</th>
						</tr>
					@endforeach
				@endif
				</tbody>
			</table>
			@if($callTimeWithDoctor != null)
			<div class="pagination" style="float: right">
				<span >
					{!! $callTimeWithDoctor->appends(request()->input())->links(); !!}
				</span>
			</div>
			<div>
				<?php
					$doctorEmail = Request::get('doctor_email');
				?>
				@if($callTimeWithDoctor->total() == 0)
					<strong>Không có dữ liệu bác sĩ @if(isset($doctorEmail)){{$doctorEmail}}@endif</strong>
				@else
					<strong>Tổng doanh số bác sĩ @if(isset($doctorEmail)){{$doctorEmail}}@endif: {{number_format($total, 0, '', ',') }} Vnđ</strong>
				@endif
			</div>
			@endif

			<div style="clear: both;"></div>

		</div>

	</section>

</div>

@endsection