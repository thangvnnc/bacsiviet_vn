@extends('v2/view/en/en_main',['title'=> 'Clinic'])
@section('en_content')

<div class="container">
        <div id="top">
            <div class="background"></div>
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/en">Home</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="#">Clinic</a></li>
                    </ul> 
                    
                </div>
               
                <div>
                    <h1 style="font-size: unset;">
                        @if(request()->input('q')!==null)
                        Search for a doctor by keyword "{{urldecode(request()->input('q'))}}"          
                        @else
							List of clinics
                            @if(Session::has('province'))
                                </br>in {{@$_COOKIE['province']}}
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
                    <span>Search by:</span>
                </li>
                
                <li>
                    <a href="/en/danhsach-phongkham/?q={{request()->input('q')}}" class="active">
                        Clinic ({{$clinic or '0' }})
                    </a>
                </li>

                 <li>
                        <a href="/en/danh-sach-nha-thuoc/?q={{request()->input('q')}}" >
                            Drugstore ({{$drugstore or '0' }})
                        </a>
                </li>
                
                <li>
                    <a href="/en/danh-sach-bac-si/?q={{request()->input('q')}}">
                        Doctors ({{$doctor or '0'}})
                    </a>
                </li>
                  <li>
                    <a href="/en/hoibacsi/danhsach/?q={{request()->input('q')}}">
                        Ask doctor ({{$question or '0'}})
                    </a>
                </li>
                <li>
                    <a href="/en/benh/tim-kiem/?q={{request()->input('q')}}" >
                        Diseace ({{$count or '0'}})
                    </a>
                </li>
                
                <li>
                    <a href="/en/thuoc-danhsach/?q={{request()->input('q')}}">
                        Medicine ({{$thuoc or '0'}})
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
                    <option value="">Country</option>
                    <?php $province = App\Province::all();
                        $select = request()->input('province');?>
                  
                        @foreach($province as $pr)
                            <option value="{{$pr->id}}" @if($pr->id==$select)selected="selected" @endif>{{$pr->name}}</option>
                        @endforeach
                </select>
                </div>
                <div class="form-field">
                    <select name ="speciality" class="select s1">
                        <option value="">Specialist</option>
                        <?php $specs = App\Speciality::all();
                            $selectsp = request()->input('speciality');
                        ?>
                        @foreach($specs as $sp)
                            <option value="{{$sp->specialty_url}}" @if($sp->specialty_url===$selectsp)selected="selected" @endif>{{$sp->en_speciality_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div >
                    <button type="submit" class="but">Filter search</button>
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
                                    <a href="/en/phongkham-chitiet/{{$cl->clinic_url}}-{{$cl->clinic_id}}/kham-benh"
                                style="background-image: url({{url('public/images/health_facilities/'.$cl->profile_image)}});">
                                    </a>
                                </div><!--Avatar-->
                                
                                <div class="content ct">
                                    <div class="name">
                                        <h2><a href="/en/phongkham-chitiet/{{$cl->clinic_url}}-{{$cl->clinic_id}}/kham-benh">{{$cl->clinic_name}}</a>
                                             <span class="verified-badge">
                                                 <em style="text-transform: uppercase;">Offical</em>
                                             </span>                    
                                        </h2>
                                     </div><!--Name-->
                                    <div class="desc dpk">
                                        @if(strlen($cl->clinic_desc)>200)
                                        {{substr( $cl->clinic_desc, 0, strpos($cl->clinic_desc, ' ', 200) )}}...
                                        <a class="readmore" style="color: #4080ff;" href="/en/phongkham-chitiet/{{$cl->clinic_url}}-{{$cl->clinic_id}}/kham-benh">Show more <i style="color: #4080ff;" class="fa fa-angle-double-right"></i></a>
                                    @else
                                        {{$cl->clinic_desc}}
                                        <a class="readmore" style="color: #4080ff;" href="/en/phongkham-chitiet/{{$cl->clinic_url}}-{{$cl->clinic_id}}/kham-benh">Show more <i style="color: #4080ff;" class="fa fa-angle-double-right"></i></a>
                                    @endif
                                    </div><!--Description-->
                             
                                    <div>
                                        <p><i class="fa fa-map-marker"></i>{{$cl->clinic_address}}</p>
                                    </div><!--Address-->
                              
                                    <div>
                                          <p><i class="fa fa-stethoscope"></i>@foreach($cl->specialities as $sp)
                                                     <a href="/en/danhsach-phongkham/?speciality={{$sp->clinic->speciality_url}}">{{$sp->clinic->speciality_name}}</a>
                                                
                                                @endforeach</p>  
                                                
                                    </div><!--Clinic-->
                                    <div >
                                        <i class="fa fa-user-md"></i> {{count($cl->doctors)}} doctor
                                    </div>
                                   
                                        
                                    <div>
                                        <span >Work time : <b style="color: #4080ff;">{{$cl->clinic_timeopen}}</b></span>
                                    </div><!--Time work-->
                                   
                                    <div class="call">
                                        <a href="#contact-29068">
                                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                            Set up a quick examination
                                        </a>
                                        <a href="#" >
                                            <i class="fa fa-heart" aria-hidden="true"></i> Memorize
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