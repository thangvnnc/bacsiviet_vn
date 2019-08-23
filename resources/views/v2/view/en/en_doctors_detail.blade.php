
@extends('v2/view/en/en_main',['title'=> 'Doctor details'])
@section('en_content')
<script type="text/javascript">
    $(document).ready(function(){
        $(".btn-scroll-top").on('click',function(event){
            let data_id = $(this).attr("data-id");
            let scrolltop = $(data_id).offset().top-90;
            $(window).scrollTop(scrolltop);
        });
    });
</script>
<div class="container">
    <div id="top">
            <div class="background"></div>
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/en">Home</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="">{{$doctor->doctor_name}}</a></li>
                    </ul> 
                    
                </div>
                <h1 style="font-size: 16px;">
                    {{$doctor->doctor_name}}
                    <span class="verified-badge">
                        <em>Official</em>
                    </span>
                </h1>
            </div> 
            
    </div><!-- #top -->
    <div id="aside">
        <div class="ava" style="">
            <a href="#" class="avatar-doctor" style=" background-image: url(
            <?php
            if (strlen(strstr("$doctor->profile_image", "https://dwbxi9io9o7ce.cloudfront.net")) > 0) {
                echo "$doctor->profile_image";
            }
            else{
                echo "/public/images/doctor/$doctor->profile_image";
            }
            
            ?>
            )"></a>
        </div>
        <div class="call-to-action">
            <a href="https://medixlink.com/chat" class="dk"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Book now</a>
        </div>

        <div class="achat">
            <a id="chatdt"  href="https://medixlink.com/chat">Chat with {{$doctor->doctor_name}}</a>
        </div>
    </div><!--Aside-->
   <div class="content">
        <div class="contribution">
         <ul>
            <li>
                <a class="btn-scroll-top" data-id="#nhan-xet">
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                <span>Satisfied</span>
                                <strong>0</strong>
                </a>
            </li>
            <li>
                <a class="btn-scroll-top" data-id="#nhan-xet" class="sticky-nav-link">
                    <i class="fa fa-commenting" aria-hidden="true"></i>
                    <span>Comment</span>
                    <strong>0</strong>
                </a>
            </li>
            <li>
                <a class="btn-scroll-top" data-id="#activity">
                    <i class="fa fa-reply" aria-hidden="true"></i>
                    <span>Answer</span>
                    <strong>0</strong>
                </a>
            </li>

            <li>
                <a class="btn-scroll-top" data-id="#activity">
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    <span>Thanks</span>
                    <strong>64</strong>
                </a>
            </li>
        </ul>
    </div><!--Contribution-->

    <div class="subsection">
        <h2><i class="fa fa-stethoscope"></i> Specialities</h2>
        <div class="ck">
                @if($doctor->specialities!=null)
                    @foreach($doctor->specialities as $spec)
                      <ul>
                        <li> <a style="color: #2B96CC" href="/danh-sach/bac-si/?specialities={{$spec->speciality->specialty_url}}">{{$spec->speciality->speciality_name}}</a> </li>
                      </ul>
                    @endforeach
                @endif
        </div>
    </div>
    <div class="subsection">
        <h2><i class="fa fa-list-ul"></i> Service</h2>
        <div class="ck">
            @if($doctor->services!=null)
                        @foreach($doctor->services as $ser)
                        <ul >
                            <li> <a style="color: #2B96CC" href="/danh-sach/bac-si/?services={{$ser->service}}">{{$ser->service['service_name']}}</a> </li>
                        </ul>
                        @endforeach
            @endif
        </div>
    </div>
       <style>
           .ck1 ul li{
               list-style-type: disc;
               margin-left: 20px;
           }
       </style>
    <div class="subsection">
        <h2><i class="fa fa-hospital-o"></i> Workplace</h2>
        <div class="ck1">
            {!!$doctor->doctor_clinic!!}
        </div>
    </div>
    <div class="subsection">
        <h2><i class="fa fa-book"></i> Experience</h2>
        <div class="ck1">
            {!!$doctor->experience!!}
        </div>
    </div>
    @if($doctor->training!=null)
    <div class="subsection">
        <h2><i class="fa fa-graduation-cap"></i> Training process</h2>             
        <div class="ck1">
            {!!$doctor->training!!}
        </div>
    </div>
    @endif

       <div class="subsection">
           <h2><i class="fa fa-usd"></i>Price</h2>
           <div class="ck" style="margin-left: 24px;">
               @if($doctor->price!=null)
                   {!!$doctor->price!!}
               @else
                   1000
               @endif
               Vnd/Minute
           </div>
       </div>
    <div class="subsection act">
        <h2 id="activity"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                Recent activities of {{$doctor->doctor_name}}</h2>
          <ul class="activity-list">
            <?php \Carbon\Carbon::setLocale('vi') ?>
                @foreach($doctor->activity as $at)
                <li>
                    <div class="entry-thumb" style="background-image: url({{url('public/images/doctor/'.$doctor->profile_image)}});" ></div>
                    <div class="entry-content">
                        <span class="entry-meta-time"> {!! \Carbon\Carbon::createFromTimeStamp(strtotime($at->created_at))->diffForHumans() !!} |  Answer <span>question:</span></span>
                        <h4><a href="/hoi-bac-si/{{$at->question['question_url']}}-{{$at->question['question_id']}}/">{{$at->question['question_title']}}</a></h4>
                        <p>
                         @if($at->answer_content!=null)
                          @if(strlen($at->answer_content)>100 && strpos($at->answer_content, ' ', 100)!="")
                            {!!substr( $at->answer_content, 0, strpos($at->answer_content, ' ', 100) )!!}       
                            
                          @else
                             {!!$at->answer_content!!}      
                          @endif
                        
                        @endif
                        </p>
                        
                        <span class="thank"><i class="fa fa-heart" aria-hidden="true"></i> 0</span>
                        <a href="/hoi-bac-si/{{$at->question['question_url']}}-{{$at->question['question_id']}}/">Detail <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                    </div>
                </li>
                @endforeach 
            </ul>      
    </div>
   
    <div class="subsection" id="nhan-xet">
        <h2 id="nhan-xet"><i class="fa fa-comment"></i> Comment on the doctor {{$doctor->doctor_name}}</h2>
        <div class="comment-form" style="float: left">
             <form method="POST" action="/comment_doctor/{{$doctor->doctor_id}}">
                <input name="_token" value="{{csrf_token()}}" type="hidden">
                        <p style="font-size: 15px;">
                            You have used a doctor's service {{$doctor->doctor_name}}? Share your feelings with the community.
                        </p>
                        <p style="font-size: 15px;">
                            If you have questions about health and expertise, please go to the page <a style="color:#2B96CC" href="/hoi-bac-si/dat-cau-hoi/">Ask doctor</a> for free advice.
                        </p>
                        
                        <div class="form-row">
                            <div class="form-field">
                                <label style="font-weight: bold;">
                                    Comment:
                                </label>
                                <div class="form-field-input">
                                    <textarea name="comment" placeholder="Your review..." required=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row indented">
                            <div class="form-field">
                                <div class="form-field-input1">
                                    <label style="color: #ff749c" class="like">
                                        <input name="like" value="true" type="radio">
                                        <i class="fa fa-thumbs-up"></i> Satisfied
                                    </label>
                                    <label class="dislike">
                                        <input name="like" value="false" type="radio">
                                        <i class="fa fa-thumbs-down"></i> Unsatisfied
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="button-row">
                            <input name="professional" value="{{$doctor->doctor_id}}" type="hidden">
                            @if(Session::get('user')!=null)
                            <button type="submit" class="btn btn-primary">Send</button>
                            @else
                            <a style="color: #2B96CC" href="/en">Login to comment</a>
                            @endif
                        </div>
                    </form>
                <div class="form-success">
                    <h4><i></i>
                        @if(session('thongbao'))
                            {{session('thongbao')}}
                             @endif</h4>
                  
                </div>
            </div>
        
    </div>
   </div>

</div>
@endsection