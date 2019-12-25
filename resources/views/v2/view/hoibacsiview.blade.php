@extends('v2/structor/main',['title'=> 'Bác sĩ chi tiết'])
@section('content')
<script type="text/javascript">
    
$(document).ready(function(){
    checkResize();
    $(window).resize(function(e){
        checkResize();
    });
    function checkResize(){
        let width = $(document).width();
        if(width > 767){
            $('.sec-hbsv2').off('click');    
            $('.sec-hbsv2').find('.dropct-hbsv').show();

        }
        else{
            $('.sec-hbsv2').on('click',function(){
                let data_isshow = $(this).attr('data-isshow');
                if(data_isshow == 0){
                    $(this).find('#up').show();
                    $(this).find('#down').hide();
                    $(this).find('.dropct-hbsv').show();
                    $(this).attr('data-isshow','1');
                }
                else{
                    $(this).find('#up').hide();
                    $(this).find('#down').show();
                    $(this).find('.dropct-hbsv').hide();
                    $(this).attr('data-isshow','0');
                }
            });
        }
    }
    
  
    $('.thank-hbsv').on('click',function(){
        let data_id = $(this).attr('data-id');
        if(data_id == 0 ){
            $(this).find('.unactive').hide();
            $(this).find('.active').show();
            $(this).attr('data-id','1');
        }
        else{
            $(this).find('.unactive').show();
            $(this).find('.active').hide();
            $(this).attr('data-id','0');
        }
    });

});

</script>
<div class="container">
	<div id="top">
            
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/">Trang chủ</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="/hoibacsi">Hỏi bác sĩ</a></li>
                    </ul> 
                    
                </div>
                <h1 style="font-size: 16px;">
					{{$question->question_title}}				
				</h1>

                <a class="buthbs" href="/hoibacsi/datcauhoi/" title="Đặt câu hỏi cho bác sĩ, hoàn toàn miễn phí">
                    <i class="fa fa-commenting" aria-hidden="true"></i> Đặt câu hỏi miễn phí
                </a>
                
            </div> 
    </div><!-- #top -->
    <br><br><br>
    <div class="hbsv-cnt">
        <div class="hbsv-cntl">
            <article>
                <img style="max-width: 640px;
                max-height: 480px;
                display: block;
                margin-left: auto;
                margin-right: auto;" src="https://medixlink.com/public/images/{{$question->question_id}}"/>
                <div class="quest" >
                    <div class="post-meta-dt1">
                        <span class="user1">
                            
                                @if($question->fullname!=null)
                                {{$question->fullname}}
                                @endif
                            
                        </span>

                        <span class="time1">
                            hỏi lúc {{$question->created_at}}
                        </span>

                        @if(isset($question->speciality_id) && $question->speciality_id !=0)
                        <span class="span-nd">
                            Chuyên khoa:
                            <?php $chuyenkhoa = App\Speciality::find($question->speciality_id);?>
                                <a href="/chuyenkhoa/{{$chuyenkhoa->specialty_url}}-{{$chuyenkhoa->speciality_id}}" title="">{{$chuyenkhoa->speciality_name}}</a>
                            
                        </span>
                        @else
                        @endif
                    </div>

                    <div class="body1">
                        {{$question->question_content}}
                        
                    </div>

             <div class="thanks-button-count">
                 <a href="#" title="" class="thank-hbsv" data-id="0">
                                    <span class="unactive" >
                                    <i class="fa fa-heart" aria-hidden="true"></i> Cảm ơn
                                    </span>
                                     <span class="active" >
                                    <i class="fa fa-heart" aria-hidden="true"></i> Đã cảm ơn
                                    </span>
                                </a>

                {{-- <div class="thanks-count-inner ">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                        <span class="thank-count-value">0</span>
                        <span>người đã cảm ơn bài viết</span>
                </div> --}}
            </div>
            </div>
                                        
                                    
            </article>
            @if(count($question->answers)>0)
            @foreach($question->answers as $ans)
            @if($ans->answer_type!="customer")
                    <article>
                        
                            
                        <div class="answer1">
                                <div class="answer-t">
                                        <a class="image " @if(!empty($ans->user->doctor->profile_image) || !empty($ans->user->clinic->profile_image)) style="background-image: url(@if($ans->user->doctor!=null)@if(strpos($ans->user->doctor->profile_image,'http')===false)/@endif{{$ans->user->doctor->profile_image}}@else @if(strpos($ans->user->clinic->profile_image,'http')===false)/@endif{{$ans->user->clinic->profile_image}} @endif);" @endif></a>

                                        <h3>
                                            
                                                <a href="@if($ans->user->doctor!=null || $ans->user->clinic!=null)@if($ans->user->doctor!=null)/danh-sach-bac-si-chi-tiet/@else/phongkham-chitiet/@endif{{App\Deals::strtoUrl($ans->user->doctor!=null?$ans->user->doctor->doctor_name: $ans->user->clinic->clinic_name)}}-{{$ans->user->doctor!=null?$ans->user->doctor->doctor_id: $ans->user->clinic->clinic_id}}@endif">
                                                    <i class="fa fa-fw fa-user-md" aria-hidden="true"></i>
                                                     @if($ans->user->doctor!=null || $ans->user->clinic!=null)
                                                     
                                                     {{$ans->user->doctor!=null?'Bác sĩ '.$ans->user->doctor->doctor_name:$ans->user->clinic->clinic_name}}
                                                     @else
                                                     {{$ans->user->fullname}}
                                                     @endif
                                                </a>
                                            

                                            <span class="verified-badge has-tooltip">
                                                <em>Chính thức</em>
                                                <span class="tooltip">Nội dung chính thức từ bác sĩ hợp tác với ViCare</span>
                                            </span>
                                        </h3>
                                            <p>
                                                <i class="fa fa-fw fa-stethoscope" aria-hidden="true"></i>                                  
                                                    <a href="/hoibacsi/danhsach/?speciality=kham-benh" title="Khám bệnh">Khám bệnh</a>

                                            </p>
                                        
                                    </div>

                                    <div class="body2">
                                        <div class="post-meta-dt2">
                                            <span class="time">{{$ans->created_at}}</span>

                                            
                                        </div>

                                        <div class="inner-boby">
                                            <div class="post-body-content">
                                                {{$ans->answer_content}}
                                            </div>                                      
                                        </div>
                                        <a href="#" class="reply" data-id="248072">
                                            <i class="fa fa-reply" aria-hidden="true"></i>
                                            Trả lời
                                        </a>

                    <div class="thanks-button-count">
                             <a href="#" title="" class="thank-hbsv" data-id="0">
                                    <span class="unactive" >
                                    <i class="fa fa-heart" aria-hidden="true"></i> Cảm ơn
                                    </span>
                                     <span class="active" >
                                    <i class="fa fa-heart" aria-hidden="true"></i> Đã cảm ơn
                                    </span>
                                </a>

                           {{--  <div class="thanks-count-inner ">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                                    <span class="thank-count-value">0</span>
                                    <span>người đã cảm ơn bài viết</span>
                            </div> --}}
                    </div>
                </div>
            </div>
                            
                        
            </article>
            @else
            <article>
                    <div class="u-answer">
                        <div class="answer-t">
                            <div class="post-meta-dt1">
                                <span class="user1">
                                    @if($ans->user!=null)
                                        {{$ans->user->fullname}}
                                    @else
                                        Giấu tên
                                    @endif
                                </span>

                                <span class="time1">
                                    Hỏi lúc: {{$ans->created_at}}
                                </span>

                                
                            </div>
                        </div>

                        <div class="body3">
                            <div class="inner-boby">
                                <div class="post-body-content">
                                    <p>{{$ans->answer_content}}</p>
                                </div>

                                
                            </div>
                            <div class="thanks-button-count">
                                <a href="#" title="" class="thank-hbsv" data-id="0">
                                    <span class="unactive" >
                                    <i class="fa fa-heart" aria-hidden="true"></i> Cảm ơn
                                    </span>
                                     <span class="active" >
                                    <i class="fa fa-heart" aria-hidden="true"></i> Đã cảm ơn
                                    </span>
                                </a>
                              

                               {{--  <div class="thanks-count-inner ">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                    <span class="thank-count-value">0</span>
                                    <span>người đã cảm ơn bài viết</span>
                                </div> --}}
                            </div>
                        </div>
                    </div>               
                </article>
                @endif
                @endforeach     
                @endif

                @if(Session::has('user') != null)
                            <div id="post-reply-form">
                                <h3>Trả lời</h3>

                                <form name="new-post" class="post-new" action="#" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        
                                            <div class="post-new-top">
                                                @if(Session::has('user') && Session::get('user')->user_type_id==2)
                                                <h4>{{Session::get('user')->fullname}}</h4>
                                                @endif
                                                <div class="avatar-form" style=""></div>
                                                @if(Session::has('user') && Session::get('user')->user_type_id==2)
                                                    <input name="reply_as_information" value="{&quot;reply_as_type&quot;: &quot;professional&quot;, &quot;reply_as_id&quot;: &quot;{{Session::get('user')->user_id}}&quot;}" type="hidden">
                                                @elseif(Session::has('user') && Session::get('user')->user_type_id==3)
                                                            <input name="reply_as_information" value="{&quot;reply_as_type&quot;: &quot;place&quot;, &quot;reply_as_id&quot;: &quot;{{Session::get('user')->user_id}}&quot;}" type="hidden">
                                                @else
                                                    <input name="reply_as_information" value="{&quot;reply_as_type&quot;: &quot;customer&quot;, &quot;reply_as_id&quot;: &quot;0&quot;}" type="hidden">
                                                @endif
                                                
                                            </div>
                                        
                                    

                                    <textarea class="form-control resize-textarea" name="body" required="" style="height: 108px;"></textarea>
                                    <button type="submit" class="btn btn-primary">Gửi trả lời</button>
                                    <input name="thread_id" value="{{$question->question_id}}" type="hidden">
                                </form>
                            </div>
                @else
                <h3><a href="/"> Bạn Cần Đăng Nhập đễ Bình Luận  </a></h3>

                 @endif
        </div>  


        <aside class="hbsv-cntr">
                <section class="sec-hbsv1">
                    
                        <h3>Hỏi bác sĩ</h3>
                    

                    <div class="collapsible-target" style="max-height: none;">
                        
                            <p>Chuyên mục Hỏi Bác sĩ mang đến cho người đọc dữ liệu hàng nghìn câu hỏi-đáp về sức khỏe đã được trả lời bởi các bác sĩ và chuyên gia uy tín. Bạn cũng có thể gửi câu hỏi mới để nhận được tư vấn trực tiếp của bác sĩ ngay tại đây, hoàn toàn miễn phí.</p>
                        
                    </div>

                    <div class="collapse-trigger" style="display: none;">
                        <span class="trigger-expand"><i class="fa fa-chevron-down"></i></span>
                        <span class="trigger-collapse"><i class="fa fa-chevron-up"></i></span>
                    </div>
                </section>

                
                <section class="sec-hbsv2" data-isshow="0">
                    <h3>Câu hỏi theo chuyên khoa<i id="down" class="fa fa-chevron-down"></i>
                        <i id="up" class="fa fa-chevron-up"></i></h3>
                    <?php $speciality = App\Speciality::all();?>
                    <div class="dropct-hbsv">
                        @foreach($speciality as $spec)
                        <dt>
                            <a href="/chuyenkhoa/{{$spec->specialty_url}}-{{$spec->speciality_id}}" class="" title="{{$spec->specialty_url}}">
                                <h5>{{$spec->speciality_name}}</h5>
                                <span class="thread-count "></span>
                            </a>
                        </dt>
                       
                        @endforeach
                    </div>

                 
                </section>
           
        </aside>
    </div>
</div>
@endsection