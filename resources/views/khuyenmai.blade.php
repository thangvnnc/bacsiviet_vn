
@extends('main',['title'=>'Danh sách khuyến mãi'])
@section('khuyen-mai','active')
@section('content')
 <div id="main">
			
			
			
<div id="page-title" class="no-background">
	<div class="mask">
		<div class="position">
			<ul class="breadcrumbs">
				<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="/" itemprop="url"><span itemprop="title">Trang chủ</span></a>
				</li>
				<li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
					<a href="/khuyen-mai/" itemprop="url"><span itemprop="title">Khuyến mãi</span></a>
				</li>
			</ul>
			<h1>
				
	Danh sách khuyến mãi

	<span class="weak">


</span>

			</h1>
		</div>
	</div>
</div>

<div class="promotion-filter position">
	<div class="content">
		<div class="promotion-category">
			<ul>
				<li>
					<a href="/khuyen-mai/" class="@if(empty(app('request')->input('categories'))) active @endif">nổi bật nhất</a>
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
		
			

<div id="filter-cta">
	<a class="button secondary weak activator" href="#filter-summary">
		<i class="fa fa-filter fa-fw" aria-hidden="true"></i><span class="active">Ẩn bộ lọc</span><span class="inactive">Lọc danh sách</span>
	</a>
	
</div>

<div id="filter-summary" style="display: none;">
		
			<a href="#tab-provinces" class="has-icon icon-provinces" data-track-path="/danh-sach/loc/provinces" title="Lọc danh sách cơ sở y tế theo Tỉnh thành">
				
					Tỉnh thành
				
			</a>
		
			<a href="#tab-districts" class="has-icon icon-districts" data-track-path="/danh-sach/loc/districts" title="Lọc danh sách cơ sở y tế theo Quận huyện">
				
					Quận huyện
				
			</a>
		
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

		
	</div>
</div>

<div id="promotion-list">
	<div class="position">
		
		<div class="grid-layout" style="position: relative; height: 2285.1px;">
			
			@if(isset($deals))
			  @foreach($deals as $deal)
				<div class="grid-item" style="float:left;min-height:490px;">
					


<a class="promotion-list-item" href="/khuyen-mai/{{\App\Deals::strtoUrl($deal->deal_title)}}-{{$deal->deal_id}}" title="{{$deal->deal_title}}">
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
				
				<!-- 	<span href="?provinces=ha-noi">Hà Nội</span> -->
				
			</div>
		

		<button class="promotion-button button">
			Xem ngay
		</button>
	</div>

	<div class="body">
		<h3 class="promotion-title">
			{{$deal->deal_title}}
			
				<span class="cms-comment-count">
					<!-- <i class="fa fa-comment-o"></i> 15 -->
				</span>
			
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
				<span>HotLine:<span class="currency"></span></span>
				<span class="new-price" style="color: #2B96CC;">{{$hl->content}}<span class="currency"></span></span>
				
					<span class="cms-comment-count">
						<!-- <i class="fa fa-comment-o"></i> 15 -->
					</span>
				
			</h3>
		</div>

		<div class="date-hits">
			
				<div class="date">
					<i class="fa fa-clock-o fa-fw" aria-hidden="true"></i>
					
						
							
						Thời hạn: {{$deal->end_time}}
						
					
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
			<div style="text-align: center;">Không tìm thấy khuyến mãi</div>
			@endif


    <div class="pagination">
        <div class="vh">.</div>
        <span class="step-links">
            

                {!! $deals->links(); !!}
        
        </span>
    </div>



	</div>
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

				<form method="post" action="https://vicare.vn/dang-nhap/?next=/uu-dai/" name="login">
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
						<button type="button" name="facebook" data-link="https://vicare.vn/tai-khoan/ket-noi/login/facebook/?next=/uu-dai/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng nhập qua Facebook</button>
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

				<form method="post" action="https://vicare.vn/dang-ky/?next=/uu-dai/" name="signup">
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
						<button type="button" name="facebook" data-link="https://vicare.vn/tai-khoan/ket-noi/login/facebook/?next=/uu-dai/" class="button-facebook"><i class="fa fa-facebook" aria-hidden="true"></i> Đăng ký qua Facebook</button>
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
		</div>
@endsection
