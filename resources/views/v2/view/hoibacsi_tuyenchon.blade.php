@extends('v2/structor/main',['title'=> 'Bác sĩ chi tiết'])
@section('content')
<div class="container">
	<div id="top">
            
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="/hoibacsi">Hỏi bác sĩ</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="">Tuyển chọn</a></li>
                    </ul> 
                    
                </div>
                <h1 style="font-size: 16px;">
					Các tuyển chọn câu hỏi			
				</h1>

                <a class="buthbs" href="/hoibacsi/datcauhoi/" title="Đặt câu hỏi cho bác sĩ, hoàn toàn miễn phí">
                    <i class="fa fa-commenting" aria-hidden="true"></i> Đặt câu hỏi miễn phí
                </a>
                
            </div> 
    </div><!-- #top -->
    <br><br><br>

    <div class="ct-hbs-tc">
       <div class="grid-lo" >
            @if(isset($subjects))
            @foreach($subjects as $sub)
                <div class="grid-it" >
                    <article>
                        <div class="media">
                            <a href="/hoibacsi/tuyenchon/{{\App\Deals::strtoUrl($sub->subject)}}-{{$sub->id}}/" style="background-image: url('{{$sub->image}}');"></a>
                        </div>

                        <div class="body">
                            <h3 class="title"><a href="/hoibacsi/tuyenchon/{{\App\Deals::strtoUrl($sub->subject)}}-{{$sub->id}}/">{{$sub->subject}}</a></h3>
                            @if(strlen($sub->description)>50)
                                        {{substr( $sub->description, 0, strpos($sub->description, ' ', 50) )}}...
                                    @else
                                        {{$sub->description}}
                                    @endif
                            <p>Hôi nách là vấn đề tế nhị khiến bạn mất đi tự tin&nbsp;và tạo ra rào cản trong khi giao tiếp. Dưới đây là tuyển tập 5 phương pháp cho...</p>
                            <a href="/hoibacsi/tuyenchon/tuyen-chon-5-phuong-phap-giup-thoi-bay-hoi-nach-trong-tich-tac-1102/" title="Tuyển chọn 5 phương pháp giúp thổi bay hôi nách trong tích tắc" alt="Tuyển chọn 5 phương pháp giúp thổi bay hôi nách trong tích tắc" class="readmore">Đọc tiếp <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                        </div>
                    </article>
                </div>
            
                
        @endforeach
        @endif  
                
            
        </div>

        <div class="pagination">
            <span class="step-links">
                      {!!$subjects->links()!!}
            </span>
        </div>
        <div class="global-thread-create-cta">
        <a href="/hoibacsi/datcauhoi/" class="button">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
            <strong>Hỏi bác sĩ</strong>
            <span>miễn phí</span>
        </a>
    </div>
    </div>
</div>
@endsection