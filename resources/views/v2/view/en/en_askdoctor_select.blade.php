@extends('v2/view/en/en_main',['title'=> 'Selective'])
@section('en_content')
<div class="container">
	<div id="top">
            
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="/hoibacsi">Ask doctor</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="">Select</a></li>
                    </ul> 
                    
                </div>
                <h1 style="font-size: 16px;">
					The question selection			
				</h1>

                <a class="buthbs" href="/hoibacsi/datcauhoi/" title="Đặt câu hỏi cho bác sĩ, hoàn toàn miễn phí">
                    <i class="fa fa-commenting" aria-hidden="true"></i> Ask questions for free
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
                            <p> Stubbornness is a delicate issue that makes you lose confidence & nbsp; and create barriers while communicating. Below is a collection of 5 methods for ... </p>
                            <a href="/hoibacsi/tuyenchon/tuyen-chon-5-phuong-phap-giup-thoi-bay-hoi-nach-trong-tich-tac-1102/" title="Tuyển chọn 5 phương pháp giúp thổi bay hôi nách trong tích tắc" alt="Tuyển chọn 5 phương pháp giúp thổi bay hôi nách trong tích tắc" class="readmore">Show more <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
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
       
    </div>
</div>
@endsection