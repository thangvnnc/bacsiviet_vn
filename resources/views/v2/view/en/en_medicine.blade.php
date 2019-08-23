@extends('v2/view/en/en_main',['title'=> 'Medicine'])
<br><br><br>
@section('en_content')


	<section section-top>
	<div class="container">
		<div class="background"></div>
	    <div class="row">
	        <div class="col-md-12 ">
	            <ol class="breadcrumb">
	                <li><a href="/">Home</a></li>
	                <li>&nbsp;>&nbsp;</li>
	                <li><a href="">Medicine list</a></li>
	            </ol>
	        </div>
	    </div>
	    
	    <div class="row">
	    	<div class="col-md-3">
	    		<h1 style="font-size: unset;">
					@if(request()->input('q')!==null)
						Search for drugs by keywords "{{urldecode(request()->input('q'))}}"
					@else
						Drug list
					    @if(Session::has('province'))
					        </br>in {{@$_COOKIE['province']}}
					    @endif
					@endif			
								
				</h1>
	    	</div>
	    </div>
	    
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
	                    <a href="/en/danh-sach-nha-thuoc/?q={{request()->input('q')}}" >
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
                    <a href="/en/thuoc-danhsach/?q={{request()->input('q')}}" class="active">
                        Medicine ({{$thuoc or '0'}})
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