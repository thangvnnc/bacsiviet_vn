@extends('v2/view/en/en_main',['title'=> 'Home'])
@section('en_content')
     <div class="global-thread-create-cta">
            <a href="/hoibacsi/datcauhoi/" class="button">
                <i class="fa fa-question-circle" aria-hidden="true"></i>
                <strong>Ask doctor</strong>
                <span>free</span>
            </a>
        </div>
    <section id="register">
        <div class="inner clr">
            <div class="span span2 alone @if(Session::get('user') != null) h-center @endif">
                <div class="middle-item">
                    <div><img class="center" src="{{ asset('') }}/public/v2/img/home_two_mobiles_en.png" alt="">
                        <p class="text-center langtr" key="p-home" ><h2>Download the app to chat with the doctor</h2></p>
                        <div class="apps clr middle-item">
                            <a href="https://itunes.apple.com/us/app/medixlink/id1443310734?ls=1&amp;mt=8"><img
                                        src="{{ asset('') }}/public/v2/img/appstore.svg" alt=""></a>
                            <a href="https://play.google.com/store/apps/details?id=com.app.khambenh.bacsiviet"><img
                                        src="{{ asset('') }}/public/v2/img/playstore.svg" alt=""></a>
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
                <h2 class="cat-title"><span key="gt" class="title langtr">Communication</span></h2>
                <em key="conn" class="langtr">Connect online health wherever you are</em></div>
            <div class="inner">
                <div class="com-slider owl-carousel owl-theme">
                    <div class="item" data-aos="fade-up">
                        <figure><img src="{{ asset('') }}/public/v2/img/slider-1.jpg" alt="">
                            <figcaption>
                                <p key="func" class="langtr">1. The function of searching drugs, searching for pharmaceuticals in the list of over 60,000 types drug</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <figure><img src="{{ asset('') }}/public/v2/img/slider-2.jpg" alt="">
                            <figcaption>
                                <p key="ssick" class="langtr">2. Look up disease with her more than 50,000 diseases</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-up">
                        <figure><img src="{{ asset('') }}/public/v2/img/slider-3.jpg" alt="">
                            <figcaption>
                                <p key="catedt" class="langtr">3. List of more than 1000 doctors nationwide on the system</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-down">
                        <figure><img src="{{ asset('') }}/public/v2/img/slider-4.jpg" alt="">
                            <figcaption>
                                <p key="gquest" class="langtr">4. Send questions directly on the web</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-in">
                        <figure><img src="{{ asset('') }}/public/v2/img/slider-5.jpg" alt="">
                            <figcaption>
                                <p key="chatdt" class="langtr">5. Chat text directly with a good doctor on the App on the phone anytime, anywhere</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-in">
                        <figure><img src="{{ asset('') }}/public/v2/img/slider-6.jpg" alt="">
                            <figcaption>
                                <p key="chataudi" class="langtr">6. Chat Audio speaks directly to doctors anytime, anywhere</p>
                            </figcaption>
                        </figure>
                    </div>
                    <div class="item" data-aos="fade-in">
                        <figure><img src="{{ asset('') }}/public/v2/img/slider-7.jpg" alt="">
                            <figcaption>
                                <p key="chatvideo" class="langtr">7. Video chat webcam camera talk directly with the doctor anytime, anywhere</p>
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
                                <figure><img src="{{ asset('') }}/public/v2/img/icon-section-1.svg" alt=""></figure>
                                <div class="info">
                                    <h3 key="news" class="langtr">NEWS</h3>
                                    <p key="newsmedic" class="langtr fs1">A variety of medical news and articles</p>
                                </div>
                            </div>
                        </a>
                        <a href="/bai-viet/danh-sach-nha-thuoc">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="{{ asset('') }}/public/v2/img/icon-section-3.svg" alt=""></figure>
                                <div class="info">
                                    <h3 key="dmnt" class="langtr">LIST OF DRUGS</h3>
                                    <p key="dmnt2" class="langtr fs1">More than 50,000 pharmacies nationwide</p>
                                </div>
                            </div>
                        </a>
                        <a href="/thuoc">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="{{ asset('') }}/public/v2/img/icon-section-5.svg" alt=""></figure>
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
                                <figure><img src="{{ asset('') }}/public/v2/img/icon-section-2.svg" alt=""></figure>
                                <div class="info">
                                    <h3 key="ssick1" class="langtr">RESEARCH IN DISEASE</h3>
                                    <p key="ssick2" class="langtr fs1">Look up more than 60,000 types of diseases</p>
                                </div>
                            </div>
                        </a>
                        <a href="/danh-sach-bac-si">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="{{ asset('') }}/public/v2/img/icon-section-4.svg" alt=""></figure>
                                <div class="info">
                                    <h3 key="dmbs1" class="langtr">DOCTOR'S LIST</h3>
                                    <p key="dmbs2" class="langtr fs1">More than 15,000 doctors linked information</p>
                                </div>
                            </div>
                        </a>
                        <a href="/danh-sach">
                            <div class="block-stuff" data-aos="fade-up">
                                <figure><img src="{{ asset('') }}/public/v2/img/icon-section-7.svg" alt=""></figure>
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
    
@endsection