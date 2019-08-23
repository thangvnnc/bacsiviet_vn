@extends('v2/view/en/en_main',['title'=> 'Drugstore'])
@section('en_content')
<div class="main-A">
	<div id="top">
        <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/en">Home</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="/en/danh-sach-nha-thuoc">Drugstore list</a></li>
                    </ul> 
                    
                </div>
                <h1 style="font-size: 18px;">
				    @if(request()->input('q')!==null)
					Search drugstore by keyword "{{urldecode(request()->input('q'))}}"			
					@else
						Drugstore list
					    @if(Session::has('province'))
					        </br>in <span class="province_name">{{@$_COOKIE['province']}}</span>
					    @endif
				    @endif

                </h1>
          </div> 
            
	 </div><!-- #top -->
	 <br>
        @if(request()->input('q')!==null)
             <div id="search">  
            <ul>
                <li>
                    <span>Search by:</span>
                </li>
                
                <li>
                    <a href="/en/danhsach-phongkham/?q={{request()->input('q')}}">
                        Clinic ({{$clinic or '0' }})
                    </a>
                </li>

                 <li>
	                    <a href="/en/danh-sach-nha-thuoc/?q={{request()->input('q')}}" class="active" >
	                        Drugstore ({{$drugstore or '0' }})
	                    </a>
	            </li>
	            
                <li>
                    <a href="/en/danh-sach-bac-si/?q={{request()->input('q')}}">
                        Doctors ({{$doctor or '0'}})
                    </a>
                </li>
                  <li>
                    <a href="/en/hoibacsi/danhsach/?q={{request()->input('q')}}">
                        Ask doctor ({{$question or '0'}})
                    </a>
                </li>
                <li>
                    <a href="/en/benh/tim-kiem/?q={{request()->input('q')}}" >
                        Diseace ({{$count or '0'}})
                    </a>
                </li>
                
                <li>
                    <a href="/en/thuoc-danhsach/?q={{request()->input('q')}}">
                        Medicine ({{$thuoc or '0'}})
                    </a>
                </li>
                
               
                
            </ul>
        
    </div><!-- #Nav search -->
        @endif
        <br>
	 <div class="cnt-nthuoc">
		<div id="filter-summarys">
			<form class="form-inline" action="/en/danh-sach-nha-thuoc/" method="get">
				<div class="form-group">
					<select name="province" id="province" >
						<?php $province = App\Province::all();
						$select = request()->input('province');?>

						<option value="">Country</option>
						@foreach($province as $pr)
							<option value="{{$pr->id}}" @if($pr->id==$select)selected="selected" @endif>{{$pr->name}}</option>
						@endforeach

					</select>
				</div>


				<button type="submit" class="submit-nt">Fitler search</button>
			</form>

			<script type="text/javascript">
			function province_change(){
			//alert('aaa');
				var id=$("#province").val();
				var dataString = 'province='+id+'&_token=<?php echo e(csrf_token()); ?>';
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
		</div>
		<ul>
			@if(isset($drugstores))
			@foreach($drugstores as $cl)
				
					<li class="has-actions has-map-marker" data-map-marker="29068">
						<div class="media">
							<a href="/en/nha-thuoc/{{$cl->drugstore_url}}" class="hero-image"
								style="background-image: url({{url('public/images/health_facilities/'.$cl->profile_image)}});width:150px;height:150px;display: block;background-size: contain;background-repeat: no-repeat;background-position: center;">
							</a>
							

						</div>

						<div class="body">
							<div class="info">
								<h2>
									<a href="/en/nha-thuoc/{{$cl->drugstore_url}}">{{$cl->drugstore_name}}</a>


									
										<span class="verified-badge has-tooltip">
											<em style="text-transform: uppercase;">Offical</em>
										
										</span>
									
								</h2>

								
									<div class="desc">
									@if(strlen($cl->drugstore_desc)>200)
										{{substr( $cl->drugstore_desc, 0, strpos($cl->drugstore_desc, ' ', 200) )}}...
										<a class="readmore" href="/en/nha-thuoc/{{$cl->drugstore_url}}">Show more <i class="fa fa-angle-double-right"></i></a>
									@else
										{{$cl->drugstore_desc}}
										<a class="readmore" href="/en/nha-thuoc/{{$cl->drugstore_url}}">show more <i class="fa fa-angle-double-right"></i></a>
									@endif
									</div>
								

								<dl class="brief">

									
										<dt><i class="fa fa-map-marker"></i></dt>
										<dd>
											{{$cl->drugstore_address}}
										</dd>
										<span>Describe : <b style="color: #4080ff;">{{$cl->drugstore_desc}}</b></span><br>
										<span>Phone : <b style="color: #4080ff;">0{{$cl->drugstore_phone}}</b></span>
								</dl>

								
									
							</div>


						</div>

						<div class="actions" style="display: none;" id="contact-29068">
							
								<div class="inner">
									<div class="booking">
										<p>Select the doctor and now you want to book from the calendar below. For advice on choosing a doctor, you can chat with us on this website or call us at <a href="tel✓473006008"> 0473 006 008 </a>.</p>
										<div class="form-row" >
											<div class="form-field">
												<label>Visit the doctor:</label>
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
	  <div class="pagination" style="margin-left: 15%">
        <span class="step-links">
   		{!! $drugstores->appends(request()->input())->links(); !!}
        </span>
    </div>
	 </div><!--Content nhà thuốc-->
</div>
@endsection