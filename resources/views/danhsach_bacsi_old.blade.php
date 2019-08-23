



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
					<a href="/danh-sach/bac-si/" itemprop="url"><span itemprop="title">Bác sĩ</span></a>
				</li>
				
				
				
			</ul>
			<h1>
				
		@if(request()->input('q')!==null)
	Tìm kiếm bác sĩ theo từ khóa "{{urldecode(request()->input('q'))}}"			
	@else
		Danh sách bác sĩ
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
                    <a href="/danh-sach/?q={{urldecode(request()->input('q'))}}">
                        Cơ sở y tế ({{$clinic or '0' }})
                    </a>
                </li>
                
                
                <li>
                    <a href="/danh-sach/bac-si/?q={{request()->input('q')}}" class="active">
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

<div id="list" class="professionals has-aside">
	<div class="position">

		<div class="content">
			

		<div id="filter-cta">
			<a class="button secondary weak activator" href="#filter-summary">
			<i class="fa fa-filter fa-fw" aria-hidden="true"></i><span class="active">Ẩn bộ lọc</span><span class="inactive">Hiện bộ lọc</span>
			</a>
		</div>

		<div id="filter-summarys">
		<form class="form-inline" action="/danh-sach/bac-si/" method="get">
		 <div class="form-group">
   			<select name="province">
   			<?php $province = App\Province::all();
   			$select = request()->input('province');?>
   			<option value="">Cả nước</option>
   			
   			@foreach($province as $pr)
			<option value="{{$pr->province_url}}" @if($pr->province_url===$select)selected="selected" @endif>{{$pr->province_name}}</option>
			@endforeach
			
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
						data-track-path="/danh-sach/bac-si/loc/tab/<%= obj[i].name %>"
						title="Lọc danh sách bác sĩ theo <%= obj[i].displayName %> - danh sách các tùy chọn">
						<%= obj[i].displayName %>
					</a>
				</li>
			<% } %>
		</ul>
		<div class="tab-content-container">
			<% for (var i = 0; i < obj.length; i++) { %>
				<div id="tab-<%= obj[i].name %>" class="tab-content filter-content">
					<div class="inner">
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
					</div>
					<div class="search">
						<input type="text" placeholder="Tìm trên danh sách này..." />
					</div>
				</div>
			<% } %>
		</div>
		<div class="button-row">
			<button type="submit"><i class="fa fa-filter fa-fw" aria-hidden="true"></i> Lọc danh sách</button>
		</div>
	</form>
</script>

						


			<ul>
				@if(isset($doctors))
				  @foreach($doctors as $dr)
					<li>
						<div class="media">
							<a href="/danh-sach/bac-si/{{$dr->doctor_url}}-{{$dr->doctor_id}}/" class="hero-image" 
								style="background-image: url({{url('public/images/doctor/'.$dr->profile_image)}})">												
							</a>
							
								<a href="/danh-sach/bac-si/{{$dr->doctor_url}}-{{$dr->doctor_id}}/nha-khoa-tong-quat#nhan-xet" class="comments-summary " title="0 hài lòng, 2 nhận xét, 0 câu trả lời, 0 cảm ơn">
									
										<span class="like-count">
											<i class="fa fa-thumbs-o-up"></i> 0
										</span>
										<span class="comment-count">
											<i class="fa fa-comment-o"></i> 2
										</span>
									
									
								</a>
							
						</div>
						<div class="body">
							<div class="info">
								<h2>
									<a href="/danh-sach/bac-si/{{$dr->doctor_url}}-{{$dr->doctor_id}}/{{$dr->doctorspeciality->speciality->specialty_url or null}}">Bác sĩ {{$dr->doctor_name}}</a>

									

									
								</h2>

								<div class="desc">
									
									@if(!empty($dr->doctor_description)|| $dr->doctor_description!='')	
									@if(strlen($dr->doctor_description)>200 && strpos($dr->doctor_description, ' ', 200)!="")
									{!!substr( $dr->doctor_description, 0, strpos($dr->doctor_description, ' ', 200) )!!}
									
										<a class="readmore" href="/danh-sach/bac-si/{{$dr->doctor_url}}-{{$dr->doctor_id}}/{{$dr->doctorspeciality->speciality->specialty_url or null}}">Xem tiếp <i class="fa fa-angle-double-right"></i></a>
									@endif
									@endif
									</div>

								<dl class="brief">
									

									
										<dt>
											<i class="fa fa-stethoscope"></i>
										</dt>
										<dd>
											@foreach($dr->specialities as $spec)
												<a href="/danh-sach/bac-si/?specialities={{$spec->speciality->specialty_url}}">{{$spec->speciality->speciality_name}}</a>
											   @if($spec!==$dr->specialities->last()),
											   @endif
											@endforeach
										</dd>
									

									

									
										<dt>
											<i class="fa fa-hospital-o"></i>
										</dt>
										<dd>
											
										     @foreach($dr->clinics as $cs)		
													<a href="/co-so-y-te/{{$cs->clinic->clinic_url}}-{{$cs->clinic->clinic_id}}">{{$cs->clinic->clinic_name}}</a>
												@if($cs!== $dr->clinics->last())
												,
												@endif	
											
											 @endforeach
												
										</dd>
									
								</dl>
							</div>
							<div class="call-to-action">
								

								<a href="#" class="sticky-nav-link action-favourite secondary weak button " title="Thêm vào ghi nhớ" data-professional-id="20143">
									<i class="fa fa-spinner fa-pulse loader"></i>
									<span class="added"><i class="fa fa-bookmark" aria-hidden="true"></i> Đã ghi nhớ</span>
									<span class="unadded"><i class="fa fa-bookmark-o" aria-hidden="true"></i> Ghi nhớ</span>
								</a>
							</div>
						</div>
						<div class="actions" id="contact-20143">
							
						</div>
					</li>
					@endforeach
				@endif
					
				
			</ul>
			

			


    <div class="pagination">
        <div class="vh">26 kết quả.</div>
        <span class="step-links">
            

       <!--      <span class="current">
                Trang 1 / 3
            </span>
-->
            {!! $doctors->appends(request()->input())->links(); !!}
         <!--        <a href="?page=2">Sau <i class="fa fa-chevron-right"></i></a>
            -->
        </span>
    </div>


		</div>

		

<aside>
    <section class="collapsible-container collapsible-list collapsed">
        <h3>Chuyên khoa</h3>

        <dl class="collapsible-target">
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=duoc" class="" title="Dược">
                    <h5>Dược</h5>
                    <span class="thread-count ">9195 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=kham-benh" class="" title="Khám bệnh">
                    <h5>Khám bệnh</h5>
                    <span class="thread-count ">3255 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=san-phu" class="" title="Sản phụ khoa">
                    <h5>Sản phụ khoa</h5>
                    <span class="thread-count ">1684 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=y-hoc-co-truyen" class="" title="Y học cổ truyền">
                    <h5>Y học cổ truyền</h5>
                    <span class="thread-count ">1673 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=rang-ham-mat" class="" title="Răng - Hàm - Mặt">
                    <h5>Răng - Hàm - Mặt</h5>
                    <span class="thread-count ">1660 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=tham-my" class="" title="Thẩm mỹ">
                    <h5>Thẩm mỹ</h5>
                    <span class="thread-count ">1611 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=nhi" class="" title="Nhi">
                    <h5>Nhi</h5>
                    <span class="thread-count ">1578 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=chan-doan-hinh-anh" class="" title="Chẩn đoán hình ảnh">
                    <h5>Chẩn đoán hình ảnh</h5>
                    <span class="thread-count ">1262 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=noi-tiet" class="" title="Nội tiết">
                    <h5>Nội tiết</h5>
                    <span class="thread-count ">1227 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=hoi-suc-cap-cuu" class="" title="Hồi sức - Cấp cứu">
                    <h5>Hồi sức - Cấp cứu</h5>
                    <span class="thread-count ">1175 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=nhan-khoa" class="" title="Nhãn khoa">
                    <h5>Nhãn khoa</h5>
                    <span class="thread-count ">999 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=tai-mui-hong" class="" title="Tai - Mũi - Họng">
                    <h5>Tai - Mũi - Họng</h5>
                    <span class="thread-count ">941 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=tim-mach" class="" title="Tim mạch">
                    <h5>Tim mạch</h5>
                    <span class="thread-count ">894 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=chan-thuong-chinh-hinh-cot-song" class="" title="Chấn thương chỉnh hình - Cột sống">
                    <h5>Chấn thương chỉnh hình - Cột sống</h5>
                    <span class="thread-count ">703 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=xet-nghiem" class="" title="Xét nghiệm">
                    <h5>Xét nghiệm</h5>
                    <span class="thread-count ">662 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=dinh-duong" class="" title="Dinh dưỡng">
                    <h5>Dinh dưỡng</h5>
                    <span class="thread-count ">654 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=da-lieu" class="" title="Da liễu">
                    <h5>Da liễu</h5>
                    <span class="thread-count ">653 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=da-khoa" class="" title="Đa khoa">
                    <h5>Đa khoa</h5>
                    <span class="thread-count ">594 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=gay-me-hoi-suc" class="" title="Gây mê hồi sức">
                    <h5>Gây mê hồi sức</h5>
                    <span class="thread-count ">576 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=tam-than" class="" title="Tâm thần">
                    <h5>Tâm thần</h5>
                    <span class="thread-count ">518 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=ung-buou" class="" title="Ung bướu">
                    <h5>Ung bướu</h5>
                    <span class="thread-count ">460 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=than-tiet-nieu" class="" title="Thận - Tiết niệu">
                    <h5>Thận - Tiết niệu</h5>
                    <span class="thread-count ">457 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=ho-hap" class="" title="Hô hấp">
                    <h5>Hô hấp</h5>
                    <span class="thread-count ">437 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=tieu-hoa-gan-mat" class="" title="Tiêu hóa - Gan mật">
                    <h5>Tiêu hóa - Gan mật</h5>
                    <span class="thread-count ">396 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=vat-ly-tri-lieu-phuc-hoi-chuc-nang" class="" title="Vật lý trị liệu - Phục hồi chức năng">
                    <h5>Vật lý trị liệu - Phục hồi chức năng</h5>
                    <span class="thread-count ">371 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=co-xuong-khop" class="" title="Cơ Xương Khớp">
                    <h5>Cơ Xương Khớp</h5>
                    <span class="thread-count ">359 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=giai-phau-benh" class="" title="Giải phẫu bệnh">
                    <h5>Giải phẫu bệnh</h5>
                    <span class="thread-count ">359 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=than-kinh" class="" title="Thần kinh">
                    <h5>Thần kinh</h5>
                    <span class="thread-count ">325 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=truyen-nhiem" class="" title="Truyền nhiễm">
                    <h5>Truyền nhiễm</h5>
                    <span class="thread-count ">320 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=huyet-hoc-truyen-mau" class="" title="Huyết học - Truyền máu">
                    <h5>Huyết học - Truyền máu</h5>
                    <span class="thread-count ">291 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=noi-soi" class="" title="Nội soi">
                    <h5>Nội soi</h5>
                    <span class="thread-count ">284 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=kiem-soat-nhiem-khuan" class="" title="Kiểm soát nhiễm khuẩn">
                    <h5>Kiểm soát nhiễm khuẩn</h5>
                    <span class="thread-count ">228 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=thu-y" class="" title="Thú y">
                    <h5>Thú y</h5>
                    <span class="thread-count ">175 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=nam" class="" title="Nam khoa">
                    <h5>Nam khoa</h5>
                    <span class="thread-count ">154 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=tham-do-chuc-nang" class="" title="Thăm dò chức năng">
                    <h5>Thăm dò chức năng</h5>
                    <span class="thread-count ">138 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=lao-khoa" class="" title="Lão khoa">
                    <h5>Lão khoa</h5>
                    <span class="thread-count ">130 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=hiem-muon-vo-sinh" class="" title="Hiếm muộn - Vô sinh">
                    <h5>Hiếm muộn - Vô sinh</h5>
                    <span class="thread-count ">105 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=di-truyen-sinh-hoc-phan-tu" class="" title="Di truyền &amp; Sinh học phân tử">
                    <h5>Di truyền &amp; Sinh học phân tử</h5>
                    <span class="thread-count ">72 bác sĩ</span>
                </a>
            </dt>
            
            <dt>
                <a href="/danh-sach/bac-si/?specialities=di-ung-mien-dich" class="" title="Dị ứng - Miễn dịch">
                    <h5>Dị ứng - Miễn dịch</h5>
                    <span class="thread-count ">71 bác sĩ</span>
                </a>
            </dt>
            
        </dl>

        <div class="collapse-trigger">
            <span class="trigger-expand"><i class="fa fa-chevron-down"></i></span>
            <span class="trigger-collapse"><i class="fa fa-chevron-up"></i></span>
        </div>
    </section>

    
        <section class="top-list">
            <h3>Đáng quan tâm</h3>

            <ul>
                
                <li>
                    <a class="image" href="/tuyen-chon-bac-si/5-bac-si-dau-nganh-ve-chuyen-khoa-tim-mach-duoc-nhieu-nguoi-biet-den-tai-tp-ho-chi-minh-122/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/19_07_2016_04_14_22_302702.jpeg);" title="5 Bác sĩ đầu ngành về chuyên khoa tim mạch được nhiều người biết đến tại TP. Hồ Chí Minh"></a>

                    <div class="body">
                        <h4>
                            <a href="/tuyen-chon-bac-si/5-bac-si-dau-nganh-ve-chuyen-khoa-tim-mach-duoc-nhieu-nguoi-biet-den-tai-tp-ho-chi-minh-122/" title="5 Bác sĩ đầu ngành về chuyên khoa tim mạch được nhiều người biết đến tại TP. Hồ Chí Minh">
                                5 Bác sĩ đầu ngành về chuyên khoa tim mạch được nhiều người biết đến tại TP. Hồ Chí Minh
                            </a>
                        </h4>
                    </div>
                </li>
                
                <li>
                    <a class="image" href="/tuyen-chon-bac-si/5-tien-si-chuyen-khoa-chan-thuong-chinh-hinh-cot-song-tai-tphcm-1649/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/09_10_2016_07_56_38_002927.jpeg);" title="5 Tiến sĩ chuyên khoa chấn thương chỉnh hình cột sống tại TP.HCM "></a>

                    <div class="body">
                        <h4>
                            <a href="/tuyen-chon-bac-si/5-tien-si-chuyen-khoa-chan-thuong-chinh-hinh-cot-song-tai-tphcm-1649/" title="5 Tiến sĩ chuyên khoa chấn thương chỉnh hình cột sống tại TP.HCM ">
                                5 Tiến sĩ chuyên khoa chấn thương chỉnh hình cột sống tại TP.HCM 
                            </a>
                        </h4>
                    </div>
                </li>
                
                <li>
                    <a class="image" href="/tuyen-chon-bac-si/5-bac-si-nam-mat-tay-chuyen-khoa-san-tai-ha-noi-119/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/19_07_2016_03_51_50_142932.jpeg);" title="5 bác sĩ nam “mát tay” chuyên khoa sản tại Hà Nội"></a>

                    <div class="body">
                        <h4>
                            <a href="/tuyen-chon-bac-si/5-bac-si-nam-mat-tay-chuyen-khoa-san-tai-ha-noi-119/" title="5 bác sĩ nam “mát tay” chuyên khoa sản tại Hà Nội">
                                5 bác sĩ nam “mát tay” chuyên khoa sản tại Hà Nội
                            </a>
                        </h4>
                    </div>
                </li>
                
                <li>
                    <a class="image" href="/tuyen-chon-bac-si/5-bac-si-nam-mat-tay-chuyen-khoa-san-tai-tp-ho-chi-minh-155/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/19_07_2016_10_07_06_495082.jpeg);" title="5 bác sĩ nam “mát tay” chuyên khoa sản tại Tp. Hồ Chí Minh"></a>

                    <div class="body">
                        <h4>
                            <a href="/tuyen-chon-bac-si/5-bac-si-nam-mat-tay-chuyen-khoa-san-tai-tp-ho-chi-minh-155/" title="5 bác sĩ nam “mát tay” chuyên khoa sản tại Tp. Hồ Chí Minh">
                                5 bác sĩ nam “mát tay” chuyên khoa sản tại Tp. Hồ Chí Minh
                            </a>
                        </h4>
                    </div>
                </li>
                
                <li>
                    <a class="image" href="/tuyen-chon-bac-si/5-bac-si-phau-thuat-than-kinh-noi-tieng-tai-tp-hcm-243/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/04_08_2016_09_51_26_177372.jpeg);" title="5 bác sĩ phẫu thuật thần kinh nổi tiếng tại Tp. HCM"></a>

                    <div class="body">
                        <h4>
                            <a href="/tuyen-chon-bac-si/5-bac-si-phau-thuat-than-kinh-noi-tieng-tai-tp-hcm-243/" title="5 bác sĩ phẫu thuật thần kinh nổi tiếng tại Tp. HCM">
                                5 bác sĩ phẫu thuật thần kinh nổi tiếng tại Tp. HCM
                            </a>
                        </h4>
                    </div>
                </li>
                
                <li>
                    <a class="image" href="/tuyen-chon-bac-si/5-bac-si-chuyen-khoa-gay-me-hoi-suc-tai-tp-hcm-257/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/08_08_2016_10_52_09_263564.jpeg);" title="5 Bác sĩ chuyên khoa gây mê hồi sức tại TP. HCM"></a>

                    <div class="body">
                        <h4>
                            <a href="/tuyen-chon-bac-si/5-bac-si-chuyen-khoa-gay-me-hoi-suc-tai-tp-hcm-257/" title="5 Bác sĩ chuyên khoa gây mê hồi sức tại TP. HCM">
                                5 Bác sĩ chuyên khoa gây mê hồi sức tại TP. HCM
                            </a>
                        </h4>
                    </div>
                </li>
                
                <li>
                    <a class="image" href="/tuyen-chon-bac-si/5-bac-si-phau-thuat-than-kinh-noi-tieng-tai-ha-noi-245/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/04_08_2016_10_28_43_627148.jpeg);" title="5 bác sĩ phẫu thuật thần kinh nổi tiếng tại Hà Nội"></a>

                    <div class="body">
                        <h4>
                            <a href="/tuyen-chon-bac-si/5-bac-si-phau-thuat-than-kinh-noi-tieng-tai-ha-noi-245/" title="5 bác sĩ phẫu thuật thần kinh nổi tiếng tại Hà Nội">
                                5 bác sĩ phẫu thuật thần kinh nổi tiếng tại Hà Nội
                            </a>
                        </h4>
                    </div>
                </li>
                
                <li>
                    <a class="image" href="/tuyen-chon-bac-si/5-bac-si-nu-chuyen-khoa-tieu-hoa-gan-mat-tai-tphcm-1686/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/09_10_2016_18_20_10_092350.jpeg);" title="5 bác sĩ nữ chuyên khoa tiêu hóa gan mật tại Tp.HCM"></a>

                    <div class="body">
                        <h4>
                            <a href="/tuyen-chon-bac-si/5-bac-si-nu-chuyen-khoa-tieu-hoa-gan-mat-tai-tphcm-1686/" title="5 bác sĩ nữ chuyên khoa tiêu hóa gan mật tại Tp.HCM">
                                5 bác sĩ nữ chuyên khoa tiêu hóa gan mật tại Tp.HCM
                            </a>
                        </h4>
                    </div>
                </li>
                
                <li>
                    <a class="image" href="/tuyen-chon-bac-si/top-5-bac-si-tuoi-tre-tai-cao-chuyen-khoa-co-xuong-khop-tai-ha-noi-146/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/19_07_2016_09_01_17_254115.jpeg);" title="Top 5 Bác sĩ tuổi trẻ tài cao chuyên khoa cơ xương khớp tại Hà Nội"></a>

                    <div class="body">
                        <h4>
                            <a href="/tuyen-chon-bac-si/top-5-bac-si-tuoi-tre-tai-cao-chuyen-khoa-co-xuong-khop-tai-ha-noi-146/" title="Top 5 Bác sĩ tuổi trẻ tài cao chuyên khoa cơ xương khớp tại Hà Nội">
                                Top 5 Bác sĩ tuổi trẻ tài cao chuyên khoa cơ xương khớp tại Hà Nội
                            </a>
                        </h4>
                    </div>
                </li>
                
                <li>
                    <a class="image" href="/tuyen-chon-bac-si/5-pho-giao-su-chuyen-khoa-ho-hap-tai-tp-hcm-241/" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/04_08_2016_09_12_57_052447.jpeg);" title="5 Phó giáo sư chuyên khoa hô hấp tại TP. HCM"></a>

                    <div class="body">
                        <h4>
                            <a href="/tuyen-chon-bac-si/5-pho-giao-su-chuyen-khoa-ho-hap-tai-tp-hcm-241/" title="5 Phó giáo sư chuyên khoa hô hấp tại TP. HCM">
                                5 Phó giáo sư chuyên khoa hô hấp tại TP. HCM
                            </a>
                        </h4>
                    </div>
                </li>
                
            </ul>

            <a href="/tuyen-chon-bac-si/" class="view-more">Xem tất cả các tuyển chọn</a>
        </section>
    
</aside>

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


			
			<input name="csrfmiddlewaretoken" value="ZPSo31DHOOuFKv1BD8gTdDyX5aUmOfmU" type="hidden">
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

</body>

</html>


