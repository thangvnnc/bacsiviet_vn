@extends('v2/view/taikhoan',['title'=> 'Tài khoản hỏi đáp'])
@section('taikhoan_content')

<script type="text/javascript">
	$(document).ready(function() {
    $(".tabs-menu a").click(function(event) {
        event.preventDefault();
        $(".tab-content").show();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content").not(tab).css("display", "none");
        tab.fadeIn();
    });
});
</script>
<div class="content-tk-home">
	<div id="tabs-container">
    	<ul class="tabs-menu">
        	<li class="current"><a href="#tab-1">Đã Được Trả Lời ({{count($answers)}})</a></li>
        	<li><a href="#tab-2">Chưa Được Trả Lời ({{$count_questions}})</a></li>	
        </ul>
	</div>
	<div class="tab-tk-ans">
      @if(count($answers))
        <div id="tab-1" class="tab-content">
           	<div id="answered">
				@foreach($answers as $question)
					<article>
						<div class="question">
							<h3><a href="/hoibacsi/{{$question['question_url']}}-{{$question['question_id']}}">{{$question->question_title}}</a></h3>

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
								<p>{{$question->question_content}}</p>

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
				<h3><a href="/hoibacsi/{{$question['question_url']}}-{{$question['question_id']}}">{{$question->question_title}}</a></h3>

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
					<p>{{$question->question_content}}</p>

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
@endsection