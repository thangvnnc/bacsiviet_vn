

@extends('main',['title'=>'Bệnh '. $benh->disease_name])


@section('content')

<div id="main">
            
            
            
<div id="page-title">
    <div class="background"></div>

    <div class="mask">
        <div class="position">
            <ul class="breadcrumbs">
                <li><a href="/">Trang chủ</a></li>
                <li><a href="/benh/">Bệnh</a></li>
                
            </ul>

            <h1>{{$benh['disease_name']}}
                
            </h1>
        </div>
    </div>
</div>

<div id="disease-detail" class="has-aside">
    <div id="sticky-wrapper" class="sticky-wrapper" style="height: 44px;"><nav class="sticky-nav smooth-scroll-link">
        <div class="position">
            <div class="inner">
                <ul>
                    
                    <li><a href="#tom-tat">Tóm tắt</a></li>
                    

                    @if(isset($benh['overview']))
                    <li><a href="#tong-quan">Tổng quan</a></li>
                    @endif

                    @if(isset($benh['reason']))
                    <li><a href="#nguyen-nhan">Nguyên nhân</a></li>
                    @endif

                    @if(isset($benh['obviate']))
                    <li><a href="#phong-ngua">Phòng ngừa</a></li>
                    @endif

                     @if(isset($benh['treatment']))
                    <li><a href="#dieu-tri">Điều trị</a></li>
                     @endif

                    @if(isset($benh['overview']))
                    <li><a href="#cau-hoi-lien-quan">Các câu hỏi liên quan</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav></div>

    <div class="position">
        <div class="content">
            <!-- 
            <section class="disease-images collapsible-container collapsible-block expanded">
                <h2 id="hinh-anh" class="header collapse-trigger"><span>Hình ảnh bệnh {{$benh->disease_name}}</span></h2>

                <div class="body collapsible-target">
                    <div class="media">
                        <div id="hero-image" class="has-full-sized-image-triggers primary carousel owl-carousel owl-loaded owl-drag" data-sync="#hero-carousel" data-images="[{&quot;large_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/01_10_2016_04_03_13_441282.jpeg&quot;, &quot;name&quot;: &quot;&quot;, &quot;origin_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/01_10_2016_04_03_13_508143.jpg&quot;, &quot;medium_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/01_10_2016_04_03_12_997991.jpeg&quot;, &quot;thumbnail_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/01_10_2016_04_03_12_921040.jpeg&quot;, &quot;nsfw&quot;: false, &quot;id&quot;: 4586}, {&quot;large_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/01_10_2016_04_03_13_972979.jpeg&quot;, &quot;name&quot;: &quot;&quot;, &quot;origin_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/01_10_2016_04_03_14_055575.jpg&quot;, &quot;medium_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/01_10_2016_04_03_13_629042.jpeg&quot;, &quot;thumbnail_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/01_10_2016_04_03_13_572508.jpeg&quot;, &quot;nsfw&quot;: false, &quot;id&quot;: 4587}, {&quot;large_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/05_10_2016_07_34_32_468702.jpeg&quot;, &quot;name&quot;: &quot;&quot;, &quot;origin_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/05_10_2016_07_34_32_539937.jpg&quot;, &quot;medium_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/05_10_2016_07_34_32_245778.jpeg&quot;, &quot;thumbnail_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/05_10_2016_07_34_32_168793.jpeg&quot;, &quot;nsfw&quot;: false, &quot;id&quot;: 5152}, {&quot;large_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/05_10_2016_07_34_32_950656.jpeg&quot;, &quot;name&quot;: &quot;&quot;, &quot;origin_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/05_10_2016_07_34_33_022216.jpg&quot;, &quot;medium_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/05_10_2016_07_34_32_682194.jpeg&quot;, &quot;thumbnail_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/05_10_2016_07_34_32_622541.jpeg&quot;, &quot;nsfw&quot;: false, &quot;id&quot;: 5153}]" style="display: block;">
                            
                                
                            
                                
                            
                                
                            
                                
                            
                        <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: 0.25s; width: 1272px;"><div class="owl-item selected active" style="width: 318px;"><div class="item">
                                    <a href="#" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/01_10_2016_04_03_12_997991.jpeg);" class="image full-sized-image-trigger"></a>
                                </div></div><div class="owl-item" style="width: 318px;"><div class="item">
                                    <a href="#" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/01_10_2016_04_03_13_629042.jpeg);" class="image full-sized-image-trigger"></a>
                                </div></div><div class="owl-item" style="width: 318px;"><div class="item">
                                    <a href="#" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/05_10_2016_07_34_32_245778.jpeg);" class="image full-sized-image-trigger"></a>
                                </div></div><div class="owl-item" style="width: 318px;"><div class="item">
                                    <a href="#" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/05_10_2016_07_34_32_682194.jpeg);" class="image full-sized-image-trigger"></a>
                                </div></div></div></div><div class="owl-nav"><div class="owl-prev disabled"></div><div class="owl-next"></div></div><div class="owl-dots disabled"></div></div>

                        
                        <div id="hero-carousel" class="carousel secondary owl-carousel owl-loaded owl-drag" data-sync="#hero-image" style="display: block;">
                            
                            
                            
                            
                            
                            
                            
                            
                            
                        <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: 0s; width: 320px;"><div class="owl-item active selected" style="width: 80px;"><div class="item">
                                <a href="#" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/01_10_2016_04_03_12_921040.jpeg);"></a>
                            </div></div><div class="owl-item active" style="width: 80px;"><div class="item">
                                <a href="#" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/01_10_2016_04_03_13_572508.jpeg);"></a>
                            </div></div><div class="owl-item active" style="width: 80px;"><div class="item">
                                <a href="#" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/05_10_2016_07_34_32_168793.jpeg);"></a>
                            </div></div><div class="owl-item active" style="width: 80px;"><div class="item">
                                <a href="#" style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/05_10_2016_07_34_32_622541.jpeg);"></a>
                            </div></div></div></div><div class="owl-nav disabled"><div class="owl-prev disabled"></div>
                            <div class="owl-next disabled"></div></div><div class="owl-dots disabled"></div></div>
                        
                    </div>
                </div>
            </section>
            -->

            
            <section class="disease-overview collapsible-container collapsible-block">
                <h2 id="tom-tat" class="header collapse-trigger"><span>Tóm tắt bệnh {{$benh->disease_name}}</span></h2>

                <div class="body collapsible-target">
                    
                    
                 {!! $benh->disease_content!!}
                    
                </div>
            </section>
            

            @if(isset($benh['overview']))
            <section class="collapsible-container collapsible-block collapsed">
                <h2 id="tong-quan" class="header collapse-trigger"><span>Tổng quan bệnh {{$benh->disease_name}}</span></h2>
                
                <div class="body collapsible-target">
                
               {!! html_entity_decode($benh['overview'])!!}
                   

                </div>

            </section>
             @endif

            @if(isset($benh['reason']))
            <section class="collapsible-container collapsible-block collapsed">
                <h2 id="nguyen-nhan" class="header collapse-trigger"><span>Nguyên nhân bệnh {{$benh['name_diff']}}</span></h2>
                
                <div class="body collapsible-target">
                  {!! $benh->cause!!}

                </div>

            </section>
             @endif

             @if(isset($benh['obviate']))
            <section class="collapsible-container collapsible-block collapsed">
                <h2 id="phong-ngua" class="header collapse-trigger"><span>Phòng ngừa bệnh {{$benh['name_diff']}}</span></h2>
               
                <div class="body collapsible-target">
                  {!!$benh->prevent!!}

                </div>
                
            </section>
            @endif

            @if(isset($benh['treatment']))
            <section class="collapsible-container collapsible-block collapsed">
                <h2 id="dieu-tri" class="header collapse-trigger"><span>Điều trị bệnh {{$benh['name_diff']}}</span></h2>
                
                <div class="body collapsible-target">
                    {!!$benh['treatment']!!}

                </div>
               
            </section>
             @endif


            <section class="disease-related collapsible-container collapsible-block ">
                <div class="header">
                    
                        <h2 id="cau-hoi-lien-quan"><span>Các câu hỏi liên quan bệnh {{$benh->disease_name}}</span></h2>
                    

                    <a class="button create-thread" href="/hoi-bac-si/dat-cau-hoi/" title="Đặt câu hỏi cho bác sĩ, hoàn toàn miễn phí">
                        <i class="fa fa-commenting" aria-hidden="true"></i> Đặt câu hỏi miễn phí
                    </a>
                    </div>
                
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

                   <!-- <a href="/hoi-bac-si/danh-sach/?q=Tim mạch&amp;loose_matching=true" class="view-more">Xem thêm các câu hỏi liên quan</a> -->
                
            </section>
           <section>
               <style>
                    .media{
                        height:200px;
                    }
                    .mySlides {display:none;}
                </style>
                <div class="w3-content">
                    @foreach($ads as $a)
                        <a href="{{$a->url}}">
                            <img class="mySlides" src="{{$a->image}}" style="width:100%;height:300px;">  
                        </a>     
                    @endforeach
                  
                </div>

                <script>
                var slideIndex = 0;
                carousel();

                function carousel() {
                    var i;
                    var x = document.getElementsByClassName("mySlides");
                    for (i = 0; i < x.length; i++) {
                      x[i].style.display = "none"; 
                    }
                    slideIndex++;
                    if (slideIndex > x.length) {slideIndex = 1} 
                    x[slideIndex-1].style.display = "block"; 
                    setTimeout(carousel, 2000); 
                }
                </script> 
            </section>

        </div>

        <aside>
            

                
                <section class="top-list">
                    <h3>Các bác sĩ chữa bệnh {{$benh->disease_name}}</h3>

                    <ul>
                      @if(isset($doctors))
                         @foreach($doctors as $doc)
                        <li>
                            <a class="image circle" href="/danh-sach/bac-si/{{$doc->doctor_url}}-{{$doc->doctor_id}}/" @if(!empty($doc->profile_image)) style="background-image: url(@if(strpos($doc->profile_image,'http')===false)/@endif{{$doc->profile_image}});" @endif title="Bác sĩ {{$doc->doctor_name}}"></a>

                            <div class="body">
                                <h4>
                                    <a href="/danh-sach/bac-si/{{$doc->doctor_url}}-{{$doc->doctor_id}}/" title="Bác sĩ {{$doc->doctor_name}}">
                                        Bác sĩ
                                        <br>
                                       {{$doc->doctor_name}}
                                    </a>
                                </h4>
                            </div>
                        </li>
                         @endforeach
                      @endif
                       
                        
                    </ul>

                    <a href="/danh-sach/bac-si/?specialities={{$benh->speciality->specialty_url or null}}" class="view-more">Xem tất cả các bác sĩ</a>
                </section>
                

                
                <section class="top-list">
                <h3>Các địa chỉ chữa bệnh {{$benh->disease_name}}</h3>

                <ul>
                    @if(isset($clinics))
                      @foreach($clinics as $cs)
                    <li>
                        <a href="/co-so-y-te/{{App\Deals::strtoUrl($cs->clinic_name)}}-{{$cs->clinic_id}}" @if(!empty($cs->profile_image)) style="background-image: url(@if(strpos($cs->profile_image,'http')===false)/@endif{{$cs->profile_image}});" @endif title="{{$cs->clinic_name}}" class="image"></a>

                        <div class="body">
                            <h4>
                                <a href="/co-so-y-te/{{App\Deals::strtoUrl($cs->clinic_name)}}-{{$cs->clinic_id}}" title="{{$cs->clinic_name}}">{{$cs->clinic_name}}</a>
                            </h4>
                        </div>
                    </li>
                    @endforeach
                   @endif
                    
                </ul>

                <a href="/danh-sach/?specialities={{$benh->speciality->specialty_url or null}}" class="view-more">Xem tất cả cơ sở y tế</a>
                </section>
                
            
        </aside>
    </div>
</div>



            
            <input type="hidden" name="csrfmiddlewaretoken" value="KaBJxWh4Ud9CmYIJWzjg6qvcj2BEoGBs">
        </div>    

        @endsection