@extends('v2/view/en/en_main',['title'=> 'Promotion'])
@section('en_content')
<div class="main-A">
	<div id="top">
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/en">Home</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="#">Promotion</a></li>
                    </ul> 
                    
                </div>
                <h1 style="font-size: 18px;">List Promotion</h1>
            </div> 
	 </div><!-- #top -->
	 <div class="km-cnt">
	 	<div class="menu-km-cnt">
	 		<ul>
				<li>
					<a href="/en/khuyenmai/" class="@if(empty(app('request')->input('categories'))) active @endif">most prominent</a>
				</li>
				@if(isset($deal_category))
				 @foreach($deal_category as $cat)
					<li>
						<a href="?categories={{$cat->category_url}}" @if(app('request')->input('categories')==$cat->category_url) class="active" @endif >{{$cat->category_name}}</a>
					</li>
				  @endforeach
				@endif
					
				
			</ul>
	 	</div>

		<div class="promotion-list">
				<div class="grid-layout" style="">
			
				@if(isset($deals))
				  @foreach($deals as $deal)
					<div class="grid-item" style="">

						<a class="promotion-list-item" href="/en/khuyenmai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}" title="{{$deal->deal_title}}">

						<div class="media">

							<div class="image-placeholder" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/10_03_2017_13_40_47_755568.jpeg)"></div>

							<div class="image" style="background-image: url(/public/images/{{$deal->image}})">
							</div>

							<div class="promotion-item-discount">
							@if($deal->old_price!=0)
								-{{number_format((($deal->price/$deal->old_price) * 100), 0) }}%
							@endif
							</div>

							<div class="address">
								<i class="fa fa-map-marker" aria-hidden="true"></i>
							</div>

							<button class="promotion-button button">
								Watch now
							</button>
					</div>

					<div class="body">
						<h3 class="promotion-title">
							{{$deal->deal_title}}
						</h3>

						<div class="price">
							<span class="old-price">{{number_format($deal->old_price)}}<span class="currency">₫</span></span>
							<span class="new-price">{{number_format($deal->price)}}<span class="currency">₫</span></span>	
						</div>

						<div class="place-address">
							<i class="fa fa-hospital-o fa-fw" aria-hidden="true"></i>
								{{$deal->clinic->clinic_name}}
						</div>

						<div class="place-address" style="margin:7px 0;">
							<h3 class="promotion-title">
								<span>HotLine:<span class="currency">0123.456.789</span></span>
								<span class="new-price" style="color: #2B96CC;"><span class="currency"></span></span>
								
									<span class="cms-comment-count">
										<!-- <i class="fa fa-comment-o"></i> 15 -->
									</span>
								
							</h3>
						</div>

						<div class="date-hits">
							
							<div class="date">
								<i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>
									Duration: {{$deal->end_time}}
							</div>
						
							<div class="hits">
								<i class="fa fa-eye" aria-hidden="true"></i>
								<span>{{$deal->ranked}}</span>
							</div>
							
						</div>
					</div>
				</a>

					</div>
			@endforeach
			@endif
						
			</div>	
			@if(isset($deals) && !count($deals))
			<div style="text-align: center;padding-top: 80px;font-size: 18px;font-weight: bold; ">No promotions found</div>
			@endif
			

	    <div class="pagination" style="padding-left: 30%;font-size: 16px" >
	        
	        <span class="step-links">
	            

	                {!! $deals->links(); !!}
	        
	        </span>
	    </div>	
			</div>
	 </div>
</div>

@endsection