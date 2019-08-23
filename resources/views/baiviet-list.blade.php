@extends('main',['title'=> 'Bài viết'])
@section('bai-viet','active')
@section('content')
  <div id="main">
			
            <?php



function to_slug($str) {
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}
?>

			
	<div class="container"  style="margin-top: 10px;"> 
    <div class="row">		
    <div class="position" id="list-cms">
        <div class="content">
            <ul class="cms-breadcrumb homepage-breadcrumb">
                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="/" itemprop="url"><span itemprop="title">Trang chủ</span></a> \
                </li>
                <li itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                    <a href="#" itemprop="url"><span itemprop="title">Bài viết</span></a>
                </li>
            </ul>

            <div class="top-new">
                
                    <div class="latest-post">
                        
                            <div class="latest-post-image">
                                <?php $tieude=to_slug($baiviet_new['article_title']);?>
                                <a href="/bai-viet/{{$baiviet_new->article_url}}-{{$baiviet_new->article_id}}" class="image"  @if(!empty($baiviet_new->image)) style="background-image: url(@if(strpos($baiviet_new->image,'http')===false)/public/images/@endif{{$baiviet_new->image}});margin-top:-110px;width:550px;height:550px;display: block;background-size: contain;background-repeat: no-repeat;background-position: center;" @endif title="{!! $baiviet_new['article_title']!!}"></a>
                            </div>
                        

                        <div class="latest-post-body">
                            <h2 class="title-latest-post">

                                <a href="/bai-viet/{{$baiviet_new->article_url}}-{{$baiviet_new->article_id}}" title="{!! $baiviet_new['article_title']!!}">
                                {!! $baiviet_new['article_title']!!}
                                </a>
                            </h2>
                            <div class="description-latest-post">
                                {{ $baiviet_new['article_summary']}}
                            </div>
                        </div>
                    </div>
                
                <div class="list-feature">
                    <ul>
						<?php $i = 0;?>
                        @foreach($baiviets as $baiviet)
                        @if($baiviet_new['article_id'] != $baiviet['article_id'])
                           @if($i<8)
                    	    <?php $tieude=to_slug($baiviet['article_title']); ?>
                            <li>
                                    <a href="/bai-viet/{{$baiviet->article_url}}-{{$baiviet['article_id']}}" class="image" @if(!empty($baiviet->image)) style="background-image: url(@if(strpos($baiviet->image,'http')===false)/public/images/@endif{{$baiviet->image}});width:50px;height:50px;display: block;background-size: contain;background-repeat: no-repeat;background-position: center;" @endif title="{{$baiviet['article_title']}}"></a>
                                
                                <h4>
                                    <a href="/bai-viet/{{$baiviet->article_url}}-{{$baiviet['article_id']}}" title="">
                                        {{$baiviet['article_title']}} 
                                    </a>
                                </h4>
                            </li>
                           @endif
                            <?php $i=$i+1;?>
                        @endif
                    @endforeach
                            
                        
                    
                        
                    </ul>
                </div>
            </div>
            <!--
            <div class="post-list-new">
                <ul>
                    
                        <li>
                            <a href="/bai-viet/lieu-tap-luyen-trong-moi-truong-nong-co-tot-cho-suc-khoe-hon/" class="image">
                                
                                    <img src="https://dwbxi9io9o7ce.cloudfront.net/images/20161230_144626_869747_sweating.2e16d0ba.fill-520x340.jpg" alt="tập luyện trong môi trường nóng" title="Liệu tập luyện trong môi trường nóng có tốt cho sức khỏe hơn?">
                                
                            </a>
                            <h4><a href="/bai-viet/lieu-tap-luyen-trong-moi-truong-nong-co-tot-cho-suc-khoe-hon/">Liệu tập luyện trong môi trường nóng có tốt cho sức khỏe hơn?</a></h4>
                        </li>
                    
                        <li>
                            <a href="/bai-viet/nguoi-bi-benh-viem-loet-da-day-nen-an-gi/" class="image">
                                
                                    <img src="https://dwbxi9io9o7ce.cloudfront.net/images/20170103_033701_985031_shutterstoc.2e16d0ba.fill-520x340.jpg" alt="vicare.vn-nguoi-bi-benh-viem-loet-da-day-nen-an-gi" title="Người bị bệnh viêm loét dạ dày nên ăn gì?">
                                
                            </a>
                            <h4><a href="/bai-viet/nguoi-bi-benh-viem-loet-da-day-nen-an-gi/">Người bị bệnh viêm loét dạ dày nên ăn gì?</a></h4>
                        </li>
                    
                        <li>
                            <a href="/bai-viet/ai-la-nguoi-nghien-tinh-duc-hay-cung-kiem-tra/" class="image">
                                
                                    <img src="https://dwbxi9io9o7ce.cloudfront.net/images/20161230_154526_880088_wallhaven-3.2e16d0ba.fill-520x340.jpg" alt="người nghiện tình dục" title="Ai là người nghiện tình dục? Hãy cùng kiểm tra﻿">
                                
                            </a>
                            <h4><a href="/bai-viet/ai-la-nguoi-nghien-tinh-duc-hay-cung-kiem-tra/">Ai là người nghiện tình dục? Hãy cùng kiểm tra﻿</a></h4>
                        </li>
                    
                        <li>
                            <a href="/bai-viet/nen-uong-gi-vao-ngay-le-ta-on-dich/" class="image">
                                
                                    <img src="https://dwbxi9io9o7ce.cloudfront.net/images/20161230_142219_617943_Breakfast_2.2e16d0ba.fill-520x340.jpg" alt="Lễ Tạ Ơn" title="Nên ăn uống gì vào ngày Lễ Tạ Ơn">
                                
                            </a>
                            <h4><a href="/bai-viet/nen-uong-gi-vao-ngay-le-ta-on-dich/">Nên ăn uống gì vào ngày Lễ Tạ Ơn</a></h4>
                        </li>
                    
                </ul>
            </div>
            -->

                    
            
                  @foreach ($Catalog as $item)
                    @if($item['parent_id']==0)
                    <div class="list-by-category">
                         <?php $cates = App\Catalog::where('parent_id',$item['id'])->get();
                         $catesID = App\Catalog::where('parent_id',$item['id'])->pluck('id');?>
                          <?php $cate_paren = App\Catalog::where('parent_id',0)->first(); ?>
                        <div class="list-category">
                            <ul>
                                <li>
                                    <a class="" href="/chuyen-muc/{{$item['name_url']}}-{{$item['id']}}">{!! $item["name"]!!}</a>
                                </li>
                                
                                 @foreach ($cates as $cate)
                                    <li>
                                        <a href="/chuyen-muc/{{$cate['name_url']}}-{{$cate['id']}}">{{$cate['name']}}</a>
                                    </li>
                                 @endforeach
                            </ul>
                        </div>
                       
                        
                        <div class="list-post">
                        
                        
                            <ul>
                     
                            

                                <?php $art = App\Article::whereIn('catalog_id',$catesID)->orWhere('catalog_id',$item['id'])->orderBy('created_at','DESC')->take(6)->get(); ?>
                                
                                 @foreach ($art as $ar)
                                    
                                     <?php $tieude=to_slug($ar['article_title']); ?>
                                        <li>
                                            <h4>
                                                <a href="/bai-viet/{{$ar->article_url}}-{{$ar->article_id}}" class="title">{{$ar['article_title']}}</a>
                                            </h4>

                                            <div class="body-post">
                                                <a href="/bai-viet/{{$ar->article_url}}-{{$ar->article_id}}" class="image">
                                                  
                                                      <img src="@if($ar->image == '') ../public/images/default_baiviet.jpg @else {!! asset('public/images/'.$ar->image) !!} @endif" alt="" title="">
                                                  
                                                </a>
                                                <div class="description">{{$ar['article_summary']}}</div>
                                            </div>
                                        </li>
                                 
                                        
                                        @endforeach

                                        
                                       
                            </ul>
                             
                                <!--
                                <div class="post-by-category">
                                    <ul>
                                                <li>
                                                    <h4><a href="/bai-viet/benh-vien-lao-phoi-trung-uong-nam-o-dau/"></a></h4>
                                                </li>
      
                                    </ul>
                                </div>
                                -->
                            
                        </div>
                        
                    </div>
                
            
                @endif
                @endforeach
                  
                
        </div>
    </div>
<div class="global-thread-create-cta">
	<a href="/hoi-bac-si/dat-cau-hoi/" class="button">
		<i class="fa fa-question-circle" aria-hidden="true"></i>
		<strong>Hỏi bác sĩ</strong>
		<span>miễn phí</span>
	</a>
</div>

			
			<input name="csrfmiddlewaretoken" value="OSU4rxNLLX1ROIMoIKau1fgs2qUAr7Vj" type="hidden">

		</div>
    </div>
</div>
@endsection
