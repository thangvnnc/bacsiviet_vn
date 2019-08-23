@extends('v2/structor/main',['title'=> 'Bác sĩ chi tiết'])
@section('content')
<div class="container">
	<div id="top">
            
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="/hoibacsi">Hỏi bác sĩ</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="">Tuyển chọn</a></li>
                    </ul> 
                    
                </div>
                <h1 style="font-size: 16px;">
					@if(isset($subject))
						{{$subject->subject}}
					@endif				
				</h1>

                <a class="buthbs" href="/hoibacsi/datcauhoi/" title="Đặt câu hỏi cho bác sĩ, hoàn toàn miễn phí">
                    <i class="fa fa-commenting" aria-hidden="true"></i> Đặt câu hỏi miễn phí
                </a>
                
            </div> 
    </div><!-- #top -->
    <br><br><br>

    <div class="tcmain">
    	<div class="tcct-left">
    		<section>
				<div class="description">
					
					<div class="image" style="background-image: url({{$subject->image}});"></div>
					
					{{$subject->description}}

				</div>

				@if(isset($questions))
				<?php $i = 1;?>
					 @foreach($questions as $ques)
				<article>
					<div class="tctitle">
				
						<div class="order">{{$i}}</div>
						<h2><a href="/hoibacsi/{{$ques->question_url}}-{{$ques->question_id}}/">{{$ques->question_title}}</a></h2>
						
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
								
								<div class="tc-answer">
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

												<div class="verified-badge1 has-tooltip">
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
				
					<div class="fb-send fb_iframe_widget" data-href="/hoibacsi/tuyenchon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}/" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=280719775275851&amp;container_width=749&amp;href=/hoibacsi/tuyenchon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}%2F&amp;locale=vi_VN&amp;sdk=joey"><span style="vertical-align: bottom; width: 47px; height: 20px;"><iframe name="f4ee759dff1b5" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:send Facebook Social Plugin" style="border: medium none; visibility: visible; width: 47px; height: 20px;" src="https://www.facebook.com/v2.5/plugins/send.php?app_id=280719775275851&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FiKWhU6BAGf7.js%3Fversion%3D42%23cb%3Df3607b9f44cdaa%26domain%3Dvicare.vn%26origin%3Dhttps%253A%252F%252Fvicare.vn%252Ff157ae0ed083544%26relation%3Dparent.parent&amp;container_width=749&amp;href=/hoi-bac-si/tuyen-chon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}%2F&amp;locale=vi_VN&amp;sdk=joey" class="" frameborder="0" width="1000px" height="1000px"></iframe></span></div>

					<div class="fb-share-button fb_iframe_widget" data-href="/hoibacsi/tuyenchon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}/" data-layout="button" data-size="small" data-mobile-iframe="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=280719775275851&amp;container_width=749&amp;href=/hoibacsi/tuyenchon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}%2F&amp;layout=button&amp;locale=vi_VN&amp;mobile_iframe=false&amp;sdk=joey&amp;size=small"><span style="vertical-align: bottom; width: 68px; height: 20px;"><iframe name="f3a60468f87144a" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:share_button Facebook Social Plugin" style="border: medium none; visibility: visible; width: 68px; height: 20px;" src="https://www.facebook.com/v2.5/plugins/share_button.php?app_id=280719775275851&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FiKWhU6BAGf7.js%3Fversion%3D42%23cb%3Df1173876b7565ec%26domain%3Dvicare.vn%26origin%3Dhttps%253A%252F%252Fvicare.vn%252Ff157ae0ed083544%26relation%3Dparent.parent&amp;container_width=749&amp;href=/hoi-bac-si/tuyen-chon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}%2F&amp;layout=button&amp;locale=vi_VN&amp;mobile_iframe=false&amp;sdk=joey&amp;size=small" class="" frameborder="0" width="1000px" height="1000px"></iframe></span></div>

					<div class="fb-like fb_iframe_widget" data-href="/hoibacsi/tuyenchon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=280719775275851&amp;container_width=749&amp;href=/hoi-bac-si/tuyen-chon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}%2F&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;size=small"><span style="vertical-align: bottom; width: 68px; height: 20px;"><iframe name="f2369137b3a7954" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like Facebook Social Plugin" style="border: medium none; visibility: visible; width: 68px; height: 20px;" src="https://www.facebook.com/v2.5/plugins/like.php?action=like&amp;app_id=280719775275851&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FiKWhU6BAGf7.js%3Fversion%3D42%23cb%3Df2b43d9fb17c698%26domain%3Dvicare.vn%26origin%3Dhttps%253A%252F%252Fvicare.vn%252Ff157ae0ed083544%26relation%3Dparent.parent&amp;container_width=749&amp;href=/hoi-bac-si/tuyen-chon/{{App\Deals::strtoUrl($subject->subject)}}-{{$subject->id}}%2F&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;size=small" class="" frameborder="0" width="1000px" height="1000px"></iframe></span></div>
				
				</div>

			</section>
    	</div>
    	<div class="tcct-right">
    		<aside class="pulled-up">
			    <section class="top-cnt">
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
			                <a href="/hoibacsi/tuyenchon/{{\App\Deals::strtoUrl($sub->subject)}}-{{$sub->id}}/" title="{{$sub->subject}}" class="image" style="background-image: url({{$sub->image}});"></a>

			                <div class="body">
			                    <h4>
			                        <a href="/hoibacsi/tuyenchon/{{\App\Deals::strtoUrl($sub->subject)}}-{{$sub->id}}/" title="{{$sub->subject}}">{{$sub->subject}}</a>
			                    </h4>
			                </div>
			            </li>
			             @endforeach
			             @endif
			        </ul>
			        <a href="/hoibacsi/tuyenchon/" class="view-more">Xem tất cả các câu hỏi tuyển chọn</a>
			    </section>
			</aside>
    	</div>
    </div>
    <div class="global-thread-create-cta">
        <a href="/hoibacsi/datcauhoi/" class="button">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
            <strong>Hỏi bác sĩ</strong>
            <span>miễn phí</span>
        </a>
    </div>
</div>

@endsection