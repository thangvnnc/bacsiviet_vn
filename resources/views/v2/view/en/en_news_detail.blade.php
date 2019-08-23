@extends('v2/view/en/en_main',['title'=> 'News details'])
@section('en_content')
<div class="container">
    <div id="top">
            
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/en">Home</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="/en/baiviet">News</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="#">News details</a></li>
                    </ul> 
                    
                </div>
                
                  <div >
                    <h5 ></h5>
                  </div>
          
                
            </div> 
    </div><!-- #top -->
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

    <br>
    
    <div class="nav-ctbv">   
        @foreach($Catalogs as $catalog)
        @if($catalog['parent_id']==0)
            <div class="dropd-f">
                <span class=" ">
                    <a href="/en/chuyenmuc/{{$catalog['name_url']}}-{{$catalog['id']}}" title="Phòng &amp; Chữa Bệnh">
                        {!! $catalog["name"]!!}
                    </a>
                </span>
                <?php $cates = App\Catalog::where('parent_id',$catalog['id'])->get(); ?>
                <?php $cate_paren = App\Catalog::where('parent_id',0)->first(); ?>
                <div class="dropd-c">
                     @foreach ($cates as $cate)
                    <a class="" href="/en/chuyenmuc/{{$cate['name_url']}}-{{$cate['id']}}">{{$cate['name']}}</a>
                      @endforeach
                </div>
            </div>
        @endif
        @endforeach
    </div><!--nav-->
    <div class="contns">            
        <div class="detail-header">
            <h1>{{ $baiviet->article_title }}</h1>
        </div> 
        <div class="detail-body cms">
            <?php \Carbon\Carbon::setLocale('vi') ?>
            <p class="date">{!! \Carbon\Carbon::parse(($baiviet['created_at']))->toFormattedDateString() !!}</p>

            <div class="social-cta">
                <div class="fb-send" data-href="/en/bai-viet/{{$baiviet->article_url}}-{{$baiviet->article_id}}"></div>
                <div class="fb-share-button" data-href="/en/bai-viet/{{$baiviet->article_url}}-{{$baiviet->article_id}}" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="">Chia sẻ</a></div>
                <div class="fb-like" data-href="/en/bai-viet/{{$baiviet->article_url}}-{{$baiviet->article_id}}" data-layout="button" data-action="like" data-size="small" data-show-faces="true" data-share="fasle"></div>
            </div>
            <div class="streamfield">
                {!!  $baiviet->article_content !!}
            </div>
        </div>
         @if(isset($lienquan) && $lienquan != '')  
        <section class="sectt">
            <h3>Related posts</h3>
            <div class="posts-list">
                <ul>
                    @foreach($lienquan as $l)
                        <?php $tieude=to_slug($l['article_title']);?>
                    @if($l['article_id'] != $baiviet['article_id'])
                        <li>
                            <a href="/en/baiviet/{{$l->article_url}}-{{$l['article_id']}}" class="image">
                                    <img src="@if(!empty($l->image)) @if(strpos($l->image,'http')===false) /public/images/{{$l->image}} @else {{$l->image}} @endif @endif" alt="" title="">
                            </a>
                            <a href="/en/baiviet/{{$l->article_url}}-{{$l['article_id']}}" title="">{{$l['article_title']}}</a>
                        </li>
            
                    @endif
                    @endforeach         
                </ul>
            </div>
        </section>
    @endif

    <section class="supplementary" id="comment-wrapper">
        <h3>Comment ({{$comment->count()}})</h3>
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
                                    Ask at time: {{$c['created_at']}}
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
                    </div> 
                </article>
                 @endforeach
        </div>
         @if(Session::get('user')!=null) 
            <div id="post-reply-form">
                <form name="new-post" class="post-new" action="/comment_article/{{$baiviet->article_url}}-{{$baiviet['article_id']}}" method="post">
                    <h4>Enter the comment content below</h4>
                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                        <div class="post-new-top">  
                        </div>
                    <textarea class="form-control resize-textarea" name="body"></textarea>
                   <br>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
            @else
        </section>
            <h3><a style="font-size: 16px;" href="/en">You need to login to comment</a></h3>
        @endif
    </div>

    <aside class="asleft">
            <section class="top-list">
                <h3>Recent posts</h3>
                    <ul class="recent-list">       
                        @foreach($noibat as $n)
                            <?php $tieude=to_slug($n['article_title']);?>
                            <li>
                                <a class="image" href="/en/baiviet/{{$n->article_url}}-{{$n['article_id']}}" @if(!empty($n->image)) style="background-image: url( @if(strpos($n->image,'http')===false) /public/images/{{$n->image}} @else {{$n->image}}) @endif" @endif title="">
                                </a>
                                <div class="body">
                                    <h4>
                                        <a href="/en/baiviet/{{$n->article_url}}-{{$n['article_id']}}" title="">
                                           {{$n['article_title']}}
                                        </a>
                                    </h4>
                                   
                                </div>
                            </li>
                        @endforeach 
                    </ul>
            </section>
    </aside> 
    
</div><!--Container-->
@endsection