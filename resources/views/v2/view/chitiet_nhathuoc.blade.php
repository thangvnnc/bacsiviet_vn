<?php $csyt = $cs->clinic_name;?>
@extends('v2/structor/main',['title'=> 'Chi tiết nhà thuốc'])
@section('content')
<div class="main-A">
	<div id="top">
            <div class="background"></div>
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="#">Chi tiết nhà thuốc</a></li>
                    </ul> 
                    
                </div>
                <h1>
                  <span itemprop="name">{{$cs['drugstore_name']}}</span>
                </h1>
            </div> 
    </div><!-- #top -->
    <div class="cnt-dtnthuoc">
    	<div class="position">
				<div class="inner">
					<ul>

							<li class="unimportant">
								<a href="#gioi-thieu" title="" data-scroll-to="0" class="active">Giới thiệu</a></li>

							@if(isset($cs->doctors) && count($cs->doctors)!=0)
							<li class="unimportant">
								<a href="#bac-si" title="" class="">Bác sĩ ({{count($cs->doctors)}})</a></li>
							@endif


					</ul>
				</div>
		</div>
		<aside class="as-left-dtnt">
			<div class="media">
				<div id="hero-image" class="primary carousel owl-carousel " data-sync="hero-carousel" data-images="">
					<div class="item">
						<a style="background-image: url({{url('public/images/health_facilities/'.$cs->profile_image)}})"></a>
					</div>
						
				</div>
			</div>

		</aside>
		<div class="content">
	        <section id="gioi-thieu" class="has-subsections">

	                <div class="subsection">
	                    <h2>
	                        <i class="fa fa-list-ul"></i> Nhà thuốc {{$cs['drugstore_name']}}
	                    </h2>
	                    <h2>
	                        <i class="fa fa-map-marker"></i> Vị trí ở {{$cs['drugstore_address']}}
	                    </h2>
						<h2>
							<i class="fa fa-info-circle"></i> Mô tả: {!!$cs['drugstore_desc']!!}
						</h2>
						<h2>
							<i class="fa fa-info-circle"></i> Số điện thoại: 0{!!$cs['drugstore_phone']!!}
						</h2>
	                </div>


	        </section>


	    </div>
	    <script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCpMDmCks06-cuBQIWBXGhkwAPUCYpp5J8'>
		</script>
	</div>
	<body onload='initialize()'>

<div id='map_canvas' style='width:100%; height:100%;'></div>
</body>
</div>
<script type='text/javascript'>

                var latitude = {{$vitri->lat}};
                var longitude ={{$vitri->lng}};
                var name = "{{$cs['drugstore_address']}}";

                function initialize() {
                    var myLatLng = new google.maps.LatLng(latitude, longitude);

                    var mapProp = {
                        zoom: 10,
                        center: myLatLng,
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    var map = new google.maps.Map(document.getElementById('map_canvas'), mapProp);
                    map.setZoom(14);
                    new google.maps.Marker({
                        position: myLatLng,
                        map: map,
                        optimized: false,
                        title: name
                    });
                }


</script>
@endsection