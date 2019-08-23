@extends('taikhoan',['title'=> 'Medicalvn - Trang chủ'])

 	@section('taikhoan_content')
 		
		<div class="content">
			
<div id="my-threads">

	<div id="my-threads-tab">
		<ul>
			<li>
				<a href="/tai-khoan/hoi-dap/?tab=answered" class="active">Câu hỏi mới nhất chưa được trả lời</a>
			</li>

			

			

			<li class="last">
				<a href="/hoi-bac-si/dat-cau-hoi/">
					<i class="fa fa-commenting"></i>
					Đặt câu hỏi
				</a>
			</li>
		</ul>
	</div>

	
		<div id="answered">
			@if(isset($questions) && count($questions)>0)
			   @foreach($questions as $qs)
			   <article>
					
						<div class="question">
							<h3><a href="/hoi-bac-si/{{$qs->question_url}}-{{$qs->question_id}}/?next=/tai-khoan/cau-hoi-moi-nhat">{{$qs->question_title}}</a></h3>

							<div class="post-meta-data">
								<span class="user">
									
										test
									
								</span>

								<span class="time">
									Hỏi lúc {{$qs->created_at}}
								</span>

								
							</div>

							<div class="body">
								

								<p>{{$qs->question_content}}</p>

								<div class="thank-count">
									<i class="fa fa-heart-o" aria-hidden="true"></i>
									<span></span>
									người cám ơn bài viết
								</div>
							</div>
						</div>
					
				</article>
			   @endforeach
			@else
				<h3>Không có câu hỏi nào chưa được trả lời.</h3>
			@endif

			
		</div>
		
	
	



</div>

		</div>

<script type="text/javascript">
<!--
$(this).addClass('active');
//-->
</script>

	@endsection
