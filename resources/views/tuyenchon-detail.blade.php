@extends('main',['title'=> $subject->subject,'thumbnail'=>$subject->image])


@section('content')
    
			
			
			
<div id="page-title" class="has-create" style="top:90px;">
	<div class="background"></div>
	<div class="mask">
		<div class="position">
			<ul class="breadcrumbs">
				<li>
					<a href="/">Trang chủ</a>
				</li>
				<li>
					<a href="/hoi-bac-si/">Hỏi bác sĩ</a>
				</li>
				<li>
					<a href="/hoi-bac-si/tuyen-chon/">Tuyển chọn</a>
				</li>
			</ul>
			<h1>
				@if(isset($subject))
				{{$subject->subject}}
				@endif

				
			</h1>
			<a class="button create-thread" href="/hoi-bac-si/dat-cau-hoi/" title="Đặt câu hỏi cho bác sĩ, hoàn toàn miễn phí">
				<i class="fa fa-commenting" aria-hidden="true"></i> Đặt câu hỏi miễn phí
			</a>
		</div>
	</div>
</div>

<div id="collection-detail" class="has-aside">
	<div class="position">
		<div class="content">
			<section>
				<div class="description">
					
						<div class="image" style="background-image: url({{$subject->image}});"></div>
					
					{{$subject->description}}

				</div>

					@if(isset($questions))
					<?php $i = 1;?>
						 @foreach($questions as $ques)
					<article>
						<div class="title">
					
							<div class="order">{{$i}}</div>
							<h2><a href="/hoi-bac-si/{{$ques->question_url}}-{{$ques->question_id}}/">{{$ques->question_title}}</a></h2>
							
								<div class="entry-meta">
									<span class="entry-meta-user">
										Câu hỏi bởi:
										<a href="#" class="user-title">
											@if($ques->hide_creator==1||$ques->fullname=="")
												Giấu tên
										    @else
										       {{$ques->fullname}}
										    @endif
											
										</a>
									</span>

									
										<span class="entry-meta-time">
											Hỏi lúc <span class="time">{{$ques->created_at}}</span>
											<span class="time"></span>
										</span>
									

									
								</div>
							
						</div>

						<div class="body">
							
								<div class="body-top">
									<div class="cms">
										{{$ques->question_content}}
										
									</div>
								</div>			
								
							@if(!empty($ques->answer))
									
									<div class="answer">
										<div class="replyer">
								
									@if($ques->answer->user!==null)
									  	
									  	@if($ques->answer->user->doctor!==null || !empty($ques->answer->user->doctor))
											<a class="image " href="" style="background-image: url({{$ques->answer->user->doctor->profile_image}});"></a>
										
										@elseif($ques->answer->user->clinic!==null)
											 <a class="image " href="" style="background-image: url({{$ques->answer->user->avatar}});"></a>
										@else
										
										@endif
										
											<span class="replyer-info">
												<h4 class="replyer-doctor">
													<a href="">
														<i class="fa fa-user-md" aria-hidden="true"></i>
														@if($ques->answer->user->doctor!=null)
														Bác sĩ {{$ques->answer->user->doctor->doctor_name}}
														@else
														     {{$ques->answer->user->fullname}}
														@endif
													</a>

													<div class="verified-badge has-tooltip">
														<span class="tooltip">Đã được xác thực bởi Bacsiviet</span>
													</div>
												</h4>

												<span class="replyer-description">
													<i class="fa fa-clock-o" aria-hidden="true"></i>
													Trả lời lúc {{$ques->answer->created_at}}
												</span>
											</span>

										</div>
									
										@endif
										<div class="cms">
											

										{!!$ques->answer->answer_content!!}
										</div>
									</div>
								@endif
								
							
						</div>
					</article>
				<?php $i+=1;?>
					@endforeach
					@endif
				
					

				<div class="social-cta">
	
		<div class="fb-send fb_iframe_widget" data-href="/hoi-bac-si/tuyen-chon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}/" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=280719775275851&amp;container_width=749&amp;href=/hoi-bac-si/tuyen-chon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}%2F&amp;locale=vi_VN&amp;sdk=joey"><span style="vertical-align: bottom; width: 47px; height: 20px;"><iframe name="f4ee759dff1b5" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:send Facebook Social Plugin" style="border: medium none; visibility: visible; width: 47px; height: 20px;" src="https://www.facebook.com/v2.5/plugins/send.php?app_id=280719775275851&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FiKWhU6BAGf7.js%3Fversion%3D42%23cb%3Df3607b9f44cdaa%26domain%3Dvicare.vn%26origin%3Dhttps%253A%252F%252Fvicare.vn%252Ff157ae0ed083544%26relation%3Dparent.parent&amp;container_width=749&amp;href=/hoi-bac-si/tuyen-chon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}%2F&amp;locale=vi_VN&amp;sdk=joey" class="" frameborder="0" width="1000px" height="1000px"></iframe></span></div>

		<div class="fb-share-button fb_iframe_widget" data-href="/hoi-bac-si/tuyen-chon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}/" data-layout="button" data-size="small" data-mobile-iframe="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=280719775275851&amp;container_width=749&amp;href=/hoi-bac-si/tuyen-chon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}%2F&amp;layout=button&amp;locale=vi_VN&amp;mobile_iframe=false&amp;sdk=joey&amp;size=small"><span style="vertical-align: bottom; width: 68px; height: 20px;"><iframe name="f3a60468f87144a" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:share_button Facebook Social Plugin" style="border: medium none; visibility: visible; width: 68px; height: 20px;" src="https://www.facebook.com/v2.5/plugins/share_button.php?app_id=280719775275851&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FiKWhU6BAGf7.js%3Fversion%3D42%23cb%3Df1173876b7565ec%26domain%3Dvicare.vn%26origin%3Dhttps%253A%252F%252Fvicare.vn%252Ff157ae0ed083544%26relation%3Dparent.parent&amp;container_width=749&amp;href=/hoi-bac-si/tuyen-chon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}%2F&amp;layout=button&amp;locale=vi_VN&amp;mobile_iframe=false&amp;sdk=joey&amp;size=small" class="" frameborder="0" width="1000px" height="1000px"></iframe></span></div>

		<div class="fb-like fb_iframe_widget" data-href="/hoi-bac-si/tuyen-chon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=280719775275851&amp;container_width=749&amp;href=/hoi-bac-si/tuyen-chon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}%2F&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;size=small"><span style="vertical-align: bottom; width: 68px; height: 20px;"><iframe name="f2369137b3a7954" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like Facebook Social Plugin" style="border: medium none; visibility: visible; width: 68px; height: 20px;" src="https://www.facebook.com/v2.5/plugins/like.php?action=like&amp;app_id=280719775275851&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FiKWhU6BAGf7.js%3Fversion%3D42%23cb%3Df2b43d9fb17c698%26domain%3Dvicare.vn%26origin%3Dhttps%253A%252F%252Fvicare.vn%252Ff157ae0ed083544%26relation%3Dparent.parent&amp;container_width=749&amp;href=/hoi-bac-si/tuyen-chon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}%2F&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;size=small" class="" frameborder="0" width="1000px" height="1000px"></iframe></span></div>
	
</div>

			</section>
		</div>
		

<aside class="pulled-up" style="margin-top:90px;">
    <section class="collapsible-container collapsible-text collapsed">
        
            <h3>Hỏi bác sĩ</h3>
        

        <div class="collapsible-target" style="max-height: none;">
            
                <p>Chuyên mục Hỏi Bác sĩ mang đến cho người đọc dữ liệu hàng nghìn câu hỏi-đáp về sức khỏe đã được trả lời bởi các bác sĩ và chuyên gia uy tín. Bạn cũng có thể gửi câu hỏi mới để nhận được tư vấn trực tiếp của bác sĩ ngay tại đây, hoàn toàn miễn phí.</p>
            
        </div>

        <div class="collapse-trigger" style="display: none;">
            <span class="trigger-expand"><i class="fa fa-chevron-down"></i></span>
            <span class="trigger-collapse"><i class="fa fa-chevron-up"></i></span>
        </div>
    </section>

    

    

    

    

    
    <section class="top-list">
        <h3>Đáng quan tâm</h3>

        <ul>
            @if(isset($subjects))
              @foreach($subjects as $sub)
            <li>
                <a href="/hoi-bac-si/tuyen-chon/{{\App\Deals::strtoUrl($sub->subject)}}-{{$sub->id}}/" title="{{$sub->subject}}" class="image" style="background-image: url({{$sub->image}});"></a>

                <div class="body">
                    <h4>
                        <a href="/hoi-bac-si/tuyen-chon/{{\App\Deals::strtoUrl($sub->subject)}}-{{$sub->id}}/" title="{{$sub->subject}}">{{$sub->subject}}</a>
                    </h4>
                </div>
            </li>
             @endforeach
             @endif
           
            
        </ul>

        <a href="/hoi-bac-si/tuyen-chon/" class="view-more">Xem tất cả các câu hỏi tuyển chọn</a>
    </section>
    

    
</aside>

	</div>
</div>

<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

	<!-- Background of PhotoSwipe.
	It's a separate element, as animating opacity is faster than rgba(). -->
	<div class="pswp__bg"></div>

	<!-- Slides wrapper with overflow:hidden. -->
	<div class="pswp__scroll-wrap">

		<!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
		<div class="pswp__container">
		<!-- don't modify these 3 pswp__item elements, data is added later on -->
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
			<div class="pswp__item"></div>
		</div>

		<!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
		<div class="pswp__ui pswp__ui--hidden">

			<div class="pswp__top-bar">

			<!--  Controls are self-explanatory. Order can be changed. -->

				<div class="pswp__counter"></div>

				<button class="pswp__button pswp__button--close" title="Close (Esc)"></button>


				<button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

				<button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

				<div class="pswp__preloader">
					<div class="pswp__preloader__icn">
						<div class="pswp__preloader__cut">
							<div class="pswp__preloader__donut"></div>
						</div>
					</div>
				</div>
			</div>

			<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
			</button>

			<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
			</button>

			<div class="pswp__caption">
				<div class="pswp__caption__center"></div>
			</div>

		</div>
	</div>
</div>

			
				

<script id="login-overlay-template" type="text/html">

	<div class="has-account-type-selector">
		<ul class="tab-content-triggers">
			<li><a href="#signup-tab" class="active"><i class="fa fa-user-plus" aria-hidden="true"></i> Đăng ký</a></li>
			<li><a href="#login-tab"><i class="fa fa-sign-in" aria-hidden="true"></i> Đăng nhập</a></li>
		</ul>

		<div class="tab-content-container">

			<div id="login-tab" class="tab-content">
				<div class="for-email-existed">
					<p>Bạn đã có tài khoản đăng ký tại ViCare với email này. Vui lòng đăng nhập để sử dụng đầy đủ chức năng của ViCare. Sau khi đăng nhập, bạn sẽ được đưa trở lại trang trước. Nội dung bạn vừa viết đã được lưu lại vào trình duyệt và sẽ không bị mất đi.</p>
				</div>

				<form method="post" action="https://vicare.vn/dang-nhap/?next=/hoi-bac-si/tuyen-chon/chua-tri-benh-gan-cung-cay-ca-gai-4864/" name="login">
					<div class="form-row">
						<div class="form-field">
							<label>
								Email:
							</label>
							<div class="form-field-input">
								<input type="text" name="email" required />
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-field">
							<label>
								Mật khẩu:
							</label>
							<div class="form-field-input">
								<input type="password" name="password" required></input>
								<p>
									<a class="reset-password-link" href="https://vicare.vn/quen-mat-khau/">Quên mật khẩu?</a>
								</p>
							</div>
						</div>
					</div>
					<div class="button-row">
						<button type="submit">Đăng nhập</button>
					</div>
					<hr class="form-hr" />
					<div class="button-row">
						<button type="button" name="facebook" data-link="https://vicare.vn/tai-khoan/ket-noi/login/facebook/?next=/hoi-bac-si/tuyen-chon/chua-tri-benh-gan-cung-cay-ca-gai-4864/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng nhập qua Facebook</button>
					</div>
				</form>
			</div>

			<div id="signup-tab" class="tab-content active">

				<div class="instruction">
					<p>
						Chào mừng bạn đến với ViCare!
					</p>

					<div class="for-source-register_place">
						<p>
							Sau khi mở tài khoản, bạn có thể dễ dàng cập nhật, chỉnh sửa trang thông tin phòng khám, bệnh viện hoặc doanh nghiệp mà bạn quản lý trên ViCare. Bạn cũng có thể gửi phản hồi nhận xét của khách hàng, và tham gia giải đáp các thắc mắc về y tế, sức khỏe của cộng đồng.
						</p>
						<p>
							Bạn cần chọn loại tài khoản là "Quản lý cơ sở y tế".
						</p>
					</div>
					<div class="for-source-register_prof">
						<p>
							Sau khi mở tài khoản, bạn có thể dễ dàng cập nhật, chỉnh sửa trang thông tin của mình trên ViCare. Bạn cũng có thể gửi phản hồi nhận xét của bệnh nhân, và tham gia giải đáp các thắc mắc về y tế, sức khỏe của cộng đồng.
						</p>
						<p>
							Bạn cần chọn loại tài khoản là "Bác sĩ".
						</p>
					</div>
					<div class="for-source-favourite">
						<p>
							Sau khi mở tài khoản, bạn có thể lưu lại cơ sở y tế và bác sĩ đáng quan tâm, cũng như sử dụng đầy đủ các chức năng, dịch vụ của ViCare
						</p>
					</div>
					<div class="for-source-promotion">
						<p>
							Bạn hãy mở tài khoản hoặc đăng nhập để nhận các ưu đãi về khám chữa bệnh, chăm sóc sức khỏe hấp dẫn từ ViCare!
						</p>
					</div>
					<div class="for-source-others">
						<p>
							Mở tài khoản dễ dàng, nhanh chóng với một form duy nhất để có thể sử dụng đầy đủ các chức năng và dịch vụ của ViCare.
						</p>
					</div>

				</div>

				<form method="post" action="https://vicare.vn/dang-ky/?next=/hoi-bac-si/tuyen-chon/chua-tri-benh-gan-cung-cay-ca-gai-4864/" name="signup">
					<div class="form-row">
						<div class="form-field">
							<label>
								Loại tài khoản:
							</label>
							<div class="form-field-input">
								<select class="account-type-selector" name="type">
									<option value="user">Thành viên</option>
									<option value="professional">Bác sĩ</option>
									<option value="place">Cơ sở y tế &amp; doanh nghiệp</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-field">
							<label>
								Họ và tên:
							</label>
							<div class="form-field-input">
								<input type="text" name="name" id="name" data-rules="required" class="validate" />
								<p class="validation-error help-block"></p>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-field">
							<label>
								Điện thoại:
							</label>
							<div class="form-field-input">
								<input type="text" name="mobile_phone" id="mobile_phone" data-rules="required" />
								<p class="validation-error help-block"></p>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-field">
							<label>
								Email:
							</label>
							<div class="form-field-input">
								<input name="email" type="text" id="email" data-rules="required|valid_email" class="validate" />
								<p class="validation-error help-block"></p>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-field">
							<label>
								Mật khẩu:
							</label>
							<div class="form-field-input">
								<input type="password" name="password" id="password" title="Mật khẩu cần có ít nhất 5 kí tự" placeholder="Mật khẩu cần có ít nhất 5 kí tự" data-display="Mật khẩu" data-rules="required|min_length[5]" class="validate"></input>
								<p class="validation-error help-block"></p>
							</div>
						</div>
					</div>
					<div class="form-row">
						<div class="form-field">
							<label>
								Xác nhận lại mật khẩu:
							</label>
							<div class="form-field-input">
								<input type="password" name="confirm_password" id="confirm_password" title="Nhập lại mật khẩu" placeholder="Nhập lại mật khẩu" data-rules="required|matches[password]" class="validate"></input>
								<p class="validation-error help-block"></p>
							</div>
						</div>
					</div>

					<div class="for-account-type-place">
						<hr class="form-hr" />
						<div class="form-row">
							<div class="form-field">
								<label>
									Tên cơ sở y tế / doanh nghiệp:
								</label>
								<div class="form-field-input">
									<input type="text" name="place_name" value="<%= meta.placeName %>"/>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-field">
								<label>
									Địa chỉ:
								</label>
								<div class="form-field-input">
									<input type="text" name="place_add" value="<%= meta.placeAdd %>"/>
								</div>
							</div>
						</div>
						<p>Vui lòng cung cấp đầy đủ thông tin để chúng tôi có thể liên hệ và hỗ trợ bạn tốt nhất.</p>
					</div>

					<div class="for-account-type-professional">
						<hr class="form-hr" />
						<div class="form-row">
							<div class="form-field">
								<label>
									Chuyên khoa:
								</label>
								<div class="form-field-input">
									<input type="text" name="prof_spec" value="<%= meta.profSpec %>"/>
								</div>
							</div>
						</div>
						<div class="form-row">
							<div class="form-field">
								<label>
									Nơi công tác:
								</label>
								<div class="form-field-input">
									<input type="text" name="prof_place" value="<%= meta.profPlace %>" />
								</div>
							</div>
						</div>
						<p>Vui lòng cung cấp đầy đủ thông tin để chúng tôi có thể liên hệ và hỗ trợ bạn tốt nhất.</p>
					</div>
					<div class="button-row">
						<button type="submit" name="register">Đăng ký</button>
					</div>
					<hr class="form-hr" />
					<div class="button-row">
						<button type="button" name="facebook" data-link="https://vicare.vn/tai-khoan/ket-noi/login/facebook/?next=/hoi-bac-si/tuyen-chon/chua-tri-benh-gan-cung-cay-ca-gai-4864/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng ký qua Facebook</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</script>

<script type="text/html" id="signup-confirmation-template">
	<div class="form-success">
		<h4><i class="fa fa-check-square-o"></i> Đăng ký mở tài khoản thành công!</h4>
		<p>Chào mừng bạn đến với ViCare!</p>
		<div class="for-account-type-professional">
			<p>Cảm ơn bạn đã gửi thông tin. Chúng tôi sẽ liên hệ với bạn để xác nhận trong thời gian sớm nhất.</p>
		</div>
		<div class="for-account-type-place">
			<p>Cảm ơn bạn đã gửi thông tin. Chúng tôi sẽ liên hệ với bạn để xác nhận trong thời gian sớm nhất.</p>
		</div>
		<p>
			<strong>Họ và tên:</strong> <%= name %>
			<br />
			<strong>Số điện thoại:</strong>
			<%= phone ? phone : '<em>chưa cung cấp</em>' %>
			<br />
			<strong>Email:</strong> <%= email %>
		</p>
		<div class="button-row">
			<a href="<%= next %>" class="button">OK <i class="fa fa-check" aria-hidden="true"></i></a>
		</div>
	</div>
</script>



			
			<input name="csrfmiddlewaretoken" value="ZPSo31DHOOuFKv1BD8gTdDyX5aUmOfmU" type="hidden">
		
@endsection
