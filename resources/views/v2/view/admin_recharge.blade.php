@extends('v2/view/taikhoan',['title'=> 'Tài khoản'])
@section('taikhoan_content')

<div class="content-tk-home">
	<style>
		.btn-balance-update{
			font-size: 1rem;
		}
	</style>
	<section class="sec-acc-home" style="margin-bottom: 20px;">
		<form action="/taikhoan/admin-recharge" method="get">
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<div style="float: right;">
				<input name="query" placeholder="Tìm kiếm" class="form-control" type="text"></div>
		</form>
		<div class="section-header">
			<h2 style="margin-top: 15px;"><i class="fa fa-fw fa-list" aria-hidden="true"></i>
				Danh sách user
			</h2>
		</div>

		<!-- Modal -->
		<div id="balance_update" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Nhập số tiền</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="pwd">Số tiền:</label>
							<input type="number" class="form-control" id="balane-input">
						</div>
					</div>
					<div class="modal-footer" style="height: 70px;">
						<button type="button" class="btn btn-primary btn-update">Lưu</button>
					</div>
				</div>

			</div>
		</div>

		<div class="section-body">
			<table class="table">
				<thead class="thead-light">
				<tr>
					<th scope="col"><strong>ID</strong></th>
					<th scope="col"><strong>Tên user</strong></th>
					<th scope="col"><strong>Email</strong></th>
					<th scope="col"><strong>Số điện thoại</strong></th>
					<th scope="col"><strong>Số tiền</strong></th>
				</tr>
				</thead>
				<tbody>

				@if(isset($userList))
					@foreach($userList as $userItem)
						<tr>
							<td scope="row">{{$userItem->user_id}}</td>
							<td>{{$userItem->fullname}}</td>
							<td>{{$userItem->email}}</td>
							<td>{{$userItem->phone}}</td>
							<td>
								<?php
                                	$patient = \App\Patient::where('user_id', $userItem->user_id)->first();
                                	$balance = 0;
                                	if($patient != null)
									{
									    if($patient->balance > 0)
										{
                                            $balance = $patient->balance;
                                        }
									}
                                ?>
								<a class="btn-balance-update" data-id={{$userItem->user_id}} data-balance={{$balance}} href="javascript:void(0)">{{$balance}} vnd</a>

							</td>
						</tr>
					@endforeach
				@endif
				</tbody>
			</table>
			<div class="pagination" style="float: right">
				<span >
					{!! $userList->appends(request()->input())->links(); !!}
				</span>
			</div>

			<div style="clear: both;"></div>
			<form action="/taikhoan/admin-recharge-update" method="post" class="frm-update-balance">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
				<div style="float: right;">
					<input id="admin-recharge-update-id" hidden name="user-id" type="text">
					<input id="admin-recharge-update-balance" hidden name="balance" type="text">
					<input id="admin-recharge-update-link" hidden name="link" type="text">
				</div>
			</form>
			<script>
                $(document).ready(function (e) {
                    $('.btn-balance-update').on('click', function (e) {
                        let userId = $(this).attr('data-id');
                        let balance = $(this).attr('data-balance');
                        $('#balance_update').attr('data-id', userId);
                        $('#balance_update').modal();
                    });

                    $('.btn-update').on('click', function (e) {
                        let userId = $('#balance_update').attr('data-id');
                        let balance = $('#balane-input').val();
                        if(balance === "")
                        {
                            alert("Vui lòng nhập số");
                            return;
                        }
                        if(balance <= 0 && balance > 1000000000)
                        {
                            alert("Vui lòng nhập số lớn hơn 0 nhỏ hơn 1 000 000 000");
                            return;
                        }

                        $('#admin-recharge-update-id').val(userId);
                        $('#admin-recharge-update-balance').val(balance);
                        $('#admin-recharge-update-link').val(window.location.href);
                        $('.frm-update-balance').submit();
                    });
                });
			</script>
		</div>

	</section>

</div>

@endsection