@extends('v2/structor/main',['title'=> 'Chuyên mục'])
@section('content')
<div class="main-A">
	 <div id="top">
            
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="">Chuyên mục</a></li>
                       
                    </ul> 
                    
                </div>
                
                  <div >
                    <h5 ></h5>
                  </div>
          
                
            </div> 
    </div><!-- #top -->
    <div class="nav-ctbv">   
        @foreach($Catalogs as $catalog)
        @if($catalog['parent_id']==0)
            <div class="dropd-f">
                <span class=" ">
                    <a href="/chuyenmuc/{{$catalog['name_url']}}-{{$catalog['id']}}" title="Phòng &amp; Chữa Bệnh">
                        {!! $catalog["name"]!!}
                    </a>
                </span>
                <?php $cates = App\Catalog::where('parent_id',$catalog['id'])->get(); ?>
                <?php $cate_paren = App\Catalog::where('parent_id',0)->first(); ?>
                <div class="dropd-c">
                     @foreach ($cates as $cate)
                    <a class="" href="/chuyenmuc/{{$cate['name_url']}}-{{$cate['id']}}">{{$cate['name']}}</a>
                      @endforeach
                </div>
            </div>
        @endif
        @endforeach
    </div><!--nav-->
    <div class="contcm" >
        <div class=""> 
        @if(isset($baiviet_new['article_title']) )         
                <div class="nd1">
                    <div class="imgvm">
                            <img src="{!!asset('public/images/'.$baiviet_new->image)!!}" >
                    </div>
                    <div class="nd1cm1">
                        <h2>
                            <a href="/baiviet/{{$baiviet_new->article_url}}-{{$baiviet_new['article_id']}}">{{$baiviet_new['article_title']}}</a>
                        </h2>
                        <div class="nd1cm2">
                          {{$baiviet_new['article_summary']}}
                        </div>
                    </div>
                </div>
                <div class="nd2">
                    <ul>
                    	@foreach($baiviet as $b)
			                @if($baiviet_new['article_id'] != $b['article_id'])
				                <li>
				                 <img src="{!!asset('public/images/'.$b->image)!!}" alt=" {{$b['article_title']}}">
				    
				                <div class="nd2cm2">
					                <h4>
					                    <a href="/baiviet/{{$b->article_url}}-{{$b['article_id']}}"> {{$b['article_title']}}</a>           
					                </h4>
					                    
					                          {{$b['article_summary']}}
					                       
				                </div>
				                </li>
			                @endif
		                @endforeach
                    </ul>
                </div>
            

            	
                <div style="padding: 30px 0 0 33.3%;" class="pagination">
                    
                    <span class="step-links">
                       {!! $baiviet->links(); !!}
                        
                    </span>
                </div>
            @else
            <h3> Không có bài viết </h3>
            
            @endif
        </div>
    </div>
    <div class="global-thread-create-cta">
        <a href="/hoi-bac-si/dat-cau-hoi/" class="button">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
            <strong>Hỏi bác sĩ</strong>
            <span>miễn phí</span>
        </a>
    </div>
</div>
@endsection