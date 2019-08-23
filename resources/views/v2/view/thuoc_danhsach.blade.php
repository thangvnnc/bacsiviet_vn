@extends('v2/structor/main',['title'=> 'Thuốc'])
<br><br><br>
@section('content')


	<section section-top>
	<div class="container">
		<div class="background"></div>
	    <div class="row">
	        <div class="col-md-12 ">
	            <ol class="breadcrumb">
	                <li><a href="/">Trang chủ</a></li>
	                <li>&nbsp;>&nbsp;</li>
	                <li><a href="">Danh sách thuốc</a></li>
	            </ol>
	        </div>
	    </div>
	    
	    <div class="row">
	    	<div class="col-md-3">
	    		<h1 style="font-size: unset;">
					@if(request()->input('q')!==null)
						Tìm kiếm thuốc theo từ khóa "{{urldecode(request()->input('q'))}}"
					@else
						Danh sách thuốc
					    @if(Session::has('province'))
					        </br>tại {{@$_COOKIE['province']}}
					    @endif
					@endif			
								
				</h1>
	    	</div>
	    </div>
	    
	    @if(request()->input('q')!==null)
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
                    <a href="/benh/tim-kiem/?q={{request()->input('q')}}" >
                        Bệnh ({{$count or '0'}})
                    </a>
                </li>
                
                <li>
                    <a href="/thuoc-danhsach/?q={{request()->input('q')}}" class="active">
                        Thuốc ({{$thuoc or '0'}})
                    </a>
                </li>
                
               
                
            </ul>
        
    		</div><!-- #Nav search -->
		@endif
	    <div class="row thuoc">
	    	@foreach($medicines as  $medicine )
                <div class="col-md-4  medic">
                	<ul>
                		<li>
                			<?php $tieude = App\Medicine::to_slug($medicine['description']);
								 		 ?>
								<a href="/thuoc-chitiet/{{$tieude}}-{{$medicine['medicine_id'] }}">
								{{  $medicine['description']  }} </a>
                    		<p>{{  $medicine['production_company']  }}   {{  $medicine['manufacturer']  }} </p>
                		</li>
                	</ul>
                </div>
             @endforeach	
	    </div>
	    <div class="row" >
	    	<div class="col-md-2"></div>
	    	<div class="col-md-4 pagination">
	    		<span >
			    	{!! $medicines->appends(request()->input())->links(); !!}
			 	</span>
	    	</div>
	    	
	    </div>
	</div>
	</section>


@endsection