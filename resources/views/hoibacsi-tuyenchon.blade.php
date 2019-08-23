@extends('main',['title'=> 'Danh sách tuyển chọn câu hỏi'])


@section('content')
     <div id="main">
			
			
			

<div id="page-title" class="has-create">
	<div class="background"></div>
	<div class="mask">
		<div class="position">
			<ul class="breadcrumbs">
				<li>
					<a href="/">Trang chủ</a>
				</li>
				<li>
					<a href="/hoi-bac-si/">Hỏi bác sĩ</a>
				</li>
				<li class="active">Tuyển chọn</li>
			</ul>
			<h1>Các tuyển chọn câu hỏi

    <span class="weak"></span>

</h1>
			<a class="button create-thread" href="/hoi-bac-si/dat-cau-hoi/" title="Đặt câu hỏi cho bác sĩ, hoàn toàn miễn phí">
				<i class="fa fa-commenting" aria-hidden="true"></i> Đặt câu hỏi miễn phí
			</a>
		</div>
	</div>
</div>




<div id="collection-list">
	<div class="position">
		<div class="grid-layout" style="position: relative; height: 1782.83px;">
			@if(isset($subjects))
			@foreach($subjects as $sub)
				<div class="grid-item" style="position: absolute; left: 0px; top: 0px;">
					<article>
						<div class="media">
							<a href="/hoi-bac-si/tuyen-chon/{{\App\Deals::strtoUrl($sub->subject)}}-{{$sub->id}}/" style="background-image: url('{{$sub->image}}')"></a>
						</div>

						<div class="body">
							<h3 class="title"><a href="/hoi-bac-si/tuyen-chon/{{\App\Deals::strtoUrl($sub->subject)}}-{{$sub->id}}/">{{$sub->subject}}</a></h3>
							@if(strlen($sub->description)>50)
										{{substr( $sub->description, 0, strpos($sub->description, ' ', 50) )}}...
									@else
										{{$sub->description}}
									@endif
							<p>Hôi nách là vấn đề tế nhị khiến bạn mất đi tự tin&nbsp;và tạo ra rào cản trong khi giao tiếp. Dưới đây là tuyển tập 5 phương pháp cho...</p>
							<a href="/hoi-bac-si/tuyen-chon/tuyen-chon-5-phuong-phap-giup-thoi-bay-hoi-nach-trong-tich-tac-1102/" title="Tuyển chọn 5 phương pháp giúp thổi bay hôi nách trong tích tắc" alt="Tuyển chọn 5 phương pháp giúp thổi bay hôi nách trong tích tắc" class="readmore">Đọc tiếp <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
						</div>
					</article>
				</div>
			
				
		@endforeach
		@endif	
				
			
		</div>

		


    <div class="pagination">
        <div class="vh">4012 kết quả.</div>
        <span class="step-links">
            

            <span class="current">
                  {!!$subjects->links()!!}
            </span>

            
               
            
        </span>
    </div>


	</div>
</div>

			
			<input name="csrfmiddlewaretoken" value="OSU4rxNLLX1ROIMoIKau1fgs2qUAr7Vj" type="hidden">
		</div>
@endsection
