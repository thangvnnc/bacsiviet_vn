@extends('v2/structor/main',['title'=> 'Bệnh chi tiết'])
@section('content')
<script type="text/javascript">
	$(document).ready(function(){

		checkResize();
		$(window).resize(function(e){
			checkResize();
		});

		function checkResize(){
			let width = $(document).width();
			if(width > 639){
				$('.scb').off('click');
				$('.scb').find('.b1').show();
			}
			else{
				$('.scb').on('click',function(){
					let data_isshow = $(this).attr('data-isshow');
					if(data_isshow == 0){
						 $(this).find('#show').hide();
            			$(this).find('#hide').show();
						$(this).find('.b1').show();
						$(this).attr('data-isshow','1');
					}
					else{
						$(this).find('#show').show();
             			$(this).find('#hide').hide();
						$(this).find('.b1').hide();
						$(this).attr('data-isshow','0');
					}
				});
			}
			
		}
		
		$(".btn-scroll-to").on('click', function(event) {   
	      let data_id = $(this).attr("data-id");  
	      let scrollTo = $(data_id).offset().top - 90;
	      $(window).scrollTop(scrollTo);      
	    });

        $('ul li a').on('click',function(){
            $('li a').removeClass('active');
            $(this).addClass('active');
        });

           /*Silder*/
        let img = $('.scb').find('.b1 .media #hero-image').find('.item');
        let img_lg = img.length;
        console.log(img_lg);
        let width_img = img_lg*250;
        console.log(width_img);
        $('#hero-image').css('width',width_img+'px');
        var interval;
        let margin_left = 0;
        let max_slider = width_img -250;

        function startSlider(){
            interval = setInterval(function(){
                margin_left-=250;
                if(margin_left < -max_slider){
                    margin_left = 0;
                }
                $('#hero-image').animate({'margin-left': margin_left +'px','trasition': 'margin-left 800ms ease 0s'},1000);
            },3000)
        }
        function stopSlider(){
            clearInterval(interval);
        }
       $('.media').on('mouseenter',stopSlider).on('mouseleave',startSlider);
       startSlider();
      
       $('#hero-carousel .item a').on('click',function(e){
            let hero_carousel_item = $('#hero-carousel .item');
            e.preventDefault();
            for(let i=0;i<hero_carousel_item.length;i++){
                $(hero_carousel_item[i]).find(this).attr('href',i);
               
            }
            margin_left = $(this).attr('href') *-250;
            console.log(margin_left);
            $('#hero-image').css('margin-left',margin_left+'px');
       });


        
	});
</script>
<div class="container">
	<div id="top">
            
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="">Bệnh</a></li>
                    </ul> 
                    
                </div>
                
                  <div >
                    <h5 >{{$benh['disease_name']}}</h5>
                  </div>
                 <div class="header ">
                    
                        
                    

                    <a class="button create-thread" href="/hoibacsi/datcauhoi/" title="Đặt câu hỏi cho bác sĩ, hoàn toàn miễn phí">
                        <i class="fa fa-commenting" aria-hidden="true"></i> Đặt câu hỏi miễn phí
                    </a>
                    </div>   
                
            </div> 
    </div><!-- #top -->
    <br><br><br>
	<div id="bct">
        
            <ul>

                <li><a class="btn-scroll-to active" data-id="#tom-tat" >Tóm tắt</a></li>
                 @if(isset($benh['overview']))
                <li><a class="btn-scroll-to" data-id="#tong-quan">Tổng quan</a></li>
                @endif

                @if(isset($benh['reason']))
                <li><a class="btn-scroll-to" data-id="#nguyen-nhan">Nguyên nhân</a></li>
                @endif

                @if(isset($benh['obviate']))
                <li><a class="btn-scroll-to" data-id="#phong-ngua">Phòng ngừa</a></li>
                @endif

                 @if(isset($benh['treatment']))
                <li><a class="btn-scroll-to" data-id="#dieu-tri">Điều trị</a></li>
                 @endif

                @if(isset($benh['overview']))
                <li><a class="btn-scroll-to" data-id="#cau-hoi-lien-quan">Các câu hỏi liên quan</a></li>
                @endif
            </ul>
    </div><!-- #Nav search -->
    <div class="ctb">
    	<div class="cctb">
        	<section class="secctb scb" data-isshow="0">
                <h2 id="tom-tat" class="header collapse-trigger"><span>Tóm tắt bệnh {{$benh->disease_name}}</span><i id="show" class="fa fa-angle-right" aria-hidden="true"></i><i id="hide" class="fa fa-angle-down" aria-hidden="true"></i></h2>

                <div class="body b1 ">
                    
                    
                 {!! $benh->disease_content!!}
                    
                </div>
            </section>
            

            @if(isset($benh['overview']))
            <section class=" secctb scb" data-isshow="0">
                <h2 id="tong-quan" class="header collapse-trigger"><span>Tổng quan bệnh {{$benh->disease_name}}</span><i id="show" class="fa fa-angle-right" aria-hidden="true"></i><i id="hide" class="fa fa-angle-down" aria-hidden="true"></i></h2>
                
                <div class="body b1  collapsible-target">
                
               {!! html_entity_decode($benh['overview'])!!}
                   

                </div>

            </section>
             @endif

            @if(isset($benh['reason']))
            <section class="secctb scb" data-isshow="0">
                <h2 id="nguyen-nhan" class="header collapse-trigger"><span>Nguyên nhân bệnh {{$benh['name_diff']}}</span><i id="show" class="fa fa-angle-right" aria-hidden="true"></i><i id="hide" class="fa fa-angle-down" aria-hidden="true"></i></h2>
                
                <div class="body b1 collapsible-target">
                  {!! $benh->cause!!}

                </div>

            </section>
             @endif

             @if(isset($benh['obviate']))
            <section class=" secctb scb" data-isshow="0">
                <h2 id="phong-ngua" class="header collapse-trigger"><span>Phòng ngừa bệnh {{$benh['name_diff']}}</span><i id="show" class="fa fa-angle-right" aria-hidden="true"></i><i id="hide" class="fa fa-angle-down" aria-hidden="true"></i></h2>
               
                <div class="body b1 collapsible-target">
                  {!!$benh->prevent!!}

                </div>
                
            </section>
            @endif

            @if(isset($benh['treatment']))
            <section class=" secctb scb" data-isshow="0">
                <h2 id="dieu-tri" class="header collapse-trigger"><span>Điều trị bệnh {{$benh['name_diff']}}</span><i id="show" class="fa fa-angle-right" aria-hidden="true"></i><i id="hide" class="fa fa-angle-down" aria-hidden="true"></i></h2>
                
                <div class="body b1 collapsible-target">
                    {!!$benh['treatment']!!}

                </div>
               
            </section>
             @endif


            <section class=" secctb scb" data-isshow="0">
            	<h2 id="cau-hoi-lien-quan"><span>Các câu hỏi liên quan bệnh {{$benh->disease_name}}</span><i id="show" class="fa fa-angle-right" aria-hidden="true"></i><i id="hide" class="fa fa-angle-down" aria-hidden="true"></i></h2>
                <div class="body b1 ">
                	
                
                    <ul class="collapsible-target">
                        @foreach($cauhoi as $h)
                        <li>
                            <article>
                                

                                <h3 ><a style="color:#2B96CC;" href="/hoi-bac-si/{{App\Deals::strtoUrl($h->question_title)}}-{{$h->question_id}}/">{{$h->question_title}}</a></h3>
                                
                                    <div class="post-meta-data">
                                        <span class="user">
                                                @if($h['fullname'] == '')
                                                Giấu Tên
                                                @else
                                                {{$h['fullname']}}
                                                @endif
                                            
                                        </span>

                                        <span class="time">
                                            hỏi lúc 00h00 24-02-2017
                                        </span>

                                        
                                        <span>
                                            Chuyên khoa:
                                            
                                                <a href="" title="">{{$h->speciality->speciality_name or null}}</a>
                                            
                                        </span>
                                        
                                    </div>

                                    <div class="body">
                                        <p></p><p>{{$h['question_content']}}</p><p></p>
                                    </div>
                                
                            </article>
                        </li>
                        @endforeach
 
                    </ul>
                </div>
               
            </section>
       </div>
       <aside class="asctb">
                <section class="sick-dt-right" >
                    <h3 >Các bác sĩ chữa bệnh {{$benh->disease_name}}</h3>

                    <ul>
                      @if(isset($doctors))
                         @foreach($doctors as $doc)
                        <li>
                            <div class="b-r">
                            		<a class="image " href="/danh-sach-bac-si-chi-tiet/{{$doc->doctor_url}}-{{$doc->doctor_id}}/" @if(!empty($doc->profile_image)) style="background-image: url(@if(strpos($doc->profile_image,'http')===false)/@endif{{$doc->profile_image}});" @endif title="Bác sĩ {{$doc->doctor_name}}"></a>

	                            <div class="body">
	                                <h4>
	                                    <a href="/danh-sach-bac-si-chi-tiet/{{$doc->doctor_url}}-{{$doc->doctor_id}}/" title="Bác sĩ {{$doc->doctor_name}}">
	                                        Bác sĩ
	                                        <br>
	                                       {{$doc->doctor_name}}
	                                    </a>
	                                </h4>
	                            </div>
                            </div>
                        </li>
                         @endforeach
                      @endif
                       
                    </ul>

                    <a href="/danh-sach-bac-si/?specialities={{$benh->speciality->specialty_url or null}}" class="view-more">Xem tất cả các bác sĩ</a>
                        
                </section>
                

                
                <section class="sick-dt-bot" data-isshow="0">
                <h3>Các địa chỉ chữa bệnh {{$benh->disease_name}}</h3>

                <ul>
                    @if(isset($clinics))
                      @foreach($clinics as $cs)
                    <li>
                        <div class="b-r">
                        		<a href="/phongkham-chitiet/{{App\Deals::strtoUrl($cs->clinic_name)}}-{{$cs->clinic_id}}" @if(!empty($cs->profile_image)) style="background-image: url(@if(strpos($cs->profile_image,'http')===false)/@endif{{$cs->profile_image}});" @endif title="{{$cs->clinic_name}}" class="image"></a>

	                        <div class="body">
	                            <h4>
	                                <a href="/phongkham-chitiet/{{App\Deals::strtoUrl($cs->clinic_name)}}-{{$cs->clinic_id}}" title="{{$cs->clinic_name}}">{{$cs->clinic_name}}</a>
	                            </h4>
	                        </div>
                        </div>
                    </li>
                    @endforeach
                   @endif
                      </ul>
                      <a href="/danhsach-phongkham/?specialities={{$benh->speciality->specialty_url or null}}" class="view-more">Xem tất cả cơ sở y tế</a>
               </section>
             

              
                
            
       </aside>

    </div>
</div>
@endsection