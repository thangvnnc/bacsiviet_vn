
@extends('main',['title'=> 'Medicalvn - Trang chủ'])

@section('content')
 <div id="main">
 <div class="position clearfix" id="detail-cms">
      <div class="dropdown-container">
        
        @foreach($Catalogs as $catalog)
       @if($catalog['parent_id']==0)
        <div class="dropdown-menu">
    <span class="title ">
            
        <a href="/chuyen-muc/{{$catalog['name_url']}}-{{$catalog['id']}}" title="Phòng &amp; Chữa Bệnh">
            {!! $catalog["name"]!!}
        </a>

    </span>

     <?php $cates = App\Catalog::where('parent_id',$catalog['id'])->get(); ?>
     <?php $cate_paren = App\Catalog::where('parent_id',0)->first(); ?>
    <div class="dropdown">
         @foreach ($cates as $cate)
        <a class="" href="/chuyen-muc/{{$cate['name_url']}}-{{$cate['id']}}">{{$cate['name']}}</a>
          @endforeach
    
        
    </div>
    
</div>
    @endif
@endforeach
       </div>  
   

            
            
    <div class="position category-list" id="list-cms">
        <div class="category-content"> 
        @if(isset($baiviet_new['article_title']) )         
                <div class="latest-post">

                    <div class="latest-post-image">
                        
                            <img src="{!!asset('public/images/'.$baiviet_new->image)!!}" alt="Không tiêm phòng trước khi mang thai có ảnh hưởng gì không?">
                        
                    </div>
                    <div class="latest-post-body">
                        <h2 class="title-latest-post">
                            <a href="/bai-viet/{{$baiviet_new->article_url}}-{{$baiviet_new['article_id']}}">{{$baiviet_new['article_title']}}</a>

                            
                        </h2>
                        <div class="description-latest-post">
                          {{$baiviet_new['article_summary']}}
                        </div>
                    </div>
                </div>
                <div class="post-list">
                    <ul>
                    @foreach($baiviet as $b)
                    @if($baiviet_new['article_id'] != $b['article_id'])
                <li>
                 <img src="{!!asset('public/images/'.$b->image)!!}" alt=" {{$b['article_title']}}">
    
                <div class="post-content">
                <h4>
                    <a href="/bai-viet/{{$b->article_url}}-{{$b['article_id']}}"> {{$b['article_title']}}</a>           
                </h4>
                    
                          {{$b['article_summary']}}
                       
                </div>
                </li>
                @endif
                @endforeach
                    </ul>
                </div>
            

            
                <div class="pagination">
                    <div class="vh"> kết quả.</div>
                    <span class="step-links">
                       {!! $baiviet->links(); !!}
                        
                    </span>
                </div>
            @else
            <h3> Không có bài viết </h3>
            <h3> </h3>
            <h3> </h3>
            <h3>  </h3>
            <h3>  </h3>
            <h3> </h3>
            <h3> </h3>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
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

            
            <input type="hidden" name="csrfmiddlewaretoken" value="KaBJxWh4Ud9CmYIJWzjg6qvcj2BEoGBs">
        </div>

        </div>
@endsection
