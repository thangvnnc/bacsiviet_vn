@extends('v2/view/en/en_main',['title'=> 'Disease'])
@section('en_content')
<script type="text/javascript">
	$(document).ready(function(){
		/**/
		checkResize();
		$(window).resize(function(event){
			let width = $(document).width(); 
			checkResize();
		});

		function checkResize(){
			let width = $(document).width();
			if(width > 639){
				$('.lists').off('click');
				$('.lists').find('.ls').show();
				
			}
			else{
				$('.lists').on('click',function(){
					let data_isshow = $(this).attr('data-isshow');
					if(data_isshow == 0){
						$(this).find('#show').hide();
						$(this).find('#hide').show();
						$(this).find('.ls').show();
						$(this).attr('data-isshow','1');
					
					}
					else{
						$(this).find('#show').show();
						$(this).find('#hide').hide();
						$(this).find('.ls').hide();
						$(this).attr('data-isshow','0');

					}
				});
			}
		}
		/**/
		$(".btn-scroll-to").on('click', function(event) {   
      let data_id = $(this).attr("data-id");  
      let scrollTo = $(data_id).offset().top - 90;
      $(window).scrollTop(scrollTo);      
    });
		
		
	
	});
</script>
<div class="container">
	<div id="top">
            <div class="background"></div>
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/en">Home</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="#">Disease</a></li>
                    </ul> 
                    
                </div>
               
                <div class="row">
                    <div class="col-md-3">
                        <h1 style="font-size: unset;">                
                            @if(request()->input('q')!==null)
                            Search for a doctor by keyword "{{urldecode(request()->input('q'))}}"         
                            @else
                                Disease list

                                @if(Session::has('province'))
                                    </br>in <span class="province_name">{{@$_COOKIE['province']}}</span>
                                @endif
                            @endif
                            <span class="weak"></span>
                        </h1> 
                    </div>
                
                </div>
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
        @endif
        <br>
    <div class="sick">
        <div class="content">
            <section class="scroll-link">
                <h3>Look up alphabetically</h3>
                <ul>
                      @foreach(range('A','Z') as $char) 
                        <li>
                            
                                <a class="btn-scroll-to" data-id="#{{$char}}" class="active">{{$char}}</a>
                            
                        </li>
                       @endforeach
                </ul>
            </section>

            <section class="disease-body lss collapsible-container collapsible-block">
                <h3 class="collapse-trigger">The most sought-after disease</h3>
                <ul class="collapsible-target">
                        @foreach($benh_view as $view)
                        <?php $tieude = App\Disease::to_slug($view['name']);
                                             ?>
                        <li><a href="/en/benh/{{$tieude}}-{{$view['disease_id']}}">{{$view->name}}</a></li>
                        @endforeach
                </ul>
            </section>
                    

                @foreach(range('A','Z') as $char)
                    <section id="{{$char}}" class="lists" data-isshow="0">
                        <h3 class="collapse-trigger">{{$char}}<i id="show" class="fa fa-angle-right" aria-hidden="true"></i><i id="hide" class="fa fa-angle-down" aria-hidden="true"></i></h3>

                        <ul class="collapsible-target ls">
                                <?php $benhs = App\Disease::where('disease_name','LIKE',''.$char.'%')->distinct()->get(); ?>
                                @foreach($benhs as $benh)
                              
                                 <?php $tieude = App\Disease::to_slug($benh->disease_name);
                                             ?>
                                <li><a href="/en/benh/{{$tieude}}-{{$benh['disease_id']}}">{{$benh->disease_name}}</a></li>
                                @endforeach
                            
                        </ul>

                        <span class="back-to-top smooth-scroll-link">
                            <a class="btn-scroll-to" data-id="#top" class="active">
                                Return to the top
                                <i class="fa fa-arrow-circle-up" aria-hidden="true"></i>
                            </a>
                        </span>
                    </section>
                @endforeach
        </div>
    	
	</div>
</div>
@endsection