

<!DOCTYPE html>
<html lang="en" class="no-js">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Bac si Viet">
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
    
    <!-- bootstrap css -->
    <link rel="stylesheet" href="/public/css/bootstrap.min.css">
    <!-- preloader css -->
    <link rel="stylesheet" href="/public/css/introLoader.min.css">
    <!-- animate css -->
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
    <script src="/public/js/modernizr.js"></script>
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

	<body class="page-professional-list
		 not-logged-in 
		"
		data-customer-id=
		data-customer-type=>


        <header id="header" class="navbar-fixed-top">
            <div id="header-wrap">
                <div class="position">
                    <nav class="navbar navbar-default">
                        <div class="">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <!-- Logo ============================================= -->
                                <div id="logo">
                                    <a href="/" class="medihere-logo"><img src="/public/images/logo.png" alt="medihere Logo" title="medihere"></a>
                                </div>
                                <!-- #logo end -->
                            </div>

                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <!-- unordered list starts here -->
                                <ul class="nav navbar-nav navbar-left">
                                    <li><a class="active" href="/hoi-bac-si"><i class="fa fa-fw fa-comments-o"></i>Hỏi bác sĩ</a></li>
                                    <li><a href="/bai-viet"><i class="fa fa-fw fa-heartbeat"></i>Bài viết</a></li>
                                    <li><a href="/danh-sach/?specialities=xet-nghiem"><i class="fa fa-fw fa-flask"></i>Xét nghiệm</a></li>
                                    <li><a href="/benh"><i class="fa fa-bed" aria-hidden="true"></i>Bệnh</a></li>
                                    <li><a href="/thuoc"><i class="fa fa-toggle-on"></i>Thuốc</a></li>
                                      <li><a href="/danh-sach/bac-si"><i class="fa fa-fw fa-user-md"></i>Bác sĩ</a></li>
                                        <li><a href="/danh-sach"><i class="fa fa-fw fa-hospital-o"></i>Cơ sở y tế</a></li>
                                          <li><a href="/khuyen-mai"><i class="fa fa-fw fa-gift"></i>Khuyến mãi</a></li>
                                </ul>
                          @if(Session::get('user')!=null)      
                                <div class="user">
							<a href="/tai-khoan/ghi-nho/" class="favourite-count-container" title="Danh sách đã ghi nhớ">
								<i class="fa fa-bookmark" aria-hidden="true"></i> <span class="favourite-count">0</span>
							</a>
							
								<span class="name"><a href="/tai-khoan"><i class="fa fa-fw fa-user" aria-hidden="true"></i> @if(Session::get('user')!=null) {{Session::get('user')->fullname}} @else None @endif</a></span>
							

							<div class="user-dropdown">
							@if(Session::get('user')->user_type_id==2)
								<a class="" href="/tai-khoan/cau-hoi-moi-nhat/"><i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> Câu hỏi mới nhất</a>

							@endif

								<a class="" href="/tai-khoan/hoi-dap/"><i class="fa fa-fw fa-comments-o" aria-hidden="true"></i> Hỏi đáp của tôi</a>

								<a class="" href="/tai-khoan/nhan-xet/"><i class="fa fa-fw fa-commenting" aria-hidden="true"></i> Nhận xét đã gửi</a>

								<a href="/tai-khoan/ghi-nho/" class=""><i class="fa fa-fw fa-bookmark-o" aria-hidden="true"></i> Đã ghi nhớ (<span class="favourite-count">0</span>)</a>

								

								

								

								<a class="" href="/tai-khoan/"><i class="fa fa-fw fa-info-circle" aria-hidden="true"></i> Thông tin tài khoản</a>

								<a class="" href="/tai-khoan/doi-mat-khau/"><i class="fa fa-fw fa-key" aria-hidden="true"></i> Đổi mật khẩu</a>

								<a href="/dang-xuat" class="logout"><i class="fa fa-fw fa-sign-out" aria-hidden="true"></i> Đăng xuất</a>
							</div>
							</div>
						@else
						<div class="user main-nav">
							<a class=" signup-overlay-trigger" href="/dang-ky/"><i class="fa fa-fw fa-user-plus" aria-hidden="true" rel="nofollow"></i> Đăng ký</a>
							<a class=" login-overlay-trigger" href="/dang-nhap/"><i class="fa fa-fw fa-sign-in" aria-hidden="true" rel="nofollow"></i><span class="unimportant">Đăng nhập</span></a>
						</div>
						@endif
							
						
						@if(!Request::is('/'))
						<form class="search" method="get" action="{{url('/tim-kiem')}}" name="global-search">
						<span class="location">
							<select id="location-switch">
								<option value="">Cả nước</option>
									<option value="Hà Nội">Hà Nội</option>
									<option value="Hồ Chí Minh">Hồ Chí Minh</option>
									<option value="An Giang">An Giang</option><option value="Bà Rịa - Vũng Tàu">Bà Rịa - Vũng Tàu</option><option value="Bắc Cạn">Bắc Cạn</option><option value="Bắc Giang">Bắc Giang</option><option value="Bạc Liêu">Bạc Liêu</option><option value="Bắc Ninh">Bắc Ninh</option><option value="Bến Tre">Bến Tre</option><option value="Bình Dương">Bình Dương</option><option value="Bình Định">Bình Định</option><option value="Bình Phước">Bình Phước</option><option value="Bình Thuận">Bình Thuận</option><option value="Cao Bằng">Cao Bằng</option><option value="Cà Mau">Cà Mau</option><option value="Cần Thơ">Cần Thơ</option><option value="Đà Nẵng">Đà Nẵng</option><option value="Đắk Nông">Đắk Nông</option><option value="Đắk Lắk">Đắk Lắk</option><option value="Đồng Nai">Đồng Nai</option><option value="Điện Biên">Điện Biên</option><option value="Đồng Tháp">Đồng Tháp</option><option value="Gia Lai">Gia Lai</option><option value="Hà Giang">Hà Giang</option><option value="Hà Nam">Hà Nam</option><option value="Hà Tĩnh">Hà Tĩnh</option><option value="Hải Dương">Hải Dương</option><option value="Hải Phòng">Hải Phòng</option><option value="Hậu Giang">Hậu Giang</option><option value="Hòa Bình">Hòa Bình</option><option value="Hưng Yên">Hưng Yên</option><option value="Khánh Hòa">Khánh Hòa</option><option value="Kiên Giang">Kiên Giang</option><option value="Kon Tum">Kon Tum</option><option value="Lai Châu">Lai Châu</option><option value="Lạng Sơn">Lạng Sơn</option><option value="Lào Cai">Lào Cai</option><option value="Lâm Đồng">Lâm Đồng</option><option value="Long An">Long An</option><option value="Nam Định">Nam Định</option><option value="Nghệ An">Nghệ An</option><option value="Ninh Bình">Ninh Bình</option><option value="Ninh Thuận">Ninh Thuận</option><option value="Phú Thọ">Phú Thọ</option><option value="Phú Yên">Phú Yên</option><option value="Quảng Bình">Quảng Bình</option><option value="Quảng Nam">Quảng Nam</option><option value="Quảng Ngãi">Quảng Ngãi</option><option value="Quảng Ninh">Quảng Ninh</option><option value="Quảng Trị">Quảng Trị</option><option value="Sơn La">Sơn La</option><option value="Sóc Trăng">Sóc Trăng</option><option value="Tây Ninh">Tây Ninh</option><option value="Thái Bình">Thái Bình</option><option value="Thái Nguyên">Thái Nguyên</option><option value="Thanh Hóa">Thanh Hóa</option><option value="Thừa Thiên - Huế">Thừa Thiên - Huế</option><option value="Tiền Giang">Tiền Giang</option><option value="Trà Vinh">Trà Vinh</option><option value="Tuyên Quang">Tuyên Quang</option><option value="Vĩnh Phúc">Vĩnh Phúc</option><option value="Vĩnh Long">Vĩnh Long</option><option value="Yên Bái">Yên Bái</option>
							</select>
						</span>

						<div class="inner">
							<div class="has-suggestion"><input name="q" id="search-input" value="" placeholder="triệu chứng, bác sĩ, cơ sở y tế..." autocomplete="off" type="text"><div class="suggestion" style="display: none;"></div></div>
							<button type="submit"><i class="fa fa-search icon-search-not-loading"></i><i class="icon-search-loading"></i></button>
						</div>
					</form>
					@endif
                            </div>
                            <!-- /.navbar-collapse -->
                        </div>
                        <!-- /.container-fluid -->
                    </nav>
                </div>
            </div>
        </header>
  <div id="main">
			
			
			
<div id="page-title">
	<div class="background"></div>
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
	@if(request()->input('q')!==null)
	Tìm kiếm phòng khám theo từ khóa "{{urldecode(request()->input('q'))}}"			
	@else
		Danh sách cơ sở y tế
	    @if(Session::has('province'))
	        </br>tại {{$_COOKIE['province']}}
	    @endif
    @endif

<span class="weak">
	

	
	

	

	


</span>

			</h1>
		</div>
	</div>
</div>

@if(request()->input('q')!==null)
    <div id="nav-search">
        <div class="position">
            <ul>
                <li>
                    <span>Tìm kiếm theo:</span>
                </li>
                
                <li>
                    <a href="/danh-sach/?q={{request()->input('q')}}" class="active">
                        Cơ sở y tế ({{$clinic or '0' }})
                    </a>
                </li>
                
                
                <li>
                    <a href="/danh-sach/bac-si/?q={{request()->input('q')}}">
                        Bác sĩ ({{$doctor or '0'}})
                    </a>
                </li>
                
                
                 <!-- 
                <li>
                    <a href="/dich-vu/?q={{request()->input('q')}}">
                        Dịch vụ ({{$service or '0'}} )
                    </a>
                </li>
                
                 -->
                
                
                <li>
                    <a href="/hoi-bac-si/danh-sach/?q={{request()->input('q')}}">
                        Hỏi bác sĩ ({{$question}})
                    </a>
                </li>
                
               
                
                
                <li>
                    <a href="/benh/tim-kiem/?q={{request()->input('q')}}" >
                        Bệnh ({{$count or '0'}})
                    </a>
                </li>
                
                
                <li>
                    <a href="/thuoc/danh-sach/?q={{request()->input('q')}}">
                        Thuốc ({{$thuoc or '0'}})
                    </a>
                </li>
                
               
                
            </ul>
        </div>
    </div>
  @endif


<div id="list" class="places has-aside">
	<div class="position">
		<div class="content">
			

<div id="filter-cta">
	<a class="button secondary weak activator" href="#filter-summary">
		<i class="fa fa-filter fa-fw" aria-hidden="true"></i><span class="active">Ẩn bộ lọc</span><span class="inactive">Lọc danh sách</span>
	</a>
	<!-- 
		<span class="geosearch-options">
			<a href="#" class="button secondary weak sort-by-location ">
				<i class="fa fa-spinner fa-pulse loader"></i>
				Gần nhất trước
			</a>
			<a class="button secondary weak update-location" href="#">
				<i class="fa fa-crosshairs" aria-hidden="true"></i><i class="fa fa-spinner fa-pulse loader"></i>
				<span class="label">Định vị</span>
			</a>
		</span>
	-->
</div>

<div id="filter-summarys">
		<form class="form-inline" action="/danh-sach/" method="get">
		 <div class="form-group">
   			<select name="province" id="province" onchange="province_change()">
   			<?php $province = App\Province::all();
   			$select = request()->input('province');?>
   			<option value="">Cả nước</option>
   			
   			@foreach($province as $pr)
			<option value="{{$pr->province_url}}" @if($pr->province_url===$select)selected="selected" @endif>{{$pr->province_name}}</option>
			@endforeach
			
			</select>
  		</div>
		 <div class="form-group">
   			<select name="district" id="district">
   			<?php $province = App\Province::all();
   			$select = request()->input('province');?>
   			<option value="">Quận/huyện</option>
   			
   		
			
			</select>
  		</div>
		
	
  		 <div class="form-group">
   			<select name ="speciality">
			<option value="">Chuyên khoa</option>
			<?php $specs = App\Speciality::all();$selectsp = request()->input('speciality');?>
			
			@foreach($specs as $sp)
				<option value="{{$sp->specialty_url}}" @if($sp->specialty_url===$selectsp)selected="selected" @endif>{{$sp->speciality_name}}</option>
			@endforeach
			</select>
  		</div>
		<button type="submit" class="btn btn-default">Lọc kết quả</button>
		</form>
		
		
	</div>

<script type="text/html" id="full-filter-template">
	<form name="listing-filter" action="#" method="GET">
		<ul class="tab-content-triggers">
			<% for (var i = 0; i < obj.length; i++) { %>
				<li>
					<a href="#tab-<%= obj[i].name %>" class="has-icon icon-<%= obj[i].name %>"
						data-track-path="/danh-sach/loc/tab/<%= obj[i].name %>"
						title="Lọc danh sách cơ sở y tế theo <%= obj[i].displayName %> - danh sách các tùy chọn">
						<%= obj[i].displayName %>
					</a>
				</li>
			<% } %>
		</ul>
		<div class="tab-content-container">
			<% for (var i = 0; i < obj.length; i++) { %>
				<div id="tab-<%= obj[i].name %>" class="tab-content filter-content <%= obj[i].name %> has-no-option" data-link="<%= obj[i].link %>" <% if (obj[i].child) { %> data-child="<%= obj[i].child %>" <% } %> data-name="<%= obj[i].name %>">
					<div class="inner">
						<% if (obj[i].parent) { %>
							<p class="no-option">Bạn cần chọn ít nhất một <a href="#tab-<%= obj[i].parent %>" class="tab-content-link"><%= obj[i].parentDisplayName %></a> trước.</p>
						<% } %>
						<% if (!obj[i].parent) { %>
							<% for (var k = 0; k < 3; k++) { %>
								<ul>
									<% for (var j = Math.ceil(obj[i].options.length / 3)*k; j < Math.ceil(obj[i].options.length / 3)*(k + 1) && j < obj[i].options.length; j++) { %>
										<li>
											<label>
												<input type="checkbox" name="<%= obj[i].name %>" <% if (obj[i].options[j].checked) { %>checked<% } %>
													value="<%= obj[i].options[j].slug ? obj[i].options[j].slug : obj[i].options[j].name %>" />
												<span><%= obj[i].options[j].name %></span>
											</label>
										</li>
									<% } %>
								</ul>
							<% } %>
						<% } %>
					</div>
					<div class="search">
						<input type="text" name="<%= obj[i].name %>-keywords" placeholder="Tìm trên danh sách này..." />
					</div>
				</div>
			<% } %>
		</div>
		<div class="button-row">
			<button type="submit"><i class="fa fa-filter fa-fw" aria-hidden="true"></i> Lọc danh sách</button>
		</div>
	</form>
</script>

<script type="text/html" id="list-filter-template">
	<div class="<%= slug %>">
		<div class="child-name">
			<strong><%= name %></strong>
		</div>
		<div class="child-content">
			<% for (var k = 0; k < 3; k++) { %>
			<ul>
				<% for (var j = Math.ceil(data.length / 3)*k; j < Math.ceil(data.length / 3)*(k + 1) && j < data.length; j++) { %>
				<li>
					<label>
						<input type="checkbox" name="<%= child %>" <% if (data[j].checked) { %>checked<% } %>
						value="<%= data[j].slug ? data[j].slug : data[j].name %>" />
						<span><%= data[j].name %></span>
					</label>
				</li>
				<% } %>
			</ul>
			<% } %>
		</div>
	</div>
</script>

						

			<ul>
			@if(isset($clinics))
			@foreach($clinics as $cl)
				
					<li class="has-actions has-map-marker" data-map-marker="29068">
						<div class="media">
							<a href="/co-so-y-te/{{$cl->clinic_url}}-{{$cl->clinic_id}}/kham-benh" class="hero-image" 
								style="background-image: url({{url('public/images/health_facilities/'.$cl->profile_image)}})">
							</a>
							
							<a href="/co-so-y-te/{{$cl->clinic_url}}-{{$cl->clinic_id}}/kham-benh#nhan-xet" class="comments-summary" title="4.0 sao, 93 nhận xét">
								
									<span class="star-ratings inited" data-score="80"><span class="stars"><span class="back"><b></b><b></b><b></b><b></b><b></b></span><span class="front" style="width: 80%;"><b></b><b></b><b></b><b></b><b></b></span></span></span>
								
								<span class="comment-count">
									<i class="fa fa-comment-o"></i> 93
								</span>
							</a>
						</div>

						<div class="body">
							<div class="info">
								<h2>
									<a href="/co-so-y-te/{{$cl->clinic_url}}-{{$cl->clinic_id}}/kham-benh">{{$cl->clinic_name}}</a>
									

									
										<span class="verified-badge has-tooltip">
											<em>Chính thức</em>
											<span class="tooltip">Thông tin trực tiếp quản lý bởi  Khoa Khám chữa bệnh theo yêu cầu - Bệnh viện Đại học Y Hà Nội</span>
										</span>
									
								</h2>

								
									<div class="desc">
									@if(strlen($cl->clinic_desc)>200)
										{{substr( $cl->clinic_desc, 0, strpos($cl->clinic_desc, ' ', 200) )}}...
										<a class="readmore" href="/co-so-y-te/{{$cl->clinic_url}}-{{$cl->clinic_id}}/kham-benh">Xem tiếp <i class="fa fa-angle-double-right"></i></a>
									@else
										{{$cl->clinic_desc}}
										<a class="readmore" href="/co-so-y-te/{{$cl->clinic_url}}-{{$cl->clinic_id}}/kham-benh">Xem tiếp <i class="fa fa-angle-double-right"></i></a>
									@endif
									</div>
								

								<dl class="brief">

									
										<dt><i class="fa fa-map-marker"></i></dt>
										<dd>
											{{$cl->clinic_address}}
											<span class="distance-to-user ">
												(cách
												<span data-lat="21.004435" data-lon="105.830803">
													
												</span> km)
											</span>
										</dd>
									

									
										<dt>
											<i class="fa fa-stethoscope"></i>
										</dt>
										<dd>
											<!-- speciality list for every clinic -->
												@foreach($cl->specialities as $sp)
													<a href="/danh-sach/?specialities={{$sp->clinic->speciality_url}}">{{$sp->clinic->speciality_name}}</a>,
												
											    @endforeach
												
								
												
											
											
										</dd>
									

									
										<dt>
											<i class="fa fa-user-md"></i>
										</dt>
										<dd>
											{{count($cl->doctors)}} bác sĩ
										</dd>
									
								</dl>
							</div>

							<div class="call-to-action">
								
									<a href="#contact-29068" class="button action-book" data-place-id="29068">
										<i class="fa fa-calendar-check-o" aria-hidden="true"></i>
										Đặt khám nhanh
									</a>
								
								<a href="#" class="sticky-nav-link action-favourite secondary weak button " title="Thêm vào ghi nhớ" data-place-id="29068">
									<i class="fa fa-spinner fa-pulse loader"></i>
									<span class="added"><i class="fa fa-bookmark" aria-hidden="true"></i> Đã ghi nhớ</span>
									<span class="unadded"><i class="fa fa-bookmark-o" aria-hidden="true"></i> Ghi nhớ</span>
								</a>
							</div>
						</div>

						<div class="actions" id="contact-29068">
							
								<div class="inner">
									<div class="booking">
										<p>
											Chọn bác sĩ và giờ bạn muốn đặt khám từ lịch dưới đây. Để được tư vấn chọn bác sĩ, bạn có thể chat với chúng tôi trên trang web này hoặc gọi điện cho chúng tôi theo số <a href="tel:0473006008">0473 006 008</a>.
										</p>
										<div class="form-row">
											<div class="form-field">
												<label>Khám với bác sĩ:</label>
												<div class="form-field-input">
													<select class="professional-select has-my-vicare" data-place-id="29068">
													
													<optgroup label="Chấn thương chỉnh hình - Cột sống">
														
															<option value="40572">
															Nguyễn Vũ
															</option>
														
													</optgroup>
													
													<optgroup label="Da liễu">
														
															<option value="5210">
															Đàm Thị Hòa
															</option>
														
													</optgroup>
													
													<optgroup label="Dị ứng - Miễn dịch">
														
															<option value="3066">
															Hoàng Thị Lâm
															</option>
														
															<option value="168">
															Lê Thị Thúy Hải
															</option>
														
															<option value="7736">
															Lê Thị Thúy Hải
															</option>
														
															<option value="122">
															Nguyễn Thị Vân
															</option>
														
													</optgroup>
													
													<optgroup label="Khám bệnh">
														
															<option value="21853">
															Danh Thị Phượng
															</option>
														
															<option value="3066">
															Hoàng Thị Lâm
															</option>
														
															<option value="3043">
															Nguyễn Công Hoan
															</option>
														
															<option value="122">
															Nguyễn Thị Vân
															</option>
														
															<option value="2941">
															Ngô Đăng Thục
															</option>
														
															<option value="3100">
															Phan Thị Hồng Tuyên
															</option>
														
															<option value="3102">
															Phạm Hồng Huyên
															</option>
														
															<option value="4266">
															Trần Thị Phương Mai
															</option>
														
															<option value="3072">
															Đinh Thị Kim Dung
															</option>
														
															<option value="21852">
															Đào Thị Loan
															</option>
														
													</optgroup>
													
													<optgroup label="Lão khoa">
														
															<option value="3035">
															Đỗ Khánh Hỷ
															</option>
														
													</optgroup>
													
													<optgroup label="Ngoại Thần kinh">
														
															<option value="3098">
															Kiều Đình Hùng
															</option>
														
															<option value="40572">
															Nguyễn Vũ
															</option>
														
													</optgroup>
													
													<optgroup label="Ngoại Thận - Tiết niệu">
														
															<option value="2001">
															Vũ Nguyễn Khải Ca
															</option>
														
													</optgroup>
													
													<optgroup label="Ngoại Tiêu hoá - Gan mật">
														
															<option value="3097">
															Kim Văn Vụ 
															</option>
														
															<option value="406">
															Phạm Đức Huấn
															</option>
														
													</optgroup>
													
													<optgroup label="Nội Cơ Xương Khớp">
														
															<option value="168">
															Lê Thị Thúy Hải
															</option>
														
															<option value="897">
															Vũ Thị Bích Hạnh
															</option>
														
													</optgroup>
													
													<optgroup label="Nội Hô hấp">
														
															<option value="168">
															Lê Thị Thúy Hải
															</option>
														
															<option value="2540">
															Phan Thu Phương
															</option>
														
															<option value="2932">
															Trần Hoàng Thành
															</option>
														
													</optgroup>
													
													<optgroup label="Nội Thần kinh">
														
															<option value="168">
															Lê Thị Thúy Hải
															</option>
														
													</optgroup>
													
													<optgroup label="Nội Thận - Tiết niệu">
														
															<option value="168">
															Lê Thị Thúy Hải
															</option>
														
															<option value="1993">
															Vương Tuyết Mai
															</option>
														
															<option value="391">
															Đỗ Gia Tuyển
															</option>
														
															<option value="1983">
															Đỗ Thị Liệu
															</option>
														
													</optgroup>
													
													<optgroup label="Nội Tim mạch">
														
															<option value="168">
															Lê Thị Thúy Hải
															</option>
														
													</optgroup>
													
													<optgroup label="Nội Tiêu hoá - Gan mật">
														
															<option value="895">
															Đào Văn Long
															</option>
														
															<option value="168">
															Lê Thị Thúy Hải
															</option>
														
													</optgroup>
													
													<optgroup label="Nội soi">
														
															<option value="3056">
															Lương Minh Hương
															</option>
														
															<option value="11176">
															soi đại tràng
															</option>
														
													</optgroup>
													
													<optgroup label="Nội tiết">
														
															<option value="168">
															Lê Thị Thúy Hải
															</option>
														
													</optgroup>
													
													<optgroup label="Phụ khoa">
														
															<option value="2775">
															Phạm Bá Nha
															</option>
														
													</optgroup>
													
													<optgroup label="Sản khoa">
														
															<option value="2775">
															Phạm Bá Nha
															</option>
														
													</optgroup>
													
													<optgroup label="Sản phụ khoa">
														
															<option value="2298">
															Cung Thị Thu Thủy
															</option>
														
															<option value="2248">
															Nguyễn Quốc Tuấn
															</option>
														
															<option value="7749">
															Nguyễn Thị Bích Vân
															</option>
														
															<option value="2978">
															Nguyễn Đức Hinh
															</option>
														
															<option value="7746">
															Phạm Bá Nha
															</option>
														
															<option value="2775">
															Phạm Bá Nha
															</option>
														
															<option value="3092">
															Phạm Thị Hoa Hồng
															</option>
														
															<option value="4266">
															Trần Thị Phương Mai
															</option>
														
													</optgroup>
													
													<optgroup label="Tai - Mũi - Họng">
														
															<option value="4194">
															Cao Minh Thành
															</option>
														
															<option value="3056">
															Lương Minh Hương
															</option>
														
															<option value="4051">
															Nguyễn Quang Trung
															</option>
														
															<option value="3061">
															Ngô Ngọc Liễn
															</option>
														
															<option value="706">
															Phạm Khánh Hòa
															</option>
														
															<option value="3049">
															Phạm Thị Bích Đào
															</option>
														
															<option value="707">
															Phạm Trần Anh
															</option>
														
															<option value="3054">
															Phạm Tuấn Cảnh
															</option>
														
															<option value="7744">
															Tống Xuân Thắng
															</option>
														
													</optgroup>
													
													<optgroup label="Thần kinh">
														
															<option value="3043">
															Nguyễn Công Hoan
															</option>
														
															<option value="2948">
															Nguyễn Văn Hướng
															</option>
														
															<option value="40572">
															Nguyễn Vũ
															</option>
														
															<option value="2941">
															Ngô Đăng Thục
															</option>
														
													</optgroup>
													
													<optgroup label="Thận - Tiết niệu">
														
															<option value="1993">
															Vương Tuyết Mai
															</option>
														
															<option value="3072">
															Đinh Thị Kim Dung
															</option>
														
															<option value="1983">
															Đỗ Thị Liệu
															</option>
														
													</optgroup>
													
													<optgroup label="Tim mạch">
														
															<option value="112">
															Nguyễn Lân Việt
															</option>
														
															<option value="7712">
															Nguyễn Lân Hiếu
															</option>
														
													</optgroup>
													
													<optgroup label="Ung bướu">
														
															<option value="3037">
															Lê Văn Quảng
															</option>
														
															<option value="3040">
															Nguyễn Văn Hiếu
															</option>
														
															<option value="40572">
															Nguyễn Vũ
															</option>
														
															<option value="3054">
															Phạm Tuấn Cảnh
															</option>
														
													</optgroup>
													
													</select>
												</div>
											</div>
										</div>
										<div class="booking-picker">
											<table class="weeks"></table>
										</div>
										<div class="loader">
											<div class="spinner"></div>
										</div>
									</div>
								</div>
							
						</div>
					</li>
				@endforeach
			@endif
					
				
			</ul>
			
			


    <div class="pagination">
        <div class="vh">47954 kết quả.</div>
        <span class="step-links">
            

           <!-- <span class="current">
                Trang 1 / 4796
            </span>
-->
   
   		{!! $clinics->appends(request()->input())->links(); !!}        
        <!--         <a href="?page=2">Sau <i class="fa fa-chevron-right"></i></a>
         -->   
        </span>
    </div>


		</div>

		<aside>
	<!-- <div class="geosearch-options">
		<a href="#" class="button secondary weak sort-by-location ">
			<i class="fa fa-spinner fa-pulse loader"></i>
			Xếp gần nhất trước
		</a>
		<a class="button secondary weak update-location" href="#">
			<i class="fa fa-crosshairs" aria-hidden="true"></i><i class="fa fa-spinner fa-pulse loader"></i> Định vị
		</a>
	</div>-->

	
			
				<section class="top-list">
						<h3>Đáng quan tâm</h3>
						<ul>
							
									<li>
											<a class="image" href="/tuyen-chon/4-dia-chi-chua-benh-tri-hieu-qua-tai-tp-ho-chi-minh-5/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/13_06_2016_08_04_34_577453.jpeg);" title="4 địa chỉ chữa bệnh trĩ hiệu quả tại TP. Hồ Chí Minh"></a>

											<div class="body">
												<h4>
														<a href="/tuyen-chon/4-dia-chi-chua-benh-tri-hieu-qua-tai-tp-ho-chi-minh-5/" title="4 địa chỉ chữa bệnh trĩ hiệu quả tại TP. Hồ Chí Minh">
													4 địa chỉ chữa bệnh trĩ hiệu quả tại TP. Hồ Chí Minh
														</a>
												</h4>
											</div>
									</li>
							
									<li>
											<a class="image" href="/tuyen-chon/5-benh-vien-lon-lam-viec-thu-7-va-chu-nhat-o-ha-noi-161/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/19_07_2016_10_59_51_367406.jpeg);" title="5 bệnh viện lớn làm việc thứ 7 và chủ nhật ở Hà Nội"></a>

											<div class="body">
												<h4>
														<a href="/tuyen-chon/5-benh-vien-lon-lam-viec-thu-7-va-chu-nhat-o-ha-noi-161/" title="5 bệnh viện lớn làm việc thứ 7 và chủ nhật ở Hà Nội">
													5 bệnh viện lớn làm việc thứ 7 và chủ nhật ở Hà Nội
														</a>
												</h4>
											</div>
									</li>
							
									<li>
											<a class="image" href="/tuyen-chon/4-benh-vien-lon-nhat-tai-quan-go-vap-o-tp-hcm-182/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/20_07_2016_08_12_47_267872.jpeg);" title="4 bệnh viện lớn nhất tại quận Gò Vấp ở TP. HCM"></a>

											<div class="body">
												<h4>
														<a href="/tuyen-chon/4-benh-vien-lon-nhat-tai-quan-go-vap-o-tp-hcm-182/" title="4 bệnh viện lớn nhất tại quận Gò Vấp ở TP. HCM">
													4 bệnh viện lớn nhất tại quận Gò Vấp ở TP. HCM
														</a>
												</h4>
											</div>
									</li>
							
									<li>
											<a class="image" href="/tuyen-chon/5-co-so-dieu-tri-mun-trung-ca-uy-tin-tai-ha-noi-200/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/21_07_2016_02_54_03_896547.jpeg);" title="5 Cơ sở điều trị mụn trứng cá uy tín tại hà nội"></a>

											<div class="body">
												<h4>
														<a href="/tuyen-chon/5-co-so-dieu-tri-mun-trung-ca-uy-tin-tai-ha-noi-200/" title="5 Cơ sở điều trị mụn trứng cá uy tín tại hà nội">
													5 Cơ sở điều trị mụn trứng cá uy tín tại hà nội
														</a>
												</h4>
											</div>
									</li>
							
									<li>
											<a class="image" href="/tuyen-chon/5-co-so-kham-phu-khoa-dang-tin-cay-tai-ha-noi-192/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/22_07_2016_04_21_10_110188.jpeg);" title="5 cơ sở khám phụ khoa đáng tin cậy tại Hà Nội"></a>

											<div class="body">
												<h4>
														<a href="/tuyen-chon/5-co-so-kham-phu-khoa-dang-tin-cay-tai-ha-noi-192/" title="5 cơ sở khám phụ khoa đáng tin cậy tại Hà Nội">
													5 cơ sở khám phụ khoa đáng tin cậy tại Hà Nội
														</a>
												</h4>
											</div>
									</li>
							
									<li>
											<a class="image" href="/tuyen-chon/5-benh-vien-kham-chuyen-khoa-y-hoc-co-truyen-uy-tin-tai-ha-noi-201/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/21_07_2016_03_07_28_614708.jpeg);" title="5 Bệnh viện khám chuyên khoa y học cổ truyền uy tín tại Hà nội"></a>

											<div class="body">
												<h4>
														<a href="/tuyen-chon/5-benh-vien-kham-chuyen-khoa-y-hoc-co-truyen-uy-tin-tai-ha-noi-201/" title="5 Bệnh viện khám chuyên khoa y học cổ truyền uy tín tại Hà nội">
													5 Bệnh viện khám chuyên khoa y học cổ truyền uy tín tại Hà nội
														</a>
												</h4>
											</div>
									</li>
							
									<li>
											<a class="image" href="/tuyen-chon/5-benh-vien-lon-lam-viec-thu-7-va-chu-nhat-tai-tp-hcm-205/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/21_07_2016_04_13_01_690629.jpeg);" title="5 bệnh viện lớn làm việc thứ 7 và chủ nhật tại TP. HCM"></a>

											<div class="body">
												<h4>
														<a href="/tuyen-chon/5-benh-vien-lon-lam-viec-thu-7-va-chu-nhat-tai-tp-hcm-205/" title="5 bệnh viện lớn làm việc thứ 7 và chủ nhật tại TP. HCM">
													5 bệnh viện lớn làm việc thứ 7 và chủ nhật tại TP. HCM
														</a>
												</h4>
											</div>
									</li>
							
									<li>
											<a class="image" href="/tuyen-chon/6-phong-kham-san-phu-khoa-tot-tai-quan-7-tp-hcm-159/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/20_07_2016_10_17_07_671729.jpeg);" title="6 phòng khám sản phụ khoa tốt tại Quận 7 – TP. HCM"></a>

											<div class="body">
												<h4>
														<a href="/tuyen-chon/6-phong-kham-san-phu-khoa-tot-tai-quan-7-tp-hcm-159/" title="6 phòng khám sản phụ khoa tốt tại Quận 7 – TP. HCM">
													6 phòng khám sản phụ khoa tốt tại Quận 7 – TP. HCM
														</a>
												</h4>
											</div>
									</li>
							
									<li>
											<a class="image" href="/tuyen-chon/5-co-so-y-te-chua-vo-sinh-hiem-muon-dang-tin-cay-tai-ha-noi-210/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/22_07_2016_03_13_11_377573.jpeg);" title="5 cơ sở y tế chữa vô sinh hiếm muộn đáng tin cậy tại Hà Nội"></a>

											<div class="body">
												<h4>
														<a href="/tuyen-chon/5-co-so-y-te-chua-vo-sinh-hiem-muon-dang-tin-cay-tai-ha-noi-210/" title="5 cơ sở y tế chữa vô sinh hiếm muộn đáng tin cậy tại Hà Nội">
													5 cơ sở y tế chữa vô sinh hiếm muộn đáng tin cậy tại Hà Nội
														</a>
												</h4>
											</div>
									</li>
							
									<li>
											<a class="image" href="/tuyen-chon/5-bac-si-chuyen-khoa-nhi-kham-tai-nha-o-ha-noi-235/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/04_08_2016_07_26_00_647500.jpeg);" title="5 Bác sĩ chuyên khoa nhi khám tại nhà ở Hà Nội"></a>

											<div class="body">
												<h4>
														<a href="/tuyen-chon/5-bac-si-chuyen-khoa-nhi-kham-tai-nha-o-ha-noi-235/" title="5 Bác sĩ chuyên khoa nhi khám tại nhà ở Hà Nội">
													5 Bác sĩ chuyên khoa nhi khám tại nhà ở Hà Nội
														</a>
												</h4>
											</div>
									</li>
							
									<li>
											<a class="image" href="/tuyen-chon/nhung-co-so-kham-benh-tram-cam-tai-ha-noi-ma-ban-nen-biet-260/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/09_08_2016_09_16_40_393850.jpeg);" title="Những cơ sở khám bệnh trầm cảm tại Hà Nội mà bạn nên biết"></a>

											<div class="body">
												<h4>
														<a href="/tuyen-chon/nhung-co-so-kham-benh-tram-cam-tai-ha-noi-ma-ban-nen-biet-260/" title="Những cơ sở khám bệnh trầm cảm tại Hà Nội mà bạn nên biết">
													Những cơ sở khám bệnh trầm cảm tại Hà Nội mà bạn nên biết
														</a>
												</h4>
											</div>
									</li>
							
									<li>
											<a class="image" href="/tuyen-chon/kham-suc-khoe-tong-quat-o-dau-tot-tai-tphcm-208/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/21_07_2016_04_37_01_745304.jpeg);" title="Khám sức khỏe tổng quát ở đâu tốt tại Tp.HCM?"></a>

											<div class="body">
												<h4>
														<a href="/tuyen-chon/kham-suc-khoe-tong-quat-o-dau-tot-tai-tphcm-208/" title="Khám sức khỏe tổng quát ở đâu tốt tại Tp.HCM?">
													Khám sức khỏe tổng quát ở đâu tốt tại Tp.HCM?
														</a>
												</h4>
											</div>
									</li>
							
									<li>
											<a class="image" href="/tuyen-chon/chua-soi-than-o-dau-tot-tai-ha-noi-va-tp-hcm-224/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/28_07_2016_07_42_07_238366.jpeg);" title="Chữa sỏi thận ở đâu tốt tại Hà Nội và TP. HCM"></a>

											<div class="body">
												<h4>
														<a href="/tuyen-chon/chua-soi-than-o-dau-tot-tai-ha-noi-va-tp-hcm-224/" title="Chữa sỏi thận ở đâu tốt tại Hà Nội và TP. HCM">
													Chữa sỏi thận ở đâu tốt tại Hà Nội và TP. HCM
														</a>
												</h4>
											</div>
									</li>
							
									<li>
											<a class="image" href="/tuyen-chon/3-benh-vien-tam-than-uy-tin-o-ha-noi-132/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/19_07_2016_05_08_30_154036.jpeg);" title="3 bệnh viên tâm thần uy tín ở Hà Nội"></a>

											<div class="body">
												<h4>
														<a href="/tuyen-chon/3-benh-vien-tam-than-uy-tin-o-ha-noi-132/" title="3 bệnh viên tâm thần uy tín ở Hà Nội">
													3 bệnh viên tâm thần uy tín ở Hà Nội
														</a>
												</h4>
											</div>
									</li>
							
									<li>
											<a class="image" href="/tuyen-chon/nhung-co-so-kham-nhi-uy-tin-tai-tphcm-me-nen-luu-y-152/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/19_07_2016_09_27_10_883430.jpeg);" title="Những cơ sở khám nhi uy tín tại Tp.HCM mẹ nên lưu ý"></a>

											<div class="body">
												<h4>
														<a href="/tuyen-chon/nhung-co-so-kham-nhi-uy-tin-tai-tphcm-me-nen-luu-y-152/" title="Những cơ sở khám nhi uy tín tại Tp.HCM mẹ nên lưu ý">
													Những cơ sở khám nhi uy tín tại Tp.HCM mẹ nên lưu ý
														</a>
												</h4>
											</div>
									</li>
							
						</ul>

						<a href="/tuyen-chon/" class="view-more">
								Xem tất cả các tuyển chọn
						</a>
				</section>
			
	
</aside>


	</div>
</div>

<script type="text/html" id="professional-select-template">
	<select class="professional-select">
		<% for (var i = 0; i < obj.length; i++) { %>
			<option value="<%= obj[i].professional_id %>">
				<%= obj[i].professional_name %>
				<% for (var j = 0; j < obj[i].specialities.length; j++) {
					if (j == 0) {
						print('(');
					} else {
						print(', ');
					}
					print(obj[i].specialities[j].name);
					if (j == (obj[i].specialities.length -1)) { print(')'); }
				} %>
			</option>
		<% } %>
	</select>
</script>
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


<div id="subscribe">
	<h2>Để tiếp tục, vui lòng nhập địa chỉ email của bạn</h2>
	
	<form method="POST" action="#">
		<input name="email" required="" type="email">
		<button type="submit">OK</button>
	</form>

	<p>
		ViCare cam kết bảo mật tuyệt đối địa chỉ email và thông tin cá nhân của bạn.
	</p>
</div>
<div class="global-thread-create-cta">
	<a href="/hoi-bac-si/dat-cau-hoi/" class="button">
		<i class="fa fa-question-circle" aria-hidden="true"></i>
		<strong>Hỏi bác sĩ</strong>
		<span>miễn phí</span>
	</a>
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

				<form method="post" action="https://vicare.vn/dang-nhap/?next=/danh-sach/" name="login">
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
						<button type="button" name="facebook" data-link="https://vicare.vn/tai-khoan/ket-noi/login/facebook/?next=/danh-sach/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng nhập qua Facebook</button>
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

				<form method="post" action="https://vicare.vn/dang-ky/?next=/danh-sach/" name="signup">
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
						<button type="button" name="facebook" data-link="https://vicare.vn/tai-khoan/ket-noi/login/facebook/?next=/danh-sach/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng ký qua Facebook</button>
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



			
			<input name="csrfmiddlewaretoken" value="o76v1bf5eB34ClSCVPwbpGYopdhPhjC5" type="hidden">
		</div>
     <div class="global-thread-create-cta">
	<a href="/hoi-bac-si/dat-cau-hoi/" class="button">
		<i class="fa fa-question-circle" aria-hidden="true"></i>
		<strong>Hỏi bác sĩ</strong>
		<span>miễn phí</span>
	</a>
</div>
       <!-- footer starts -->
        <footer class="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                    <div class="col-md-4 article footer-widget1">
                            <h3>Bài viết Mới Nhất</h3>
                            <ul class="popular-posts">
                           
                        
                       
                     @if($article)
                           @foreach($article as $art)
                            
                                                

                                <li>
                                     <a href="{!! url('bai-viet/'.$art['article_id'])!!}">

                                        <img src="@if(!empty($art->image))@if(strpos($art->image,'http')===false)/public/images/@endif{{$art->image}}@endif"  alt="#"/>
                                    </a>
                                    <?php \Carbon\Carbon::setLocale('vi') ?>
                                    <h4><a href="{!! url('bai-viet/'.$art['article_id'])!!}">{!!$art['article_title']!!} </a></h4>
                                    <span><i class="fa fa-calendar">{!! \Carbon\Carbon::parse(($art['created_at']))->toFormattedDateString() !!}   {!! \Carbon\Carbon::createFromTimeStamp(strtotime($art['created_at']))->diffForHumans() !!}</i></span>
                                </li>
                            
                               @endforeach
                    @endif  
                        
              
                            </ul>
                        </div>

                        <div class="col-md-4 footer-widget2">
                            <h3>Thông tin liên hệ</h3>
                            <span>283/97 Cách Mạng Tháng 8, Phường 12, Quận 10, TP.HCM,
</span>
                            <span> Việt Nam</span>
                            <br>
                            <span>bacsivietok@gmail.com
</span>
                            <br>
                            <span>Hỗ trợ: 0981.405.925
<br>
Skype : netbotvn
                            </span>

                            <div class="footer-socials">
                                <h4>Kết nối với chúng tôi</h4>
                                <div id="fb-root"></div>
                                <script>(function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s); js.id = id;
                                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
                                fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));</script>
                               <div class="fb-page" data-href="https://www.facebook.com/B%C3%A1c-S%C4%A9-Vi%E1%BB%87t-971050299703719/" data-tabs="timeline" data-width="340" data-height="246" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Bacsyviet-1580363511992683/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Bacsyviet-1580363511992683/">Bacsyviet</a></blockquote></div>

                               
                            </div>
                        </div>

                        <div class="col-md-4 footer-widget1">
                            <h3>Khuyến Mãi Nổi Bật</h3>
                            <ul class="popular-posts">
                        @if($deals)
                         <?php $i = 0;?>
                            @foreach($deals as $deal)
                               @if($i<5)
                              <li>
                                    <a href="/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}">
                                        <img src="/public/images/{!!$deal['image']!!}"  alt="#"/>
                                    </a>
                                    <h4><a href="/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}">{!!$deal['deal_title']!!} </a></h4>
                                    
                
                    
                                        <span style="color:#ff749c;margin-right: 20px;">{!!$deal['price']!!}<span class="currency">₫</span></span>
                                        <span style="color: #eee;text-decoration: line-through;">{!!$deal['old_price']!!}</span><span class="currency">₫</span>
                    
                
                                  
                                   
                                    <?php \Carbon\Carbon::setLocale('vi') ?>
                                    <span><i class="fa fa-calendar">{!! \Carbon\Carbon::parse(($deal['created_at']))->toFormattedDateString() !!}   {!! \Carbon\Carbon::createFromTimeStamp(strtotime($deal['created_at']))->diffForHumans() !!}</i></span>
                                </li>
                                @endif
                                <?php $i+=1;?>
                            @endforeach
                        @endif
                        </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div id="back-top">
                <a class="back-top" href="#slider"><i class="fa fa-angle-up"></i></a>
            </div>
            <div class="footer-bottom text-center">
               <div class="disclaimer">
               <p style="font-size: 1.5em;"><?php @include('counter.php');?></p></br>
				<p>
					Website được sở hữu và quản lý bởi: <strong>Công ty Cổ phần BacSiViet</strong>. Trụ sở chính: 283/97 Cách Mạng Tháng 8, Phường 12, Quận 10, TP.HCM, Việt Nam
				</p>
				<!-- <p>Giấy chứng nhận đăng ký kinh doanh số <strong class="registration-number">*******</strong> do Sở Kế hoạch và Đầu tư TP Hồ Chí Minh cấp ngày *****</p> -->
				<p>Các thông tin trên web site này chỉ mang tính chất tham khảo. Chúng tôi không chịu trách nhiệm nào do việc áp dụng các thông tin trên web site này gây ra.</p>
			</div>
			 
            </div>
           
        </footer>
    </main>
    <!-- main page ends -->
	
    <!-- Jquery and javascript files -->
     <script type="text/javascript" src="/public/js/vilib.js"></script>
    <!-- <script type="text/javascript" src="/public/js/jquery-2.1.1.js"></script> -->
    <!-- date picker js -->
    <script type="text/javascript" src="/public/js/datepicker.js"></script>
    <!-- bootstrap 3.3.6 js -->
    <script type="text/javascript" src="/public/js/bootstrap.min.js"></script>
    <!-- owl carousel js-->
    <script type="text/javascript" src="/public/js/owl.carousel.js"></script>
    <!-- smooth scroll js -->
    <script type="text/javascript" src="/public/js/smoothscroll.js"></script>
    <!-- preloader js -->
    <script type="text/javascript" src="/public/js/jquery.introLoader.pack.min.js"></script> 
    <!-- custom scripts -->
    <script type="text/javascript" src="/public/js/script.js"></script>
     
     <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.medixlink.com/public/js/analytics.js','ga');

  ga('create', 'UA-97538710-1', 'auto');
  ga('send', 'pageview');

</script>

<script type="text/javascript">
function province_change(){
	//alert('aaa');
	var id=$("#province").val();
	var dataString = 'province='+id+'&_token={{csrf_token()}}';
	$.ajax({
        type: 'POST',
        url: '/api/district',
        data: dataString,
        cache: false,
        success: function(output) {
         //   alert('a');
           $("#district").html(output);
        }
    });
}
</script>
</body>

</html>

