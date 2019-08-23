@extends('v2/structor/main',['title'=> 'Bác sĩ chi tiết'])
@section('content')
<script type="text/javascript">

	$(document).ready(function(){		
		let path = window.location.pathname + "/";
		let aList = $(".sec-acc").find('a');
		for(let i = 0; i < aList.length; i++) {
			let href = $(aList[i]).attr('href');

			if (href === path) {
				$(aList[i]).addClass("active");
			}
		}
	});
</script>
<div class="main-A">
	<div id="account" class="has-aside">
		<div id="top">
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="/taikhoan">Quản lý tài khoản</a></li>
                    </ul> 
                    
                </div>
                <h1 style="font-size: 18px;">Thông tin tài khoản</h1>
            </div> 
             <div class="global-thread-create-cta">
			<a href="/hoibacsi/datcauhoi/" class="button">
				<i class="fa fa-question-circle" aria-hidden="true"></i>
				<strong>Hỏi bác sĩ</strong>
				<span>miễn phí</span>
			</a>
		</div>
	 </div><!-- #top -->
	 <hr>
	<div class="cont-tk">
			<aside class="as-tk">
				<section class="sec-acc">
					<h3>Xin chào, {{Session::get('user')->fullname}}</h3>

					<dl>
						
						
						<dt>
							<a href="/taikhoan/"><i class="fa fa-fw fa-user" aria-hidden="true"></i> Thông tin tài khoản</a>
						</dt>
						
						<dt>
							<a href="/taikhoan/ghinho/" class=" "  ><i class="fa fa-fw fa-bookmark-o" aria-hidden="true"></i> Đã ghi nhớ (0)</a>
						</dt>
						<dt>
							<a href="/tai-khoan/nhan-xet/" ><i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> Nhận xét đã gửi</a>
						</dt>
						<dt>
							<a href="/taikhoan/hoidap/" ><i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> Hỏi đáp của tôi</a>
						</dt>
						<dt>
							<a href="/taikhoan/doimatkhau/" ><i class="fa fa-fw fa-key" aria-hidden="true"></i> Đổi mật khẩu</a>
						</dt>
						@if(Session::get('user')->user_type_id==0)
						<dt>
							<a href="/taikhoan/thembacsi/" ><i class="fa fa-plus" aria-hidden="true"></i> Thêm bác sĩ</a>
						</dt>
						<dt>
							<a href="/taikhoan/themcsyt/" ><i class="fa fa-plus" aria-hidden="true"></i> Thêm csyt</a>
						</dt>
						<dt>
							<a href="/taikhoan/themnhathuoc/" ><i class="fa fa-plus" aria-hidden="true"></i> Thêm nhà thuốc</a>
						</dt>
						<dt>
							<a href="/taikhoan/doanh-thu-bac-si/" ><i class="fa fa-list" aria-hidden="true"></i> Doanh thu bác sĩ</a>
						</dt>
						<dt>
							<a href="/taikhoan/admin-recharge" ><i class="fa fa-list" aria-hidden="true"></i> Nạp tiền cho tài khoản</a>
						</dt>
						@endif
						@if(Session::get('user')->user_type_id==2)
							<dt>
								<a href="/taikhoan/vietbai/" ><i class="fa fa-plus" aria-hidden="true"></i> Gửi bài viết</a>
							</dt>
							<dt>
								<a href="/taikhoan/doanhso/" ><i class="fa fa-list" aria-hidden="true"></i> Doanh số</a>
							</dt>
						@endif
						<dt>
							<a href="/dangxuat" class="logout" {{-- onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" --}}><i class="fa fa-fw fa-power-off" aria-hidden="true"></i> Đăng xuất</a>
						</dt>

					</dl>
				</section>
			</aside>

			@include('v2.view.button_naptien')
			
			  @yield('taikhoan_content')
			
		</div>
	</div>

	<input type="hidden" name="csrfmiddlewaretoken" value="gbuq7WSx8WlnCDBnDiNS8NPgizVPFAgG">
</div>
{{-- <form id="frm-logout" action="/dangxuat" method="POST" style="display: none;">
    			{{ csrf_field() }}
		</form> --}}
@endsection