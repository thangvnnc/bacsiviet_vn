@extends('v2/view/en/en_account',['title'=> 'Tài khoản'])
@section('en_account_content')


	<div class="content-tk-home">
			
	<section class="sec-acc-home">
		<div class="section-header">
			<h2><i class="fa fa-fw fa-list" aria-hidden="true"></i> Call time</h2>
		</div>

		<div class="section-body">
			<table class="table">
				<thead class="thead-light">
				<tr>
					<th scope="col"><strong>ID</strong></th>
					<th scope="col"><strong>Fullname</strong></th>
					<th scope="col"><strong>Unit</strong></th>
					<th scope="col"><strong>Money</strong></th>
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
							<td>{{$userCall->fullname}}</td>
							<td>

								@if($calltime->type == 0)
									{{$calltime->times}} Minute
								@else
									{{round($calltime->times)}} Message
								@endif
							</td>
							<td>{{number_format($calltime->times * $calltime->unit, 0, '', ',')}} Vnd</td>
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
				<strong>Total: {{number_format($total, 0, '', ',')}} Vnd</strong>
			</div>
			<div style="clear: both;"></div>

		</div>

	</section>

</div>

@endsection