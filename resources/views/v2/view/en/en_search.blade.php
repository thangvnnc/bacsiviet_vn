@extends('v2/view/en/en_main',['title'=> 'Search'])
@section('en_content')
<div class="container">

	<div id="top">
            <div class="background"></div>
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/en">Home</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="">Search</a></li>
                    </ul> 
                    
                </div>
                <h1 style="font-size: unset;">
                	Search for disease by keyword "{{ urldecode(app('request')->input('q')) }}"
                </h1>
            </div> 
	</div><!--#top-->
	<br>
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
                    <a href="/en/benh/tim-kiem/?q={{request()->input('q')}}" class="active">
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
    <div class="inf">
		<div id="disease-list">
			<div class="content tk">
				<ul>
					@if(count($benh))
					  @foreach($benh as $b)
					<li>
						<article>
							
							<a href="/en/benh/{{App\Deals::strtoUrl($b->disease_name)}}-{{$b->disease_id}}/" class="image" @if($b->disease_image!=="") style="background-image: url({{$b->disease_image}});" @endif></a>
							

							<h3><a href="/en/benh/{{App\Deals::strtoUrl($b->disease_name)}}-{{$b->disease_id}}/">{{$b->disease_name}}</a></h3>

							<div class="post-meta-data">
								
								<span>
									Specialist:
									
										<a href="" title="">{{$b->speciality->speciality_name or null}}</a>
									
							
									
								</span>
								
							</div>

							
							<div class="">
								<p>
									Other names of this disease:

									
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