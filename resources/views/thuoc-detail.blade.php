

@extends('main',['title'=> 'Thuốc'.$thuoc->disease_name])

@section('content')

<div id="main">
			
			
			
<div id="page-title" class="no-background">
    <div class="mask">
        <div class="position">
            <ul class="breadcrumbs">
                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="/" itemprop="url"><span itemprop="title">Trang chủ</span></a>
                </li>
                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="/thuoc/" itemprop="url"><span itemprop="title">Thuốc</span></a>
                </li>
                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                <a href="/thuoc/danh-sach/?drug_type=thuoc-tac-dung-tren-qua-trinh-dong-mau-va-tieu-fibrin" itemprop="url"><span itemprop="title"></span></a>
                </li>
            </ul>
            <h1>
                {!!$thuoc['description']!!}
            </h1>
        </div>
    </div>
</div>
<aside style="float:right;margin-top: 30px;">
    <style>
        .mySlides {display:none;}
    </style>
    <div class="w3-content">
        @foreach($ads as $a)
            <a href="{{$a->url}}">
                <img class="mySlides" src="{{$a->image}}" style="width:80%;height:500px;">       
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
</aside>
<div id="drug-detail">
    <div class="position">
        <div class="content">
            <div class="drug-nav-left">
                <a href="#show-all" class="hide-other-trigger active"><i class="fa fa-list-ul fa-fw" aria-hidden="true"></i> Hiển thị tất cả</a>

                @if($thuoc['guide']!='')
                    <a href="#huong-dan-su-dung" class="hide-other-trigger"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i> Hướng dẫn sử dụng</a>
                     @else
                @endif 
                @if($thuoc['info_drugs']!='')         
                    <a href="#thong-tin-duoc-chat" class="hide-other-trigger"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> Thông tin dược chất</a>
				        @else
                @endif 
                @if($thuoc['contraindication_medicine']!='')  
                    <a href="#chong-chi-dinh" class="hide-other-trigger"><i class="fa fa-times fa-fw" aria-hidden="true"></i> Chống chỉ định</a>
                           @else
                @endif  
                @if($thuoc['side_effect_medicine']!='')
                    <a href="#tac-dung-phu" class="hide-other-trigger"><i class="fa fa-meh-o fa-fw" aria-hidden="true"></i> Tác dụng phụ</a>
                                  @else
                @endif  
                @if($thuoc['careful_medicine']!='')
                    <a href="#luu-y" class="hide-other-trigger"><i class="fa fa-sticky-note-o fa-fw" aria-hidden="true"></i> Lưu ý</a>
                                   @else
                @endif 
                @if($thuoc['overdose_medicine']!='')
                    <a href="#qua-lieu" class="hide-other-trigger"><i class="fa fa-frown-o fa-fw" aria-hidden="true"></i> Quá liều</a>
                                   @else
                @endif 
               @if($thuoc['preservation_medicine']!='')
                    <a href="#bao-quan" class="hide-other-trigger"><i class="fa fa-medkit fa-fw" aria-hidden="true"></i> Bảo quản</a>
                                   @else
                @endif 
			@if($thuoc['interactive_medicine']!='')
                    <a href="#tuong-tac" class="hide-other-trigger"><i class="fa fa-magic fa-fw" aria-hidden="true"></i> Tương tác</a>
                                   @else
                @endif 
                
			<a href="https://medixlink.com" class="ads"><img src="http://adi.admicro.vn/adt/adn/2017/04/160x6-adx58e3227bdc686.jpg"></a>
                

                
            </div>
            <div class="drug-body">
                @if($thuoc->image!==null)
				<section class="drug-image collapsible-container collapsible-block expanded">
                        <h2 id="hinh-anh-thuoc" class="header collapse-trigger"><i class="fa fa-picture-o" aria-hidden="true"></i> <span>Hình ảnh thuốc</span></h2>
                        <div class="body collapsible-target">
                            <div class="standard-carousel owl-carousel has-full-sized-image-triggers owl-loaded owl-drag hide-dots" data-settings="{margin:0, dots: true, nav: true, navigation: true, pagination: true, dots: true, items: 1, autoWidth: true, responsive: {0: {autoWidth: false}, 480: {responsive: {autoWidth: true}}}}" data-images="[{&quot;large_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/14_11_2016_02_26_42_635132.jpeg&quot;, &quot;name&quot;: &quot;&quot;, &quot;origin_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/14_11_2016_02_26_42_918628.jpg&quot;, &quot;medium_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/14_11_2016_02_26_42_423178.jpeg&quot;, &quot;thumbnail_url&quot;: &quot;https://dwbxi9io9o7ce.cloudfront.net/images/14_11_2016_02_26_42_369010.jpeg&quot;, &quot;nsfw&quot;: false, &quot;id&quot;: 1772}]" style="">
                            
                                
                            
                        <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 180px;"><div class="owl-item active" style="width: auto;"><div class="item">
                                    <img src="{{$thuoc->image}}" alt="" data-style="background-image: url(https://dwbxi9io9o7ce.cloudfront.net/images/14_11_2016_02_26_42_635132.jpeg);" class="image full-sized-image-trigger" style="opacity: 1;">
                                </div></div></div></div><div class="owl-nav disabled"><div class="owl-prev disabled"></div><div class="owl-next disabled"></div></div><div class="owl-dots disabled"><div class="owl-dot active"><span></span></div></div></div>
                        </div>
                    </section>
                  @endif
                <section class="collapsible-container collapsible-block expanded">
                    <h2 id="tom-tat-thuoc" class="header collapse-trigger"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <span>Tóm tắt thuốc</span></h2>
                    <div class="body collapsible-target">
                        
                            <div class="drug-info">
                                <h4>Số đăng ký: </h4>
                                {{$thuoc['registered_number']}}
                            </div>
                        

                        
                            <div class="drug-info">
                                <h4>Đóng gói: </h4>
                                {{$thuoc['packing']}}
                            </div>
                        

                        
                            <div class="drug-info">
                                <h4>Tiêu chuẩn: </h4>
                                {{$thuoc['standard']}}
                            </div>
                        

                        
                            <div class="drug-info">
                                <h4>Tuổi thọ: </h4>
                               {{$thuoc['duration']}}
                            </div>
                        

                          @if(!empty($thuoc->production_company))
                            <div class="drug-info">
                                <h4>Công ty sản xuất: </h4>
                                {{$thuoc['production_company']}}
                            </div>
                        
						  @endif
                        
                            <div class="drug-info">
                                <h4>Quốc gia sản xuất: </h4>
                                {{$thuoc['production_country']}}
                            </div>
                        

                        
                            <div class="drug-info">
                                <h4>Công ty đăng ký: </h4>
                                {{$thuoc['register_company']}}
                            </div>
                        

                        
                            <div class="drug-info">
                                <h4>Quốc gia đăng ký: </h4>
                                {{$thuoc['register_company']}}
                            </div>
                        

                        

                        

                        
                            <div class="drug-info">
                                <h4>Loại thuốc: </h4>
                               {{$thuoc['type_medicine']}}
                            </div>
                        
                    </div>
                </section>

                @if($thuoc->guide!="")
                    <section class="huong-dan-su-dung collapsible-container collapsible-block collapsed hide-other-content">
                        <h2 id="huong-dan-su-dung" class="header collapse-trigger"><i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i> <span>Hướng dẫn sử dụng</span></h2>

                        <div class="body collapsible-target">
   						
							{!!$thuoc['guide']!!}

                        </div>
                    </section>
                
				@endif
                
                    <section class="thong-tin-duoc-chat collapsible-container collapsible-block collapsed hide-other-content">
                        <h2 id="thong-tin-duoc-chat" class="header collapse-trigger">
                            <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span>Thông tin về dược chất <a href=""></a></span>
                        </h2>

                        <div class="body collapsible-target">
                           
                        	{!!$thuoc['info_drugs']!!}
                        </div>
                    </section>
                

                

                

                
                    <section class="chong-chi-dinh collapsible-container collapsible-block collapsed hide-other-content">
                        <h2 id="chong-chi-dinh" class="header collapse-trigger"><i class="fa fa-times fa-fw" aria-hidden="true"></i> <span>Chống chỉ định</span></h2>

                        <div class="body collapsible-target">
                        	 {!!$thuoc['contraindication_medicine']!!}

                        </div>
                    </section>
                

                
                    <section class="tac-dung-phu collapsible-container collapsible-block collapsed hide-other-content">
                        <h2 id="tac-dung-phu" class="header collapse-trigger"><i class="fa fa-meh-o fa-fw" aria-hidden="true"></i> <span>Tác dụng phụ</span></h2>

                        <div class="body collapsible-target">
					 {!!$thuoc['side_effect_medicine']!!}

                        </div>
                    </section>
                

                
                    <section class="luu-y collapsible-container collapsible-block collapsed hide-other-content">
                        <h2 id="luu-y" class="header collapse-trigger"><i class="fa fa-sticky-note-o fa-fw" aria-hidden="true"></i> <span>Lưu ý</span></h2>

                        <div class="body collapsible-target">
                            <h4>1. Thận trọng:</h4>

                             {!!$thuoc['careful_medicine']!!}
                        </div>
                    </section>
                

                
                    <section class="qua-lieu collapsible-container collapsible-block collapsed hide-other-content">
                        <h2 id="qua-lieu" class="header collapse-trigger"><i class="fa fa-frown-o fa-fw" aria-hidden="true"></i> <span>Quá liều</span></h2>

                        <div class="body collapsible-target">
                            {!!$thuoc['overdose_medicine']!!}

                        </div>
                    </section>
                

                
                    <section class="bao-quan collapsible-container collapsible-block collapsed hide-other-content">
                        <h2 id="bao-quan" class="header collapse-trigger"><i class="fa fa-medkit fa-fw" aria-hidden="true"></i> <span>Bảo quản</span></h2>

                        <div class="body collapsible-target">
                             {!!$thuoc['preservation_medicine']!!}

                        </div>
                    </section>
                

                

                

                
                    <section class="tuong-tac collapsible-container collapsible-block collapsed hide-other-content">
                        <h2 id="tuong-tac" class="header collapse-trigger"><i class="fa fa-magic fa-fw" aria-hidden="true"></i> <span>Tương tác</span></h2>

                        <div class="body collapsible-target">
                             {!!$thuoc['interactive_medicine']!!}

                        </div>
                    </section>
                

                
  @if(isset($comment))
  
    <section class="supplementary" id="comment-wrapper">
    <h3 style="border-top:1px solid #2B96CC;padding:10px 0;">Bình luận ({{$comment->count()}})</h3>
    @if(session('thongbao'))
    {{session('thongbao')}}
    @endif
    <div id="list-comment">
    @foreach($comment as $c)

   
    <article>
        <div class="answer user-answer">
            <div class="answer-top">
                <div class="post-meta-data">
                    <span class="user">
                       <?php $art = App\Users::find($c['user_id']); ?>
                           {{$art['fullname']}}

                            
                    </span>

                    <span class="time">
                         lúc: {{$c['created_at']}}
                    </span>
                </div>
            </div>
            <div class="answer-top">
            <?php substr("{{$c['created_at']}}", 0, 1); ?>
                <!--   <div class="image " style="background: #E497B8;">
                        
                            <span>
                              <?php 
                              $ten = $art['fullname'];
                              echo substr($ten, 0, 1); ?>
                            </span>
                        
            
                </div>-->
            <div class="body">

                <div class="inner-boby">
                    <div class="post-body-content">
                     {{$c['content']}}
                    </div>

                   
                </div>

         
            </div>
        </div>
    </article>
     @endforeach
    </div>
 @if(Session::get('user')!=null) 
    <div id="post-reply-form">
		<form name="new-post" class="post-new" action="/comment_drug/{{App\Deals::strtoUrl($thuoc->article_url)}}-{{$thuoc->medicine_id}}" method="post">
            <h4>Nhập nội dung bình luận dưới đây</h4>
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            
                <div class="post-new-top">
                   
                </div>
             <input type="hidden" name="drug_id" value="{{$thuoc->medicine_id}}"/>
			 <input type="hidden" name="user_id" value="{{Session::get('user')->user_id}}"/>
            <textarea class="form-control resize-textarea" name="body"></textarea>

            <button type="submit">Gửi</button>
           
        </form>
    </div>
    @else
</section>

 <h3>Bạn Cần Đăng Nhập Bình Luận</h3>
 @endif
        </div>
    
@endif
                
            </div>
        </div>

        
            
<aside>
    @if(isset($lienquan))
    <section class="top-list drug-collection">
            
                <h3>Các thuốc liên quan</h3>
            @if($thuoc->speciality_id !==null)
            <ul class="border-bottom">
                @foreach($lienquan as $l)
                    @if($l['medicine_id'] != $thuoc['medicine_id'])
                    <li> <?php $tieude = App\Medicine::to_slug($l['description']);
                                             ?>
                        <div class="content-collection">
                            <a class="drug-icon" href="/thuoc/{{$tieude}}-{{$l['medicine_id'] }}" title="{{$l['description']}}"></a>
                            <div class="body">
                                <h4>
                                    <a href="/thuoc/{{$tieude}}-{{$l['medicine_id'] }}" title="{{$l['description']}}">
                                        {!!$l['description']!!}
                                    </a>
                                </h4>
                            </div>
                        </div>
                    </li>
                    @endif
                @endforeach
                 
                
            </ul>
			@endif
           
        </section>
    
    @endif
  
    
</aside>

        

    </div>
    
</div>

<div class="global-thread-create-cta">
	<a href="/hoi-bac-si/dat-cau-hoi/" class="button">
		<i class="fa fa-question-circle" aria-hidden="true"></i>
		<strong>Hỏi bác sĩ</strong>
		<span>miễn phí</span>
	</a>
</div>
<!-- Root element of PhotoSwipe. Must have class pswp. -->
		</div>
		@endsection