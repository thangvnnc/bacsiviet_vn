@extends('v2/view/en/en_main',['title'=> 'Doctors'])
@section('en_content')

<div class="container">
        <div id="top">
            <div class="background"></div>
            <div class="link">
                <div class="nav">
                    <ul>
                        <li><a href="/en">Home</a></li>
                        <li>&nbsp;>&nbsp;</li>
                        <li><a href="#">List Doctors</a></li>
                    </ul> 
                    
                </div>
               
                <div class="row">
                    <div class="col-md-3">
                        <h1 style="font-size: unset;width: 100%;">                
                            @if(request()->input('q')!==null)
                            Search for a doctor by keyword "{{urldecode(request()->input('q'))}}"         
                            @else
                                List Doctors

                                @if(Session::has('province'))
                                    </br>in <span class="province_name">{{@$_COOKIE['province']}}</span>
                                @endif
                            @endif
                            <span class="weak"></span>
                        </h1> 
                    </div>
                  
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
                    <a href="/en/danhsach-phongkham/?q={{request()->input('q')}}">
                        Clinic ({{$clinic or '0' }})
                    </a>
                </li>

                 <li>
                        <a href="/en/danh-sach-nha-thuoc/?q={{request()->input('q')}}" >
                            Drugstore ({{$drugstore or '0' }})
                        </a>
                </li>
                
                <li>
                    <a href="/en/danh-sach-bac-si/?q={{request()->input('q')}}" class="active">
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
                        <?php $specs = App\Speciality::all();$selectsp = request()->input('speciality');?>
                        
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
                        @if(isset($doctors))
                        @foreach($doctors as $dr)
                            <li>
                                <div id="avatar">
                                    <a href="/en/danh-sach-bac-si-chi-tiet/{{$dr->doctor_url}}-{{$dr->doctor_id}}/{{$dr->doctorspeciality->speciality->specialty_url or null}}" style="background-image: url(
                                        <?php
                                            if (strlen(strstr("$dr->profile_image", "https://dwbxi9io9o7ce.cloudfront.net")) > 0) {
                                                echo "$dr->profile_image";
                                            }
                                            else{
                                                echo "/public/images/doctor/$dr->profile_image";
                                            }
                                         ?>);"></a>
                                </div><!--Avatar-->
                                
                                <div class="content">
                                    <div class="name">
                                        <a href="/en/danh-sach-bac-si-chi-tiet/{{$dr->doctor_url}}-{{$dr->doctor_id}}/{{$dr->doctorspeciality->speciality->specialty_url or null}}">{{$dr->doctor_name}}</a>
                                </div><!--Name-->
                                <div class="desc">
                                        @if(!empty($dr->doctor_description)|| $dr->doctor_description!='')
                                            {{$dr->doctor_description}}
                                        @if(strlen($dr->doctor_description)>200 && strpos($dr->doctor_description, ' ', 200)!="")
                                        {!!substr( $dr->doctor_description, 0, strpos($dr->doctor_description, ' ', 200) )!!}
                                        
                                            <a class="readmore" style="color: #2fa4e7;" href="/en/danh-sach-bac-si-chi-tiet/{{$dr->doctor_url}}-{{$dr->doctor_id}}/{{$dr->doctorspeciality->speciality->specialty_url or null}}">Show more <i style="color: #2fa4e7;" class="fa fa-angle-double-right"></i></a>
                                        @endif
                                        @endif
                                </div><!--Description-->
                             
                                    <div>
                                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                                             <b >Address: </b>
                                             <a style=" color: #2fa4e7;" href="/en/danh-sach-bac-si-chi-tiet/?q={{$dr->doctor_address}}&key=city">
                                            @if(strtolower(request()->input('q')) == strtolower($dr->doctor_address))
                                                    <b >{{$dr->doctor_address}}</b>
                                                @else 
                                                    {{$dr->doctor_address}}
                                                @endif
                                            </a>
                                        
                                    </div><!--Address-->
                              
                                    <div>   

                                        <p><i class="fa fa-hospital-o"></i><b> Work place:</b> {!!$dr->doctor_clinic!!}</p>
                                    </div><!--Clinic-->
                                 
                                    <div id="chat">
                                        <i class="fas fa-phone"></i> <a  href="/en/chat" class="bt button secondary" title="Chat với {{$dr->doctor_name}}">
                                        Chat with {{$dr->doctor_name}}</a><br>
                                        
                                    </div><!--Chat-->
                                   
                                    <div >
                                        <p style="font-weight: bold; float: left; margin-right: 10px;" ><b>Work time: </b>{{$dr->doctor_timework}}</p>

                                        <p style="font-weight: bold; color: #E84F5E;" >
                                            <?php

                                            if($dr->price != null)
                                            {
                                                echo $dr->price;
                                            }
                                            else
                                            {
                                                echo 1000;
                                            }
                                            ?>
                                            Vnd/Min</p>
                                    </div><!--Time work-->
                                </div>
                               
                            </li>
                        @endforeach
                        @endif
                    </ul>
                </div><!--Doctor Info-->
                <div class="pagination" style="">
                   
                    
                    <span >
                        {!! $doctors->appends(request()->input())->links(); !!}
                    </span>
                   
                </div>
            </div>
        </div><!--List doctor-->
</div>

@endsection