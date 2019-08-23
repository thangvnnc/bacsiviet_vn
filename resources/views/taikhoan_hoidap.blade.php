@extends('taikhoan',['title'=> 'Medicalvn - Trang chủ'])

 	@section('taikhoan_content')
 <div class="content">
 <div class="global-thread-create-cta">
	<a href="/hoi-bac-si/dat-cau-hoi/" class="button">
		<i class="fa fa-question-circle" aria-hidden="true"></i>
		<strong>Hỏi bác sĩ</strong>
		<span>miễn phí</span>
	</a>
</div>
 		<div id="tabs-container">
    <ul class="tabs-menu">
        <li class="current"><a href="#tab-1">Đã Được Trả Lời ({{count($count_answers)}})</a></li>
        <li><a href="#tab-2">Chưa Được Trả Lời {{$count_questions}})</a></li>
		
		<!--
			<li class="last">
				<a href="/hoi-bac-si/dat-cau-hoi/">
					<i class="fa fa-commenting"></i>
					Đặt câu hỏi
				</a>
			</li>
	
-->
	<!--
		<div id="answered">
			
				<h3>Không có bài viết nào</h3>
			

			
		</div>
	
	-->



</div>
		
		
	


    </ul>
      <div class="tab">
     
      @if(count($answers))
        <div id="tab-1" class="tab-content">
           		<div id="answered">
				@foreach($answers as $question)
				
		<article>
					
						<div class="question">
							<h3><a href="/hoi-bac-si/{{$question['question_url']}}-{{$question['question_id']}}">{{$question->question_title}}</a></h3>

							<div class="post-meta-data">
								<span class="user">
									@if($question->hiding_creator == 0)
										{{$question->fullname}}
								    @else<span class="user">Giấu Tên</span>
								    	@endif
									
								</span>

								<span class="time">
									Hỏi lúc {{$question->created_at}}
								</span>

								
							</div>

							<div class="body">
								

								<p>{{$question->question_content}}<!--<a href="/benh/viem-gan-2149/"> viêm gan </a>B cho trẻ trong vòng 24 giờ không--></p>

								<div class="thank-count">
									<i class="fa fa-heart-o" aria-hidden="true"></i>
									<span></span>
									người cám ơn bài viết
								</div>
							</div>
						</div>
					
		</article>
		
				@endforeach
			<div style = "padding-bottom:10px;">{!!$answers->links()!!}</div>
				

	
		</div>
        </div>
        @endif
        
        @if(count($questions))
        <div id="tab-2" class="tab-content">
         @foreach($questions as $question)
         <article>
					
						<div class="question">
							<h3><a href="/hoi-bac-si/{{$question['question_url']}}-{{$question['question_id']}}">{{$question->question_title}}</a></h3>

							<div class="post-meta-data">
								<span class="user">
									@if($question->hiding_creator == 0)
										{{Session::get('user')->fullname}}
								    @else<span class="user">Giấu Tên</span>
								    	@endif
									
								</span>

								<span class="time">
									Hỏi lúc {{$question->created_at}}
								</span>

								
							</div>

							<div class="body">
								

								<p>{{$question->question_content}}<!--<a href="/benh/viem-gan-2149/"> viêm gan </a>B cho trẻ trong vòng 24 giờ không--></p>

								<div class="thank-count">
									<i class="fa fa-heart-o" aria-hidden="true"></i>
									<span></span>
									người cám ơn bài viết
								</div>
							</div>
						</div>
					
		</article>
         @endforeach
        <div style="padding-bottom:10px;">{!!$questions->links()!!}</div>
        </div>
        @endif
    </div>
</div>
</div>

	

		</div>

<style type="text/css">

.tabs-menu {
    height: 30px;
    float: left;
    clear: both;
}

.tabs-menu li {
    height: 30px;
    line-height: 30px;
    float: left;
    margin-right: 10px;
    background-color: #fff;
    
    border-top: 1px solid #d4d4d1;
    border-right: 1px solid #d4d4d1;
    border-left: 1px solid #d4d4d1;
}

.tabs-menu li.current {
    position: relative;
    background-color: #2b96cc;
    border-bottom: 1px solid #fff;
    z-index: 5;
}

.tabs-menu li a {
    padding: 10px;
    text-transform: uppercase;
    
    text-decoration: none; 
}

.tabs-menu .current a {
    color: #2e7da3;
}

.tab {
    border: 1px solid #d4d4d1;
    background-color: #fff;
    float: left;
    margin-bottom: 20px;
    width: auto;
}

.tab-content {
    width: 100%;
    padding: 20px;
    display: none;
}

#tab-1 {
 display: block;   
}
.last
{
	    float: right;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
    $(".tabs-menu a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
});
</script>
	@endsection
