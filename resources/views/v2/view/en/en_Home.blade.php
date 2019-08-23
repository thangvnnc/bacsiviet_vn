@extends('v2/view/en/en_main',['title'=> 'Home'])
@section('en_content')
     <div class="global-thread-create-cta">
            <a href="/hoibacsi/datcauhoi/" class="button">
                <i class="fa fa-question-circle" aria-hidden="true"></i>
                <strong>Ask doctor</strong>
                <span>free</span>
            </a>
        </div>
     <section id="register" style="margin-top: -70px;">
        <div class="inner clr">
            <div class="span span2 alone @if(Session::get('user') != null) h-center @endif">
                <div class="middle-item">
                    <div><img class="center" src="public/v2/img/home_two_mobiles_en.png" alt="">
                        <p class="text-center langtr" key="p-home" >A doctor who is always with you</p>
                        <div class="apps clr middle-item">
                            <a href="https://itunes.apple.com/us/app/medixlink/id1443310734?ls=1&amp;mt=8"><img
                                        src="public/v2/img/appstore.svg" alt=""></a>
                            <a href="https://play.google.com/store/apps/details?id=com.app.khambenh.bacsiviet"><img
                                        src="public/v2/img/playstore.svg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
            @if(Session::get('user') == null)
                <?php $isLoginTag = false;?>
                <div class="span span2 alone pp white-bg rounded">
                    <div class="block-register">
                        <div class="group-labels clr">
                            <label class="register-tab  @if($errors->has('errorReg') || session('successReg')) active @else <?php $isLoginTag = true;?> @endif"><span key="dk" class="langtr">Register</span></label>
                            <label class="login-tab  @if($errors->has('errorlogin') || $isLoginTag) active @endif"><span key="dn" class="langtr">Login</span></label>
                        </div>
                        <div class="tab-register @if($errors->has('errorReg') || session('successReg')) active @endif">
                            @if($errors->has('errorReg'))
                                <div class="alert alert-danger">
                                    {{$errors->first('errorReg')}}
                                </div>
                            @endif
                            @if (session('successReg'))
                                <div class="alert alert-success">
                                    {{session('successReg')}}
                                </div>
                            @endif
                            <form action="/en/dang-ky" method="post" enctype="miltipart/form-data">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>

                                <div class="group-input">
                                    <h3 key="ht" class="langtr">FULL NAME</h3>
                                    <div>
                                        <input type="text" name="name" id="name" placeholder="Full name">
                                    </div>
                                </div>
                                <div class="group-input">
                                    <h3 key="sdt" class="langtr">PHONE</h3>
                                    <div>
                                        <input type="text" name="mobile_phone" id="phone" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="group-input">
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <h3 key="gen" class="langtr">GENDER</h3>
                                            <select name="gender" class="form-control test" required="" id="gender"
                                                    type="text">
                                                <option key="oth" class="langtr" value="3">OTHER</option>
                                                <option key="male" class="langtr" value="1">MALE</option>
                                                <option key="fem" class="langtr" value="2">FEMALE</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <h3 key="ltk" class="langtr">ACCOUNT TYPE</h3>
                                            <select class="form-control test" name="type" required="">
                                                <option value="user" key="user" class="langtr" selected="selected">User</option>
                                                <option key="doc" class="langtr" value="professional">Doctor</option>
                                                <option key="qlpk" class="langtr" value="place">Clinic management</option>
                                                <option key="drug" class="langtr" value="drugstore">Drugstore</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="group-input text">
                                    <h3 key="dce" class="langtr">EMAIL ADDRESS</h3>
                                    <div>
                                        <input type="text" name="email" id="user" placeholder="Email">
                                    </div>
                                </div>
                                <div class="group-input text">
                                    <h3>PASSWORD</h3>
                                    <div>
                                        <input type="password" name="password"
                                               placeholder="The password must be at least 5 characters in length">
                                    </div>
                                </div>

                                <br>
                                <div class="fcenter">
                                    <button type="submit" key="dk"  class="btn btn-ok btn-rounded langtr" value="">Register</button>
                                </div>

                            </form>
                        </div>
                        <div class="tab-login @if($errors->has('errorlogin') || $isLoginTag) active @endif">
                            <form method="post" action="/en/dang-nhap" name="login">
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <input type="hidden" name="next" value="{{Request::get('next')}}"/>
                                <p>*All fields are required</p>
                                <div class="group-input">
                                    <h3>USERNAME</h3>
                                    <div>
                                        <input name="email" required="" type="text" placeholder="User name">
                                    </div>
                                </div>
                                <div class="group-input">
                                    <h3>PASSWORD</h3>
                                    <div>
                                        <input name="password" required="" type="password" placeholder="Password">
                                    </div>
                                </div>
                                {{--<div class="req"><span>Quên mật khẩu?</span> <a href="#" class="alink">Tạo lại mật khẩu</a></div>--}}
                                <div class="req">
                                    @if($errors->has('errorlogin'))
                                        <div class="form-row">
                                            <div class="alert alert-danger">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-hidden="true">
                                                    &times;
                                                </button>
                                                <p style="color: #E84F5E;">{{$errors->first('errorlogin')}} </p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="fcenter">
                                    <button type="submit" key="dn"  class="btn btn-ok btn-rounded langtr" value="">Login</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            @endif
        </div>
        <div id="stuffs">
            <div class="inner inner2">
                <h2 class="cat-title"><span key="gt" class="title langtr"></span></h2>
                <em key="conn" class="langtr">Online medical system in Viet Nam with over 1000 good doctors, clinics all specialties and more than 1,000,000 patients nationwide with all specialties</em></div>
            <div class="inner">
                <div class="com-slider owl-carousel owl-theme">
                    <div class="item" data-aos="fade-in">
                        <figure><img src="public/v2/img/slider-5.jpg" alt="">
                            <figcaption>
                                <p key="chatdt" class="langtr">1. Chat text directly with a good doctor on the App on the phone anytime, anywhere</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-in">
                        <figure><img src="public/v2/img/slider-6.jpg" alt="">
                            <figcaption>
                                <p key="chataudi" class="langtr">2. Chat Audio speaks directly to doctors anytime, anywhere</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-in">
                        <figure><img src="public/v2/img/slider-7.jpg" alt="">
                            <figcaption>
                                <p key="chatvideo" class="langtr">3. Video chat webcam camera talk directly with the doctor anytime, anywhere</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <figure><img src="public/v2/img/slider-1.jpg" alt="">
                            <figcaption>
                                <p key="func" class="langtr">4. The function of searching drugs, searching for pharmaceuticals in the list of over 60,000 types drug</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <figure><img src="public/v2/img/slider-2.jpg" alt="">
                            <figcaption>
                                <p key="ssick" class="langtr">5. Look up disease with her more than 50,000 diseases</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <figure><img src="public/v2/img/slider-3.jpg" alt="">
                            <figcaption>
                                <p key="catedt" class="langtr">6. List of more than 1000 doctors nationwide on the system</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-down">
                        <figure><img src="public/v2/img/slider-4.jpg" alt="">
                            <figcaption>
                                <p key="gquest" class="langtr">7. Send questions directly on the web</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="inner inner2">
                <div class="block-stuffs clr">
                    <div class="span span2 m alone">
                        <a href="/bai-viet">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="public/v2/img/icon-section-1.svg" alt=""></figure>
                                <div class="info">
                                    <h3 key="news" class="langtr">NEWS</h3>
                                    <p key="newsmedic" class="langtr fs1">A variety of medical news and articles</p>
                                </div>
                            </div>
                        </a>
                        <a href="/bai-viet/danh-sach-nha-thuoc">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="public/v2/img/icon-section-3.svg" alt=""></figure>
                                <div class="info">
                                    <h3 key="dmnt" class="langtr">LIST OF DRUGS</h3>
                                    <p key="dmnt2" class="langtr fs1">More than 50,000 pharmacies nationwide</p>
                                </div>
                            </div>
                        </a>
                        <a href="/thuoc">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="public/v2/img/icon-section-5.svg" alt=""></figure>
                                <div class="info">
                                    <h3 key="smedic" class="langtr">MEDICINE</h3>
                                    <p key="smedic2" class="langtr fs1">Information over 50,000 drugs</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="span span2 m alone">
                        <a href="/benh">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="public/v2/img/icon-section-2.svg" alt=""></figure>
                                <div class="info">
                                    <h3 key="ssick1" class="langtr">RESEARCH IN DISEASE</h3>
                                    <p key="ssick2" class="langtr fs1">Look up more than 60,000 types of diseases</p>
                                </div>
                            </div>
                        </a>
                        <a href="/danh-sach-bac-si">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="public/v2/img/icon-section-4.svg" alt=""></figure>
                                <div class="info">
                                    <h3 key="dmbs1" class="langtr">DOCTOR'S LIST</h3>
                                    <p key="dmbs2" class="langtr fs1">More than 15,000 doctors linked information</p>
                                </div>
                            </div>
                        </a>
                        <a href="/danh-sach">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="public/v2/img/icon-section-7.svg" alt=""></figure>
                                <div class="info">
                                    <h3 key="dmpk1" class="langtr">LIST OF DEPARTMENTS</h3>
                                    <p key="dmpk2" class="langtr fs1">More than 10,000 examination rooms and hospitals nationwide</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="counters">
        <div class="inner">
            <div class="has-bg clr">
                <div class="span span4 m alone text-center">
                    <h1 class="counter ctr1" data-count="10968">0</h1>
                    <em key="cli" class="langtr">Clinic</em></div>
                <div class="span span4 m alone text-center">
                    <h1 class="counter ctr2" data-count="15121">0</h1>
                    <em key="doc" class="langtr">Doctor</em></div>
                <div class="span span4 m alone text-center">
                    <h1 class="counter ctr3" data-count="51345">0</h1>
                    <em key="drug" class="langtr">Drugstore</em></div>
                <div class="span span4 m alone text-center">
                    <h1 class="counter ctr4" data-count="112652">0</h1>
                    <em key="panti" class="langtr">Patient</em></div>
            </div>
        </div>
    </section>
    <section id="services">
        <div class="inner">
            <div class="block-services">
                <div class="v-list" data-aos="fade-up">
                    <h2 key="sv" class="heading langtr">Services</h2>
                    <ul>
                        <li> <a key="svp" class="langtr fs1" href="#"> Urgent Care </a> </li>
                        <li> <a key="sve" class="langtr fs1" href="#"> Behavioral Health </a> </li>
                        <li> <a key="svephye" class="langtr fs1" href="#"> Preventive Health </a> </li>
                        <li> <a key="svnur" class="langtr fs1" href="#"> Chronic Care </a> </li>
                    </ul>
                    {{--<a href="#" class="btn btn-default rounded"></a>--}}
                </div>
                <div class="h-list">
                    <h2 class="cat-title"><span class="title"></span></h2>
                    <em key="svs" class="langtr">Support services</em>
                    <div class="sv-slider owl-carousel owl-theme">
                        <div class="item" data-aos="fade-up">
                            <a href="#" class="hover hover-zoom">
                                <figure><img src="public/v2/img/ambulance.jpg" alt=""></figure>
                                <div class="info">
                                    <h3 key = "svvc" class = "langtr"> Urgent Care </h3>
                                    <p key = "svvc2" class = "langtr fs">
                                        Rethinking the way you receive care
                                        Our approach to care is all about breaking down the walls of an office and supporting your health wherever you are.
                                        Our Vietnam-based, board-certified doctors and licensed psychologists are available on your schedule.
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="item" data-aos="fade-up">
                            <a href="#" class="hover hover-zoom">
                                <figure><img src="public/v2/img/khamtainha.jpg" alt=""></figure>
                                <div class="info">
                                    <h3 key = "svh" class = "langtr"> Behavioral Health </h3>
                                    <p key = "svh2" class = "langtr fs">
                                        When you’re sick and need to see a doctor, our team is standing by around the clock. Available 24/7, our providers can help get you on track as well as order prescriptions, if needed. We’ll take the hassle and guesswork out of feeling better.
                                        For select health plans and employers, we can offer treatment programs and plans to help manage specific issues and conditions.
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="item" data-aos="fade-down">
                            <a href="#" class="hover hover-zoom">
                                <figure><img src="public/v2/img/khamdinhkytongquat.jpg" alt=""></figure>
                                <div class="info">
                                    <h3 key = "svh5" class = "langtr"> Preventive Health </h3>
                                    <p key = "svh6" class = "langtr fs">
                                        Our attentive care team Doctor with you to support your day-to-day health and self-care routines. From healthy eating to preventive lab screenings, we bring together trusted Doctor with solutions that actually work in the real world.
                                        For select health plans, we can offer treatment programs and plans to help manage specific issues and conditions.
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="item" data-aos="fade-in">
                            <a href="#" class="hover hover-zoom">
                                <figure><img src="public/v2/img/dieuduongtainha.jpg" alt=""></figure>
                                <div class="info">
                                    <h3 key = "svh7" class = "langtr"> Chronic Care </h3>
                                    <p key = "svh8" class = "langtr fs">
                                        Our approach to care gives you the flexibility to focus on your health when it works for you. When you need to manage an ongoing or chronic health conditions, we make it easy and are there in the touch of a button.
                                        For select health plans, we can offer treatment programs and plans to help manage specific issues and conditions.
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <script>
         $(document).ready(function () {
             setHeightEqualWidth();
             function setHeightEqualWidth() {
                 let widthImage = $('.img-slider-home').width();
                 let height = widthImage*1.2;
                 $('.img-slider-home').css("height", height + "px");
             }
             $(window).resize(function() {
                 setHeightEqualWidth();
             });
         });
     </script>
    <section id="specialists">
        <div class="inner">
           <h2 class = "cat-title"> <span key = "bsnb1" class = "title langtr"> Featured doctors </span> </h2>
            <em style="max-width:unset;" key = "bsnb2" class = "langtr"> List of highly interactive doctors on the system </em>
            <div class="content" style="width: 100%;">
                <div class="dr-slider owl-carousel owl-theme">
                    @if(isset($doctors))
                        @foreach($doctors as $doctor)
                            <div class="item" data-aos="fade-up">
                                <figure class="hover hover-zoom"><img class="img-slider-home" style="width: 100%;" src="
                @if($doctor->profile_image == '')
                                            https://n6-img-fp.akamaized.net/free-vector/doctor-character-background_1270-84.jpg?size=338&ext=jpg
                @else
                                    {{url('public/images/doctor/'.$doctor->profile_image)}}"
                                                                      alt="{{$doctor->doctor_name}}"
                                                                      @endif title="{{$doctor->doctor_name}}">
                                    <figcaption><a href="#"></a>
                                        <span>{{$doctor->doctor_name}}</span><em>{{$doctor->doctorspeciality->speciality->speciality_name}}</em>
                                    </figcaption>
                                </figure>
                            </div>
                        @endforeach
                @endif
                    {{--<div class="item" data-aos="fade-up">--}}
                    {{--<figure class="hover hover-zoom"><img src="public/v2/img/photo-1541044714743-82d583a7bd64.jpg" alt="">--}}
                    {{--<figcaption> <a href="#"><i class="fab fa-facebook"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-google-plus"></i></a> <span>Tên bác sĩ</span><em>Chức vụ</em> </figcaption>--}}
                    {{--</figure>--}}
                    {{--</div>--}}
                    {{--<div class="item" data-aos="fade-up">--}}
                    {{--<figure class="hover hover-zoom"><img src="public/v2/img/photo-1544723495-432537d12f6c.jpg" alt="">--}}
                    {{--<figcaption> <a href="#"><i class="fab fa-facebook"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-google-plus"></i></a> <span>Tên bác sĩ</span><em>Chức vụ</em> </figcaption>--}}
                    {{--</figure>--}}
                    {{--</div>--}}
                    {{--<div class="item" data-aos="fade-down">--}}
                    {{--<figure class="hover hover-zoom"><img src="public/v2/img/photo-1549024080-61c44c983c91.jpg" alt="">--}}
                    {{--<figcaption> <a href="#"><i class="fab fa-facebook"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-google-plus"></i></a> <span>Tên bác sĩ</span><em>Chức vụ</em> </figcaption>--}}
                    {{--</figure>--}}
                    {{--</div>--}}
                    {{--<div class="item" data-aos="fade-in">--}}
                    {{--<figure class="hover hover-zoom"><img src="public/v2/img/photo-1494571180607-f17765ead771.jpg" alt="">--}}
                    {{--<figcaption> <a href="#"><i class="fab fa-facebook"></i></a> <a href="#"><i class="fab fa-twitter"></i></a> <a href="#"><i class="fab fa-google-plus"></i></a> <span>Tên bác sĩ</span><em>Chức vụ</em> </figcaption>--}}
                    {{--</figure>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </section>
@endsection