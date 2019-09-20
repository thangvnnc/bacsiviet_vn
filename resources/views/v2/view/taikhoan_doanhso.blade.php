@extends('v2/view/taikhoan',['title'=> 'Tài khoản'])
@section('taikhoan_content')

<div class="content-tk-home">
			
	<section class="sec-acc-home">
		<form action="/taikhoan/doanhso" method="get">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
		<div class="section-header">
			<h2><i class="fa fa-fw fa-list" aria-hidden="true"></i> Doanh số thu nhập</h2>
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
                                };?></td>
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
			<div class="pagination" style="float: right">
                    <span >
                        {!! $callTimeWithDoctor->appends(request()->input())->links(); !!}
                    </span>

			</div>

			<div>
				<strong>Tổng doanh số: {{number_format($total, 0, '', ',') }} Vnđ</strong>
			</div>
			<div style="clear: both;"></div>

		</div>

	</section>

</div>

@endsection