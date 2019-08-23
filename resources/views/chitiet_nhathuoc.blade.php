<?php $nhathuoc = $cs->drugstore_name;?>
@extends('main',['title'=> ''.$nhathuoc.''])
	@section('content')

<div id="main">



<div itemscope="" itemtype="http://schema.org/LocalBusiness">

	<div id="page-title">
		<div class="background">

		</div>
		<div class="mask">
			<div class="position">
				<ul class="breadcrumbs">
					<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
						<a href="/" itemprop="url"><span itemprop="title">Trang chủ</span></a>
					</li>
					<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
						<a href="/danh-sach/" itemprop="url"><span itemprop="title">Cơ sở y tế</span></a>
					</li>
				</ul>
				<h1>
						<span itemprop="name">{{$cs['drugstore_name']}}</span>
				</h1>
			</div>
		</div>
	</div>

	<div id="detail" class="has-actions">

		<div id="sticky-wrapper" class="sticky-wrapper" style="height: 44px;"><nav class="sticky-nav smooth-scroll-link">
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
		</nav></div>

		<div class="position">

		<aside>
				<div class="media">
					<div id="hero-image" class="primary carousel owl-carousel " data-sync="hero-carousel" data-images="">
		<div class="item">
								<a style="background-image: url({{url('public/images/health_facilities/'.$cs->profile_image)}})"></a>
							</div>
						<!--
							<div class="item no-image">
								<a style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/2015-12-31_045549.2265400000.jpeg);" class="image full-sized-image-trigger" ></a>
							</div>
							-->
					</div>

					<!--
						<div id="hero-carousel" class="carousel secondary owl-carousel" data-sync="#hero-image">

								<div class="item">
									<a  style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/2015-12-10_023936.6224150000.jpeg);"></a>
								</div>

								<div class="item">
									<a  style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/2015-12-31_045548.0586350000.jpeg);"></a>
								</div>

								<div class="item">
									<a  style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/2015-12-31_045549.1334010000.jpeg);"></a>
								</div>

						</div>
					 -->


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

<?php
//
//  $vitri = "";
//	if($cs->drugstore_address != ""){
//		 $vt = explode(",", $cs->drugstore_address);
//		 if(isset($vt[3])){
//
//			$vitri = $vt[3];
//
//		}else{
//			$vitri = $cs->drugstore_address;
//		}
//	}else{
//		$vitri = "Hồ Chí Minh";
//	}
//
//
//    function get_infor_from_address($address = null) {
//
//      // $prepAddr = str_replace(' ', '+', stripUnicode($address));
//    	$prepAddr = str_replace(' ', '+', $address);
//
//      $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
//
//      $output = json_decode($geocode);
//
//
//
//
//      return $output;
//    }
//
//    // Loại bỏ dấu tiếng Việt để cho kết quả chính xác hơn
//    function stripUnicode($str){
//      if (!$str) return false;
//      $unicode = array(
//        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
//        'd'=>'đ|Đ',
//        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
//        'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
//        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
//        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
//        'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ'
//      );
//      foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
//      return $str;
//    }
//
//
//      $address = get_infor_from_address($vitri);
//
//
//      if($address->status == "ZERO_RESULTS"){
//          $vt = $cs->drugstore_address;
//          $place = explode(",",$vt);
//          $vitri = "Hà Nội";
//          $address = get_infor_from_address($vitri);
//      }
//      // Thắng mod 20181106 1000 start
//      // Fix bug lấy không có vị trí mà đi lấy item thứ 0 trong list empty
//	  // Mặc định lấy vị trí công ty nếu không lấy được
//      $haveLat = isset($address->results[0]) ? $address->results[0] : false;
//      $haveLong = isset($address->results[0]) ? $address->results[0] : false;
//      $lat = 10.758363;
//      $long = 106.662145;
//      if ($haveLat && $haveLong){
//          $lat = $address->results[0]->geometry->location->lat;
//          $long = $address->results[0]->geometry->location->lng;
//      }
//      // Thắng mod 20181106 1000 end
//?>

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

<body onload='initialize()'>

<div id='map_canvas' style='width:100%; height:100%;'></div>
</body>

<script type="text/html" id="group-filter-list-template">
	<div class="standard-carousel owl-carousel" data-settings="{nav: true, dots: true, margin: 10, responsive: {0: {items: 1, slideBy: 1}, 520: {items: 2, slideBy: 2}, 700: {items: 1, slideBy: 1}, 920: {items: 2, slideBy: 2}, 1100: {items: 3, slideBy: 3}}, stagePadding: 40}">
		<% for (var i = 0; i < obj.data.length; i++) { %>
			<% if (i%2 == 0 || obj.data.length < 6) { %>
				<div class="item">
			<% } %>
			<a class="group-filter-item" href="<%= obj.data[i].absolute_url %>" title="Xem thông tin chi tiết">
				<div class="image" <% if (obj.data[i].main_thumbnail_image) { %> style="background-image: url(<%= obj.data[i].main_thumbnail_image %>);" <% } %> ></div>
				<div class="item-info">
					<h4>
						<%= obj.data[i].occupation %> <%= obj.data[i].titles %> <%= obj.data[i].name %>
					</h4>
					<% if (obj.data[i].degrees_nested ) { %>
						<p>
							<% if (obj.data[i].title_nested ) { %>
								<%= obj.data[i].title_nested.name %><% if (obj.data[i].degrees_nested) { %>,<% } %>
							<% } %>
							<% for (var j = 0; j < obj.data[i].degrees_nested.length; j++) { %>
								<% if (j < 3) { %>
									<%= obj.data[i].degrees_nested[j].name %> <% if (j != obj.data[i].degrees_nested.length - 1 ) { %>, <% } %>
								<% } else { %>
									...
								<% } %>
							<% } %>
						</p>
					<% } %>
					<% if (obj.data[i].place_child) { %>
						<div><i class="fa fa-hospital-o" aria-hidden="true"></i> <%= obj.data[i].place_child.name %></div>
					<% } %>
					<% if (obj.data[i].like_count > 0 || obj.data[i].comment_count > 0 ) { %>
						<div class="comments-summary" title="<%= obj.data[i].like_count %> hài lòng, <%= obj.data[i].comment_count %> nhận xét">
							<span class="like-count">
								<i class="fa fa-thumbs-o-up"></i> <%= obj.data[i].like_count %>
							</span>
							<span class="comment-count">
								<i class="fa fa-comment-o"></i> <%= obj.data[i].comment_count %>
							</span>
						</div>
					<% } %>
				</div>
			</a>
			<% if (i%2 != 0 || obj.data.length < 6) { %>
				</div>
			<% } %>
		<% } %>
	</div>

		</div>
		

   
		
			
		

	</div>
</div>

<script type="text/html" id="comment-template">
	<li class="comment" id="comment-<%= id %>" class="<% if (parent) {print ('child') } %>">
		<div class="comment-avatar" <% if (customer_main_thumbnail_image) { %> style="background-image: url(<%= customer_main_thumbnail_image %> );" <% } %> ></div>
		<div class="comment-body">
			<h4>
				<% if (display_name) {
						print(display_name);
					} else {
						print(email);
					}
				%>

				<% if (overall_rating) { %>
					<span class="star-ratings" data-score="<%= (overall_rating / 5) * 100 %>"></span>
				<% } %>

				<% if (typeof liking !== 'undefined') { %>
					<span class="liking">
						<% if (liking === true) { %>
							<span class="yes"><i class="fa fa-thumbs-o-up"></i> Hài lòng</span>
						<% } else if (liking === false) { %>
							<span class="no"><i class="fa fa-thumbs-o-down"></i> Không hài lòng</span>
						<% } %>
					</span>
				<% } %>
			</h4>

			<div class="comment-content">
				<%= comment_html %>
			</div>

			<% if (parent == null) { %>
				<ul class="ratings-list">
					<% if (ratings.attitude) { %>
						<li>
							<span class="label">Thái độ phục vụ:</span>
							<span class="star-ratings" data-score="<%= ratings.attitude / 5 * 100 %>"></span>
						</li>
					<% } %>
					<% if (ratings.waiting_time) { %>
						<li>
							<span class="label">Thời gian chờ đợi</span>
							<span class="star-ratings" data-score="<%= ratings.waiting_time / 5 * 100 %>"></span>
						</li>
					<% } %>
					<% if (ratings.cleanliness) { %>
						<li>
							<span class="label">Vệ sinh, sạch sẽ</span>
							<span class="star-ratings" data-score="<%= ratings.cleanliness / 5 * 100 %>"></span>
						</li>
					<% } %>
					<% if (ratings.recommending) { %>
						<li>
							Sẽ giới thiệu cho người thân?
							<% if (ratings.recommending == '5') { %>
								<span class="yes" title="Có">
									<i class="fa fa-check" aria-hidden="true"></i> Có
								</span>
							<% } %>
							<% if (ratings.recommending == '1') { %>
								<span class="no" title="Không">
									<i class="fa fa-times" aria-hidden="true"></i> Không
								</span>
							<% } %>
						</li>
					<% } %>
				</ul>
			<% } %>

			<p class="date"><%= created_at %></p>
		</div>
	</li>
</script>


<div id="subscribe">
	<h2>Để tiếp tục, vui lòng nhập địa chỉ email của bạn</h2>
	
	<form method="POST" action="#">
		<input type="email" name="email" required="">
		<button type="submit">OK</button>
	</form>

	<p>
		BacSyViet cam kết bảo mật tuyệt đối địa chỉ email và thông tin cá nhân của bạn.
	</p>
</div>
<div class="global-thread-create-cta">
	<a href="/hoi-bac-si/dat-cau-hoi/" class="button">
		<i class="fa fa-question-circle" aria-hidden="true"></i>
		<strong>Hỏi bác sĩ</strong>
		<span>miễn phí</span>
	</a>
</div>

<script type="text/html" id="comment-edit-template">
	<form name="<%= name %>" class="form-edit-comment" data-id="<%= id %>" data-place-id="<%= place %>" data-professional-id="<%= professional %>">
		<div class="form-row">
			<textarea class="form-control resize-textarea" rows="3" name="comment"><%= comment %></textarea>
		</div>
		<div class="button-row">
			<span class="cancel-edit" data-comment-id="<%= id %>"><i class="fa fa-times"></i> Huỷ sửa</span>
			<button type="submit">Sửa</button>
		</div>
	</form>
</script>


<script type="text/html" id="comment-reply-template">
	<form name="<%= name %>" class="form-reply-comment" data-id="<%= id %>" data-place-id="<%= place %>" data-professional-id="<%= professional %>" data-email="<%= email %>">
		<div class="form-row">
			<textarea class="form-control resize-textarea" rows="3" name="comment"></textarea>
		</div>
		<div class="button-row">
			<button type="submit">Gửi trả lời</button>
		</div>
	</form>
</script>

			
			<input type="hidden" name="csrfmiddlewaretoken" value="zkXvJoLMUHUwnZTyvLqe4nirmNgGKR7a">
		</div>

<style type="text/css">
@import url(//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);
fieldset, label { margin: 0; padding: 0; }
body{ margin: 20px; }
h1 { font-size: 1.5em; margin: 10px; }

/****** Style Star Rating Widget *****/

.rating { 
  border: none;
  float: left;
}

.rating > input { display: none; } 
.rating > label:before { 
  margin: 5px;
  font-size: 1.25em;
  font-family: FontAwesome;
  display: inline-block;
  content: "\f005";
}

.rating > .half:before { 
  content: "\f089";
  position: absolute;
}

.rating > label { 
  color: #ddd; 
  float: right; 
}

/***** CSS Magic to Highlight Stars on Hover *****/

.rating > input:checked ~ label, /* show gold star when clicked */
.rating:not(:checked) > label:hover, /* hover current star */
.rating:not(:checked) > label:hover ~ label { color: #ff749c;  } /* hover previous stars in list */

.rating > input:checked + label:hover, /* hover current star when changing rating */
.rating > input:checked ~ label:hover,
.rating > label:hover ~ input:checked ~ label, /* lighten current selection */
.rating > input:checked ~ label:hover ~ label { color: #FFED85;  } 
</style>
<div id="map" class="bando rendered" style="position: relative; overflow: hidden;"></div>

	@endsection