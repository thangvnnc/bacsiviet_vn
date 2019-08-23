@extends('main')

@section('bac-si','active');
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
								<a href="/danh-sach/bac-si/" itemprop="url"><span itemprop="title">Bác sĩ</span></a>
							</li>
						</ul>
						<h1>				
							@if(request()->input('q')!==null)
							Tìm kiếm bác sĩ theo từ khóa "{{urldecode(request()->input('q'))}}"			
							@else
								Danh sách bác sĩ

							    @if(Session::has('province'))
							        </br>tại <span class="province_name">{{@$_COOKIE['province']}}</span>
							    @endif
						    @endif
							<span class="weak"></span>
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
                @if(request()->input('key') == 'city')
                <li>
                    <span>Kết quả tìm kiếm theo địa chỉ  <b style="color:red;">{{request()->input('q')}}</b> có :</span>    
                </li>              
                <li>
                    <a href="/danh-sach/bac-si?q={{request()->input('q')}}&key=city" class="active">
                        Bác sĩ ({{$doctor or '0'}})
                    </a>
                </li>
                @endif
                @if(request()->input('key') == 'specialities')
                <li>
                    <span>Kết quả tìm kiếm theo chuyên khoa  <b style="color:red;">{{$speciality->speciality_name}}</b> có :</span>    
                </li>              
                <li>
                    <a href="/danh-sach/bac-si?q={{request()->input('q')}}&key=specialities" class="active">
                        Bác Sĩ ({{$doctor or '0'}})
                    </a>
                </li>
                @endif
                
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
							<option value="{{$pr->id}}" @if($pr->id==$select)selected="selected" @endif>{{$pr->name}}</option>
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
				<button type="submit" class="btn btn-default btnSearch">Lọc kết quả</button>
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
							<!-- <a href="/danh-sach/bac-si/{{$dr->doctor_url}}-{{$dr->doctor_id}}/" class="hero-image" 
								style="background-image: url({{url('public/images/doctor/'.$dr->profile_image)}});width:150px;height:150px;display: block;background-size: contain;background-repeat: no-repeat;background-position: center;">
							</a> -->

							<a href="/danh-sach/bac-si/{{$dr->doctor_url}}-{{$dr->doctor_id}}/" class="hero-image" 
                        style="background-image: url(

                        <?php
                            if (strlen(strstr("$dr->profile_image", "https://dwbxi9io9o7ce.cloudfront.net")) > 0) {
                                echo "$dr->profile_image";
                            }
                            else{
                                echo "https://medixlink.com/public/images/doctor/$dr->profile_image";
                            }
                            
                         ?>
                        


                        );width:150px;height:150px;display: block;background-size: contain;background-repeat: no-repeat;background-position: center;">                                             
                    </a>
							
							 {{----}}
								{{--<a href="/danh-sach/bac-si/{{$dr->doctor_url}}-{{$dr->doctor_id}}/nha-khoa-tong-quat#nhan-xet" class="comments-summary " title="0 hài lòng, 2 nhận xét, 0 câu trả lời, 0 cảm ơn">--}}
									{{----}}
										{{--<span class="like-count">--}}
											{{--<i class="fa fa-thumbs-o-up"></i> 0--}}
										{{--</span>--}}
										{{--<span class="comment-count">--}}
											{{--<i class="fa fa-comment-o"></i> 2--}}
										{{--</span>--}}
									{{----}}
									{{----}}
								{{--</a>--}}
							
						</div>
						<div class="body">
							<div class="info">
								<h2>
							<a style="color:#2fa4e7;" href="/danh-sach/bac-si/{{$dr->doctor_url}}-{{$dr->doctor_id}}/{{$dr->doctorspeciality->speciality->specialty_url or null}}">{{$dr->doctor_name}}</a>
						</h2>

						<div class="desc">
							
							@if(!empty($dr->doctor_description)|| $dr->doctor_description!='')
                                {{$dr->doctor_description}}
							@if(strlen($dr->doctor_description)>200 && strpos($dr->doctor_description, ' ', 200)!="")
							{!!substr( $dr->doctor_description, 0, strpos($dr->doctor_description, ' ', 200) )!!}
							
								<a class="readmore" href="/danh-sach/bac-si/{{$dr->doctor_url}}-{{$dr->doctor_id}}/{{$dr->doctorspeciality->speciality->specialty_url or null}}">Xem tiếp <i class="fa fa-angle-double-right"></i></a>
							@endif
							@endif
							</div>

							<dl class="brief" style="font-size: 13px;">
							

							
								{{--<dt>--}}
									{{--<i class="fa fa-stethoscope"></i>--}}

								{{--</dt>--}}

								{{--<dd>--}}
                                    {{--<b style="color:#555555;">Chuyên Khoa: </b>--}}
									{{--@foreach($dr->specialities as $spec)--}}
										{{--<a style="color:#2fa4e7;font-size: 14px;" href="/danh-sach/bac-si/?q={{$spec->speciality->specialty_url}}&key=specialities">--}}
                                            {{--@if(strlen(strstr($spec->speciality->specialty_url, request()->input('q'))) > 0)--}}
                                        {{--<b style="color:red;font-size: 14px;">{{$spec->speciality->speciality_name}}</b>--}}
                                            {{--@else--}}
                                                {{--{{$spec->speciality->speciality_name}}--}}
                                            {{--@endif--}}
                                        {{--</a>--}}
									   {{--@if($spec!==$dr->specialities->last()),--}}
									   {{--@endif--}}
									{{--@endforeach--}}
								{{--</dd>--}}
                                <br/>
                                <hr/>

                                <dt>
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </dt>
                                <dd>
                                    <b style="color:#555555;">Địa Chỉ: </b>
                                    <a style="color:#2fa4e7;font-size: 14px;" href="/danh-sach/bac-si/?q={{$dr->doctor_address}}&key=city">
                                                @if(strtolower(request()->input('q')) == strtolower($dr->doctor_address))
                                                    <b style="color:red; font-size: 14px;">{{$dr->doctor_address}}</b>
                                                @else 
                                                    {{$dr->doctor_address}}
                                                @endif
                                    </a>
                                </dd>
							     <br/>
								<hr/>
							
								<dt>
									<i class="fa fa-hospital-o"></i>
								</dt>
								<dd>
									<b style="color:#555555;float:left;margin-right:2px;">Nơi Công Tác: </b><div style="float:left;color: #2fa4e7; font-size: 12px;"> {!!$dr->doctor_clinic!!}</div>
								     <!-- @foreach($dr->clinics as $cs)		
											<a href="/co-so-y-te/{{$cs->clinic->clinic_url}}-{{$cs->clinic->clinic_id}}">{{$cs->clinic->clinic_name}}</a>
										@if($cs!== $dr->clinics->last())
										,
										@endif	
									
									 @endforeach -->
									

								</dd>
							
						</dl>
							<!-- <br /> -->
                        <hr />

                        <a href="https://medixlink.com/messages" class="button secondary" title="Chat với {{$dr->doctor_name}}">
                        	Chat Với {{$dr->doctor_name}}
                            <!-- <?php 
                                $us = App\Users::where('user_id',$dr->user_id)->get(); 
                                foreach($us as $u) : ?>
                                    <div id="cometchat_userlist_{{$u->user_id}}" class="cometchat_userlist" onmouseover="jqcc(this).addClass('cometchat_userlist_hover');" onmouseout="jqcc(this).removeClass('cometchat_userlist_hover');" amount="0"><span class="cometchat_userscontentavatar"></span><div class="cometchat_chatboxDisplayDetails"><div class="cometchat_userdisplayname"> Chát Với {{$dr->doctor_name}}</div><span id="cometchat_buddylist_typing_{{$u->user_id}}" class="cometchat_buddylist_typing"></span><span class="cometchat_userscontentdot cometchat_away"></span><div class="cometchat_userdisplaystatus"></div></div><span class="cometchat_msgcount"><div class="cometchat_msgcounttext" style="display:none;">0</div></span></div>
                                <?php endforeach ?> -->
                           
                            
                        </a>
                        <span style="margin-left:25px;" class="cometchat_userscontentavatar"> Giờ làm việc: <b style="color: #2fa4e7;">{{$dr->doctor_timework}}</b></span>

							</div>
							<div class="call-to-action">


								{{--<a href="#" class="sticky-nav-link action-favourite secondary weak button " title="Thêm vào ghi nhớ" data-professional-id="20143">--}}
									{{--<i class="fa fa-spinner fa-pulse loader"></i>--}}
									{{--<span class="added">--}}
										{{--<i class="fa fa-heart" aria-hidden="true"></i>--}}
									 	{{--Đã ghi nhớ--}}
									{{--</span>--}}
									{{--<span class="unadded">--}}
										{{--<i class="fa fa-heart-o" aria-hidden="true"></i> Ghi nhớ--}}
									{{--</span>--}}
								{{--</a>--}}
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

		

<!-- <aside>
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
                @if(isset($news_popular) && count($news_popular) > 0)
                @foreach($news_popular as $key => $val)
                <li>
                    <a class="image" href="{{url('bai-viet/'.$val->article_id)}}" 
                        style="background-image: url({{url('public/images/'.$val->image)}})" 
                        title="{{$val->article_title}}">                        
                    </a>

                    <div class="body">
                        <h4>
                            <a href="{{url('bai-viet/'.$val->article_id)}}" 
                                title="{{$val->article_title}}">
                                {{$val->article_title}}
                            </a>
                        </h4>
                    </div>
                </li>
                @endforeach
                @endif                
            </ul>

            <a href="{{url('bai-viet')}}" class="view-more">
                Xem tất cả bài viết
                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </a>
        </section> -->

   <aside>     
    	<section class="top-list" style="border: none;padding: 0;">
        <style>
            .mySlides {display:none;}
        </style>
        <div class="w3-content">
            @foreach($ads as $a)
                <a href="{{$a->url}}">
                    <img class="mySlides" src="{{$a->image}}" style="width:100%;height:500px;"></a>
            @endforeach
          
        </div>

        <script>
        var slideIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
              x[i].style.display = "none"; 
            }
            slideIndex++;
            if (slideIndex > x.length) {slideIndex = 1} 
            x[slideIndex-1].style.display = "block"; 
            setTimeout(carousel, 2000); 
        }
        </script> 
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
       
@endsection       


