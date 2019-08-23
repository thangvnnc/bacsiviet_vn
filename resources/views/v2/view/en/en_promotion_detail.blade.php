<?php if(!empty($deal->image))
{ 
	if(strpos($deal->image,'http')===false) 
	{
		$images = '/public/images/'.$deal->image;
	}
	else{
		$images = $deal->image;
	}
	
}
else{
	$images = "";
}
?>
@extends('v2/view/en/en_main',['title'=> 'Promotion details'])
@section('en_content')
<div class="main-A">
	<div id="top">
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/en">Home</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="/en/khuyenmai">Promotion</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="#">Promotion details</a></li>
                    </ul> 
                    
                </div>
               </div>
	 </div><!-- #top -->

	<div class="km-dt-ct">
		<aside class="clearfix">
			<div class="media gallery">
			
				<div  id="hero-image" class="has-full-sized-image-triggers promotion-hero primary carousel owl-carousel owl-loaded owl-drag" data-sync="#hero-carousel" data-images="[{&quot;medium_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/14_03_2017_03_40_17_185504.jpeg&quot;, &quot;origin_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/14_03_2017_03_40_17_519390.jpg&quot;, &quot;thumbnail_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/14_03_2017_03_40_17_076193.jpeg&quot;, &quot;name&quot;: &quot;&quot;}, {&quot;medium_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_41_354014.jpeg&quot;, &quot;origin_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_41_754245.jpg&quot;, &quot;thumbnail_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_41_218879.jpeg&quot;, &quot;name&quot;: &quot;&quot;}, {&quot;medium_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_41_895335.jpeg&quot;, &quot;origin_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_42_210358.jpg&quot;, &quot;thumbnail_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_41_830366.jpeg&quot;, &quot;name&quot;: &quot;&quot;}, {&quot;medium_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_42_394873.jpeg&quot;, &quot;origin_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_42_761438.jpg&quot;, &quot;thumbnail_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_42_316633.jpeg&quot;, &quot;name&quot;: &quot;&quot;}]">
					
			
				<div class="owl-stage-outer">
					<div class="owl-stage" style="transform: translate3d(-1272px, 0px, 0px); transition: all 0.25s ease 0s; width: 1696px;">
						<div class="owl-item" style="width: 424px;">
							<div class="item">
								<a href="#" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/14_03_2017_03_40_17_185504.jpeg);" class="image full-sized-image-trigger"></a>
							</div>
						</div>

						<div class="owl-item" style="width: 424px;">
							<div class="item">
								<a href="#" style="background-image: url(https://dwbxi9io9o7cae.cloudfront.net/images/13_03_2017_12_30_41_354014.jpeg);" class="image full-sized-image-trigger"></a>
							</div>
						</div>

						<div class="owl-item" style="width: 424px;">
							<div class="item">
								<a href="#" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_41_895335.jpeg);" class="image full-sized-image-trigger"></a>
							</div>
						</div>

						<div class="owl-item selected active" style="width: 424px;">
							<div class="item" style="width:450px;">
								<a  href="#" @if(!empty($deal->image)) style="background-image: url(@if(strpos($deal->image,'http')===false)/public/images/@endif{{$deal->image}}); background-size: contain;background-position: center;background-repeat: no-repeat;" @endif class="image full-sized-image-trigger">
									<img height="280px"; width="100%" src="/public/images/{{$deal->image}}" />
								</a>
							</div>
						</div>

					</div>
					</div>

				</div>
			</div>
		</aside>
		<div class=" price-container">
			 <h1 >{{$deal->deal_title}}</h1>
               <div class="fb-share-button fb_iframe_widget" data-href="/en/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}/" data-layout="button" data-size="small" data-mobile-iframe="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=280719775275851&amp;container_width=0&amp;href=/en/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}%2F&amp;layout=button&amp;locale=vi_VN&amp;mobile_iframe=false&amp;sdk=joey&amp;size=small"><span style="vertical-align: bottom; width: 0px; height: 0px;"><iframe name="f1d42fec71b0a2" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:share_button Facebook Social Plugin" style="border: medium none; visibility: visible; width: 0px; height: 0px;" src="https://www.facebook.com/v2.5/plugins/share_button.php?app_id=280719775275851&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FnRK_i0jz87x.js%3Fversion%3D42%23cb%3Df25cb58c176576a%26domain%3Dvicare.vn%26origin%3Dhttps%253A%252F%252Fvicare.vn%252Ff237b0f5ded3228%26relation%3Dparent.parent&amp;container_width=0&amp;href=/en/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}%2F&amp;layout=button&amp;locale=vi_VN&amp;mobile_iframe=false&amp;sdk=joey&amp;size=small" class="" frameborder="0" width="1000px" height="1000px"></iframe></span></div>

				<div class="fb-like fb_iframe_widget" data-href="/en/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=280719775275851&amp;container_width=0&amp;href=/en/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}%2F&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;size=small"><span style="vertical-align: bottom; width: 0px; height: 0px;"><iframe name="f361ba0ac44ece" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like Facebook Social Plugin" style="border: medium none; visibility: visible; width: 0px; height: 0px;" src="https://www.facebook.com/v2.5/plugins/like.php?action=like&amp;app_id=280719775275851&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FnRK_i0jz87x.js%3Fversion%3D42%23cb%3Df3ae13bb512330e%26domain%3Dvicare.vn%26origin%3Dhttps%253A%252F%252Fvicare.vn%252Ff237b0f5ded3228%26relation%3Dparent.parent&amp;container_width=0&amp;href=/en/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}%2F&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;size=small" class="" frameborder="0" width="1000px" height="1000px"></iframe></span></div>


				<div class="price-get">
					<div class="price-km">
				
					
						<span class="old-price-container">Cost: <span class="old-price-km">{{number_format($deal->old_price,0)}}</span><span class="currency">₫</span></span>

						<span class="new-price-km">
							{{number_format($deal->price,0)}}<span class="currency">₫</span>
							<span class="discount">
								@if($deal->old_price!=0)
									-{{number_format((($deal->price/$deal->old_price) * 100), 0) }}%
								@endif
							</span>
						</span>
					
				
				</div>
		

				<div class=" get-promotion">
					<div class="hits">
							<i class="fa fa-user" aria-hidden="true"></i>
							<span>{{$deal->ranked}} watched</span>
					</div>

					<div class="expire">
						<div class="promotion-expired-date">
							<i class="fa fa-clock-o" aria-hidden="true"></i>
									Duration: {{$deal->end_time}}
						</div>
						<div class="promotion-expired-date">
							<i class="fa fa-phone" aria-hidden="true"></i>
									<span style="color: #2B96CC;font-size:18px;font-weight: bold;">Hotline: 0123.456.789</span>
						</div>
					</div>

				</div>
			</div>
		</div> <!--Price container-->
		
		<div class="bot-clearfix">
			
			<section class="sec-km-dt">
				<h3 class="collapse-trigger arrow product-desc section-title">Introduce</h3>
				<div class="c">
				{!!$deal->deal_content!!}
					</div>
			</section>
			<section class="promotion-place-list">
			@if(!empty($deal->clinic))
				<div class="suggestion">
					<h3 class="section-title">Locations to receive incentives</h3>
					<form class="promotion-group" data-promotion-group-position="2">
						<ul class="places">
							
								<li class="has-actions has-map-marker" data-map-marker="80070">
									<div class="place-image">
										<a href="/en/phongkham-chitiet/{{$deal->clinic->clinic_url}}-{{$deal->clinic->clinic_id}}/kham-benh" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/14_11_2016_08_37_55_688205.jpeg);">
										</a>
									</div>

									<div class="body">
										<h2>
											<a href="/en/phongkham-chitiet/{{$deal->clinic->clinic_url}}-{{$deal->clinic->clinic_id}}/kham-benh">{{$deal->clinic->clinic_name}}</a>
											
										</h2>
										<div class="field-place">
											
												<i class="fa fa-map-marker"></i>
													{{$deal->clinic->clinic_address}}
											
										</div>
										
										
									</div>

									
								</li>
							
						</ul>

						<button class="button promotion-btn" type="submit">Get deals right away</button>
					</form>
			</div>
			@endif

			<section class="related">
				<h3 class="section-title">Related offers</h3>

				<a class="promotion-list-item" href="/uu-dai/dieu-tri-benh-xoang-bang-dong-y-3271/" title="Điều trị bệnh xoang bằng Đông y">
					</a>
			</section>	

		</section>
			

					</div>	
		<section class="c-comment-vue" id="vue-bootstrap">
			    <h3>Comment ({{$comment->count()}})</h3>
			    @if(session('thongbao'))
			    {{session('thongbao')}}
			    @endif
			    <div id="c-comment-vue__list">
			    @foreach($comment as $c)

			   <ul>
			 	  <li>
			   <li><div class="c-comment-vue__list--top"><div class="c-comment-vue__list--top__image" style="background-image: url(&quot;https://dwbxi9io9o7ce.cloudfront.net/images/pasted_image_at_2017_03_02_06_04_p.2e16d0ba.fill-512x512.png&quot;);"></div> <div class="post-meta-data"><span class="user">
			                             <?php $art = App\Users::find($c['user_id']); ?>
			                           {{$art['fullname']}}
			                            <span class="verified-badge has-tooltip"><em>Offical</em> <span class="tooltip">Official content from doctors cooperating with ViCare</span></span></span> <!----> <!----> <span class="time"><i aria-hidden="true" class="fa fa-clock-o"></i>   {{$c['created_at']}}
			                        </span> <div class="c-comment-vue__list--bottom"><div class="inner-boby"><div class="post-body-content"><div>
			                               {{$c['content']}}
			                            </div> <!----></div></div> <div><!----> <div class="thanks-button-count"> <!----></div></div></div></li>
			 	  </li>
			   </ul>
			    
			     @endforeach
			    </div>
			 @if(Session::get('user')!=null) 
			    <div id="c-comment-vue__form">
					<form name="new-post" class="post-new" action="/deal_comment" method="post">
			            <h4>Enter the comment content below</h4>
			            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
			            <input type="hidden" name="deal_id" value="{{$deal->deal_id}}"/>
			                <div class="post-new-top">
			                   
			                </div>
			            

			            <textarea class="form-control resize-textarea" name="body"></textarea>

			            <button type="submit">Send</button>
			           
			        </form>
			    </div>
			    @else
			</section>

			 <h3>You need to log in to comment</h3>
			 @endif
	</div><!--.km-dt-ct-->
 
	
</div>

@endsection