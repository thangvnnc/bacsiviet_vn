@extends('main',['title'=> 'Danh sách thuốc'])
@section('thuoc','active');
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
					</ul>
					<h1>
						@if(request()->input('q')!==null)
						Tìm kiếm thuốc theo từ khóa "{{urldecode(request()->input('q'))}}"			
						@else
							Danh sách thuốc
						    @if(Session::has('province'))
						        </br>tại {{@$_COOKIE['province']}}
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
                <li>
                    <span>Tìm kiếm theo:</span>
                </li>
                
                <li>
                    <a href="/danh-sach/?q={{request()->input('q')}}">
                        Cơ sở y tế ({{$clinic or '0' }})
                    </a>
                </li>
                
                
                <li>
                    <a href="/danh-sach/bac-si/?q={{request()->input('q')}}" >
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
                    <a href="/thuoc/danh-sach/?q={{request()->input('q')}}" class="active">
                        Thuốc ({{$thuoc or '0'}})
                    </a>
                </li>
                
               
                
            </ul>
        </div>
    
    </div>
@endif

<div class="position">
	<div id="drug-list">
		<div class="content">
			
			<section id="drug-tab">
				<ul>
					<li>
						<a class="active" href="/thuoc/">Thuốc</a>
					</li>
				<!--	<li>
						<a href="/thuoc/duoc-chat/">Dược chất</a>
					</li>
					-->
				</ul>
			</section>			

			<section>
				<ul class="grid-layout">
					@foreach($medicines as  $medicine )						
					<li class="grid-item">
						<article>
							<h3>
								 <?php $tieude = App\Medicine::to_slug($medicine['description']);
								 		 ?>
								<a href="/thuoc/{{$tieude}}-{{$medicine['medicine_id'] }}">
								{{  $medicine['description']  }} </a>
							</h3>								
							<div class="cms">   
								{{  $medicine['production_company']  }}   {{  $medicine['manufacturer']  }} 
							</div>								
						</article>
 					</li>					
					@endforeach		
				</ul>
			</section>
			<div class="pagination">
        <div class="vh"></div>
        <span class="step-links">
            

           <!-- <span class="current">
                Trang 1 / 2
            </span> -->

            	{!! $medicines->appends(request()->input())->links(); !!}
               <!-- <a href="?page=2">Sau <i class="fa fa-chevron-right"></i></a> -->
            
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
<input name="csrfmiddlewaretoken" value="ZPSo31DHOOuFKv1BD8gTdDyX5aUmOfmU" type="hidden">
		</div>
@endsection
