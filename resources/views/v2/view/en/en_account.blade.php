@extends('v2/view/en/en_main',['title'=> 'Account'])
@section('en_content')
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
                        <li><a href="/en">Home</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="#">Account management</a></li>
                    </ul> 
                    
                </div>
                <h1 style="font-size: 18px;">Account information</h1>
            </div> 
            
	 </div><!-- #top -->
	 <hr>
	<div class="cont-tk">
			<aside class="as-tk">
				<section class="sec-acc">
					<h3>Hello, {{Session::get('user')->fullname}}</h3>

					<dl>
						
						
						<dt>
							<a href="/en/taikhoan/"><i class="fa fa-fw fa-user" aria-hidden="true"></i> Account infomation</a>
						</dt>
						
						<dt>
							<a href="/en/taikhoan/ghinho/" class=" "  ><i class="fa fa-fw fa-bookmark-o" aria-hidden="true"></i> Remembered (0)</a>
						</dt>
						<dt>
							<a href="/tai-khoan/nhan-xet/" ><i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> Comment sent</a>
						</dt>
						<dt>
							<a href="/en/taikhoan/hoidap/" ><i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> My FAQ</a>
						</dt>
						<dt>
							<a href="/en/taikhoan/doimatkhau/" ><i class="fa fa-fw fa-key" aria-hidden="true"></i> Change Password</a>
						</dt>
						@if(Session::get('user')->user_type_id==0)
						<dt>
							<a href="/en/taikhoan/thembacsi/" ><i class="fa fa-plus" aria-hidden="true"></i> Thêm bác sĩ</a>
						</dt>
						<dt>
							<a href="/en/taikhoan/themcsyt/" ><i class="fa fa-plus" aria-hidden="true"></i> Thêm cơ sở y tế</a>
						</dt>
						<dt>
							<a href="/en/taikhoan/themnhathuoc/" ><i class="fa fa-plus" aria-hidden="true"></i> Thêm nhà thuốc</a>
						</dt>
						<dt>
							<a href="/taikhoan/doanh-thu-bac-si/" ><i class="fa fa-list" aria-hidden="true"></i> Doanh thu bác sĩ</a>
						</dt>
						@endif
						@if(Session::get('user')->user_type_id==2)
							<dt>
								<a href="/en/taikhoan/vietbai/" ><i class="fa fa-plus" aria-hidden="true"></i> Send the writing</a>
							</dt>
							<dt>
								<a href="/en/taikhoan/doanhso" ><i class="fa fa-list" aria-hidden="true"></i> Call time</a>
							</dt>
						@endif
						<dt>
							<a href="/en/dangxuat" class="logout" {{-- onclick="event.preventDefault(); document.getElementById('frm-logout').submit();" --}}><i class="fa fa-fw fa-power-off" aria-hidden="true"></i> Logout</a>
						</dt>

					</dl>
				</section>
			</aside>

			@include('v2.view.en.en_button_recharge')
			
			  @yield('en_account_content')
			
		</div>
	</div>

	<input type="hidden" name="csrfmiddlewaretoken" value="gbuq7WSx8WlnCDBnDiNS8NPgizVPFAgG">
</div>
{{-- <form id="frm-logout" action="/dangxuat" method="POST" style="display: none;">
    			{{ csrf_field() }}
		</form> --}}
@endsection