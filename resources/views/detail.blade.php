
@extends('main',['title'=> $baiviet->article_title])

@section('content')
 <div id="main">
<div class="position clearfix" id="detail-cms">
    <div class="breadcrumbs">
        
            <h2>
                
                    <a href="" title=""></a>
                
            </h2>
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


    </div>

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


    <div class="post-content">
        <div class="content">

            <div class="detail-header">
                <h1>{{ $baiviet->article_title }}</h1>
            </div>

            
                <div class="detail-body cms">
                    
                        
                            <!-- <div class="feed-img-cover">
                                <img class="feed-img uploaded" src="@if(!empty($baiviet->image))@if(strpos($baiviet->image,'http')===false)/public/images/@endif{{$baiviet->image}}@endif" alt="">
                            </div> -->
                        
                    
					<?php \Carbon\Carbon::setLocale('vi') ?>
                    <p class="date">{!! \Carbon\Carbon::parse(($baiviet['created_at']))->toFormattedDateString() !!}</p>

                    <div class="social-cta">
                            <div class="fb-send" data-href="/bai-viet/{{$baiviet->article_url}}-{{$baiviet->article_id}}"></div>
                          <div class="fb-share-button" data-href="/bai-viet/{{$baiviet->article_url}}-{{$baiviet->article_id}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="">Chia sẻ</a></div>
                          <div class="fb-like" data-href="/bai-viet/{{$baiviet->article_url}}-{{$baiviet->article_id}}" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="fasle"></div>

                    </div>

                    <div class="streamfield">
                        

         {!!  $baiviet->article_content !!}
    


                    </div>
                </div>
            

                    <!--
                <div class="tags">
                    Từ khóa:
                    
                        <a href="/bai-viet/tag/my-pham-cho-ba-bau/" data-track-tag="mỹ phẩm cho bà bầu" class="track-tag">mỹ phẩm cho bà bầu</a> 
                    
                        <a href="/bai-viet/tag/ba-bau-dung-my-pham-gi/" data-track-tag="bà bầu dùng mỹ phẩm gì" class="track-tag">bà bầu dùng mỹ phẩm gì</a> 
                    
                        <a href="/bai-viet/tag/tham-my/" data-track-tag="thẩm mỹ" class="track-tag">thẩm mỹ</a> 
                    
                        <a href="/bai-viet/tag/my-pham/" data-track-tag="mỹ phẩm" class="track-tag">mỹ phẩm</a> 
                    
                        <a href="/bai-viet/tag/ba-bau/" data-track-tag="bà bầu" class="track-tag">bà bầu</a> 
                    
                        <a href="/bai-viet/tag/sua-rua-mat/" data-track-tag="sữa rửa mặt" class="track-tag">sữa rửa mặt</a> 
                    
                        <a href="/bai-viet/tag/suc-khoe-thai-nhi/" data-track-tag="sức khỏe thai nhi" class="track-tag">sức khỏe thai nhi</a>
                    
                </div>  -->

                @if(isset($lienquan) && $lienquan != '')  
                <section class="supplementary">
                    <h3>Bài viết liên quan</h3>
                    <div class="posts-list">
                        <ul>
                                  @foreach($lienquan as $l)
                                  <?php $tieude=to_slug($l['article_title']);?>
                                  @if($l['article_id'] != $baiviet['article_id'])
                                <li>
                                    
                                        <a href="/bai-viet/{{$l->article_url}}-{{$l['article_id']}}" class="image">
                                                <img src="@if(!empty($l->image)) @if(strpos($l->image,'http')===false) /public/images/{{$l->image}} @else {{$l->image}} @endif @endif" alt="" title="">
                                        </a>
                                    

                                    <a href="/bai-viet/{{$l->article_url}}-{{$l['article_id']}}" title="">{{$l['article_title']}}</a>
                                </li>
                            
                                        @endif
                                        @endforeach
                            
                        </ul>
                    </div>
                </section>
                @endif
            

            
  
<section class="supplementary" id="comment-wrapper">
    <h3>Bình luận ({{$comment->count()}})</h3>
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
                        Hỏi lúc: {{$c['created_at']}}
                    </span>
                </div>
            </div>
            <div class="answer-top">
            <?php substr("{{$c['created_at']}}", 0, 1); ?>
                  <div class="image " style="background: #E497B8;">
                        
                            <span>
                              <?php 
                              $ten = $art['fullname'];
                              echo substr($ten, 0, 1); ?>
                            </span>
                        
            
                </div>
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
		<form name="new-post" class="post-new" action="/comment_article/{{$baiviet->article_url}}-{{$baiviet['article_id']}}" method="post">
            <h4>Nhập nội dung bình luận dưới đây</h4>
            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
            
                <div class="post-new-top">
                   
                </div>
            

            <textarea class="form-control resize-textarea" name="body"></textarea>

            <button type="submit">Gửi</button>
           
        </form>
    </div>
    @else
</section>

 <h3>Bạn Cần Đăng Nhập Bình Luận</h3>
 @endif
        </div>

        
            <aside>
                    <section class="top-list">


                        <h3>Bài đăng gần đây</h3>
                            <ul class="recent-list">
                                    
                             @foreach($noibat as $n)
                             <?php $tieude=to_slug($n['article_title']);?>
                                    <li>
                                        <a class="image" href="/bai-viet/{{$n->article_url}}-{{$n['article_id']}}" @if(!empty($n->image)) style="background-image: url( @if(strpos($n->image,'http')===false) /public/images/{{$n->image}} @else {{$n->image}}) @endif" @endif title="">
                                        </a>
                                        <div class="body">
                                            <h4>
                                                <a href="/bai-viet/{{$n->article_url}}-{{$n['article_id']}}" title="">
                                                   {{$n['article_title']}}
                                                </a>
                                            </h4>
                                            <p></p>
                                        </div>
                                    </li>
                             
                                    @endforeach
                                
                            </ul>
                    </section>
                

            </aside>
        <aside>
                    <section class="top-list" style="border: none;padding: 0;">
                        <style>
                            .mySlides {display:none;}
                            </style>
                            <div class="w3-content">
                                @foreach($ads as $a)
                                    <a href="{{$a->url}}">
                                        <img class="mySlides" src="{{$a->image}}" style="width:100%;height:500px;">  
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

<script type="text/html" id="thread-reply-template-user">
    <article>
        <div class="answer user-answer">
            <div class="answer-top">
                <div class="post-meta-data">
                    <span class="user">
                        <% if (post.hiding_creator) { %>
                            Giấu tên
                        <% } else { %>
                            <%= post.created_by.name %>
                        <% } %>
                    </span>

                    <span class="time">
                        Hỏi lúc <%= post.created_at %>
                    </span>
                </div>
            </div>

            <div class="body">

                <div class="inner-boby">
                    <div class="post-body-content">
                        <%= post.body %>
                    </div>

                    <div class="media">
                        <% if (post.all_images != null && post.all_images.length >= 1) { %>
                            <ul>
                            <% for (var i = 0; i < post.all_images.length; i++) { %>
                                <li>
                                    <a href="#" data-id="<%= post.all_images[i].id %>" class="image <% if (post.all_images[i].nsfw) { %> censored <% } %>" style="background-image: url(<%= post.all_images[i].thumbnail_url %>);"></a>

                                    <span class="caption-image">
                                        <span class="caption-content"><%= post.all_images[i].name %></span>

                                        <input type="text" value="<%= post.all_images[i].name %>">

                                        <span class="complete-edit-caption">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </span>

                                        <span class="cancel-edit-caption">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </span>

                                        <span class="edit-caption">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </span>
                                    </span>

                                    <span class="remove-image">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </span>
                                </li>
                            <% } %>
                            </ul>
                        <% } %>
                    </div>
                </div>

                <a href="#" class="edit" data-id="<% =post.id %>">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                    Sửa
                </a>

                <a href="#" class="reply" data-id="<%= post.id %>">
                    <i class="fa fa-reply" aria-hidden="true"></i>
                    Trả lời
                </a>

                <div class="thanks-button-count" >
                    <a href="#" title="" class="thank" data-id="<%=post.id %>">
                        <span class="unactive-text"><i class="fa fa-heart-o" aria-hidden="true"></i> Cảm ơn</span>
                    </a>

                    <div class="thanks-count-inner" >
                        <i class="fa fa-heart-o" aria-hidden="true" >
                            <span class="thank-count-value">0</span>
                            <span>người đã cảm ơn bài viết</span>
                        </i>
                    </div>
                </div>
            </div>
        </div>
    </article>
</script>






<script type="text/html" id="post-edit-time-template">
	<span class="time"><%=modified_at%></span>

	<span class="has-tooltip">
		<i class="fa fa-pencil" aria-hidden="true"></i>
		đã sửa
		<span class="tooltip">Sửa lần cuối lúc <%=modified_at%></span>
	</span>
</script>

			
			<input name="csrfmiddlewaretoken" value="JB6cGncAu65rULRflMGPIklFMbaFJKg1" type="hidden">
		</div>
@endsection
