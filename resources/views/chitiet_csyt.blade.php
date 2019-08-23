<?php $csyt = $cs->clinic_name;?>
@extends('main',['title'=> ''.$csyt.''])
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
						<span itemprop="name">{{$cs['clinic_name']}}</span>
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


							<!--<li class="unimportant">
								<a href="#co-so" title="">Cơ sở trực thuộc</a></li>
						
							-->
							<!--
							<li>
								<a href="#thong-tin-bao-hiem" title="" class="">Thông tin bảo hiểm</a>
							</li>
							-->

						<li>
							<a href="#nhan-xet" title="">
								<i class="fa fa-comment-o"></i> Nhận xét
															</a>
						</li>


							<li>
								<a href="#map" title="">Bản đồ</a>
							</li>


							<li>
								<a href="#activity" title="Hoạt động trên ViCare">
									Hoạt động
								</a>
							</li>

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


						<ul class="ratings-list ratings-summary sticky-nav-link" href="#nhan-xet">

								<li itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" class="important">
									<span class="star-ratings" data-score="{{($sum/$danhgia)*20}}"></span>
									<span class="desc">
										<strong><span itemprop="ratingValue">{{round(($sum/$danhgia),1)}}</span></strong>
										(<span itemprop="reviewCount"></span>{{$danhgia}} đánh giá )
									</span>
								</li>




							<!--
								<li>
									<span class="">Được giới thiệu:</span>
									<span class="hp-bar">
										<span style="width:91%"></span>
									</span>
									<span class="desc">
										<strong>81%</strong>
									</span>
								</li>
							-->
						</ul>


					<div class="call-to-action">

						<a href="https://medixlink.com/dang-ky" class="button secondary">
							Đặt khám ngay
						</a>
							{{--<a href="https://medixlink.com/dang-ky" class="sticky-nav-link action-book button" title="Đặt khám tại Khoa Khám chữa bệnh theo yêu cầu - Bệnh viện Đại học Y Hà Nội" data-place-id="29068">--}}
								{{--<i class="fa fa-calendar-check-o" aria-hidden="true"></i>--}}
								{{--Đặt khám ngay--}}
							{{--</a>--}}
					</div>

					<div class="actions" id="contact-29068">
						<div class="inner contact-details">

								<h3>Bạn có thể liên hệ với Khoa Khám chữa bệnh theo yêu cầu - Bệnh viện Đại học Y Hà Nội theo số điện thoại: <a href="tel:{{$hl->content}}" class="phone">{{$hl->content}}</a></h3>

						</div>
					</div>
				</div>

				<div class="summary">
					<dl itemprop="address" itemscope itemtype="http://schema.org/PostalAddress" class="contact-info">

							<dt><i class="fa fa-map-marker"></i></dt>
							<dd>
								<span itemprop="streetAddress">{{$cs['clinic_address']}}</span>
								<span class="distance-to-user has-distance">
								
								</span>
							</dd>

							<dt><i class="fa fa-phone"></i></dt>
							<dd>
								<span itemprop="streetAddress">{{$hl->content}}</span>
								<span class="distance-to-user has-distance">
								
								</span>
							</dd>

							<dt><i class="fa fa-clock-o"></i></dt>
							<dd>
								<ul class="opening-hours">

								{{$cs['clinic_time']}}


								</ul>
							</dd>



							<dt><i class="fa fa-map-o"></i></dt>
							<dd>
								<a href="#map" class="sticky-nav-link">Bản đồ</a>
							</dd>



							<dt><i class="fa fa-globe"></i></dt>
							<dd>
								Nói được

									<a>Tiếng Việt</a>

							</dd>


							<!--
							<dt><i class="fa fa-level-up"></i></dt>
							<dd>Trực thuộc <a href="/benh-vien-dai-hoc-y-ha-noi-17287/hoi-suc-cap-cuu">Bệnh viện Đại học Y Hà Nội</a></dd>
							-->

					</dl>

				</div>
			</aside>
<div class="content">


        <section id="gioi-thieu" class="has-subsections">


                <div class="subsection">
                    <div class="inner cms has-readmore-content">
                        <p style="text-align:justify">
                        	{!!$cs['clinic_desc']!!}
                        </p>

                    </div>
                </div>





           			<div class="subsection">
                    <h2><i class="fa fa-stethoscope"></i> Chuyên khoa</h2>
                    <div class="inner cms has-readmore-content">
                        <ul class="original-list">
                          @if($cs->specialities !=null)
                              @foreach($cs->specialities as $sp)

                    <li> <a href="/danh-sach/?specialities="></a>
                    {{$sp->clinic->speciality_name}}</li>

                     @endforeach
                     @endif

                        </ul>
                    <div class="list-container full-list">
                    @if($cs->specialities!=null)
                    @foreach($cs->specialities as $sp)
        		  <ul>
                    <li> <a href="/danh-sach/?specialities={{$sp->clinic->speciality_url}}">{{$sp->clinic->speciality_name}}</a>
                    </li>
             	 </ul>
                     @endforeach
                     @endif
                     <ul></ul><ul></ul></div></div>
                </div>


                <div class="subsection">
                    <h2>
                        <i class="fa fa-list-ul"></i> Các dịch vụ tại  {{$cs['clinic_name']}}
                    </h2>
                    <div class="inner cms has-readmore-content">

                        <ul class="original-list">
                          @if($cs->services !=null ||$cs->services!="")
                              @foreach($cs->services as $serv)

                    <li> <a href="/danh-sach/?services="{{$serv->service->service_url}}></a>
                    {{$serv->service->service_name}}</li>

                     @endforeach
                     @endif

                        </ul>
                    <div class="list-container full-list">
                    @if($cs->services!=null)
                    @foreach($cs->services as $serv)
        		  <ul>
                    <li> <a href="/danh-sach/?services={{$serv->service->service_url}}">{{$serv->service->service_name}}</a>
                    </li>
             	 </ul>
                     @endforeach
                     @endif
                     <ul></ul><ul></ul></div></div>


        </section>







        <section>
            <h2 id="co-so-vat-chat-trang-thiet-bi"><i class="fa fa-medkit"></i> Cơ sở vật chất và trang thiết bị</h2>
            <div class="inner cms has-readmore-content">

				{!!$cs->facilities!!}



            <div class="list-container full-list"> <p style="text-align:justify"></div></div>
        </section>
    	<section>
            <h2 id="bac-si"><i class="fa fa-user-md"></i> Bác sĩ làm việc tại Phòng khám {{$cs['clinic_name']}}</h2>

			 @foreach($bacsi as $b)
			 <?php $cates = App\Doctor::find($b['doctor_id']); ?>



           <div class="owl-item active" style="width: 248.667px; margin-right: 10px;"><div class="item">

			<a class="group-filter-item" href="/danh-sach/bac-si/-{{$b['doctor_id']}}/" title="Xem thông tin chi tiết">
				<div class="image" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/20_04_2016_08_24_39_119415.jpeg);"></div>
				<div class="item-info">
					<h4>
						{{$cates['doctor_name']}}
					</h4>

						<p>



									<!--Tiến sĩ  -->


						</p>



				</div>
			</a>

				</div></div>
				@endforeach






        </section>
 <section id="activity">
        <div class="subsection">
            <h2>
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                Hoạt động gần đây của  {{$cs->clinic_name}}
                <!--
                                    <a href="/danh-sach/{{$cs->clinic_url or null}}-{{$cs->clinic_id}}/hoat-dong/">Xem tất cả <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                -->
            </h2>
            <ul class="activity-list">
            <?php \Carbon\Carbon::setLocale('vi') ?>
                @foreach($cs->activity as $at)
                <li>
                    <div class="entry-thumb" @if(!empty($cs->profile_image)) style="background-image: url(@if(strpos($cs->profile_image,'http')===false)/@endif{{$cs->profile_image}});" @endif></div>
                    <div class="entry-content">
                        <span class="entry-meta-time"> {!! \Carbon\Carbon::createFromTimeStamp(strtotime($at->created_at))->diffForHumans() !!} |  Trả lời <span>câu hỏi:</span></span>
                        <h4><a href="/hoi-bac-si/{{$at->question['question_url']}}-{{$at->question['question_id']}}/">{{$at->question['question_title']}}</a></h4>
                        <p>
                        @if($at->answer_content!=null)
                          @if(strlen($at->answer_content)>100 && strpos($at->answer_content, ' ', 100)!="")
							{!!substr( $at->answer_content, 0, strpos($at->answer_content, ' ', 100) )!!}

						  @else
						     {!!$at->answer_content!!}
						  @endif

                        @endif
                        </p>

                        <span class="thank"><i class="fa fa-heart" aria-hidden="true"></i> 0</span>
                        <a href="/hoi-bac-si/{{$at->question['question_url']}}-{{$at->question['question_id']}}/">Chi tiết <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                    </div>
                </li>
                @endforeach


            </ul>

            <div class="view-question">
                <a href="/hoi-bac-si/"><strong>Xem chuyên mục hỏi đáp</strong>Và đặt câu hỏi</a>
            </div>
        </div>
    </section>
    <section>
		<h2 id="dat-kham"><i class="fa fa-calendar"></i> Đặt lịch khám với {{$cs->clinic_name}}</h2>
		<div class="inner">
			<p>
				Chọn phòng khám và giờ bạn muốn đặt khám từ lịch dưới đây. Để được tư vấn chọn phòng khám, bạn có thể chat với chúng tôi trên trang web này hoặc gọi điện cho chúng tôi theo số <a href="tel:{{$hl->content}}">{{$hl->content}}</a>.
			</p>
		</div>
	</section>
	<section class="comments-container">
        <h2 id="nhan-xet"><i class="fa fa-comment-o"></i> Nhận xét về {{$cs->clinic_name}}</h2>
        <div class="inner">

            <div class="comment-form">
             <form method="POST" action="/comment_clinic/{{$cs->clinic_id}}" >
             	<input type="hidden" name="_token" value="{{csrf_token()}}">
                    <p>Bạn đã sử dụng dịch vụ của Khoa Khám chữa bệnh theo yêu cầu - {{$cs->clinic_name}}? Hãy chia sẻ cảm nhận của bạn với cộng đồng.</p>
                    <p>Nếu bạn có câu hỏi về sức khỏe và chuyên môn, vui lòng chuyển sang trang <a href="/hoi-bac-si/dat-cau-hoi/">Hỏi Bác sĩ</a> để được tư vấn miễn phí.</p>
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                     <input type="hidden" name="clinic_id" value="{{$cs->clinic_id}}"/>
                      <input type="hidden" name="next" value="{{Request::url()}}"/>
                        <div class="form-row">

                        </div>



                    <div class="form-row">
                    <div class="form">



    <fieldset class="rating"><h1>Đánh Giá:</h1>
    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
    <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
		</fieldset>

                       </div>
                    </div>
                    <div class="form-row">
                        <div class="form-field">
                            <label>
                                Bình luận:
                            </label>
                            <div class="form-field-input">
                                <textarea name="body" required="" placeholder="Đánh giá của bạn..."></textarea>
                            </div>
                        </div>
                    </div>
                    <!--
                	<div class="form-row confirm-comeback">
                        <div class="form-field has-long-label">
                            <label>
                                Nếu người thân của bạn cần đi khám, bạn có giới thiệu họ đến cơ sở y tế này không?
                                <span class="instruction">(không bắt buộc)</span>
                            </label>
                            <div class="form-field-input">
                                <label class="yes">
                                    <input type="radio" name="recommending" value="5">
                                    Có <i class="fa fa-check" aria-hidden="true"></i>
                                </label>
                                <label class="no">
                                    <input type="radio" name="recommending" value="1">
                                    Không <i class="fa fa-times" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                    </div>
					-->
                     <div class="button-row">
						<input name="professional" value="{{$cs->clinic_id}}" type="hidden">
						@if(Session::get('user')!=null)
						<button type="submit">Gửi</button>
						@else
						<a href="/dang-nhap?next={{Request::url()}}">Đăng nhập để nhận xét</a>
						@endif
					</div>
                </form>
                <div class="form-success">
                    <h4><i></i>@if(session('thongbao'))
    						{{session('thongbao')}}
   							 @endif</h4>

                </div>
            </div>

            <ul class="comments">
            @foreach($comment as $c)
                <li class="comment ">

                         	<?php $user = App\Users::find($c['user_id']); ?>

                        <div class="comment-avatar" style="background-image:  #6193CA"><span><?php  $ten = $user['fullname'];
                              echo substr($ten, 0, 1); ?></span></div>
                            <div class="comment-body">
                                <h4>
                                    <span>
                                        
                                           {{$user['fullname']}}  
                                        
                                    </span>
                                    @if($c->feedback_ > 0)
                                    <span class="star-ratings" data-score="{{$c->feedback_ * 2}}0">
                                    <span class="front" style="width: 100%;"></span></span>
                                    @endif
                                </h4>



                                <div class="comment-content">
                                    <p>{{$c->content}}.</p>
                                </div>





                                <p class="date">{{$c['created_at']}}</p>
                                <!--
                                <div class="comment-actions">

                                        <a class=" open-reply-comment " name="place-comment" data-comment-id="90" data-place-id="32209" data-email="xadoaxongtusat4@gmail.com" href="/dang-ky/?type=place&amp;place_name=Phòng khám Sản phụ khoa - Bác sĩ Đỗ Thị Ngọc Lan&amp;place_add=26 ngõ 30&amp;source=register_place&amp;next=/phong-kham-san-phu-khoa-bac-si-do-thi-ngoc-lan-32209/san-phu-khoa">
                                            Trả lời
                                        </a>


                                    <strong>
                                        Nhận xét này có hữu ích với bạn không?
                                        <span class="options">
                                            <a href="#" class="comment-voting useful" data-comment-id="90" data-comment-type="place" title="Có">
                                                <i class="fa fa-check fa-fw" aria-hidden="true"></i>
                                                <i class="fa fa-spinner fa-pulse fa-fw loader"></i>
                                                <span>12</span>
                                            </a>
                                            <a href="#" class="comment-voting not-useful" data-comment-id="90" data-comment-type="place" title="Không">
                                                <i class="fa fa-times fa-fw" aria-hidden="true"></i>
                                                <i class="fa fa-spinner fa-pulse fa-fw loader"></i>
                                                <span>3</span>
                                            </a>
                                        </span>
                                    </strong>
                                </div>
							     -->
                            </div>
                </li>
                @endforeach




            </ul>
        </div>
    </section>

</div>

<script type='text/javascript'
src='https://maps.googleapis.com/maps/api/js'>
</script>

<?php

  $vitri = "";
	if($cs->clinic_address != ""){
		 $vt = explode(",", $cs->clinic_address);
		 if(isset($vt[3])){

			$vitri = $vt[3];

		}else{
			$vitri = $cs->clinic_address;
		}
	}else{
		$vitri = "Hồ Chí Minh";
	}


    function get_infor_from_address($address = null) {

      // $prepAddr = str_replace(' ', '+', stripUnicode($address));
    	$prepAddr = str_replace(' ', '+', $address);

      $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');

      $output = json_decode($geocode);




      return $output;
    }

    // Loại bỏ dấu tiếng Việt để cho kết quả chính xác hơn
    function stripUnicode($str){
      if (!$str) return false;
      $unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd'=>'đ|Đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ'
      );
      foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
      return $str;
    }


      $address = get_infor_from_address($vitri);


      if($address->status == "ZERO_RESULTS"){
          $vt = $cs->clinic_address;
          $place = explode(",",$vt);
          $vitri = "Hà Nội";
          $address = get_infor_from_address($vitri);
      }
      // Thắng mod 20181106 1000 start
      // Fix bug lấy không có vị trí mà đi lấy item thứ 0 trong list empty
	  // Mặc định lấy vị trí công ty nếu không lấy được
      $haveLat = isset($address->results[0]) ? $address->results[0] : false;
      $haveLong = isset($address->results[0]) ? $address->results[0] : false;
      $lat = 10.758363;
      $long = 106.662145;
      if ($haveLat && $haveLong){
          $lat = $address->results[0]->geometry->location->lat;
          $long = $address->results[0]->geometry->location->lng;
      }
      // Thắng mod 20181106 1000 end
?>

<script type='text/javascript'>
    var latitude = "<?php echo $lat; ?>";
    var longitude ="<?php echo $long; ?>";
    var address = "<?php echo $vitri; ?>";
function initialize()
{
    var myLatLng = new google.maps.LatLng(latitude,longitude);

 var mapProp = {
  zoom:10,
  center: myLatLng,
  mapTypeId: google.maps.MapTypeId.ROADMAP
  };
var map=new google.maps.Map(document.getElementById('map_canvas'),mapProp);

var marker = new google.maps.Marker({
  position: myLatLng,
  map: map,
  optimized: false,
  title:address
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