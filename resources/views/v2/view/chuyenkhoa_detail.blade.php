@extends('v2/structor/main',['title'=> 'Bác sĩ chi tiết'])
@section('content')
<script type="text/javascript">
    $(document).ready(function(){
        checkResize();
        $(window).resize(function(){
            checkResize();
        });

        let ckTopList = $(".ck-top-list");
        for(let i = 0; i < ckTopList.length; i++) {
            $(ckTopList[i]).find("ul").find("li").slice(0,6).show();            
        }

        $(".ck-ud").on('click',function(){
            
            var a = $(".ck-ud-dropd").length;

            let data_id = $(this).attr("data-id");
            if(data_id == 0){
                $(this).find("#ck-up").show();
                $(this).find("#ck-down").hide();
                // $(".ck-ud-dropd:hidden").slice().show();
                $(this).parents('.ck-top-list').find('ul').find('li').show();
                $(this).attr("data-id","1");
            }
            else{
                var itemLi = $(this).parents('.ck-top-list').find('ul').find('li');
                var lengthItem = itemLi.length;
                console.log(lengthItem);
                itemLi.slice(6, lengthItem).hide();

                $(this).find("#ck-up").hide();
                $(this).find("#ck-down").show();
                // $(".ck-ud-dropd:visible").slice(a/12,a).hide();
                $(this).attr("data-id","0");
            }
        });
        
            //Slider
       function checkResize(){
            let width_wd = $(document).width();
            let ck_profess = $('.ck-professionals');
            var interval;
            for(let i=0;i<ck_profess.length;i++){
                let doc_leng = $(ck_profess[i]).find('#doctor-content-ck').find('.item-ck').length;
                let width = doc_leng*200;
                let width_doc = $(ck_profess[i]).find('#doctor-content-ck').css('width',width +'px');
                

                if(width_wd < 768){
                    let slideht = 1;
                    let margin_left = 0;
                    let max_slide = width -(slideht*200);
                     let ms = 0;
                    $('.next-ck').on('click',function(){
                        console.log('clicked');
                        margin_left-=200;
                        ms = 200;
                        if(margin_left <-max_slide){
                            margin_left = 0;
                            ms = 1000;
                        }

                        $(this).parents('.ck-professionals').find('#doctor-content-ck').css({'margin-left': margin_left +'px','transition':'margin-left ' + ms + 'ms ease 0s'});
                    });

                    $('.prev-ck').on('click',function(){
                        margin_left+=200;
                        ms = 200;
                        if(margin_left > 0){
                            margin_left = -max_slide;
                            ms = 1000;
                        }
                        $(this).parents('.ck-professionals').find('#doctor-content-ck').css({'margin-left': margin_left +'px','transition':'margin-left ' + ms + 'ms ease 0s'});
                    });
                    function startSlider(){
                        interval = setInterval(function(){
                            ms = 200;
                            margin_left -= 200;
                            if(margin_left < -max_slide){
                                margin_left = 0;
                                ms = 1000;
                            }
                            $('.clinic-autoplay #doctor-content-ck').animate({'margin-left': margin_left +'px','transition':' margin-left '+ ms+ 'ease 0.2s'},1000);
                        },3000);
                    }
                }
                else if( width_wd >= 768 && width_wd <= 1024){
                     let slideht = 3;
                    let margin_left = 0;
                    let max_slide = width -(slideht*200);
                     let ms = 0;
                    $('.next-ck').on('click',function(){
                        
                        margin_left-=200;
                        ms = 200;
                        if(margin_left <-max_slide){
                            margin_left = 0;
                            ms = 1000;
                        }

                        $(this).parents('.ck-professionals').find('#doctor-content-ck').css({'margin-left': margin_left +'px','transition':'margin-left ' + ms + 'ms ease 0s'});
                    });

                    $('.prev-ck').on('click',function(){
                        margin_left+=200;
                        ms = 200;
                        if(margin_left > 0){
                            margin_left = -max_slide;
                            ms = 1000;
                        }
                        $(this).parents('.ck-professionals').find('#doctor-content-ck').css({'margin-left': margin_left +'px','transition':'margin-left ' + ms + 'ms ease 0s'});
                    });
                        function startSlider(){
                        interval = setInterval(function(){
                            ms = 200;
                            margin_left -= 200;
                            if(margin_left < -max_slide){
                                margin_left = 0;
                                ms = 1000;
                            }
                            $('.clinic-autoplay #doctor-content-ck').animate({'margin-left': margin_left +'px','transition':' margin-left '+ ms+ 'ease 0.2s'},1000);
                        },3000);
                    }
                }
                else{
                     let slideht = 4;
                    let margin_left = 0;
                    let max_slide = width -(slideht*200);
                     let ms = 0;
                    $('.next-ck').on('click',function(){
                       
                        margin_left-=200;
                        ms = 200;
                        if(margin_left <-max_slide){
                            margin_left = 0;
                            ms = 1000;
                        }

                        $(this).parents('.ck-professionals').find('#doctor-content-ck').css({'margin-left': margin_left +'px','transition':'margin-left '+ms+'ms ease 0s'});
                    });

                    $('.prev-ck').on('click',function(){
                        margin_left+=200;
                        ms = 200;
                        if(margin_left > 0){
                            margin_left = -max_slide;
                            ms = 1000;
                        }
                        $(this).parents('.ck-professionals').find('#doctor-content-ck').css({'margin-left': margin_left +'px','transition':'margin-left '+ms+'ms ease 0s'});
                    });
                    function startSlider(){
                        interval = setInterval(function(){
                            ms = 200;
                            margin_left -= 200;
                            if(margin_left < -max_slide){
                                margin_left = 0;
                                ms = 1000;
                            }
                            $('.clinic-autoplay #doctor-content-ck').animate({'margin-left': margin_left +'px','transition':' margin-left '+ ms+ 'ease 0.2s'},1000);
                        },3000);
                    }
                }
            }
           function stopSlider(){
                clearInterval(interval);
           }
           $('.clinic-autoplay').on('mouseenter',stopSlider).on('mouseleave',startSlider);
           startSlider();
            
        }
        
         
       
    });
</script>
<div class="main-A">
	<div id="top">
            
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="/">Chuyên khoa</a></li>
                        
                    </ul> 
                    
                </div>
                <h1 style="font-size: 16px;">
					Chuyên khoa {{$speciality->speciality_name}}			
				</h1>

                <a class="buthbs" href="/hoibacsi/datcauhoi/" title="Đặt câu hỏi cho bác sĩ, hoàn toàn miễn phí">
                    <i class="fa fa-commenting" aria-hidden="true"></i> Đặt câu hỏi miễn phí
                </a>
                
            </div> 
    </div><!-- #top -->
    <br><br><br>
    <div class="hbs-ckl">
            
               <section class="ck-professionals">
                <h3>
                    Bác sĩ nổi bật có chuyên khoa này 
                    <a href="/danh-sach-bac-si-chi-tiet/?specialities=san-phu" title="Xem danh sách bác sĩ">Xem tất cả <i class="fa fa-angle-double-right"></i></a>
                </h3>
                 @if(isset($doctors)) 
                      <div class="prev-ck">
                            <span ><i  class="fa fa-chevron-left" id="ck-left"></i></span>
                        </div>
                    <div class="slide-show">
                        <div id="doctor-content-ck" >
                             @foreach($doctors as $doc)
                                <div class="item-ck">
                                     <a href="/danh-sach-bac-si-chi-tiet/{{$doc->doctor_url}}-{{$doc->doctor_id}}/kham-benh">
                                    <img src="@if($doc->profile_image!=null) @if(strpos($doc->profile_image, 'http')===false)https://medixlink.com/public/images/doctor/@endif{{$doc->profile_image}}@endif" alt="#" title="medihere Blog Post"/>
                                    <h3>{{$doc->doctor_name}}</h3>
                                   
                                   
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>   
                    <div class="next-ck">
                         <span ><i class="fa fa-chevron-right" id="ck-right"></i></span>
                     </div>
                     @endif
                </section>
            

            
            <section class="ck-professionals" >
                <h3>
                    Cơ sở y tế nổi bật có chuyên khoa này 
                    <a href="/danh-sach/?specialities=san-phu" title="Xem danh sách cơ sở y tế">Xem tất cả <i class="fa fa-angle-double-right"></i></a>
                </h3>
                 @if(isset($clinics)) 
                 <div class="clinic-autoplay">
                  <div class="prev-ck">
                            <span ><i  class="fa fa-chevron-left" id="ck-left"></i></span>
                        </div>
                    <div class="next-ck">
                         <span ><i class="fa fa-chevron-right" id="ck-right"></i></span>
                     </div>
                  <div class="slide-show">
                        <div id="doctor-content-ck" >
  
                     @foreach($clinics as $cs)
                        <div class="item-ck">
                             <a href="/co-so-y-te/{{$cs->clinic_url}}-{{$cs->clinic_id}}">
                            <img src="@if($cs->profile_image!=null) @if(strpos($cs->profile_image, 'http')===false)https://medixlink.com/public/images/health_facilities/@endif{{$cs->profile_image}}@endif" alt="" title="medihere Blog Post"/>
                            <h3>{{$cs->clinic_name}}</h3>
                           
                           
                            </a>
                    
                         </div>
                    
                    @endforeach
                    </div>
                     </div> 
                </div>
            @endif
            </section>  
            

            
            
            
            
            <section id="ck-question-section">
                <div class="header">
                    <h3>Các câu hỏi mới nhất</h3>
                    <a href="/hoi-bac-si/danh-sach/">Xem danh sách câu hỏi <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                </div>

                @if(isset($questions))
                  @foreach($questions as $qs)
                <article>
                    
                        <div class="ck-question">
                            <h3><a href="/hoibacsi/{{$qs->question_url}}-{{$qs->question_id}}/">{{$qs->question_title}}</a></h3>

                            <div class="post-meta-data">
                                <span class="user">
                                    
                                        {{$qs->fullname}}
                                    
                                </span>

                                <span class="time">
                                    Hỏi lúc 00h38 11-02-2017
                                </span>

                                
                                <span>
                                    Chuyên khoa:
                                    
                                        <a href="/hoi-bac-si/danh-sach/?speciality={{$speciality->specialty_url}}" title="">{{$speciality->speciality_name}}</a>
                                    
                                </span>
                                
                            </div>

                            <div class="body">
                                

                                <p>{{$qs->question_content}}</p>

                                <div class="thank-count">
                                    <i class="fa fa-heart-o" aria-hidden="true"></i>
                                    <span>0</span>
                                    người cám ơn bài viết
                                </div>
                            </div>
                        </div>
            <?php $traloi = App\Answer::where('question_id',$qs->question_id)->first(); ?>
                    @if(isset($traloi) && $traloi )
                        @if($traloi->user!=null)
                    
                        <div class="ck-answer">
                            <span>Được trả lời bởi</span>

                            <ul>
                                @if($traloi->user->doctor!==null)
                                    <li>
                                            <span class="image " @if(!empty($traloi->user->doctor->profile_image)) style="background-image: url(@if(strpos($traloi->user->doctor->profile_image,'http')===false)/@endif{{$traloi->user->doctor->profile_image}});" @endif></span>
                                            <h4><a href="/danh-sach-bac-si-chi-tiet/{{$traloi->user->doctor->doctor_url}}-{{$traloi->user->doctor->doctor_id}}">
                                                Bác sĩ {{$traloi->user->doctor->doctor_name}}
                                                </a>
                                            </h4>

                                            @if(strlen($traloi->user->doctor->doctor_description)>200 && strpos($traloi->user->doctor->doctor_description, ' ', 200)!="")
                                    
                                                <span>{!!substr( $traloi->user->doctor->doctor_description, 0, strpos($traloi->user->doctor->doctor_description, ' ', 200) )!!}</span>
                                            @endif
                                        </li>
                                @elseif($traloi->user->clinic!==null)
                                    <li>
                                            <span class="image " @if(!empty($traloi->user->clinic->profile_image)) style="background-image: url(@if(strpos($traloi->user->clinic->profile_image,'http')===false)/@endif{{$traloi->user->clinic->profile_image}});" @endif></span>
                                            <h4>
                                                {{$traloi->user->doctor}}
                                            </h4>

                                            
                                                <span></span>
                                            
                                        </li>
                                @else
                                    {{$traloi->user->fullname}}
                                @endif
                            </ul>
                        </div>
                    
                        @endif
                        
                        @endif
                </article>
                @endforeach
             @endif  
            </section>
    </div>

    <aside class="hbs-ckr">
    
            <section class="ck-header">
                <h3>{{$speciality->speciality_name}}</h3>

                <div class="" style="max-height: none;">
                    {!!$speciality->speciality_desc!!}

                </div>

                <div class="collapse-trigger" style="display: none;">
                    <span class="trigger-expand"><i class="fa fa-chevron-down" id="ck-down"></i></span>
                    <span class="trigger-collapse"><i class="fa fa-chevron-up" id="ck-up"></i></span>
                </div>
            </section>
            

            
            <section class="ck-top-list">
                <h3>Các câu hỏi cùng chuyên khoa</h3>

                <ul>
                    @if(!empty($speciality->questions))
                      @foreach($speciality->questions as $ques)
                    <li class="ck-ud-dropd">
                        <a class="image" id="test" href="/hoibacsi/{{$ques->question_url}}-{{$ques->question_id}}/" style="background-image: url();" title="Dùng thuốc bổ khi mang thai: Những điều bạn nên biết"></a>

                        <div class="body">
                            <h4>
                                <a href="/hoibacsi/{{$ques->question_url}}-{{$ques->question_id}}/" title="{{$ques->question_title}}">
                                    {{$ques->question_title}}
                                </a>
                            </h4>
                        </div>
                    </li>
                    
                    @endforeach
                    @endif
                   
                </ul>

                <a href="/hoibacsi/tuyenchon/" class="view-more">Xem tất cả các tuyển chọn câu hỏi</a>
                 <div class="ck-ud" data-id="0">
                        <span class="trigger-expand"><i class="fa fa-chevron-down" id="ck-down"></i></span>
                        <span class="trigger-collapse"><i class="fa fa-chevron-up" id="ck-up"></i></span>
                    </div>
            </section>
            

            
            <section class="ck-top-list">
                <h3>Các tuyển chọn bác sĩ</h3>

                <ul>
                    @if(!empty($specs = $speciality->doctors($speciality->speciality_id)))
                      @foreach($specs as $doc)
                    <li class="ck-ud-dropd">
                        <a class="image circle" href="/danh-sach-bac-si-chi-tiet/{{App\Deals::strtoUrl($doc->doctor_name)}}-{{$doc->doctor_id}}" @if(!empty($doc->profile_image)) style="background-image: url(@if(strpos($doc->profile_image,'http')===false)/@endif{{$doc->profile_image}});" @endif title="5 Bác sĩ đầu ngành về chuyên khoa tim mạch được nhiều người biết đến tại TP. Hồ Chí Minh"></a>

                        <div class="body">
                            <h4>
                                <a href="/danh-sach-bac-si-chi-tiet/{{App\Deals::strtoUrl($doc->doctor_name)}}-{{$doc->doctor_id}}" title="{{$doc->doctor_name}}">
                                    {{$doc->doctor_name}}
                                </a>
                            </h4>
                        </div>
                    </li>
                     @endforeach
                    @endif
                    
                </ul>
                 <div class="ck-ud" data-id="0">
                        <span class="trigger-expand"><i class="fa fa-chevron-down" id="ck-down"></i></span>
                        <span class="trigger-collapse"><i class="fa fa-chevron-up" id="ck-up"></i></span>
                    </div>
            </section>
            <section class="ck-top-list">
                <h3>Các tuyển chọn cơ sở y tế</h3>

                <ul>
                    @if(!empty($specs = $speciality->clinics($speciality->speciality_id)))
                      @foreach($specs as $cs)
                    <li class="ck-ud-dropd">
                        <a class="image" href="/phongkham-chitiet/{{App\Deals::strtoUrl($cs->clinic_name)}}-{{$cs->clinic_id}}/" @if(!empty($cs->profile_image))style="background-image: url(@if(strpos($cs->profile_image,'http')===false)/@endif{{$cs->profile_image}})" @endif title="{{$cs->clinic_name}}"></a>

                        <div class="body">
                            <h4>
                                <a href="/phongkham-chitiet/{{App\Deals::strtoUrl($cs->clinic_name)}}-{{$cs->clinic_id}}/" title="{{$cs->clinic_name}}">
                                    {{$cs->clinic_name}}
                                </a>
                            </h4>
                        </div>
                    </li>
                    @endforeach
                   @endif
                     
                   
                </ul>
               <div class="ck-ud" data-id="0">
                        <span class="trigger-expand"><i class="fa fa-chevron-down" id="ck-down"></i></span>
                        <span class="trigger-collapse"><i class="fa fa-chevron-up" id="ck-up"></i></span>
                    </div>
            </section>
    </aside>
     <div class="global-thread-create-cta">
        <a href="/hoibacsi/datcauhoi/" class="button">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
            <strong>Hỏi bác sĩ</strong>
            <span>miễn phí</span>
        </a>
    </div>
</div>
@endsection