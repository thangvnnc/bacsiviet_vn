@extends('main')
@section('co-so-y-te','active');
@section('content')

    <div id="main">

        <div class="container">
            <div class="row">

                <div id="page-title">
                    <div class="background"></div>
                    <div class="mask">
                        <div class="position">
                            <ul class="breadcrumbs">
                                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                                    <a href="/" itemprop="url"><span itemprop="title">Trang chủ</span></a>
                                </li>
                                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                                    <a href="/danh-sach/" itemprop="url"><span itemprop="title">Danh sách nhà thuốc</span></a>
                                </li>


                            </ul>
                            <h1>
                                @if(request()->input('q')!==null)
                                    Tìm kiếm phòng khám theo từ khóa "{{urldecode(request()->input('q'))}}"
                                @else
                                    Danh sách nhà thuốc
                                    @if(Session::has('province'))
                                    </br>tại <span class="province_name">{{@$_COOKIE['province']}}</span>
                                @endif
                                @endif

                                <span class="weak">
	

	
	

	

	


</span>

                            </h1>
                        </div>
                    </div>
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
                                Cơ sở y tế ({{$drugstore or '0' }})
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
                            <a href="/benh/tim-kiem/?q={{request()->input('q')}}">
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
                            <i class="fa fa-filter fa-fw" aria-hidden="true"></i><span
                                    class="active">Ẩn bộ lọc</span><span class="inactive">Lọc danh sách</span>
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
			@if(isset($drugstores))
			@foreach($drugstores as $cl)

					<li class="has-actions has-map-marker" data-map-marker="29068">
						<div class="media">
							<a href="/nha-thuoc/{{$cl->drugstore_url}}" class="hero-image"
								style="background-image: url({{url('public/images/health_facilities/'.$cl->profile_image)}});width:150px;height:150px;display: block;background-size: contain;background-repeat: no-repeat;background-position: center;">
							</a>


						</div>

						<div class="body">
							<div class="info">
								<h2>
									<a href="/nha-thuoc/{{$cl->drugstore_url}}">{{$cl->drugstore_name}}</a>



										<span class="verified-badge has-tooltip">
											<em>Chính thức</em>
											<span class="tooltip">Thông tin trực tiếp quản lý bởi  Khoa Khám chữa bệnh theo yêu cầu - Bệnh viện Đại học Y Hà Nội</span>
										</span>

								</h2>


									<div class="desc">
									@if(strlen($cl->drugstore_desc)>200)
										{{substr( $cl->drugstore_desc, 0, strpos($cl->drugstore_desc, ' ', 200) )}}...
										<a class="readmore" href="/nha-thuoc/{{$cl->drugstore_url}}">Xem tiếp <i class="fa fa-angle-double-right"></i></a>
									@else
										{{$cl->drugstore_desc}}
										<a class="readmore" href="/nha-thuoc/{{$cl->drugstore_url}}">Xem tiếp <i class="fa fa-angle-double-right"></i></a>
									@endif
									</div>


								<dl class="brief">


										<dt><i class="fa fa-map-marker"></i></dt>
										<dd>
											{{$cl->drugstore_address}}
											<span class="distance-to-user ">
												(cách
												<span data-lat="21.004435" data-lon="105.830803">

												</span> km)
											</span>
										</dd>







										<span>Mô tả : <b style="color: #4080ff;">{{$cl->drugstore_desc}}</b></span><br>
										<span>Số điện thoại : <b style="color: #4080ff;">0{{$cl->drugstore_phone}}</b></span>
								</dl>



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


<div id="subscribe" style="display: none;">
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
@endsection

