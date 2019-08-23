<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-3589565635207321",
    enable_page_level_ads: true
  });
</script>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" ccomponentontent="Bac si Viet">
    <meta name="keywords" content="Medical, medihere, Doctor, HTML5, Bootstrap, Popular, custom, clinic, health-care, template, theme" />
    <meta name="author" content="Mostafiz">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <meta property="og:image" itemprop="thumbnailUrl" content="{{$thumbnail or null}}" />
					
    <link rel="apple-touch-icon" sizes="57x57" href="/public/images/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/public/images/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/public/images/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/public/images/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/public/images/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/public/images/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/public/images/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/public/images/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/public/images/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/public/images/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/public/images/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/public/images/favicon-16x16.png">
	<link rel="manifest" href="/public/images/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/public/images/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
    <title>{{$title or "Chọn bệnh viện, bác sĩ, phòng khám và tra cứu thuốc, bệnh để chăm sóc sức khỏe tốt nhât | medixlink.com"}} </title>
    <!-- Stylesheets -->
    <!-- preloader css -->
    <!--<link rel="stylesheet" href="/public/css/introLoader.min.css" media="none" onload="if(media!='all')media='all'">-->
    <!-- animate css -->
    <!-- bootstrap css -->
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
 
    <link rel="stylesheet" href="/public/css/animate.css" type="text/css" />
    <!-- owl carousel styles -->
    <link rel="stylesheet" href="/public/css/owl.carousel.css" type="text/css" />
    <!-- date picker css -->
     <!-- main style -->
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="/public/css/font-awesome.min.css">
    <!-- google fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,700,800,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,700,300,500' rel='stylesheet' type='text/css'>
    <!-- modernizr -->
	<script async src="/public/js/modernizr.js "></script>

	{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>--}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">--}}

    <link rel="stylesheet" href="/public/css/circle.css"/>
    <script async src="/public/js/circle.js "></script>

    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Document Wrapper
    ============================================= -->
    <main id="homepage">
       
        <!-- // Preloader markup -->
        <div id="element" class="introLoading"></div>
		
        <!-- Header
        ============================================= -->

        <div class="cssrelate component">

        {{--<img src="/public/images/logo.png" style="height: inherit"/>--}}
        <!-- Start Nav Structure -->
            <button class="cssrelate cn-button" id="cn-button">Menu</button>
            <div class="cn-animate" style="position: absolute;top: 50%;left: 50%;">
                <div class="cssrelate cn-wrapper" id="cn-wrapper">
                <ul class="cssrelate">
                    <li class="cssrelate one-line">
                        <a href="/danh-sach-nha-thuoc" class="cssrelate">
                            <span class="cssrelate text-style">Nhà thuốc</span>
                            <i class="cssrelate fa fa-home"></i>
                        </a>
                    </li>
                    <li class="cssrelate one-line">
                        <a class="cssrelate @yield('hoi-bac-si')" href="/hoi-bac-si" title="Hỏi bác sĩ">
                            <span class="cssrelate text-style">Hỏi bác sĩ</span>
                            <i class="cssrelate fa fa-question-circle" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="cssrelate one-line">
                        <a href="/bai-viet" class="cssrelate @yield('bai-viet')" title="Bài viết">
                            <span class="cssrelate text-style">Bài viết</span>
                            <i class="cssrelate fa fa-newspaper-o" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="cssrelate one-line">
                        <a href="/benh" class="cssrelate @yield('benh')" title="Bệnh">
                            <span class="cssrelate text-style">Bệnh</span>
                            <i class="cssrelate fa fa-bed" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="cssrelate one-line">
                        <a href="/thuoc" class="cssrelate @yield('thuoc')" title="Thuốc">
                            <span class="cssrelate text-style">Thuốc</span>
                            <i class="cssrelate fa fa-toggle-on"></i>
                        </a>
                    </li>
                    <li class="cssrelate one-line">
                        <a href="/danh-sach/bac-si" class="cssrelate @yield('bac-si')" title="Bác sĩ">
                            <span class="cssrelate text-style">Bác sĩ</span>
                            <i class="cssrelate fa fa-fw fa-user-md"></i>
                        </a>
                    </li>
                    <li class="cssrelate one-line">
                        <a href="/danh-sach" class="cssrelate @yield('co-so-y-te')" title="Cơ sở y tế">
                            <span class="cssrelate text-style">Phòng Khám</span>
                            <i class="cssrelate fa fa-fw fa-hospital-o"></i>
                        </a>
                    </li>
                    @if(Session::get('user')!=null)
                    <li class="cssrelate one-line">
                            <a href="/dang-xuat" class="cssrelate">
                                <span class="cssrelate text-style">Đăng Xuất</span>
                                <i class="cssrelate fa fa-fw fa-sign-out" aria-hidden="true"></i>
                            </a>
                    </li>
                    @else
                    <li class="cssrelate one-line">
                        <a class="cssrelate login-overlay-trigger" href="/dang-nhap/">
                            <span class="cssrelate text-style">Đăng nhập</span>
                            <i class="cssrelate fa fa-fw fa-sign-in" aria-hidden="true" rel="nofollow"></i>
                        </a>
                    </li>
                    @endif
                    <li class="cssrelate two-line">
                        <a href="/dangky" class="cssrelate @yield('khuyen-mai')" title="Chat với bác sĩ">
                            <span class="cssrelate text-style">Chat với<br>bác sĩ</span>
                            <i class="cssrelate fa fa-gift" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="cssrelate one-line">
                        <a href="/hoi-bac-si/dat-cau-hoi" title="Chat với bác sĩ" class="cssrelate">
                            <span class="cssrelate text-style">Đặt câu hỏi</span>
                            <i class="cssrelate fa fa-question-circle" aria-hidden="true"></i>
                        </a>
                    </li>
                    @if(Session::get('user')!=null)
                    <li class="cssrelate one-line">
                        <a class="cssrelate" href="/tai-khoan">
                            <span class="cssrelate text-style">Tài khoản</span>
                            <i class="cssrelate fa fa-fw fa-key" aria-hidden="true"></i>
                        </a>
                    </li>
                    @else
                    <li class="cssrelate one-line">
                        <a class="cssrelate signup-overlay-trigger" href="/dang-ky">
                            <span class="cssrelate text-style">Đăng ký</span>
                            <i class="cssrelate fa fa-fw fa-user-plus" aria-hidden="true" rel="nofollow"></i>
                        </a>
                    </li>
                    @endif
                    <li class="cssrelate one-line">
                        <a href="/khuyen-mai" class="cssrelate @yield('khuyen-mai')" title="Khuyến mãi">
                            <span class="cssrelate text-style">Khuyến mãi</span>
                            <i class="cssrelate fa fa-gift" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
            </div>
            <!-- End of Nav Structure -->
            <script>
                function eventFire(el, etype) {
                    if (el.fireEvent) {
                        el.fireEvent('on' + etype);
                    } else {
                        var evObj = document.createEvent('Events');
                        evObj.initEvent(etype, true, false);
                        el.dispatchEvent(evObj);
                    }
                }

                document.addEventListener("DOMContentLoaded", function (event) {
                    eventFire(document.getElementById('cn-button'), 'click');
                });
            </script>
        </div>

        <style>
            @-webkit-keyframes rotating /* Safari and Chrome */ {
                from {
                    -webkit-transform: rotate(0deg);
                    -o-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                to {
                    -webkit-transform: rotate(360deg);
                    -o-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }
            @keyframes rotating {
                from {
                    -ms-transform: rotate(0deg);
                    -moz-transform: rotate(0deg);
                    -webkit-transform: rotate(0deg);
                    -o-transform: rotate(0deg);
                    transform: rotate(0deg);
                }
                to {
                    -ms-transform: rotate(360deg);
                    -moz-transform: rotate(360deg);
                    -webkit-transform: rotate(360deg);
                    -o-transform: rotate(360deg);
                    transform: rotate(360deg);
                }
            }
            .cn-animate {
                -webkit-animation: rotating 45s linear infinite;
                -moz-animation: rotating 45s linear infinite;
                -ms-animation: rotating 45s linear infinite;
                -o-animation: rotating 45s linear infinite;
                animation: rotating 45s linear infinite;
            }
        </style>
        <header id="header" class="navbar-fixed-top">
            <div id="header-wrap">
                <div class="position">
                    <nav class="navbar navbar-default">
                        <div class="">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                {{--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">--}}
                                    {{--<span class="sr-only">Toggle navigation</span>--}}
                                    {{--<span class="icon-bar"></span>--}}
                                    {{--<span class="icon-bar"></span>--}}
                                    {{--<span class="icon-bar"></span>--}}
                                {{--</button>--}}
                                <!-- Logo ============================================= -->
                                <div id="logo">
                                    <a href="/" class="medihere-logo"><img style="max-width: 155px" src="/public/images/logo.png" alt="medihere Logo" title="medihere"></a>
                                </div>
                                <!-- #logo end -->
                            </div>

                            {{--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">--}}
                                {{--<!-- unordered list starts here -->--}}
                                {{--<ul class="nav navbar-nav navbar-left">--}}
                                    {{--<li>--}}
                                        {{--<a class="@yield('hoi-bac-si')" href="/hoi-bac-si" title="Hỏi bác sĩ">--}}
                                            {{--<i class="fa fa-question-circle" aria-hidden="true"></i>--}}
                                            {{--Hỏi Bác Sĩ--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="/bai-viet" class="@yield('bai-viet')" title="Bài viết">--}}
                                            {{--<i class="fa fa-newspaper-o" aria-hidden="true"></i>--}}
                                            {{--Bài Viết--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="/benh" class="@yield('benh')" title="Bệnh">--}}
                                            {{--<i class="fa fa-bed" aria-hidden="true"></i>--}}
                                            {{--Bệnh--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="/thuoc" class="@yield('thuoc')" title="Thuốc">--}}
                                            {{--<i class="fa fa-toggle-on"></i>--}}
                                            {{--Thuốc--}}
                                        {{--</a>--}}
                                    {{--</li>--}}

                                    {{--<li>--}}
                                        {{--<a href="/danh-sach/bac-si" class="@yield('bac-si')" title="Bác sĩ">--}}
                                            {{--<i class="fa fa-fw fa-user-md"></i>--}}
                                            {{--Bác Sĩ--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="/danh-sach" class="@yield('co-so-y-te')" title="Cơ sở y tế">--}}
                                            {{--<i class="fa fa-fw fa-hospital-o"></i>--}}
                                            {{--Phòng Khám--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                    {{--<li>--}}
                                        {{--<a href="/khuyen-mai" class="@yield('khuyen-mai')" title="Khuyến mãi">--}}
                                            {{--<i class="fa fa-gift" aria-hidden="true"></i>--}}
                                            {{--Khuyến Mãi--}}
                                        {{--</a>--}}
                                    {{--</li>--}}

                                     {{--<li>--}}
                                        {{--<a href="/messages" class="@yield('khuyen-mai')" title="Chat với bác sĩ--}}
                                            {{--<i class="fa fa-gift" aria-hidden="true"></i>--}}
                                            {{--Chat Bác Sĩ--}}
                                        {{--</a>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                          {{--@if(Session::get('user')!=null)--}}
                                {{--<div class="user">--}}
                                {{--@if(\App\Users::where('user_id', Session::get('user')->user_id)->first()->patient)--}}
                                {{--<span class="name"><a href="{{route('naptien')}}" title="Ví"><i class="fa fa-fw fa-money" aria-hidden="true"></i>--}}
                                        {{--{{\App\Users::where('user_id', Session::get('user')->user_id)->first()->patient->balance}}--}}
                                    {{--</a></span>--}}
                                {{--@endif--}}
								{{--<span class="name"><a href="/tai-khoan"><i class="fa fa-fw fa-user" aria-hidden="true"></i> @if(Session::get('user')!=null) {{Session::get('user')->fullname}} @else None @endif</a></span>--}}


							{{--<div class="user-dropdown">--}}
							{{--@if(Session::get('user')->user_type_id==2)--}}
								{{--<a class="" href="/tai-khoan/cau-hoi-moi-nhat/"><i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> Câu Hỏi Mới Nhất</a>--}}

							{{--@endif--}}

								{{--<a class="" href="/tai-khoan/hoi-dap/"><i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> Hỏi Đáp Của Tôi</a>--}}

								{{--<a class="" href="/tai-khoan/nhan-xet/"><i class="fa fa-fw fa-commenting" aria-hidden="true"></i> Nhận Xét Đã Gửi</a>--}}

								{{--<a href="/messages" class=""><i class="fa fa-fw fa-bookmark-o" aria-hidden="true"></i> Chat Với Bác Sĩ (<span class="favourite-count">0</span>)</a>--}}







								{{--<a class="" href="/tai-khoan/"><i class="fa fa-fw fa-info-circle" aria-hidden="true"></i> Thông Tin Tài Khoản</a>--}}

								{{--<a class="" href="/tai-khoan/doi-mat-khau/"><i class="fa fa-fw fa-key" aria-hidden="true"></i> Đổi Mật Khẩu</a>--}}

								{{--<a href="/dang-xuat" ><i class="fa fa-fw fa-sign-out" aria-hidden="true"></i> Đăng Xuất</a>--}}
							{{--</div>--}}
							{{--</div>--}}
						{{--@else--}}
						{{--<div class="user main-nav">--}}
							{{--<a class=" signup-overlay-trigger" href="/dang-ky"><i class="fa fa-fw fa-user-plus" aria-hidden="true" rel="nofollow"></i> Đăng Ký</a>--}}
							{{--<a class=" login-overlay-trigger" href="/dang-nhap/"><i class="fa fa-fw fa-sign-in" aria-hidden="true" rel="nofollow"></i><span class="unimportant">Đăng Nhập</span></a>--}}
						{{--</div>--}}
						{{--@endif--}}


						{{--@if(!Request::is('/'))--}}
						<form id="form-search-all" class="search" method="get" action="/tim-kiem" name="global-search">
						<span class="location">
							<select id="location-switch">
								<option value="">Cả nước</option>
									<option value="Hà Nội">Hà Nội</option>
									<option value="Hồ Chí Minh">Hồ Chí Minh</option>
									<option value="An Giang">An Giang</option><option value="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu</option><option value="Bắc Cạn">Bắc Cạn</option><option value="Bắc Giang">Bắc Giang</option><option value="Bạc Liêu">Bạc Liêu</option><option value="Bắc Ninh">Bắc Ninh</option><option value="Bến Tre">Bến Tre</option><option value="Bình Dương">Bình Dương</option><option value="Bình Định">Bình Định</option><option value="Bình Phước">Bình Phước</option><option value="Bình Thuận">Bình Thuận</option><option value="Cao Bằng">Cao Bằng</option><option value="Cà Mau">Cà Mau</option><option value="Cần Thơ">Cần Thơ</option><option value="Đà Nẵng">Đà Nẵng</option><option value="Đắk Nông">Đắk Nông</option><option value="Đắk Lắk">Đắk Lắk</option><option value="Đồng Nai">Đồng Nai</option><option value="Điện Biên">Điện Biên</option><option value="Đồng Tháp">Đồng Tháp</option><option value="Gia Lai">Gia Lai</option><option value="Hà Giang">Hà Giang</option><option value="Hà Nam">Hà Nam</option><option value="Hà Tĩnh">Hà Tĩnh</option><option value="Hải Dương">Hải Dương</option><option value="Hải Phòng">Hải Phòng</option><option value="Hậu Giang">Hậu Giang</option><option value="Hòa Bình">Hòa Bình</option><option value="Hưng Yên">Hưng Yên</option><option value="Khánh Hòa">Khánh Hòa</option><option value="Kiên Giang">Kiên Giang</option><option value="Kon Tum">Kon Tum</option><option value="Lai Châu">Lai Châu</option><option value="Lạng Sơn">Lạng Sơn</option><option value="Lào Cai">Lào Cai</option><option value="Lâm Đồng">Lâm Đồng</option><option value="Long An">Long An</option><option value="Nam Định">Nam Định</option><option value="Nghệ An">Nghệ An</option><option value="Ninh Bình">Ninh Bình</option><option value="Ninh Thuận">Ninh Thuận</option><option value="Phú Thọ">Phú Thọ</option><option value="Phú Yên">Phú Yên</option><option value="Quảng Bình">Quảng Bình</option><option value="Quảng Nam">Quảng Nam</option><option value="Quảng Ngãi">Quảng Ngãi</option><option value="Quảng Ninh">Quảng Ninh</option><option value="Quảng Trị">Quảng Trị</option><option value="Sơn La">Sơn La</option><option value="Sóc Trăng">Sóc Trăng</option><option value="Tây Ninh">Tây Ninh</option><option value="Thái Bình">Thái Bình</option><option value="Thái Nguyên">Thái Nguyên</option><option value="Thanh Hóa">Thanh Hóa</option><option value="Thừa Thiên - Huế">Thừa Thiên - Huế</option><option value="Tiền Giang">Tiền Giang</option><option value="Trà Vinh">Trà Vinh</option><option value="Tuyên Quang">Tuyên Quang</option><option value="Vĩnh Phúc">Vĩnh Phúc</option><option value="Vĩnh Long">Vĩnh Long</option><option value="Yên Bái">Yên Bái</option>
							</select>
						</span>

						<div class="inner">
							<div class="has-suggestion"><input name="q" id="search-input" value="" placeholder="Triệu chứng, bác sĩ, cơ sở y tế..." autocomplete="off" type="text"><div class="suggestion"></div></div>
							<button type="submit">
                                <i class="fa fa-search icon-search-not-loading"></i>
                                <i class="icon-search-loading"></i>
                            </button>
						</div>
					</form>
					{{--@endif--}}
                            {{--</div>--}}
                            <!-- /.navbar-collapse -->
                        </div>
                        <!-- /.container-fluid -->
                    </nav>
                </div>
            </div>
        </header>
        <!-- #header end -->
