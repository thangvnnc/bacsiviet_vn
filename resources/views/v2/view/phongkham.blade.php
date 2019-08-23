@extends('v2/structor/main',['title'=> 'Cơ sở y tế'])
@section('content')

<div class="container">
        <div id="top">
            <div class="background"></div>
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="#">Trang chủ</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="#">Cơ sở y tế</a></li>
                    </ul> 
                    
                </div>
               
                <div>
                    <h1 style="font-size: unset;">
                        @if(request()->input('q')!==null)
                        Tìm kiếm thuốc theo từ khóa "{{urldecode(request()->input('q'))}}"
                        @else
                            Danh sách phòng khám
                            @if(Session::has('province'))
                                </br>tại {{@$_COOKIE['province']}}
                            @endif
                        @endif
                        <span class="weak"></span>
                    </h1>
                </div> 
            </div> 
        </div><!-- #top -->
        <br>
        @if(request()->input('q')!==null)
             <div id="search">
        
            <ul>
                <li>
                    <span>Tìm kiếm theo:</span>
                </li>
                
                <li>
                    <a href="/danhsach-phongkham/?q={{request()->input('q')}}" class="active">
                        Phòng khám ({{$clinic or '0' }})
                    </a>
                </li>

                 <li>
                        <a href="/danh-sach-nha-thuoc/?q={{request()->input('q')}}" >
                            Nhà thuốc ({{$drugstore or '0' }})
                        </a>
                </li>

                <li>
                    <a href="/danh-sach-bac-si/?q={{request()->input('q')}}">
                        Bác sĩ ({{$doctor or '0'}})
                    </a>
                </li>
                  <li>
                    <a href="/hoibacsi/danhsach/?q={{request()->input('q')}}">
                        Hỏi bác sĩ ({{$question or '0'}})
                    </a>
                </li>
                <li>
                    <a href="/benh/tim-kiem/?q={{request()->input('q')}}" >
                        Bệnh ({{$count or '0'}})
                    </a>
                </li>

                <li>
                    <a href="/thuoc-danhsach/?q={{request()->input('q')}}">
                        Thuốc ({{$thuoc or '0'}})
                    </a>
                </li>
                
               
                
            </ul>
        
            </div><!-- #Nav search -->
        @endif
        <br>
         <div class="search">
            <form action="" method="" class="form-inline">
                <div class="form-field">
                <select class="select s1" name="province">
                    <option value="">Cả nước</option>
                    <?php $province = App\Province::all();
                        $select = request()->input('province');?>
                  
                        @foreach($province as $pr)
                            <option value="{{$pr->id}}" @if($pr->id==$select)selected="selected" @endif>{{$pr->name}}</option>
                        @endforeach
                </select>
                </div>
                <div class="form-field">
                    <select name ="speciality" class="select s1">
                        <option value="">Chuyên khoa</option>
                        <?php $specs = App\Speciality::all();$selectsp = request()->input('speciality');?>
                        
                        @foreach($specs as $sp)
                            <option value="{{$sp->specialty_url}}" @if($sp->specialty_url===$selectsp)selected="selected" @endif>{{$sp->speciality_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div >
                    <button type="submit" class="but">Lọc tìm kiếm</button>
                </div>
                
            </form>
        </div><!--.Search-->
        <!--List Doctors-->
        <br>
        <div class="list">
            <div id="content">
                <div class="dt">
                    <ul>
                        @if(isset($clinics))
                        @foreach($clinics as $cl)
                            <li>
                                <div id="avatar">
                                    <a href="/phongkham-chitiet/{{$cl->clinic_url}}-{{$cl->clinic_id}}/kham-benh"
                                style="background-image: url({{url('public/images/health_facilities/'.$cl->profile_image)}});">
                                    </a>
                                </div><!--Avatar-->

                                <div class="content ct">
                                    <div class="name">
                                        <h2><a href="/phongkham-chitiet/{{$cl->clinic_url}}-{{$cl->clinic_id}}/kham-benh">{{$cl->clinic_name}}</a>
                                             <span class="verified-badge">
                                                 <em style="text-transform: uppercase;">Chính thức</em>
                                             </span>
                                        </h2>
                                     </div><!--Name-->
                                    <div class="desc dpk">
                                    @if(strlen($cl->clinic_desc)>200)
                                        {{substr( $cl->clinic_desc, 0, strpos($cl->clinic_desc, ' ', 200) )}}...
                                        <a class="readmore" style="color: #4080ff;" href="/phongkham-chitiet/{{$cl->clinic_url}}-{{$cl->clinic_id}}/kham-benh">Xem tiếp <i style="color: #4080ff;" class="fa fa-angle-double-right"></i></a>
                                    @else
                                        {{$cl->clinic_desc}}
                                        <a class="readmore" style="color: #4080ff;" href="/phongkham-chitiet/{{$cl->clinic_url}}-{{$cl->clinic_id}}/kham-benh">Xem tiếp <i style="color: #4080ff;" class="fa fa-angle-double-right"></i></a>
                                    @endif
                                    </div><!--Description-->

                                    <div>
                                        <p><i class="fa fa-map-marker"></i>{{$cl->clinic_address}}</p>
                                    </div><!--Address-->

                                    <div>
                                        <p><i class="fa fa-stethoscope"></i>

                                                @foreach($cl->specialities as $sp)
                                                @if(count($cl->specialities) > 0)
                                                    @if(isset($sp->clinic))
                                                    <a href="/danhsach-phongkham/?specialities={{$sp->clinic->specialty_url}}">{{$sp->clinic->speciality_name}}</a>
                                                    @endif
                                                @endif
                                                @endforeach</p>



                                    </div><!--Clinic-->
                                    <div >
                                        <i class="fa fa-user-md"></i> {{count($cl->doctors)}} bác sĩ
                                    </div>


                                    <div>
                                        <span >Giờ Mở Cửa : <b style="color: #4080ff;">{{$cl->clinic_timeopen}}</b></span>
                                    </div><!--Time work-->

                                    <div class="call">
                                        <a href="#contact-29068">
                                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                            Đặt khám nhanh
                                        </a>
                                        <a href="#" >
                                            <i class="fa fa-heart" aria-hidden="true"></i> Ghi nhớ
                                        </a>
                                    </div>
                                </div>

                            </li>
                        @endforeach
                        @endif
                    </ul>
                </div><!--Doctor Info-->
                <div class="pagination" style="">


                    <span >
                     {!! $clinics->appends(request()->input())->links(); !!}
                    </span>

                </div>
            </div>
        </div><!--List doctor-->
</div>

@endsection