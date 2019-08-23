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
@extends('main',['title'=>$deal->deal_title,'thumbnail'=>$images])

@section('content')
 <div id="main">
			
			
@if(isset($deal))

<div id="page-title" class="promotion-title">
	<div class="mask">
		<div class="position">
			<ul class="breadcrumbs">
				<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="/" itemprop="url"><span itemprop="title">Trang chủ</span></a>
				</li>
				<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="/uu-dai/" itemprop="url"><span itemprop="title">Ưu đãi</span></a>
				</li>
				<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="/uu-dai/?categories=kham-tong-quat" itemprop="url"><span itemprop="title">Khám Tổng Quát</span></a>
				</li>
			</ul>
			<h1 class="mobile promotion-heading">
				{{$deal->deal_title}}
				

				<div class="social-cta">
	
		<!-- <div class="fb-send fb_iframe_widget" data-href="/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=280719775275851&amp;container_width=0&amp;href=/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}%2F&amp;locale=vi_VN&amp;sdk=joey"><span style="vertical-align: bottom; width: 0px; height: 0px;"><iframe name="f1222532133966c" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:send Facebook Social Plugin" style="border: medium none; visibility: visible; width: 0px; height: 0px;" src="https://www.facebook.com/v2.5/plugins/send.php?app_id=280719775275851&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FnRK_i0jz87x.js%3Fversion%3D42%23cb%3Df12bb5e4451cf0a%26domain%3Dvicare.vn%26origin%3Dhttps%253A%252F%252Fvicare.vn%252Ff237b0f5ded3228%26relation%3Dparent.parent&amp;container_width=0&amp;href=https%3A%2F%2Fvicare.vn%2Fuu-dai%2Fchon-goi-10-lan-dieu-tri-bang-dds-dien-sinh-hoc-tai-the-gioi-massage-4744%2F&amp;locale=vi_VN&amp;sdk=joey" class="" frameborder="0" width="1000px" height="1000px"></iframe></span></div> -->

		<div class="fb-share-button fb_iframe_widget" data-href="/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}/" data-layout="button" data-size="small" data-mobile-iframe="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=280719775275851&amp;container_width=0&amp;href=/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}%2F&amp;layout=button&amp;locale=vi_VN&amp;mobile_iframe=false&amp;sdk=joey&amp;size=small"><span style="vertical-align: bottom; width: 0px; height: 0px;"><iframe name="f1d42fec71b0a2" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:share_button Facebook Social Plugin" style="border: medium none; visibility: visible; width: 0px; height: 0px;" src="https://www.facebook.com/v2.5/plugins/share_button.php?app_id=280719775275851&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FnRK_i0jz87x.js%3Fversion%3D42%23cb%3Df25cb58c176576a%26domain%3Dvicare.vn%26origin%3Dhttps%253A%252F%252Fvicare.vn%252Ff237b0f5ded3228%26relation%3Dparent.parent&amp;container_width=0&amp;href=/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}%2F&amp;layout=button&amp;locale=vi_VN&amp;mobile_iframe=false&amp;sdk=joey&amp;size=small" class="" frameborder="0" width="1000px" height="1000px"></iframe></span></div>

		<div class="fb-like fb_iframe_widget" data-href="/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=280719775275851&amp;container_width=0&amp;href=/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}%2F&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;size=small"><span style="vertical-align: bottom; width: 0px; height: 0px;"><iframe name="f361ba0ac44ece" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like Facebook Social Plugin" style="border: medium none; visibility: visible; width: 0px; height: 0px;" src="https://www.facebook.com/v2.5/plugins/like.php?action=like&amp;app_id=280719775275851&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FnRK_i0jz87x.js%3Fversion%3D42%23cb%3Df3ae13bb512330e%26domain%3Dvicare.vn%26origin%3Dhttps%253A%252F%252Fvicare.vn%252Ff237b0f5ded3228%26relation%3Dparent.parent&amp;container_width=0&amp;href=/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}%2F&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;size=small" class="" frameborder="0" width="1000px" height="1000px"></iframe></span></div>
	
</div>

			</h1>
		</div>
	</div>
</div>

<div id="promotion-detail" class="presignup-target" data-presignup-target="4744">
	<div class="position">
		<div class="mobile price-container">
			<!--this component is repeated in promotion_list and homepage-->
			<div class="price">
				
					
						<span class="old-price">{{number_format($deal->old_price,0)}}</span><span class="currency">₫</span>
						<span class="new-price">{{number_format($deal->price,0)}}<span class="currency">₫</span></span>
					
				
			</div>

			
				<div class="discount ">
			@if($deal->old_price!=0)
				-{{number_format((($deal->price/$deal->old_price) * 100), 0) }}%
			@endif
				</div>
			
		</div>

		<div class="top clearfix">
			<div class="top-left">
				<aside class="clearfix">
					<div class="media gallery">
						
						<div id="hero-image" class="has-full-sized-image-triggers promotion-hero primary carousel owl-carousel owl-loaded owl-drag" data-sync="#hero-carousel" data-images="[{&quot;medium_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/14_03_2017_03_40_17_185504.jpeg&quot;, &quot;origin_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/14_03_2017_03_40_17_519390.jpg&quot;, &quot;thumbnail_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/14_03_2017_03_40_17_076193.jpeg&quot;, &quot;name&quot;: &quot;&quot;}, {&quot;medium_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_41_354014.jpeg&quot;, &quot;origin_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_41_754245.jpg&quot;, &quot;thumbnail_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_41_218879.jpeg&quot;, &quot;name&quot;: &quot;&quot;}, {&quot;medium_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_41_895335.jpeg&quot;, &quot;origin_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_42_210358.jpg&quot;, &quot;thumbnail_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_41_830366.jpeg&quot;, &quot;name&quot;: &quot;&quot;}, {&quot;medium_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_42_394873.jpeg&quot;, &quot;origin_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_42_761438.jpg&quot;, &quot;thumbnail_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_42_316633.jpeg&quot;, &quot;name&quot;: &quot;&quot;}]">
							
								
							
								
							
								
							
								
							
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
										<img height="280px"; width="100%" src="../public/images/{{$deal->image}}" />
									</a>
								</div>
							</div>
						</div></div><div class="owl-nav"><div class="owl-prev"></div><div class="owl-next disabled"></div></div><div class="owl-dots disabled"></div></div>

						
							<div id="hero-carousel" class="carousel secondary owl-carousel owl-loaded owl-drag" data-sync="#hero-image">
							
							<div class="owl-stage-outer">
								<div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 151px;">

									<div class="owl-item active" style="width: 30px;">

										<div class="item">
											<!-- <a href="#" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/14_03_2017_03_40_17_076193.jpeg);"></a> -->
										</div>
									</div>
									<div class="owl-item active" style="width: 30px;">
										<div class="item">
											<!-- <a href="#" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_41_218879.jpeg);"></a> -->
										</div>
									</div>

									<div class="owl-item active" style="width: 30px;">
										<div class="item">
											<!-- <a href="#" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_41_830366.jpeg);"></a> -->
										</div>
									</div>
									<div class="owl-item active selected" style="width: 30px;">

										<div class="item">
											<!-- <a href="#" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/13_03_2017_12_30_42_316633.jpeg);"></a> -->
										</div>
									</div>
							</div>
								</div>

									<div class="owl-nav disabled"><div class="owl-prev disabled"></div><div class="owl-next disabled"></div></div><div class="owl-dots disabled"></div>
								</div>
						

					</div>
				</aside>
			</div>

			
				<section class="mobile promotion-place-list">
					<div class="suggestion">
	<h3 class="section-title">Địa điểm nhận ưu đãi</h3>
	<form class="promotion-group" data-promotion-group-position="1">
		<ul class="places">
			
				<li class="has-actions has-map-marker" data-map-marker="80070">
					<div class="place-image">
						<a href="/co-so-y-te/{{$deal->clinic->clinic_url}}-{{$deal->clinic->clinic_id}}/kham-benh" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/14_11_2016_08_37_55_688205.jpeg);">
						</a>
					</div>

					<div class="body">
						<h2>
							<a href="/co-so-y-te/{{$deal->clinic->clinic_url}}-{{$deal->clinic->clinic_id}}/kham-benh">{{$deal->clinic->clinic_name}}</a>
							
						</h2>
						<div class="field-place">
							
								<i class="fa fa-map-marker"></i>
									{{$deal->clinic->clinic_address}}
							
						</div>
						<div class="field-place">
							
						</div>
						<div class="call-to-action">
							<a href="#contact-80070" id="80070" class=" action-get-contact  button" title="Nhận ưu đãi Chọn Gói 10 Lần Điều Trị Bằng DDS - Điện Sinh Học Tại Thế Giới Massage" data-place-id="80070" data-track-label="Bấm chọn nhận ưu đãi với Thế Giới Massage" data-bookable="False" data-track-path="/uu-dai/chon-goi-10-lan-dieu-tri-bang-dds-dien-sinh-hoc-tai-the-gioi-massage-4744/nhan-uu-dai/80070" data-promotion-url="/uu-dai/chon-goi-10-lan-dieu-tri-bang-dds-dien-sinh-hoc-tai-the-gioi-massage-4744/" data-coupon="" data-voucher="False" data-customer-id="">
								Nhận ưu đãi
							</a>
						</div>
						<label>
							<input data-input-position="1" class="promotion-group-input" value="#80070" name="input-top" required="" checked="" type="radio">
							<span></span>
						</label>
					</div>

					<div class="actions" id="contact-80070">
						<div class="inner contact-details">

							

							
								<div class="section promotion-contact">
									<p><strong>Ưu đãi này đang được áp dụng cho tất cả khách hàng tại Thế Giới Massage.</strong></p>
									<p>
										Bạn có thể liên hệ với Thế Giới Massage theo cách dưới đây:
									</p>
									<ul>
										<li>
											Điện thoại: <a href="#" class="phone">0432123688</a>
										</li>
										
										
									</ul>
								</div>
							

							
						</div>
					</div>
				</li>
			
		</ul>

		<button class="button promotion-btn" type="submit">Nhận ưu đãi ngay</button>
	</form>
</div>


				</section>
			

				<div class="mobile get-promotion">
					<div class="container">
						
							<div class="expire">
								
									
										
											<div class="promotion-expired-date">
												<i class="fa fa-clock-o" aria-hidden="true"></i>
												
													Thời hạn: 30/04/2017
												
											</div>
										
									
								
							</div>
						

							<div class="hits">
								
									<i class="fa fa-eye" aria-hidden="true"></i>
									<span>144 đã xem</span>
								
								
							</div>
					</div>
				</div>

				<section class="top-right collapsible-container collapsible-block expanded">
					<h2 class="desktop">
						{{$deal->deal_title}}
						
						<div class="social-cta">
	
		<!-- <div class="fb-send fb_iframe_widget" data-href="https://vicare.vn/uu-dai/chon-goi-10-lan-dieu-tri-bang-dds-dien-sinh-hoc-tai-the-gioi-massage-4744/" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=280719775275851&amp;container_width=736&amp;href=https%3A%2F%2Fvicare.vn%2Fuu-dai%2Fchon-goi-10-lan-dieu-tri-bang-dds-dien-sinh-hoc-tai-the-gioi-massage-4744%2F&amp;locale=vi_VN&amp;sdk=joey"><span style="vertical-align: bottom; width: 47px; height: 20px;"><iframe name="f2663f9a8341dac" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:send Facebook Social Plugin" style="border: medium none; visibility: visible; width: 47px; height: 20px;" src="https://www.facebook.com/v2.5/plugins/send.php?app_id=280719775275851&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FnRK_i0jz87x.js%3Fversion%3D42%23cb%3Df2636702a549776%26domain%3Dvicare.vn%26origin%3Dhttps%253A%252F%252Fvicare.vn%252Ff237b0f5ded3228%26relation%3Dparent.parent&amp;container_width=736&amp;href=https%3A%2F%2Fvicare.vn%2Fuu-dai%2Fchon-goi-10-lan-dieu-tri-bang-dds-dien-sinh-hoc-tai-the-gioi-massage-4744%2F&amp;locale=vi_VN&amp;sdk=joey" class="" frameborder="0" width="1000px" height="1000px"></iframe></span></div>
-->
		<div class="fb-share-button fb_iframe_widget" data-href="/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}/" data-layout="button" data-size="small" data-mobile-iframe="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="app_id=280719775275851&amp;container_width=0&amp;href=/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}%2F&amp;layout=button&amp;locale=vi_VN&amp;mobile_iframe=false&amp;sdk=joey&amp;size=small"><span style="vertical-align: bottom; width: 0px; height: 0px;"><iframe name="f1d42fec71b0a2" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:share_button Facebook Social Plugin" style="border: medium none; visibility: visible; width: 0px; height: 0px;" src="https://www.facebook.com/v2.5/plugins/share_button.php?app_id=280719775275851&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FnRK_i0jz87x.js%3Fversion%3D42%23cb%3Df25cb58c176576a%26domain%3Dvicare.vn%26origin%3Dhttps%253A%252F%252Fvicare.vn%252Ff237b0f5ded3228%26relation%3Dparent.parent&amp;container_width=0&amp;href=/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}%2F&amp;layout=button&amp;locale=vi_VN&amp;mobile_iframe=false&amp;sdk=joey&amp;size=small" class="" frameborder="0" width="1000px" height="1000px"></iframe></span></div>

		<div class="fb-like fb_iframe_widget" data-href="/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="false" data-share="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=280719775275851&amp;container_width=0&amp;href=/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}%2F&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;size=small"><span style="vertical-align: bottom; width: 0px; height: 0px;"><iframe name="f361ba0ac44ece" allowtransparency="true" allowfullscreen="true" scrolling="no" title="fb:like Facebook Social Plugin" style="border: medium none; visibility: visible; width: 0px; height: 0px;" src="https://www.facebook.com/v2.5/plugins/like.php?action=like&amp;app_id=280719775275851&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fconnect%2Fxd_arbiter%2Fr%2FnRK_i0jz87x.js%3Fversion%3D42%23cb%3Df3ae13bb512330e%26domain%3Dvicare.vn%26origin%3Dhttps%253A%252F%252Fvicare.vn%252Ff237b0f5ded3228%26relation%3Dparent.parent&amp;container_width=0&amp;href=/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}%2F&amp;layout=button_count&amp;locale=vi_VN&amp;sdk=joey&amp;share=false&amp;show_faces=false&amp;size=small" class="" frameborder="0" width="1000px" height="1000px"></iframe></span></div>
	
</div>

					</h2>
					<h3 class="description-heading collapse-trigger arrow section-title">Thông tin chi tiết</h3>

					
						<div class="cms collapsible-target">
							{!!$deal->description!!}
						</div>
					

					<div class="desktop promotion-info clearfix">
							<div class="desktop price-container">
								<!--this component is repeated in promotion_list and homepage-->
								<div class="price">
									
										
											<span class="old-price-container">Giá gốc: <span class="old-price">{{number_format($deal->old_price,0)}}</span><span class="currency">₫</span></span>

											<span class="new-price">
												{{number_format($deal->price,0)}}<span class="currency">₫</span>
												<span class="discount">
													@if($deal->old_price!=0)
														-{{number_format((($deal->price/$deal->old_price) * 100), 0) }}%
													@endif
												</span>
											</span>
										
									
								</div>
							</div>

						
							<div class="desktop get-promotion">
								<div class="hits">
									
										<i class="fa fa-user" aria-hidden="true"></i>
										<span>{{$deal->ranked}} đã xem</span>
									

									
								</div>

								<div class="expire">
									
										
											
												<div class="promotion-expired-date">
													<i class="fa fa-clock-o" aria-hidden="true"></i>
														
															Thời hạn: {{$deal->end_time}}
														
															</div>
												<div class="promotion-expired-date">
													<i class="fa fa-phone" aria-hidden="true"></i>
														
															<span style="color: #2B96CC;font-size:18px;font-weight: bold;">Hotline: {{$hl->content}}</span>
														
															</div>
														
										
									
								</div>

							</div>
						
					</div>
				</section>
		</div>

		<div class="bottom clearfix">
			
				<section class="collapsible-container collapsible-block expanded">
					<h3 class="collapse-trigger arrow product-desc section-title">Giới thiệu</h3>
					<div class="c">
					{!!$deal->deal_content!!}
						</div>
				</section>
			

			
				<section class="promotion-place-list">
				@if(!empty($deal->clinic))
					<div class="suggestion">
	<h3 class="section-title">Địa điểm nhận ưu đãi</h3>
	<form class="promotion-group" data-promotion-group-position="2">
		<ul class="places">
			
				<li class="has-actions has-map-marker" data-map-marker="80070">
					<div class="place-image">
						<a href="/co-so-y-te/{{$deal->clinic->clinic_url}}-{{$deal->clinic->clinic_id}}/kham-benh" class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/14_11_2016_08_37_55_688205.jpeg);">
						</a>
					</div>

					<div class="body">
						<h2>
							<a href="/co-so-y-te/{{$deal->clinic->clinic_url}}-{{$deal->clinic->clinic_id}}/kham-benh">{{$deal->clinic->clinic_name}}</a>
							
						</h2>
						<div class="field-place">
							
								<i class="fa fa-map-marker"></i>
									{{$deal->clinic->clinic_address}}
							
						</div>
						<div class="field-place">
							
						</div>
						<div class="call-to-action">
							<a href="#contact-80070" id="80070" class=" action-get-contact  button" title="Nhận ưu đãi Chọn Gói 10 Lần Điều Trị Bằng DDS - Điện Sinh Học Tại Thế Giới Massage" data-place-id="80070" data-track-label="Bấm chọn nhận ưu đãi với Thế Giới Massage" data-bookable="False" data-track-path="/uu-dai/chon-goi-10-lan-dieu-tri-bang-dds-dien-sinh-hoc-tai-the-gioi-massage-4744/nhan-uu-dai/80070" data-promotion-url="/uu-dai/chon-goi-10-lan-dieu-tri-bang-dds-dien-sinh-hoc-tai-the-gioi-massage-4744/" data-coupon="" data-voucher="False" data-customer-id="">
								Nhận ưu đãi
							</a>
						</div>
						<label>
							<input data-input-position="1" class="promotion-group-input" value="#80070" name="input-top" required="" checked="" type="radio">
							<span></span>
						</label>
					</div>

					<div class="actions" id="contact-80070">
						<div class="inner contact-details">

							

							
								<div class="section promotion-contact">
									<p><strong>Ưu đãi này đang được áp dụng cho tất cả khách hàng tại {{$deal->clinic->clinic_name}}</strong></p>
									<p>
										Bạn có thể liên hệ với {{$deal->clinic->clinics}} theo cách dưới đây:
									</p>
									<ul>
										<li>
											Điện thoại: <a href="#" class="phone">{{$deal->clinic->clinic_phone}}</a>
										</li>
										
										
									</ul>
								</div>
							

							
						</div>
					</div>
				</li>
			
		</ul>

		<button class="button promotion-btn" type="submit">Nhận ưu đãi ngay</button>
	</form>
</div>
@endif

			<section class="related clearfix">
				<h3 class="section-title">Ưu đãi liên quan</h3>

				
					
						


<a class="promotion-list-item" href="/uu-dai/dieu-tri-benh-xoang-bang-dong-y-3271/" title="Điều trị bệnh xoang bằng Đông y">
	

	
</a>

					</div>
				
			</section>
		
		<section class="c-comment-vue" id="vue-bootstrap">
    <h3>Bình luận ({{$comment->count()}})</h3>
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
                            <span class="verified-badge has-tooltip"><em>Chính thức</em> <span class="tooltip">Nội dung chính thức từ bác sĩ hợp tác với ViCare</span></span></span> <!----> <!----> <span class="time"><i aria-hidden="true" class="fa fa-clock-o"></i>   {{$c['created_at']}}
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
            <h4>Nhập nội dung bình luận dưới đây</h4>
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            <input type="hidden" name="deal_id" value="{{$deal->deal_id}}"/>
                <div class="post-new-top">
                   
                </div>
            

            <textarea class="form-control resize-textarea" name="body"></textarea>

            <button type="submit">Gửi</button>
           
        </form>
    </div>
    @else
</section>

 <h3>Bạn Cần Đăng Nhập Bình Luận</h3>
 @endif
	</div>

</div>

<script type="text/html" id="booking-picker-template">
	<table class="weeks">
		<tr>
			<td>
				<table class="week">
					<tr>
						<% for (var i = 0; i < obj.length; i++) { %>
							<th>
								<span class="day"><%= obj[i].dayFormatted %></span>
								<span class="date"><%= obj[i].shortDateFormatted %></span>
							</th>
						<% } %>
					 </tr>
					 <tr>
						<% if (hasSlots) { %>
							<% for (var i = 0; i < obj.length; i++) { %>
								<td>
									<% for (var j = 0; j < obj[i].slots.length; j++) { %>
										<% if (obj[i].slots[j].cancelled) { %>
											<span class="cancelled" title="Buổi khám này đã bị hủy"><%= obj[i].slots[j].startFormatted %></span>
										<% } else if (obj[i].slots[j].past) { %>
											<span class="past" title="Buổi khám này đã kết thúc"><%= obj[i].slots[j].startFormatted %></span>
										<% } else { %>
											<a class="<% if (obj[i].slots[j].booking_count >= obj[i].slots[j].slot_size) { %>full<% } %>"
												href="/dat-kham/<%= placeId %>/<%= obj[i].dateFormatted %>/<%= obj[i].slots[j].startFormatted %>/<%= professionalId %>"
												<% if (obj.openInNewWindow) { %>target="_blank"<% } %>>
												<span class="time"><%= obj[i].slots[j].startFormatted %></span>
												<span class="occupancy" style="width: <%= obj[i].slots[j].booking_count / obj[i].slots[j].slot_size * 100 %>%"></span>
											</a>
										<% } %>
									<% } %>
									<% if (obj[i].slots.length == 0) { %>
										<span class="no-slot">&nbsp;</span>
									<% } %>
								</td>
							<% } %>
						<% } else { %>
							<td colspan="<%= obj.length %>" class="no-slot">
								<% if (professionalName) { %>
									<i class="fa fa-calendar-times-o" aria-hidden="true"></i> Bác sĩ <%=professionalName%> không có ca trực nào trong 3 tuần tới.
								<% } else if (placeName) { %>
									<i class="fa fa-calendar-times-o" aria-hidden="true"></i> Bác sĩ không có ca trực nào trong 3 tuần tới tại <%=placeName%>.
								<% } %>
							</td>
						<% } %>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</script>

<div class="global-thread-create-cta">
	<a href="/hoi-bac-si/dat-cau-hoi/" class="button">
		<i class="fa fa-question-circle" aria-hidden="true"></i>
		<strong>Hỏi bác sĩ</strong>
		<span>miễn phí</span>
	</a>
</div>
<!-- Root element of PhotoSwipe. Must have class pswp. -->

<script type="text/x-template" id="component-comment">
<div>
    
    <h3>Bình luận ([[comments.length]])</h3>
    <div class="c-comment-vue__list">
        <ul>
            <li v-for="(comment, index) in comments">
                <div class="c-comment-vue__list--top">

                    <div v-if="comment.created_by.main_image" class="c-comment-vue__list--top__image" :style="{ backgroundImage: 'url(' + comment.created_by.main_image + ')' }">
                    </div>

                    <div v-else :class="{ 'c-comment-vue__list--top__image': true, 'official': comment.created_by.official}"></div>

                    <div class="post-meta-data">
                        <span class="user" v-if="comment.created_by.official">
                            [[ comment.created_by.occupation ]] [[ comment.created_by.name ]]
                            <span class="verified-badge has-tooltip">
                                <em>Chính thức</em>
                                <span class="tooltip">Nội dung chính thức từ bác sĩ hợp tác với ViCare</span>
                            </span>
                        </span>

                        <span class="user" v-if="!comment.created_by.official">
                            [[ comment.created_by.name ]]
                        </span>

                        <a v-if="changeComment" v-bind="{ href: changeLink + comment.id }"><i class="fa fa-edit"></i></a>

                        <span class="time">
                            <i class="fa fa-clock-o" aria-hidden="true"></i> [[ comment.created_at ]]
                        </span>

                        <span class="has-tooltip">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            đã sửa
                            <span class="tooltip">Sửa lần cuối lúc</span>
                        </span>
                    </div>
                </div>

                <div class="c-comment-vue__list--bottom">
                    <div class="inner-boby">
                        <div class="post-body-content">
                            <div v-html="comment.body"></div>
                            <form v-if="comment.isEditing" class="edit-post" v-on:submit="sendEditComment(comment, index, $event)" v-bind:class="{ submitting: comment.isLoading }">
                                <textarea v-model="comment.body_raw"></textarea>
                                <button type="submit">Hoàn tất</button>
                                <a class="cancel-edit" v-on:click="cancelEdit(comment, index);"><i class="fa fa-times" aria-hidden="true"></i>Hủy sửa</a>
                            </form>
                        </div>
                    </div>

                    <div v-if="!comment.isEditing">
                        <a class="edit" data-id="" v-on:click="editComment(comment, index);" v-if="authenticated && username == comment.created_by.username">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            Sửa
                        </a>

                        <a class="reply" data-id="" v-on:click.prevent="replyComment(comment, index);">
                            <i class="fa fa-reply" aria-hidden="true"></i>
                            Trả lời
                        </a>

                        <div class="thanks-button-count">
                            <a class="thank" v-bind:class="{ active: comment.isThank }">
                                <span class="unactive-text" v-on:click="sendThank(comment, index);">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i> Cảm ơn
                                </span>
                                <span class="active-text">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i> Đã cảm ơn
                                </span>
                            </a>

                            <div class="thanks-count-inner show" v-if="comment.thank_count">
                                <i class="fa fa-heart-o" aria-hidden="true"></i>
                                <span class="thank-count-value">[[ comment.thank_count ]]</span>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <div class="c-comment-vue__form">
        <form v-on:submit="addComment" v-bind:class="{ submitting: isLoading }">
            <h4>Nhập nội dung bình luận dưới đây</h4>
            <textarea ref="textarea" class="form-control resize-textarea" name="body" v-model="message.body" v-on:focus="focusCommentInput"></textarea>
            <button type="submit">Gửi trả lời</button>
        </form>
    </div>
</div>

</script>


			
				

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

				<form method="post" action="https://vicare.vn/dang-nhap/?next=/uu-dai/chon-goi-10-lan-dieu-tri-bang-dds-dien-sinh-hoc-tai-the-gioi-massage-4744/" name="login">
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
						<button type="button" name="facebook" data-link="https://vicare.vn/tai-khoan/ket-noi/login/facebook/?next=/uu-dai/chon-goi-10-lan-dieu-tri-bang-dds-dien-sinh-hoc-tai-the-gioi-massage-4744/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng nhập qua Facebook</button>
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

				<form method="post" action="https://vicare.vn/dang-ky/?next=/uu-dai/chon-goi-10-lan-dieu-tri-bang-dds-dien-sinh-hoc-tai-the-gioi-massage-4744/" name="signup">
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
						<button type="button" name="facebook" data-link="https://vicare.vn/tai-khoan/ket-noi/login/facebook/?next=/uu-dai/chon-goi-10-lan-dieu-tri-bang-dds-dien-sinh-hoc-tai-the-gioi-massage-4744/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng ký qua Facebook</button>
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
			
	@endif
		</div>
@endsection

<style type="text/css">
	
	@media only screen and (max-width:768px){
		#promotion-detail .media .carousel.primary .item a{
			width:370px !important;
			margin-left:225px !important;
		}

	}

	@media only screen and (max-width:480px){
		#promotion-detail .media .carousel.primary .item a{
			width:300px !important;
			margin-left:385px !important;
		}

	}
</style>
