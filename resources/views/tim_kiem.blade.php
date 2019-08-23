@extends('main',['title'=> 'Kết quả tìm kiếm'])


@section('content')
<div id="main">
			
			
			
<div id="page-title">
	<div class="background"></div>
	<div class="mask">
		<div class="position">
			<ul class="breadcrumbs">
				<li><a href="/">Trang chủ</a></li>
				<li class="active">Bệnh</li>
			</ul>

			<h1>
	Tìm kiếm bệnh theo từ khóa "{{ urldecode(app('request')->input('q')) }}"


<span class="weak"></span></h1>
		</div>
	</div>
</div>


    <div id="nav-search">
        <div class="position">
            <ul>
                <li>
                    <span>Tìm kiếm theo:</span>
                </li>
                
                <li>
                    <a href="/danh-sach/?q={{request()->input('q')}}">
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
                    <a href="/benh/tim-kiem/?q={{request()->input('q')}}" class="active">
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



<div class="position">
	<div id="disease-list">
		<div class="content">
			

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

						
						<div class="name-aliases">
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

			


    <div class="pagination">
        <div class="vh">1447 kết quả.</div>
        <span class="step-links">
            

            <span class="current">
            {!! $benh->appends(request()->input())->links()!!}


            </span>

            
            
            
        </span>
    </div>


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


			
			<input name="csrfmiddlewaretoken" value="nxGpdyB6qW5v4U9wW5aPImFEMbYkLLxu" type="hidden">
		</div>
		
@endsection