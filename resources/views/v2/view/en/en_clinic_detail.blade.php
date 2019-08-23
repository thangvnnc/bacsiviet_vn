<?php $csyt = $cs->clinic_name;?>
@extends('v2/view/en/en_main',['title'=> 'Clinic details'])
@section('en_content')
<script type="text/javascript">
  $(document).ready(function(){
    $(".btn-scroll-top").on('click',function(event){
      let data_id = $(this).attr("data-id");
      let scrollTop = $(data_id).offset().top;
      $(window).scrollTop(scrollTop);
    });

    $('ul li a').on('click',function(){
            $('li a').removeClass('active');
            $(this).addClass('active');
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
                        <li><a href="#">Clinic details</a></li>
                    </ul> 
                    
                </div>
                <h1>
                  <span itemprop="name">{{$cs['clinic_name']}}</span>
                </h1>
            </div> 
       
    </div><!-- #top -->
    <div class="contribution c1">
        <ul>

              <li >
                <a href="#gioi-thieu" title="" data-scroll-to="0" class="active">Introduce</a>
              </li>

              @if(isset($cs->doctors) && count($cs->doctors)!=0)
              <li >
                <a style="color: #ff749c;" class="btn-scroll-top" data-id="bac-si" title="" >Doctors ({{count($cs->doctors)}})</a>
              </li>
              @endif
            <li>
              <a style="color: #ff749c;" class="btn-scroll-top" data-id="#nhan-xet" title="">
                 Comment
                              </a>
            </li>


              <li>
                <a href="#map" title="">Map</a>
              </li>


              <li>
                <a style="color: #ff749c;" class="btn-scroll-top" data-id="#activity" title="Hoạt động trên ViCare">
                  Activity
                </a>
              </li>

          </ul>
    </div><!--Contribution-->
    <div id="aside" >
        <div class="ava" style="">
            <a  class="avatar-doctor" style="background-image: url({{url('public/images/health_facilities/'.$cs->profile_image)}})"></a>
        </div>
       
            <ul class="dg" href="#nhan-xet">

                <li  class="important">
                  <p><strong>{{round(($sum/$danhgia),1)}}</strong>( {{$danhgia}} Rate )</p>
                  
                </li>
            </ul>
       

        <div class="call-to-action">
            <a href="#dat-kham" class="dk"><i class="fa fa-calendar-check-o" aria-hidden="true"></i> Book now</a>
        </div>
        
        <div id="asd" >
            <p><i class="fa fa-map-marker"></i>{{$cs['clinic_address']}}</p>
        </div>
        
        <div id="asd" >
            <p><i class="fa fa-clock-o"></i>{{$cs['clinic_time']}}</p>
        </div>
        <div id="asd">
            <p><i class="fa fa-globe"></i>Speak

                  <a>VietNamese</a></p>
        </div>
    </div><!--Aside-->
   <div class="content">
      <div class="subsection">
        <div class="ck">
            <p id="gioi-thieu" style="text-align:justify; font-size: 15px;padding-bottom: 10px;">
              {!!$cs['clinic_desc']!!}
            </p>

        </div>
    </div>

    <div class="subsection">
        <h2><i class="fa fa-stethoscope"></i> Specialist</h2>
        <div class="ck">
                <ul class="original-list">
                  @if($cs->specialities !=null)
                  @foreach($cs->specialities as $sp)

                    <li style="color:#2B96CC;"> <a href="/danh-sach/?specialities="></a>
                    {{$sp->clinic->speciality_name}}</li>

                 @endforeach
                 @endif
                </ul>
        </div>
    </div>
    <div class="subsection">
        <h2><i class="fa fa-list-ul"></i> SERVICES AT {{$cs['clinic_name']}}</h2>
        <div class="ck">
            <ul class="original-list">
              @if($cs->services !=null ||$cs->services!="")
              @foreach($cs->services as $serv)
                <li style="color:#2B96CC;"> <a href="/danh-sach/?services="{{$serv->service->service_url}}></a>
                {{$serv->service->service_name}}</li>
               @endforeach
               @endif
            </ul>
        </div>
    </div>
    <div class="subsection">
        <h2><i class="fa fa-medkit"></i> MATERIAL AND EQUIPMENT FACILITIES</h2>
       <div class="ck">
              {!!$cs->facilities!!}
        </div>
    </div>
    <div class="subsection">
        <h2 id="bac-si"><i class="fa fa-user-md"></i> THE DOCTOR WILL WORK AT THE DEPARTMENT {{$cs['clinic_name']}}</h2>
        <div class="ck1">
             @foreach($bacsi as $b)
              <?php $cates = App\Doctor::find($b['doctor_id']); ?>
                <a class="group-filter-item" href="/danh-sach/bac-si/-{{$b['doctor_id']}}/" title="Xem thông tin chi tiết">{{$cates['doctor_name']}}</a>
              @endforeach
        </div>
    </div>
    <div class="subsection act">
        <h2 id="activity"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                Recent activities of {{$cs->clinic_name}}</h2>
          <ul class="activity-list">
            <?php \Carbon\Carbon::setLocale('vi') ?>
                @foreach($cs->activity as $at)
                <li>
                    <div class="entry-thumb" @if(!empty($cs->profile_image)) style="background-image: url(@if(strpos($cs->profile_image,'http')===false)/@endif{{$cs->profile_image}});" @endif></div>
                    <div class="entry-content">
                        <span class="entry-meta-time"> {!! \Carbon\Carbon::createFromTimeStamp(strtotime($at->created_at))->diffForHumans() !!} |  Answer <span>question:</span></span>
                        <h4><a href="/hoibacsi/{{$at->question['question_url']}}-{{$at->question['question_id']}}/">{{$at->question['question_title']}}</a></h4>
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
                        <a href="/hoibacsi/{{$at->question['question_url']}}-{{$at->question['question_id']}}/">Details <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                    </div>
                </li>
                @endforeach
            </ul>      
    </div>
    <div class="subsection">
        <h2 id="nhan-xet"><i class="fa fa-calendar"></i> Make an appointment with {{$cs->clinic_name}}</h2>
        <div class="ck1">
            <p style="font-size: 15px">
              Select the clinic and now you want to book from the calendar below. For advice on choosing a clinic, you can chat with us on this website or call us at <a href="tel:0947.436.421"></a>.
            </p>
        </div>
    </div>
    <div class="subsection">
        <h2 id="nhan-xet"><i class="fa fa-comment"></i> Comments on {{$cs->clinic_name}}</h2>
        <div class="comment-form" style="float: left">
             <form method="POST" action="/comment_doctor/{{$cs->clinic_id}}">
                <input name="_token" value="{{csrf_token()}}" type="hidden">
                        <p style="font-size: 15px">
                            Did you use the doctor's service {{$cs->clinic_name}}? Share your feelings with the community
                        </p>
                        <p style="font-size: 15px">
                            If you have health and professional questions, please go to the <a style="color:#2B96CC" href="/hoibacsi/datcauhoi/"> Ask a Doctor </a> for free advice.
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
                            <input name="professional" value="{{$cs->clinic_id}}" type="hidden">
                            @if(Session::get('user')!=null)
                            <button type=" submit" class="btn btn-primary">Send</button>
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
<script type='text/javascript'
src='https://maps.googleapis.com/maps/api/js'>
</script>

<?php

  $vitri = "";
  if($cs->clinic_address != ""){
     $vt = explode(",", $cs->clinic_address);
     if(isset($vt[3])){

      $vitri = $vt[3];

    }else{
      $vitri = $cs->clinic_address;
    }
  }else{
    $vitri = "Hồ Chí Minh";
  }


    function get_infor_from_address($address = null) {

      // $prepAddr = str_replace(' ', '+', stripUnicode($address));
      $prepAddr = str_replace(' ', '+', $address);

      $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');

      $output = json_decode($geocode);




      return $output;
    }

    // Loại bỏ dấu tiếng Việt để cho kết quả chính xác hơn
    function stripUnicode($str){
      if (!$str) return false;
      $unicode = array(
        'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd'=>'đ|Đ',
        'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
        'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ'
      );
      foreach($unicode as $nonUnicode=>$uni) $str = preg_replace("/($uni)/i",$nonUnicode,$str);
      return $str;
    }


      $address = get_infor_from_address($vitri);


      if($address->status == "ZERO_RESULTS"){
          $vt = $cs->clinic_address;
          $place = explode(",",$vt);
          $vitri = "Hà Nội";
          $address = get_infor_from_address($vitri);
      }
      // Thắng mod 20181106 1000 start
      // Fix bug lấy không có vị trí mà đi lấy item thứ 0 trong list empty
    // Mặc định lấy vị trí công ty nếu không lấy được
      $haveLat = isset($address->results[0]) ? $address->results[0] : false;
      $haveLong = isset($address->results[0]) ? $address->results[0] : false;
      $lat = 10.758363;
      $long = 106.662145;
      if ($haveLat && $haveLong){
          $lat = $address->results[0]->geometry->location->lat;
          $long = $address->results[0]->geometry->location->lng;
      }
      // Thắng mod 20181106 1000 end
?>

<script type='text/javascript'>
    var latitude = "<?php echo $lat; ?>";
    var longitude ="<?php echo $long; ?>";
    var address = "<?php echo $vitri; ?>";
function initialize()
{
    var myLatLng = new google.maps.LatLng(latitude,longitude);

 var mapProp = {
  zoom:10,
  center: myLatLng,
  mapTypeId: google.maps.MapTypeId.ROADMAP
  };
var map=new google.maps.Map(document.getElementById('map_canvas'),mapProp);

var marker = new google.maps.Marker({
  position: myLatLng,
  map: map,
  optimized: false,
  title:address
});
}


</script>

<body onload='initialize()'>

<div id='map_canvas' style='width:100%; height:100%;'></div>
</body>
</div>
@endsection
