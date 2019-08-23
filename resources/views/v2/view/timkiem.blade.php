@extends('v2/structor/main',['title'=> 'Tìm kiếm'])
@section('content')
<div class="container">

	<div id="top">
            <div class="background"></div>
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href=""></a></li>
                    </ul> 
                    
                </div>
                <h1 style="font-size: unset;">
                	Tìm kiếm bệnh theo từ khóa "{{ urldecode(app('request')->input('q')) }}"
                </h1>
            </div> 
	</div><!--#top-->
	<br>
	 <div id="search">
        
            <ul>
                <li>
                    <span>Tìm kiếm theo:</span>
                </li>
                
                <li>
                    <a href="/danhsach-phongkham/?q={{request()->input('q')}}">
                        Phòng khám ({{$clinic or '0' }})
                    </a>
                </li>

                 <li>
	                    <a href="/danh-sach-nha-thuoc/?q={{request()->input('q')}}" >
	                        Nhà thuốc ({{$drugstore or '0' }})
	                    </a>
	            </li>
	            
                <li>
                    <a href="/danh-sach-bac-si/?q={{request()->input('q')}}">
                        Bác sĩ ({{$doctor or '0'}})
                    </a>
                </li>
                  <li>
                    <a href="/hoibacsi/danhsach/?q={{request()->input('q')}}">
                        Hỏi bác sĩ ({{$question or '0'}})
                    </a>
                </li>
                <li>
                    <a href="/benh/tim-kiem/?q={{request()->input('q')}}" class="active">
                        Bệnh ({{$count or '0'}})
                    </a>
                </li>
                
                <li>
                    <a href="/thuoc-danhsach/?q={{request()->input('q')}}">
                        Thuốc ({{$thuoc or '0'}})
                    </a>
                </li>
                
               
                
            </ul>
        
    </div><!-- #Nav search -->
    <div class="inf">
		<div id="disease-list">
			<div class="content tk">
				<ul>
					@if(count($benh))
					  @foreach($benh as $b)
					<li>
						<article>
							
							<a href="/benh/{{App\Deals::strtoUrl($b->disease_name)}}-{{$b->disease_id}}/" class="image" @if($b->disease_image!=="") style="background-image: url({{$b->disease_image}});" @endif></a>
							

							<h3><a href="/benh/{{App\Deals::strtoUrl($b->disease_name)}}-{{$b->disease_id}}/">{{$b->disease_name}}</a></h3>

							<div class="post-meta-data">
								
								<span>
									Chuyên khoa:
									
										<a href="" title="">{{$b->speciality->speciality_name or null}}</a>
									
							
									
								</span>
								
							</div>

							
							<div class="">
								<p>
									Các tên gọi khác của bệnh này:

									
										<span>{{$b->disease_alias}}</span>
									
								</p>
							</div>
							

							<div class="body">
								{!!$b->overview!!}
							</div>
						</article>
					</li>
					@endforeach
					@endif
			</ul>
			
		</div>
	</div>
</div>
<div class="pagination">
	            <span >
	                {!! $benh->appends(request()->input())->links(); !!}
	            </span>
	        </div>
</div>
@endsection