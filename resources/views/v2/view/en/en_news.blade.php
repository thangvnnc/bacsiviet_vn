@extends('v2/view/en/en_main',['title'=> 'News'])
@section('en_content')
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
<div class="container">
	<div class="contt">
		<div id="top">
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/en">Home</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="/en/baiviet">News</a></li>
                    </ul> 
                    
                </div>
            </div> 
    </div><!-- #top -->
    <div class="top-new">          
	    <div class="latest-post">
	        
	         <div class="latest-post-image">
	                <?php $tieude=to_slug($baiviet_new['article_title']);?>
	                <a href="/en/baiviet/{{$baiviet_new->article_url}}-{{$baiviet_new->article_id}}" class="image img"  @if(!empty($baiviet_new->image)) style="margin-left: 0px;
                            width: 100%;
                            height: 100%;
                            display: block;
                            background-size: contain;
                            background-repeat: no-repeat;
                            background-position: center;
                            margin: auto;
                            background-image: url(@if(strpos($baiviet_new->image,'http')===false)/public/images/@endif{{$baiviet_new->image}});" @endif title="{!! $baiviet_new['article_title']!!}"></a>
	          </div>
            <script>
                $(document).ready(function () {
                    let width = $(window).width();
                    console.log(width);
                    if(width < 768)
                    {
                        $('.image-title').css("max-height", "240px");
                        $('.image-title').css("background-position", "center");
                    }
                })
            </script>
	        <div class="latest-post-body">
	            <h2 class="title-latest-post">

	                <a href="/en/baiviet/{{$baiviet_new->article_url}}-{{$baiviet_new->article_id}}" title="{!! $baiviet_new['article_title']!!}">
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
                            <a href="/en/baiviet/{{$baiviet->article_url}}-{{$baiviet['article_id']}}" class="image" @if(!empty($baiviet->image)) style="background-image: url(@if(strpos($baiviet->image,'http')===false)/public/images/@endif{{$baiviet->image}});width:50px;height:50px;display: block;background-size: contain;background-repeat: no-repeat;background-position: center;" @endif title="{{$baiviet['article_title']}}"></a>
                        
                        <h4>
                            <a href="/en/baiviet/{{$baiviet->article_url}}-{{$baiviet['article_id']}}" title="">
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
    @foreach ($Catalog as $item)
        @if($item['parent_id']==0)
        <div class="list-by-category">
             <?php $cates = App\Catalog::where('parent_id',$item['id'])->get();
             $catesID = App\Catalog::where('parent_id',$item['id'])->pluck('id');?>
              <?php $cate_paren = App\Catalog::where('parent_id',0)->first(); ?>
            <div class="list-category">
                <ul>
                    <li>
                        <a class="" href="/en/chuyenmuc/{{$item['name_url']}}-{{$item['id']}}">{!! $item["name"]!!}</a>
                    </li>
                    
                     @foreach ($cates as $cate)
                        <li>
                            <a href="/en/chuyenmuc/{{$cate['name_url']}}-{{$cate['id']}}">{{$cate['name']}}</a>
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
                                    <a href="/en/baiviet/{{$ar->article_url}}-{{$ar->article_id}}" class="title">{{$ar['article_title']}}</a>
                                </h4>

                                <div class="body-post">
                                    <a href="/en/baiviet/{{$ar->article_url}}-{{$ar->article_id}}" class="image">
                                      
                                          <img src="@if($ar->image == '') ../public/images/default_baiviet.jpg @else {!! asset('public/images/'.$ar->image) !!} @endif" alt="" title="">
                                      
                                    </a>
                                    <div class="description">{{$ar['article_summary']}}</div>
                                </div>
                            </li>
                            @endforeach    
                </ul>
            </div>                   
        </div>
    @endif
    @endforeach
   
	</div>
</div>
@endsection