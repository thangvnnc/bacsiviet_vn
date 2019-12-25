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
            if(width > 768){
                $('.sechbs2').off('click');
                $('.sechbs2').find('.ud').show();
            }
            else{
                 $('.sechbs2').on('click',function(){
                    let data_isshow = $(this).attr('data-isshow');
                    if(data_isshow == 0){
                        $(this).find('#up').show();
                        $(this).find('#down').hide();
                        $(this).find('.ud').show();
                        $(this).attr('data-isshow','1');
                    }
                    else{
                        $(this).find('#up').hide();
                        $(this).find('#down').show();
                        $(this).find('.ud').hide();
                        $(this).attr('data-isshow','0');
                    }
                });
            }
        }
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
                <h1 style="font-size: 18px">Chuyên mục Hỏi bác sĩ</h1>

                <a class="buthbs" href="/hoibacsi/datcauhoi/" title="Đặt câu hỏi cho bác sĩ, hoàn toàn miễn phí">
                    <i class="fa fa-commenting" aria-hidden="true"></i> Đặt câu hỏi miễn phí
                </a>

            </div>
    </div><!-- #top -->
    <br><br><br>
    <div class="cnthbs">
        <div class="cntleft">
            <div id="forum-landing-bottom">
                <div class="header">
                    <h3>Các câu trả lời mới nhất</h3>
                </div>
                @foreach($question as $qs)
                <article>
                        <div class="question">
                            <h3><a href="/hoibacsi/{{$qs->question_url}}-{{$qs->question_id}}">{{$qs->question_title}}</a></h3>

                            <div class="post-meta-data">
                                <span class="user">
                                    <?php $user = App\Users::where('user_id',$qs->user_id)->first(); ?>

                                    @if(isset($user) )
                                    {{-- && count($user) >0 --}}
                                            {{$user->fullname}}
                                    @else
                                    Giấu tên
                                    @endif
                                </span>
                                <span class="time">
                                    {{date("d-m-Y H:i:s A", strtotime($qs->created_at.  ' -7'))}}
                                </span>

                                <?php $chuyenkhoa = App\Speciality::find($qs->speciality_id) ?>
                                @if(isset($chuyenkhoa) && $chuyenkhoa)
                                <span class="ckhbs">
                                    Chuyên khoa:
                                    <a href="/hoibacsi/danhsach/?speciality=san-phu" title="">
                                    {{$chuyenkhoa->speciality_name}}
                                    </a>
                                </span>
                                @else
                                @endif
                            </div>

                            <div class="body">
                                <p>{{$qs->question_content}}</p>
                                <div class="thank-count">
                                    <i class="fa fa-heart" style="color: #ff749c" aria-hidden="true"></i>
                                    <span>1</span>
                                    người cám ơn bài viết
                                </div>

                            </div>
                        </div>
                    <?php $traloi = App\Answer::where('question_id',$qs['question_id'])->first(); ?>
                    @if(isset($traloi) && $traloi )
                        <div class="answer">
                            <span>Được trả lời bởi</span>
                            <ul>
                                @if($traloi->user!== null)
                                    @if($traloi->user->doctor!==null)
                                        <li>
                                                <span class="image " @if(!empty($traloi->user->doctor->profile_image)) style="background-image: url(@if(strpos($traloi->user->doctor->profile_image,'http')===false)/@endif{{$traloi->user->doctor->profile_image}});" @endif></span>

                                                <h4><a href="/danh-sach-bac-si-chi-tiet/{{$traloi->user->doctor->doctor_url}}-{{$traloi->user->doctor->doctor_id}}">
                                                    Bác sĩ {{$traloi->user->doctor->doctor_name}}
                                                    </a>
                                                </h4>

                                                @if(strlen($traloi->user->doctor->doctor_description)>200 && strpos($traloi->user->doctor->doctor_description, ' ', 200)!="")

                                                    <span>{!!substr( $traloi->user->doctor->doctor_description, 0, strpos($traloi->user->doctor->doctor_description, ' ', 200) )!!}</span>
                                                @else
                                                    {{$traloi->user->doctor->doctor_description}}
                                                @endif
                                            </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                     @endif
                </article>
                @endforeach
                 <div style="padding-left: 25%;" class="view-more">

                        {!!$question->links()!!}

                </div>
            </div>
    </div><!--.-->
     <div class="global-thread-create-cta">
        <a href="/hoibacsi/datcauhoi/" class="button">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
            <strong>Hỏi bác sĩ</strong>
            <span>miễn phí</span>
        </a>
    </div>
</div>
@endsection